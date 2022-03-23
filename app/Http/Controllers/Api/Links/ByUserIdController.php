<?php

namespace App\Http\Controllers\Api\Links;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Links\ByUserId\Root as RootResource;
use App\Services\Link\LinkService;
use Illuminate\Support\Facades\Request;

class ByUserIdController extends Controller
{
    const ORDER_BY_CREATED_TIME = "created_time";
    const ORDER_BY_UPDATED_TIME = "updated_time";
    const ORDER_BY_OPTIONS      = [
        self::ORDER_BY_CREATED_TIME,
        self::ORDER_BY_UPDATED_TIME
    ];

    const ORDER_ASC     = "asc";
    const ORDER_DESC    = "desc";
    const ORDER_OPTIONS = [
        self::ORDER_BY_CREATED_TIME,
        self::ORDER_BY_UPDATED_TIME
    ];

    private $order_by = self::ORDER_BY_CREATED_TIME;
    private $order    = self::ORDER_ASC;

    public function index($user_id = null)
    {
        $order_by = Request::instance()->orderBy;
        $order    = Request::instance()->order;

        if (!empty($order_by) && in_array($order_by, self::ORDER_BY_OPTIONS)) {
            $this->order_by = Request::instance()->orderBy;
        }
        if (!empty($order) && in_array($order, self::ORDER_OPTIONS)) {
            $this->order = Request::instance()->order;
        }

        $link_service = new LinkService();
        $response     = $link_service->getLinksByUserId($user_id, $this->order_by, $this->order);
        return (new RootResource($response))
            ->response()
            ->setStatusCode(__('api.response.codes.success'));
    }
}
