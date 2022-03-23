<?php

namespace App\Http\Resources\Api\Links\ByUserId;

use App\Http\Resources\Api\Links\ByUserId\Link as LinkResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Root extends JsonResource
{
    public function toArray($request)
    {
        $response = [
            'data' => LinkResource::collection($this)
        ];

        return $response;
    }
}
