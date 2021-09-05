<?php namespace GromIT\Instagram\Models;

use Model;
use October\Rain\Argon\Argon;
use October\Rain\Database\Collection;
use October\Rain\Database\Relations\AttachOne;
use October\Rain\Database\Relations\HasMany;
use October\Rain\Database\Traits\Nullable;
use October\Rain\Database\Traits\Validation;
use System\Models\File;

/**
 * Account Model
 *
 * @property int                $id
 * @property int                $instagram_id
 * @property string             $username
 * @property string|null        $full_name
 * @property string|null        $external_url
 * @property int                $follows_count
 * @property int                $followed_by_count
 * @property int                $media_count
 * @property string             $rapid_api_key
 * @property Argon              $created_at
 * @property Argon              $updated_at
 *
 * @property File[]             $avatar
 * @method AttachOne avatar()
 *
 * @property Collection|Media[] $medias
 * @method HasMany medias()
 */
class Account extends Model
{
    public $table = 'gromit_instagram_accounts';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'id'                => 'int',
        'instagram_id'      => 'int',
        'follows_count'     => 'int',
        'followed_by_count' => 'int',
        'media_count'       => 'int',
    ];

    use Nullable;

    protected $nullable = [
        'full_name',
        'external_url'
    ];

    use Validation;

    public $rules = [
        'username'      => 'required',
        'instagram_id'  => 'required',
        'rapid_api_key' => 'required',
    ];

    public $customMessages = [
        'instagram_id.required'  => 'Не выбран пользователь Instagram',
        'username.required'      => 'Не указано имя пользователя Instagram',
        'rapid_api_key.required' => 'Не указан API-ключ для сервиса',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $hasMany = [
        'medias' => Media::class,
    ];

    public $attachOne = [
        'avatar' => File::class,
    ];
}
