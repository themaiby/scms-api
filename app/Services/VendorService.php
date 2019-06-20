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

    public function __construct(PaginationService $paginationService)
    {
        $this->paginationService = $paginationService;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(): LengthAwarePaginator
    {
        $perPage = $this->paginationService->getPerPage();
        return Vendor::paginate($perPage, ['id', 'name', 'description', 'created_at']);
    }
}
