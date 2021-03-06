<?php

namespace App;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    public $incrementing = false;

    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
        $model->{$model->getkeyName()} = (string) Str::uuid();
        });
    }

    protected $guarded = [];
}
