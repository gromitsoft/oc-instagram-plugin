<?php namespace GromIT\Instagram\Actions;

use GromIT\Instagram\Classes\Intervals;
use GromIT\Instagram\Dto\CreateAccountDto;
use GromIT\Instagram\Models\Account;
use GromIT\Instagram\Traits\SelfMakeable;
use InstagramScraper\Instagram;
use System\Models\File;

class CreateAccountAction
{
    use SelfMakeable;

    /**
     * @throws \Exception
     */
    public function execute(CreateAccountDto $dto): Account
    {
        $account = new Account();

        $account->instagram_id      = $dto->instagram_id;
        $account->username          = $dto->username;
        $account->full_name         = $dto->full_name;
        $account->external_url      = $dto->external_url;
        $account->follows_count     = $dto->follows_count;
        $account->followed_by_count = $dto->followed_by_count;
        $account->media_count       = $dto->media_count;
        $account->rapid_api_key     = $dto->rapid_api_key;

        $account->save();

        $file = new File();

        $file->fromUrl($dto->avatar, $dto->instagram_id.'.jpeg');

        $account->avatar()->add($file);

        return $account;

    }
}
