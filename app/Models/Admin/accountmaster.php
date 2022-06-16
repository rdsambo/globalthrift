<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class accountmaster extends Model
{
    protected $table="accountmaster";
    protected $guarded=[];

    public function ddcollection()
    {
        return $this->hasMany("App\Models\Admin\ddcollection", 'AccountId', 'AccountId');
    }
    public function rdcollection()
    {
        // return $this->hasMany("App\Models\Admin\rdcollection", 'accountid', 'AccountId');
         return $this->hasMany(rdcollection::class,'accountid','AccountId');
    }
}
