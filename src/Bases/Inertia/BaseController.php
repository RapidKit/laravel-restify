<?php

namespace RapidKit\LaravelRestify\Bases\Inertia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;
use RapidKit\LaravelRestify\Bases\BaseModel;
use RapidKit\LaravelRestify\Bases\BaseService;
use Spatie\QueryBuilder\QueryBuilder;

class BaseController extends Controller
{
    protected $perPage = 15;
    protected $filterable = [];
    protected $sortable = [];
    protected $defaultSort = '-id';

    public function __construct(
        protected BaseModel $model,
        protected BaseService $service,
        protected string $indexRouteName = 'index',
    ) {
    }

    public function index(): ResponseFactory|Response
    {
        return inertia($this->service->getIndexPage(), [
            'items' => QueryBuilder::for($this->model->query())
                ->allowedFilters($this->model->filterable ?? [])
                ->allowedSorts($this->model->sortable ?? [])
                ->defaultSort($this->model->defaultSort ?? '-id')
                ->paginate(request()->get('limit', $this->perPage)),
        ]);
    }

    public function store(BaseStoreRequest $request)
    {
        $message = $this->service->storing($request->toDto());

        return to_route($this->indexRouteName)->with('flashMessage', $message);
    }

    public function update(BaseUpdateRequest $request, int|string $id)
    {
        $page = $request->input('page', 1);
        $sort = $request->input('sort', '-id');
        $limit = $request->input('limit', 15);
        $modelInstance = $this->model->query()->findOrFail($id);
        $message = $this->service->updating($request->toDto(), $modelInstance);

        return to_route($this->indexRouteName, compact('page', 'sort', 'limit'))->with('flashMessage', $message);
    }

    public function destroy(Request $request, string|int $id)
    {
        $modelInstance = $this->model->query()->findOrFail($id);
        $message = $this->service->deleting($modelInstance);

        return $this->getRedirector($request)->with('flashMessage', $message);
    }

    protected function getRedirector(Request $request)
    {
        $previousURL = $request->session()->get('_previous.url');
        parse_str(parse_url($previousURL, PHP_URL_QUERY), $params);

        $page = (int) ($params['page'] ?? $request->get('page') ?? '1');
        $limit = (int) ($params['limit'] ?? '15');
        $recordCount = $this->model->query()->count() - 1;
        $maxPage = (int) ceil($recordCount / $limit);
        $redirector = redirect()->back();

        if ($maxPage < $page) {
            $redirector = redirect()->route($this->indexRouteName, ['page' => $maxPage]);
        }

        return $redirector;
    }
}
