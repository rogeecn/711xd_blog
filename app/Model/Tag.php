<?php

namespace App\Model;

/**
 * Class Tag
 * @package App\Model
 * @mixin \Eloquent
 */
class Tag extends BaseModel
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany(Post::class, "post_tag");
    }

    public function getIdListByTagName($tagNameList = [])
    {
        if (empty($tagNameList)) return [];

        $items = collect($tagNameList)->map(function ($item) {
            return static::firstOrCreate(['name' => $item])->id;

        });

        return $items;
    }

    public function getIdByName($name)
    {

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
