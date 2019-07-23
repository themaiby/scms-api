<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerContactCreateRequest;
use App\Http\Requests\PartnerUpdateRequest;
use App\Http\Resources\CollectionResponse;
use App\Http\Resources\ItemResponse;
use App\Models\Partner;
use App\Services\PaginationService;
use Auth;
use Illuminate\Auth\AuthenticationException;

class PartnersController extends Controller
{
    /**
     * @var PaginationService
     */
    private $paginationService;

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
        return new CollectionResponse(Partner::with(['contacts'])->paginate($perPage));
    }

    /**
     * @param PartnerContactCreateRequest $request
     * @return ItemResponse
     * @throws AuthenticationException
     */
    public function create(PartnerContactCreateRequest $request): ItemResponse
    {
        $user = Auth::user();

        if ($user) {
            $partner = $user->partners()->create($request->all());
            return new ItemResponse($partner);
        }

        throw new AuthenticationException();
    }

    /**
     * @param Partner $partner
     * @param PartnerUpdateRequest $request
     * @return ItemResponse
     */
    public function update(Partner $partner, PartnerUpdateRequest $request): ItemResponse
    {
        $partner->update($request->all());
        return $this->get($partner->refresh());
    }

    /**
     * @param Partner $partner
     * @return ItemResponse
     */
    public function get(Partner $partner): ItemResponse
    {
        $partner->load(['contacts']);
        return new ItemResponse($partner);
    }
}
