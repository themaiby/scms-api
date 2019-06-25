<?php


namespace App\Services;

/**
 * Class PaginationService
 * @package App\Services
 */
class PaginationService
{
    public const PER_PAGE_MAX = 100;
    public const PER_PAGE_DEFAULT = 30;

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        $perPageRequested = request()->get('perPage');

        if ($perPageRequested === null) {
            return self::PER_PAGE_DEFAULT;
        }

        if ($perPageRequested > self::PER_PAGE_MAX) {
            return self::PER_PAGE_MAX;
        }

        return (int)$perPageRequested;
    }
}
