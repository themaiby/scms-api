<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComponentCreateRequest;
use App\Http\Requests\ComponentUpdateRequest;
use App\Http\Resources\CollectionResponse;
use App\Http\Resources\ItemResponse;
use App\Models\Component;
use App\Services\ComponentService;
use App\Services\PaginationService;
use Exception;
use Illuminate\Http\JsonResponse;

class ComponentsController extends Controller
{
    /**
     * @var PaginationService
     */
    private $paginationService;

    /**
     * @var ComponentService
     */
    private $componentService;

    public function __construct(PaginationService $pagination, ComponentService $componentService)
    {
        $this->paginationService = $pagination;
        $this->componentService = $componentService;
    }

    /**
     * @return CollectionResponse
     */
    public function getList(): CollectionResponse
    {
        $perPage = $this->paginationService->getPerPage();
        $list = Component::paginate($perPage);
        return new CollectionResponse($list);
    }

    /**
     * @param ComponentCreateRequest $request
     * @return ItemResponse
     */
    public function create(ComponentCreateRequest $request): ItemResponse
    {
        $component = $this->componentService->createComponent($request);
        return new ItemResponse($component->refresh());
    }

    /**
     * @param Component $component
     * @param ComponentUpdateRequest $request
     * @return ItemResponse
     */
    public function update(Component $component, ComponentUpdateRequest $request): ItemResponse
    {
        $component = $this->componentService->updateComponent($component, $request);
        return new ItemResponse($component->refresh()->load(['vendor']));
    }

    /**
     * @param Component $component
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Component $component): JsonResponse
    {
        $component->delete();
        return response()->json(['message' => 'Success']);
    }
}
