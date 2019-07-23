<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStatusCreateRequest;
use App\Http\Resources\CollectionResponse;
use App\Http\Resources\ItemResponse;
use App\Models\OrderStatus;

class OrderStatusesController extends Controller
{
    /**
     * @param OrderStatusCreateRequest $request
     * @return ItemResponse
     */
    public function create(OrderStatusCreateRequest $request): ItemResponse
    {
        $status = OrderStatus::create($request->all());
        return new ItemResponse($status);
    }

    /**
     * @return CollectionResponse
     */
    public function getList(): CollectionResponse
    {
        return new CollectionResponse(OrderStatus::all());
    }
}
