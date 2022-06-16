<?php

namespace App\Models\members;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class memberswithgroup extends Model
{
    use SoftDeletes;
    protected $table= "memberswithgroup";
    protected $guarded=[];

    public $timestamp=false;
}
