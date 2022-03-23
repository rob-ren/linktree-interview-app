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
     * @param string $order_by
     * @param string $order
     * @return Collection
     */
    public function getLinksByUserId($user_id, $order_by, $order)
    {
        return $this->getClassData(__CLASS__, "GetLinksByUserId", func_get_args());
    }

    /**
     * create link data and related link data
     *
     * @param string $name
     * @param string $url
     * @param string $type
     * @param array $metadata
     * @return boolean
     */
    public function addLink($name, $url, $type, $metadata)
    {
        return $this->saveClassData(__CLASS__, "AddLink", func_get_args());
    }
}
