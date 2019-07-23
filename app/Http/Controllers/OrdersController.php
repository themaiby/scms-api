<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Resources\CollectionResponse;
use App\Http\Resources\ItemResponse;
use App\Models\Order;
use App\Services\PaginationService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * @var PaginationService
     */
    private $paginationService;

    /**
     * OrdersController constructor.
     * @param PaginationService $paginationService
     */
    public function __construct(PaginationService $paginationService)
    {
        $this->paginationService = $paginationService;
    }

    /**
     * @return CollectionResponse
     */
    public function getList(): CollectionResponse
    {
        $perPage = $this->paginationService->getPerPage();
        return new CollectionResponse(
            Order::with([])
                ->paginate($perPage)
        );
    }

    /**
     * @param Order $order
     * @return ItemResponse
     */
    public function get(Order $order): ItemResponse
    {
        return new ItemResponse($order->load('partner', 'status', 'type', 'components'));
    }

    /**
     * @param OrderCreateRequest $request
     * @return ItemResponse
     * @throws AuthenticationException
     */
    public function create(OrderCreateRequest $request): ItemResponse
    {
        $user = Auth::user();

        if ($user) {
            /** @var Order $order */
            $order = $user->orders()->create($request->all());
            return $this->get($order);
        }

        throw new AuthenticationException();
    }

    /**
     * @param Order $order
     * @param OrderUpdateRequest $request
     * @return ItemResponse
     */
    public function update(Order $order, OrderUpdateRequest $request): ItemResponse
    {
        $order->update($request->all());
        return $this->get($order->refresh());
    }

    /**
     * @param Order $order
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Order $order): JsonResponse
    {
        $order->delete();
        return response()->json(['message' => 'Success']);
    }
}
