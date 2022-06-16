<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class dbo_loanapplication extends Model
{
    protected $table="dbo_loanapplication";
    protected $guarded=[];
    public function accountmaster(){
        return $this->hasOne("App\Models\Admin\accountmaster", 'MemberId', 'MemberId');

    }
    public function loanmaster(){
        return $this->hasMany("App\Models\Admin\dbo_loanmst", 'LoanAppId','LoanAppId')->where('Status','=','O');

    }
}
