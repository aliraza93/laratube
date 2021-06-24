<?php

namespace App;

class Vote extends Model
{
    public function votable() {
        return $this->morphTo();
    }
}
