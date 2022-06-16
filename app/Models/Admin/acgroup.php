<?php

namespace App\Models\Admin;
use App\Models\Admin\acsubgrp;
use App\Models\Admin\acgenled;

use Illuminate\Database\Eloquent\Model;

class acgroup extends Model
{
    protected $table= "acgroup";
    protected $guarded=[];
    public function acsubgroup(){
        return $this->hasMany("App\Models\Admin\acsubgrp",'AcGroupId','ACGroupId');

    }
}
