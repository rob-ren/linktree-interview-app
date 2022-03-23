<?php

namespace App\Http\Controllers\Api\Link;

use App\Http\Controllers\Controller;
use App\Models\Entity\Link;
use App\Models\Entity\LinkShows;
use App\Services\Link\LinkService;
use Illuminate\Support\Facades\Request;

class CreateController extends Controller
{
    public function index()
    {
        // get object from GET / POST data
        $request_object =  json_decode(json_encode(Request::instance()->all()));
        $metadata = [];

        // check the payload missing required key
        if (empty($request_object->name) || empty($request_object->url) || empty($request_object->type)) {
            return response()
                ->json(
                    ['code' => __('api.response.codes.forbidden'), 'message' => __('api.error.link.create.classic_missing_key')],
                    __('api.response.codes.forbidden')
                );
        }

        // check the data is valid
        if (!in_array($request_object->type, Link::TYPE_OPTIONS)) {
            return response()
                ->json(
                    ['code' => __('api.response.codes.forbidden'), 'message' => __('api.error.link.create.classic_invalid_data')],
                    __('api.response.codes.forbidden')
                );
        }

        // check payload type is link music and required key
        if ($request_object->type == Link::TYPE_MUSIC) {
            $metadata = $request_object->platforms;
            if (empty($request_object->platforms)) {
                return response()
                    ->json(
                        ['code' => __('api.response.codes.forbidden'), 'message' => __('api.error.link.create.music_missing_key')],
                        __('api.response.codes.forbidden')
                    );
            }
            foreach ($request_object->platforms as $platform) {
                if (empty($platform->name) || empty($platform->url)) {
                    return response()
                        ->json(
                            ['code' => __('api.response.codes.forbidden'), 'message' => __('api.error.link.create.music_missing_key')],
                            __('api.response.codes.forbidden')
                        );
                }
            }
        }

        // check payload type is link shows and required key
        if ($request_object->type == Link::TYPE_SHOW) {
            $metadata = $request_object->shows;
            if (empty($request_object->shows)) {
                return response()
                    ->json(
                        ['code' => __('api.response.codes.forbidden'), 'message' => __('api.error.link.create.shows_missing_key')],
                        __('api.response.codes.forbidden')
                    );
            }
            foreach ($request_object->shows as $show) {
                if (empty($show->date) || empty($show->address) || empty($show->status)) {
                    return response()
                        ->json(
                            ['code' => __('api.response.codes.forbidden'), 'message' => __('api.error.link.create.shows_missing_key')],
                            __('api.response.codes.forbidden')
                        );
                }
                if (!in_array($show->status, LinkShows::STATUS_OPTIONS)) {
                    return response()
                        ->json(
                            ['code' => __('api.response.codes.forbidden'), 'message' => __('api.error.link.create.shows_invalid_data')],
                            __('api.response.codes.forbidden')
                        );
                }
            }
        }

        $link_service = new LinkService();
        $link_service->addLink($request_object->name, $request_object->url, $request_object->type, $metadata);

        return response()
            ->json(
                ['code' => __('api.response.codes.success'), 'message' => __('api.response.message.success')],
                __('api.response.codes.success')
            );
    }
}
