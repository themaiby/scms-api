<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CollectionResponse extends ResourceCollection
{
    public static $wrap = 'result';

    public function with($request)
    {
        return ['response_time' => microtime(true) - LARAVEL_START,];
    }
}
