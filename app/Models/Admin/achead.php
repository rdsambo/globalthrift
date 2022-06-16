<?php

namespace App\Models\Admin;

use App\Models\Admin\acgroup;
use App\Models\Admin\acsubgrp;
use App\Models\Admin\acgenled;

use Illuminate\Database\Eloquent\Model;

class achead extends Model
{
    protected $table= "achead";
    protected $guarded=[];
    public function acgroup(){
        return $this->hasMany("App\Models\Admin\acgroup", 'ACHeadId', 'acheadid');

    }
}
