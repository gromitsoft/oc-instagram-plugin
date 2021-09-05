<?php namespace GromIT\Instagram\Actions;

use GromIT\Instagram\Classes\Intervals;
use GromIT\Instagram\Dto\FindAccountDto;
use GromIT\Instagram\Traits\SelfMakeable;
use InstagramScraper\Instagram;

class FindAccountAction
{
    use SelfMakeable;

    /**
     * @throws \InstagramScraper\Exception\InstagramNotFoundException
     * @throws \InstagramScraper\Exception\InstagramException
     */

    public function execute(FindAccountDto $dto): array
    {
        $cacheKey = implode('-', [
            $dto->api_key,
            $dto->username,
        ]);

        return cache()->remember($cacheKey, Intervals::oneDay(), function () use ($dto) {

            $result    = [];
            $instagram = new Instagram();
            $instagram->setRapidApiKey($dto->api_key);

            $account = $instagram->getAccountInfo($dto->username);

            if ($account) {
                $result = [
                    'instagram_id'      => $account->getId(),
                    'username'          => $account->getUsername(),
                    'full_name'         => $account->getFullName(),
                    'external_url'      => $account->getExternalUrl(),
                    'follows_count'     => $account->getFollowsCount(),
                    'followed_by_count' => $account->getFollowedByCount(),
                    'media_count'       => $account->getMediaCount(),
                    'rapid_api_key'     => $dto->api_key,
                    'avatar'            => $account->getProfilePicUrl(),
                ];
            }

            return $result;
        });
    }
}
