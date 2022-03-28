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
            return LinkMusic::collection($this->link_music);
        }
        if ($this->type == Link::TYPE_SHOW) {
            return LinkShows::collection($this->link_shows);
        }
        return [];
    }
}
