<?php

declare(strict_types=1);

namespace RapidKit\LaravelRestify\Bases;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;

class BaseController extends Controller
{
    /**
     * Get the model instance.
     *
     * @return BaseModel
     */
    public function model()
    {
        return new BaseModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Paginator|LengthAwarePaginator<array-key, BaseData>
     */
    public function index(): Paginator|LengthAwarePaginator
    {
        return QueryBuilder::for($this->model()->query())
            ->allowedFilters($this->model()->filterable ?? [])
            ->defaultSort($this->model()->sortable ?? [])
            ->allowedSorts($this->model()->sortable ?? [])
            ->latest('id')
            ->paginate(request()->get('limit', 15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BaseRequest $request): BaseModel
    {
        $attributes = $request->toDto();

        return $this->model()->query()->create($attributes->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(string|int $id): BaseModel
    {
        return $this->model()->query()->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BaseRequest $request, string|int $id): \Illuminate\Http\Response
    {
        $item = $this->model()->query()->findOrFail($id);
        $item->update($request->toDto()->toArray());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string|int $id): \Illuminate\Http\Response
    {
        $item = $this->model()->query()->findOrFail($id);
        $item->delete();

        return response()->noContent();
    }
}
