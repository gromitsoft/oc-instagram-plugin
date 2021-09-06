<?php namespace GromIT\Instagram\Dto;

use GromIT\Instagram\Classes\Dto;

class CreateAccountDto extends Dto
{

    /**
     * @var int $instagram_id
     */
    public $instagram_id;

    /**
     * @var string $username
     */
    public $username;

    /**
     * @var string|null $full_name
     */
    public $full_name = null;

    /**
     * @var string|null $external_url
     */
    public $external_url = null;

    /**
     * @var int $follows_count
     */
    public $follows_count;

    /**
     * @var int $followed_by_count
     */
    public $followed_by_count;

    /**
     * @var int $media_count
     */
    public $media_count;

    /**
     * @var string $rapid_api_key
     */
    public $rapid_api_key;

    /**
     * @var string|null $avatar
     */
    public $avatar;

}
