<?php

namespace App\Services\Link\Classes;

use Illuminate\Support\Collection;

class GetLinksByUserId
{
    private $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getData()
    {
        /**
         * TODO:
         * Query DB link by user_id, query like:
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
         */
        return new Collection();
    }

    public function getAllTheData()
    {
    }
}
