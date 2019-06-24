<?php

namespace App\Traits;

use App\Services\PaginationService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use ReflectionException;

trait FieldSelectable
{
    /**
     * @var PaginationService
     */
    private $paginationService;

    /**
     * FieldSelectable constructor.
     * @param PaginationService $paginationService
     */
    public function __construct(PaginationService $paginationService)
    {
        $this->paginationService = $paginationService;
    }

    /**
     * get fields which was requested by client in `fields` field
     * Only for GET requests
     * In case when its no fields requested - return all available
     * @param array $availableFields
     * @return array
     */
    public function getRequestedFields($availableFields): array
    {
        $requestedFields = request()->get('fields');

        if (!$requestedFields) {
            return $availableFields;
        }

        $fields = collect(explode(',', $requestedFields));

        return $fields->intersect($availableFields)->toArray();
    }

    /**
     * @param string $modelName
     * @param array $availableFields
     * @return LengthAwarePaginator
     * @throws ReflectionException
     */
    public function withRelations(string $modelName, array $availableFields): LengthAwarePaginator
    {
        $reflection = new ReflectionClass($modelName);

        // Checking for model instance
        if (!$reflection->getParentClass()->name === Model::class) {
            throw new ReflectionException(
                'Given class (' . $reflection->getParentClass()->getName() . ') must be compatible with ' . Model::class
            );
        }

        $fields = $this->getRequestedFields($availableFields);
        $relations = [];

        foreach ($fields as $field) {
            if ($reflection->hasMethod($field)) {
                $relations[] = $field;
            }
        }

        // Removing relations from query builder
        $fields = collect($fields)->reject(static function ($value) use ($relations) {
            foreach ($relations as $relation) {
                if ($relation === $value) {
                    return true;
                }
            }
            return false;
        })->toArray();

        return $modelName::with($relations)->paginate($this->paginationService->getPerPage(), $fields);
    }
}
