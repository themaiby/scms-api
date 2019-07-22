<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorCreateRequest;
use App\Http\Requests\VendorUpdateRequest;
use App\Http\Resources\CollectionResponse;
use App\Http\Resources\ItemResponse;
use App\Models\Vendor;
use App\Services\VendorService;
use Auth;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;

class VendorsController extends Controller
{
    /**
     * @var VendorService
     */
    private $vendorService;

    /**
     * VendorsController constructor.
     * @param VendorService $vendorService
     */
    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    /**
     * @return CollectionResponse
     */
    public function getList(): CollectionResponse
    {
        $vendors = $this->vendorService->getList();
        return new CollectionResponse($vendors);
    }

    /**
     * @param Vendor $vendor
     * @return ItemResponse
     */
    public function get(Vendor $vendor): ItemResponse
    {
        $vendor->load([
            'user',
            'components',
            'components.category',
            'contacts'
        ]);
        return new ItemResponse($vendor);
    }

    /**
     * @param VendorCreateRequest $vendorRequest
     * @return ItemResponse
     * @throws AuthenticationException
     */
    public function create(VendorCreateRequest $vendorRequest): ItemResponse
    {
        $user = Auth::user();

        if ($user) {
            $vendor = $user->vendors()->create($vendorRequest->all());
            return new ItemResponse($vendor);
        }

        throw new AuthenticationException();
    }

    /**
     * @param Vendor $vendor
     * @param VendorUpdateRequest $request
     * @return ItemResponse
     */
    public function update(Vendor $vendor, VendorUpdateRequest $request): ItemResponse
    {
        $vendor->update($request->all());
        return $this->get($vendor);
    }

    /**
     * @param Vendor $vendor
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Vendor $vendor): JsonResponse
    {
        $vendor->delete();
        return response()->json(['message' => 'Success']);
    }
}
