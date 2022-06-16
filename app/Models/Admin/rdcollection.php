<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class rdcollection extends Model
{
    protected $table="rdcollection";
    protected $guarded=[];

    public function accountmaster()
    {
        return $this->hasOne('App\Models\Admin\accountmaster','accountid','accountid');
    }
}
