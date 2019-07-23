<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerContactCreateRequest;
use App\Http\Resources\ItemResponse;
use App\Models\Partner;
use App\Models\PartnerContact;
use Exception;
use Illuminate\Http\JsonResponse;

class PartnerContactsController extends Controller
{
    /**
     * @param Partner $partner
     * @param PartnerContactCreateRequest $request
     * @return ItemResponse
     */
    public function create(Partner $partner, PartnerContactCreateRequest $request): ItemResponse
    {
        $contact = $partner->contacts()->create($request->all());
        return new ItemResponse($contact);
    }

    /**
     * @param Partner $partner
     * @param PartnerContact $contact
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Partner $partner, PartnerContact $contact): JsonResponse
    {
        $contact->delete();
        return response()->json(['message' => 'Success']);
    }
}
