<?php

namespace App\Model;

/**
 * App\Model\Tag
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tag query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tag whereName($value)
 */
class Tag extends BaseModel
{
    public function posts()
    {
        return $this->belongsToMany(Post::class, "post_tag");
    }

    public function getIdListByTagName($tagNameList = [])
    {
        if (empty($idList)) return [];

        $list = static::whereIn("name", $tagNameList)->all();
        return $list->pluck('id');
    }


    public function suggestTags($baseTagName, $count = 10)
    {
        if (empty($baseTagName)) return [];

        $list = static::where("name", "like", "%{$baseTagName}%")
            ->limit($count)
            ->all();
        return $list;
    }
}
