<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorCollectionResource;
use App\Services\VendorService;

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
     * @return VendorCollectionResource
     */
    public function list(): VendorCollectionResource
    {
        $vendors = $this->vendorService->getPaginatedList();
        return new VendorCollectionResource($vendors);
    }
}
