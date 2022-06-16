<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class eomaster extends Model
{
    protected $table   = "eomst";
    protected $guarded = [];
    public function eowise()
    {
        return $this->hasMany('App\Models\Admin\dbo_loanapplication', 'AppUId', 'EOId');
    }
    // public function lowisemem()
    // {
    //     return $this->hasMany('App\Models\Admin\membermaster', 'GroupId', 'EOId')->where('Status', 'O');
    // }
    public function lowiseac()
    {
        return $this->hasMany('App\Models\Admin\membermaster', 'GroupId', 'EOId')
                    ->join('accountmaster', 'accountmaster.MemberId', 'membermaster.MemberId')
                    ->where('membermaster.Status', 'O')
                    ->where('accountmaster.Status', 'O');
    }
    public function lowisemem()
    {
        return $this->hasMany('App\Models\Admin\eogroup', 'EOId', 'EOId')
                    ->join('membermaster','membermaster.GroupId','=','eo_group.GroupId');
    }

}
