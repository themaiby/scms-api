<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Services\VendorService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     * @return AnonymousResourceCollection
     */
    public function getList(): AnonymousResourceCollection
    {
        $vendors = $this->vendorService->getList();
        return VendorResource::collection($vendors);
    }

    /**
     * @param Vendor $vendor
     * @return VendorResource
     */
    public function get(Vendor $vendor): VendorResource
    {
        $vendor->load(['user', 'components', 'components.category']);
        return new VendorResource($vendor);
    }
}
