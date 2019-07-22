<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComponentCreateRequest;
use App\Http\Resources\CollectionResponse;
use App\Http\Resources\ItemResponse;
use App\Models\Component;
use App\Services\PaginationService;
use Auth;

class ComponentsController extends Controller
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
        $data = array_merge(['user_id' => Auth::id()], $request->all());
        $component = Component::create($data);
        return new ItemResponse($component->refresh());
    }
}
