<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVendorRequest;
use App\Http\Resources\CollectionResponse;
use App\Http\Resources\ItemResponse;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Services\VendorService;
use Exception;

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
     * @param CreateVendorRequest $vendorRequest
     * @return ItemResponse
     */
    public function create(CreateVendorRequest $vendorRequest): ItemResponse
    {
        $vendor = Vendor::create($vendorRequest->all());
        return new ItemResponse($vendor);
    }

    /**
     * @param Vendor $vendor
     * @return ItemResponse
     * @throws Exception
     */
    public function delete(Vendor $vendor): ItemResponse
    {
        $vendor->delete();
        return response();
    }
}
