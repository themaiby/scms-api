<?php

namespace App\Services;

use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class VendorService
 * @package App\Services
 */
class VendorService
{
    /**
     * @var PaginationService
     */
    private $paginationService;

    /**
     * VendorService constructor.
     * @param PaginationService $paginationService
     */
    public function __construct(PaginationService $paginationService)
    {
        $this->paginationService = $paginationService;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getList(): LengthAwarePaginator
    {
        $perPage = $this->paginationService->getPerPage();
        $availableFields = ['id', 'name', 'description', 'components_cost', 'components_count', 'created_at'];

        return Vendor::paginate($perPage, $availableFields);
    }
}
