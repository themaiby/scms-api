<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComponentCategoryCreateRequest;
use App\Http\Requests\ComponentCategoryUpdateRequest;
use App\Http\Resources\CollectionResponse;
use App\Http\Resources\ItemResponse;
use App\Models\ComponentCategory;
use App\Services\PaginationService;

class ComponentCategoriesController extends Controller
{
    /**
     * @var PaginationService
     */
    private $paginationService;

    public function __construct(PaginationService $pagination)
    {
        $this->paginationService = $pagination;
    }

    /**
     * @param ComponentCategoryCreateRequest $request
     * @return ItemResponse
     */
    public function create(ComponentCategoryCreateRequest $request): ItemResponse
    {
        $parent = ComponentCategory::find($request->get(ComponentCategoryCreateRequest::FIELD_PARENT_ID));
        $category = $parent->child()->create($request->all());
        return new ItemResponse($category);
    }

    /**
     * @return CollectionResponse
     */
    public function getList(): CollectionResponse
    {
        $perPage = $this->paginationService->getPerPage();
        $list = ComponentCategory::paginate($perPage);
        return new CollectionResponse($list);
    }

    /**
     * @param ComponentCategory $componentCategory
     * @param ComponentCategoryUpdateRequest $request
     * @return ItemResponse
     */
    public function update(ComponentCategory $componentCategory, ComponentCategoryUpdateRequest $request): ItemResponse
    {
        $componentCategory->update($request->all());
        return new ItemResponse($componentCategory->refresh());
    }
}
