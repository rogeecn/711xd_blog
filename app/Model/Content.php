<?php

namespace App\Model;


/**
 * App\Model\Content
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $post_id
 * @property string $content
 * @property-read \App\Model\Post $post
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content wherePostId($value)
 */
class Content extends BaseModel
{
    public $timestamps = false;

    //
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
