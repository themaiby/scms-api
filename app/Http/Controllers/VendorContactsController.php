<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorContactCreateRequest;
use App\Http\Resources\ItemResponse;
use App\Models\Vendor;
use App\Models\VendorContact;
use Exception;
use Illuminate\Http\JsonResponse;

class VendorContactsController extends Controller
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

    /**
     * @param Vendor $vendor
     * @param VendorContact $contact
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Vendor $vendor, VendorContact $contact): JsonResponse
    {
        $contact->delete();
        return response()->json(['message' => 'Success']);
    }
}
