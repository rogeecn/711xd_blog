<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Model\Post
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $author
 * @property string $layout
 * @property string $type
 * @property int $status
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\Content $content
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Post withoutTrashed()
 */
class Post extends BaseModel
{
    use HasSlug, SoftDeletes;

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

    public function content()
    {
        return $this->hasOne(Content::class);
    }

    public function tags()
    {
        return [1, 2, 3];
    }

    public function getRawContentAttribute()
    {
        $template = <<<_TPL
- Title: {title}
- Slug: {slug}
- Tags: {tags}
- Layout: {layout}
- Type: {type}
- Status: {status}

{breaker}

{content}
_TPL;


//        > Layout: {layoutList}
//        > Type: {typeList}
//        > Status: {statusList}

        $attributes = [
            '{title}' => $this->title ?? "",
            '{slug}' => $this->slug ?? "",
            '{tags}' => value(function () {
                return implode(",", $this->tags());
            }),
            '{layout}' => $this->layout ?? collect($this->layoutList())->keys()->first(),
            '{layoutList}' => collect($this->layoutList())->keys()->implode(","),
            '{type}' => $this->type ?? collect($this->typeList())->keys()->first(),
            '{typeList}' => collect($this->typeList())->keys()->implode(","),
            '{status}' => collect($this->humanStatusMap())->get($this->status) ?? collect($this->humanStatusMap())->first(),
            '{statusList}' => collect($this->humanStatusMap())->values()->implode(","),
            '{breaker}' => static::META_BREAKER,
            '{content}' => $this->content->content ?? "",
        ];

        return strtr($template, $attributes);
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
