<?php

namespace App\Http\Resources\Api\Links\ByUserId;

use App\Models\Entity\Link;
use Illuminate\Http\Resources\Json\JsonResource;

class MetaData extends JsonResource
{
    public function toArray($request)
    {
        if ($this->type == Link::TYPE_CLASSIC) {
            return [];
        }
        if ($this->type == Link::TYPE_MUSIC) {
            return [
                'name' => $this->link_music->name,
                'url'  => $this->link_music->url,
            ];
        }
        if ($this->type == Link::TYPE_SHOW) {
            return [
                'date'    => $this->link_shows->date,
                'address' => $this->link_shows->address,
                'status'  => $this->link_shows->status,
            ];
        }
        return [];
    }
}
