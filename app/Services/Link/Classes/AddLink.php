<?php

namespace App\Services\Link\Classes;

use App\Models\Entity\Link;
use App\Models\Entity\LinkMusic;
use App\Models\Entity\LinkShows;
use Carbon\CarbonImmutable;

class AddLink
{
    private $user_id = 1;
    private $name;
    private $url;
    private $type;
    private $metadata;

    public function __construct($user, $name, $url, $type, $metadata)
    {
        $this->name     = $name;
        $this->url      = $url;
        $this->type     = $type;
        $this->metadata = $metadata;
    }

    public function save()
    {
        // save link entity
        $link               = new Link();
        $link->user_id      = $this->user_id;
        $link->title        = $this->name;
        $link->url          = $this->url;
        $link->type         = $this->type;
        $link->created_time = CarbonImmutable::now();
        $link->updated_time = CarbonImmutable::now();
        $link->save();

        // save link music for link
        if ($this->type == Link::TYPE_MUSIC) {
            foreach ($this->metadata as $platform_data) {
                $link_music               = new LinkMusic();
                $link_music->link_id      = $link->id;
                $link_music->platform     = $platform_data->name;
                $link_music->platform_url = $platform_data->url;
                $link_music->created_time = CarbonImmutable::now();
                $link_music->updated_time = CarbonImmutable::now();
                $link_music->save();
            }
        }
        // save link show for link
        if ($this->type == Link::TYPE_SHOW) {
            foreach ($this->metadata as $shows_data) {
                $link_music               = new LinkShows();
                $link_music->link_id      = $link->id;
                $link_music->show_date    = $shows_data->date;
                $link_music->address      = $shows_data->address;
                $link_music->status       = $shows_data->status;
                $link_music->created_time = CarbonImmutable::now();
                $link_music->updated_time = CarbonImmutable::now();
                $link_music->save();
            }
        }

        return true;
    }
}
