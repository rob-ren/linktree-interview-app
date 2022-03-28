<?php

namespace App\Http\Resources\Api\Links\ByUserId;

use App\Http\Resources\Api\Links\ByUserId\MetaData as MetaDataResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Link extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'url'         => $this->url,
            'type'        => $this->type,
            'meta'        => new MetaDataResource($this),
            'createdDate' => $this->created_time,
            'updatedDate' => $this->updated_time
        ];
    }
}
