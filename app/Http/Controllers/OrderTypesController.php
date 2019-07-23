<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderTypeCreateRequest;
use App\Http\Requests\OrderTypeUpdateRequest;
use App\Http\Resources\CollectionResponse;
use App\Http\Resources\ItemResponse;
use App\Models\OrderType;

class OrderTypesController extends Controller
{
    /**
     * @return CollectionResponse
     */
    public function getList(): CollectionResponse
    {
        $types = OrderType::all();
        return new CollectionResponse($types);
    }

    /**
     * @param OrderTypeCreateRequest $request
     * @return ItemResponse
     */
    public function create(OrderTypeCreateRequest $request): ItemResponse
    {
        $type = OrderType::create($request->all());
        return new ItemResponse($type);
    }

    /**
     * @param OrderType $type
     * @param OrderTypeUpdateRequest $request
     * @return ItemResponse
     */
    public function update(OrderType $type, OrderTypeUpdateRequest $request): ItemResponse
    {
        $type->update($request->all());
        return new ItemResponse($type->refresh());
    }
}
