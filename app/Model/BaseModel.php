<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Model\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    public function getTable()
    {
        if (!isset($this->table)) {
            return str_replace('\\', '', Str::snake(class_basename($this)));
        }

        return $this->table;
    }
}