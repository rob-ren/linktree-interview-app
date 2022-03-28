<?php

namespace App\Http\Resources\Api\Links\ByUserId;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkMusic extends JsonResource
{
    public function toArray($request)
    {
        return [
            'platform' => $this->platform,
            'url'      => $this->platform_url,
        ];
    }
}
