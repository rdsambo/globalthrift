<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\atcbdt;

class acgenled extends Model
{
    protected $table= "acgenled";
    protected $guarded=[];

    public function acledgerbalsheet(){
        return $this->hasMany("App\Models\Admin\atcbdt",'DescId','DescId');
    }
}
