<?php

namespace App\Model;

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
