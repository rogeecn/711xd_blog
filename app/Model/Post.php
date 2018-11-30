<?php

namespace App\Model;

use App\Model\traits\RawContent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends BaseModel
{
    use HasSlug, SoftDeletes, RawContent;

    const META_BREAKER = "----------------------";

    protected $fillable = ['title', 'description', 'slug', 'type', 'layout', 'status'];

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->saveSlugsTo("slug")
            ->doNotGenerateSlugsOnUpdate()
            ->generateSlugsFrom(function () {
                return str_slug(pinyin_sentence($this->title));
            });
    }

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHING = 1;

    const TYPE_ARTICLE = 'article';
    const TYPE_PAGE = 'page';

    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function content()
    {
        return $this->hasOne(Content::class);
    }


    public function postTags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function statusList()
    {
        return [
            self::STATUS_DRAFT => '草稿',
            self::STATUS_PUBLISHING => '发布',
        ];
    }

    public function humanStatusMap()
    {
        return [
            self::STATUS_DRAFT => 'draft',
            self::STATUS_PUBLISHING => 'publish',
        ];
    }

    public function typeList()
    {
        return [
            self::TYPE_ARTICLE => '文章',
            self::TYPE_PAGE => '页面',
        ];
    }

    public function layoutList()
    {
        return [
            'default' => 'default',
            'page' => 'page',
        ];
    }
}
