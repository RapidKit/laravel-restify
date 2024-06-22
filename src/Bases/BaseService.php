<?php

declare(strict_types=1);

namespace RapidKit\LaravelRestify\Bases;

use Illuminate\Support\Str;

abstract class BaseService
{
    protected string $entityName;
    protected string $singularTableName;

    protected array $successMessages;
    protected array $failureMessages;

    public function __construct(
        protected BaseModel $model,
        array $successMessages = [
            'storing' => '%s created successfully!',
            'updating' => '%s updated successfully!',
            'deleting' => '%s deleted successfully!',
        ],
        array $failureMessages = [
            'storing' => 'Failed to create %s!',
            'updating' => 'Failed to update %s!',
            'deleting' => 'Failed to delete %s!',
        ]
    ) {
        $this->entityName = Str::singular($this->model->getTable());
        $this->singularTableName = Str::singular($this->model->getTable());
        $this->successMessages = $successMessages;
        $this->failureMessages = $failureMessages;
    }

    public function getSingularTableName(): string
    {
        return $this->singularTableName;
    }

    public function getIndexPage(): string
    {
        return "{$this->singularTableName}/index/page";
    }

    public function getIndexRouteName(): string
    {
        return "{$this->singularTableName}.index";
    }

    protected function handleException(\Exception $exception, string $action): array
    {
        report($exception);
        $type = 'error';
        $message = sprintf($this->failureMessages[$action], $this->entityName);

        return compact('type', 'message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BaseData $dto
     * @return array
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function storing(BaseData $dto): array
    {
        try {
            $this->model->create($dto->toArray());
            $type = 'success';
            $message = sprintf($this->successMessages['storing'], $this->entityName);
        } catch (\Exception $exception) {
            return $this->handleException($exception, 'storing');
        }

        return compact('type', 'message');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BaseData $dto
     * @param BaseModel $author
     * @return array
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function updating(BaseData $dto, BaseModel $author): array
    {
        try {
            $author->update($dto->toArray());
            $type = 'success';
            $message = sprintf($this->successMessages['updating'], $this->entityName);
        } catch (\Exception $exception) {
            return $this->handleException($exception, 'updating');
        }

        return compact('type', 'message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BaseModel $author
     * @return array
     * @throws BindingResolutionException
     */
    public function deleting(BaseModel $author): array
    {
        try {
            $author->delete();
            $type = 'success';
            $message = sprintf($this->successMessages['deleting'], $this->entityName);
        } catch (\Exception $exception) {
            return $this->handleException($exception, 'deleting');
        }

        return compact('type', 'message');
    }
}
