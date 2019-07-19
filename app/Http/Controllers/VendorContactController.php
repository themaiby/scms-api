<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVendorContactRequest;
use App\Http\Resources\ItemResponse;
use App\Models\Vendor;

class VendorContactController extends Controller
{

    /**
     * @param Vendor $vendor
     * @param CreateVendorContactRequest $request
     * @return ItemResponse
     */
    public function create(Vendor $vendor, CreateVendorContactRequest $request): ItemResponse
    {
        $contact = $vendor->contacts()->create($request->all());
        return new ItemResponse($contact);
    }
}
