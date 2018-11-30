<?php

namespace App\Model\traits;


use App\Model\Tag;

trait RawContent
{
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

        //todo: process tags
        $attributes = [
            '{title}' => $this->title ?? "",
            '{slug}' => $this->slug ?? "",
            '{tags}' => value(function () {
                return $this->postTags->pluck("name")->implode(",");
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


}