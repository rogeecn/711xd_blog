<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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