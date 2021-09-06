<?php

namespace GromIT\Instagram\Api\Controllers;

use GromIT\Instagram\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function get($accountId, $limit = 12): JsonResponse
    {
        $medias = Media::query()
            ->where('account_id', '=', $accountId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
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
