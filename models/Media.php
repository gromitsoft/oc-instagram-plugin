<?php namespace GromIT\Instagram\Models;

use Model;
use October\Rain\Argon\Argon;
use October\Rain\Database\Relations\AttachOne;
use October\Rain\Database\Relations\BelongsTo;
use October\Rain\Database\Traits\Nullable;
use October\Rain\Database\Traits\Validation;
use System\Models\File;

/**
 * Media Model
 *
 * @property int         $id
 * @property int         $account_id
 * @property int         $media_id
 * @property string      $type
 * @property string      $link
 * @property string|null $caption
 * @property int         $likes_count
 * @property int         $comments_count
 * @property Argon       $created_at
 * @property Argon       $updated_at
 *
 * @property File      $image
 * @method AttachOne image()
 *
 * @property Account     $account
 * @method BelongsTo account()
 *
 */
class Media extends Model
{
    public $table = 'gromit_instagram_media';

    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'id'             => 'int',
        'account_id'     => 'int',
        'media_id'       => 'int',
        'likes_count'    => 'int',
        'comments_count' => 'int',
    ];

    use Nullable;

    protected $nullable = [
        'caption',
    ];

    use Validation;

    public $rules = [
        'account_id'     => 'required',
        'media_id'       => 'required',
        'type'           => 'required',
        'link'           => 'required',
        'likes_count'    => 'required',
        'comments_count' => 'required',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $belongsTo = [
        'account' => Account::class,
    ];
    public $attachOne = [
        'image' => File::class,
    ];
}
