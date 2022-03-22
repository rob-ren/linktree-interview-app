<?php

namespace App\Services\Link;

use App\Services\BaseService;

class LinkService extends BaseService
{
    public function __construct()
    {
    }

    /**
     * get a collection of links by provided user_id
     * we also query the realted tables link_music and link_shows
     *
     * @param string $user_id
     * @return Collection
     */
    public function getLinksByUserId($user_id)
    {
        return $this->getClassData(__CLASS__, "GetLinksByUserId", func_get_args());
    }
}
