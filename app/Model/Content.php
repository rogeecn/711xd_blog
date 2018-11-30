<?php

namespace App\Model;


class Content extends BaseModel
{
    public $timestamps = false;

    //
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
