<?php namespace GromIT\Instagram\Actions;

use GromIT\Instagram\Dto\SyncMediaDto;
use GromIT\Instagram\Models\Account;
use GromIT\Instagram\Models\Media;
use GromIT\Instagram\Traits\SelfMakeable;
use InstagramScraper\Instagram;
use System\Models\File;

class SyncMediaAction
{
    use SelfMakeable;

    /**
     * @throws \Exception
     */
    public function execute(SyncMediaDto $dto)
    {
        // Update account
        $account = Account::query()->find($dto->account_id);

        $instagram = new Instagram();
        $instagram->setRapidApiKey($account->rapid_api_key);
        $info = $instagram->getAccountById($account->instagram_id);

        /** @var Account $account */
        $account->external_url      = $info->getExternalUrl();
        $account->follows_count     = $info->getFollowsCount();
        $account->followed_by_count = $info->getFollowedByCount();
        $account->media_count       = $info->getMediaCount();
        $account->save();

        $medias = $info->getMedias();

        foreach ($medias as $media) {

            $existMedia = Media::query()
                ->where('account_id', '=', $account->id)
                ->where('media_id', '=', $media->getId())
                ->first();

            if ($existMedia) {
                $existMedia->caption        = $media->getCaption();
                $existMedia->likes_count    = $media->getLikesCount();
                $existMedia->comments_count = $media->getCommentsCount();
                $existMedia->save();
            } else {

                $newMedia                 = new Media();
                $newMedia->account_id     = $account->id;
                $newMedia->media_id       = $media->getId();
                $newMedia->type           = $media->getType();
                $newMedia->link           = $media->getLink();
                $newMedia->caption        = $media->getCaption();
                $newMedia->likes_count    = $media->getLikesCount();
                $newMedia->comments_count = $media->getCommentsCount();
                $newMedia->save();

                $image = new File();

                $image->fromUrl($media->getImageThumbnailUrl(), $media->getId() . '-file.jpeg');

                $newMedia->image()->add($image);

            }

        }

        return $account;

    }
}
