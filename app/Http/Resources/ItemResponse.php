<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResponse extends JsonResource
{
    public static $wrap = 'result';

    public function with($request)
    {
        return ['response_time' => microtime(true) - LARAVEL_START,];
    }
}
