<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ddcollection extends Model
{
    protected $table="ddcollection";
    protected $guarded=[];

    public function account()
    {
        return $this->hasOne('\App\Models\Admin\accountmaster','AccountId','AccountId');
    }

}
