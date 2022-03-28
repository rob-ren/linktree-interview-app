<?php

namespace App\Services\Link\Classes;

use App\Models\Entity\Link;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

class GetLinksByUserId
{
    private $user_id;
    private $order_by;
    private $order;

    public function __construct($user, $user_id, $order_by, $order)
    {
        $this->user_id  = $user_id;
        $this->order_by = $order_by;
        $this->order    = $order;
    }

    public function getData()
    {
        /**
         * TODO:
         * Query DB link by user_id
         * Option1: Join query
         * SELECT
         * l.title,
         * l.type,
         * l.url,
         * lm.platform as music_platform,
         * lm.platform_url as music_url,
         * ls.show_date,
         * ls.address AS show_date,
         * ls.status AS show_status
         * FROM
         * 	link l
         * 	LEFT JOIN link_music lm ON lm.link_id = l.id
         * 	LEFT JOIN link_shows ls ON ls.link_id = l.id
         * WHERE
         * 	l.user_id = {user_id}
         * ORDER BY l.{order_by} {order}
         * 
         * Option2: Eager loading
         * Select * from link where user_id = {user_id} ORDER BY l.{order_by} {order};
         * Select * from link_music where link_id in (id1, id2, id3);
         * Select * from link_shows where link_id in (id1, id2, id3);
         */
        // return new Collection();
        return Link::with(
            ['link_music', 'link_shows']
        )->where('user_id', $this->user_id)
            ->orderBy($this->order_by, $this->order)
            ->get();
    }

    public function getAllTheData()
    {
    }
}
