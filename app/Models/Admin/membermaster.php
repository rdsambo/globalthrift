<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class membermaster extends Model
{


    use SoftDeletes;

    protected $table = "membermaster";
    //protected $fillable = [];
    protected $guarded=[];
    protected $dates = ['deleted_at'];
    protected $primaryKey = "ID";

    public function account()
    {
        return $this->hasMany('App\Models\Accountmaster','AccountId','AccountId');
    }
}
