<?php

namespace App\Http\Resources\Api\Links\ByUserId;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkShows extends JsonResource
{
    public function toArray($request)
    {
        return [
            'date'    => $this->show_date,
            'address' => $this->address,
            'status'  => $this->status,
        ];
    }
}
