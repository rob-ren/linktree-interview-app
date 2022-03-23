<?php

namespace App\Http\Resources\Api\Links\ByUserId;

use App\Http\Resources\Api\Links\ByUserId\MetaData as MetaDataResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Link extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name'        => $this->name,
            'url'         => $this->url,
            'type'        => $this->type,
            'meta'        => MetaDataResource::collection($this),
            'createdDate' => $this->created_date,
            'updatedDate' => $this->created_date
        ];
    }
}
