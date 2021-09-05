<?php namespace GromIT\Instagram\Dto;

use GromIT\Instagram\Classes\Dto;

class CreateAccountDto extends Dto
{

    public int $instagram_id;
    public string $username;
    public ?string $full_name;
    public ?string $external_url;
    public int $follows_count;
    public int $followed_by_count;
    public int $media_count;
    public string $rapid_api_key;
    public ?string $avatar;

}
