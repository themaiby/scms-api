<?php

namespace App\Http\Controllers;

use App\Exceptions\ComponentQuantityException;
use App\Http\Requests\OrderComponentCreateRequest;
use App\Http\Requests\OrderComponentUpdateRequest;
use App\Http\Resources\ItemResponse;
use App\Models\Component;
use App\Models\Order;
use App\Models\OrderComponent;
use Exception;
use Illuminate\Http\JsonResponse;

class OrderComponentsController extends Controller
{
    /**
     * @param Order $order
     * @param OrderComponentCreateRequest $request
     * @return ItemResponse
     * @throws ComponentQuantityException
     */
    public function create(Order $order, OrderComponentCreateRequest $request): ItemResponse
    {
        $componentID = $request->get('component_id');
        $quantity = Component::find($componentID)->quantity;

        if ($quantity < $request->get('quantity')) {
            throw new ComponentQuantityException();
        }

        $component = $order->components()->create($request->all());
        return new ItemResponse($component);
    }

    /**
     * @param Order $order
     * @param OrderComponent $orderComponent
     * @param OrderComponentUpdateRequest $request
     * @return ItemResponse
     * @throws ComponentQuantityException
     */
    public function update(Order $order, OrderComponent $orderComponent, OrderComponentUpdateRequest $request): ItemResponse
    {
        $orderComponent->load('sourceComponent');
        $summaryQuantity = $orderComponent->quantity + $orderComponent->sourceComponent->quantity;
        $newQuantity = $request->get('quantity');

        if ($summaryQuantity >= $newQuantity) {
            $orderComponent->update(['quantity' => $newQuantity]);
            return new ItemResponse($orderComponent);
        }

        throw new ComponentQuantityException();
    }

    /**
     * @param Order $order
     * @param OrderComponent $orderComponent
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Order $order, OrderComponent $orderComponent): JsonResponse
    {
        $orderComponent->delete();
        return response()->json(['message' => 'Success']);
    }
}
