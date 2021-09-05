<?php

namespace GromIT\Instagram\Api\Controllers;

use GromIT\Instagram\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $medias = Media::query()
            ->where('account_id', '=', $request->get('account_id'))
            ->orderBy('created_at', 'desc')
            ->limit($request->get('limit', 12))
            ->get();

        $data = [];

        foreach ($medias as $media) {
            $data[$media->id] = [
                'image'          => $media->image->getPath(),
                'type'           => $media->type,
                'link'           => $media->link,
                'caption'        => $media->caption,
                'likes_count'    => $media->likes_count,
                'comments_count' => $media->comments_count,
            ];
        }

        return $this->jsonResponse($data);
    }
}
