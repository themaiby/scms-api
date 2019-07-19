<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorContactCreateRequest;
use App\Http\Resources\ItemResponse;
use App\Models\Vendor;

class VendorContactController extends Controller
{

    /**
     * @param Vendor $vendor
     * @param VendorContactCreateRequest $request
     * @return ItemResponse
     */
    public function create(Vendor $vendor, VendorContactCreateRequest $request): ItemResponse
    {
        $contact = $vendor->contacts()->create($request->all());
        return new ItemResponse($contact);
    }
}
