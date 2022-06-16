<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class dbo_loanmst extends Model
{
    protected $table="dbo_loanmst";
    protected $guarded=[];
    protected $timestamp=false;

    public function avg_PrinCollAmt(){
        return $this->hasMany("App\Models\Admin\collectiondtl", 'LoanId', 'LoanId');
    }
    // public function avg_IntCollAmt(){   //->select('*', DB::raw('SUM(PrinCollAmt) AS avg_PrinCollAmt'),DB::raw('SUM(IntCollAmt) AS avg_IntCollAmt'));
    //     return $this->hasOne("App\Models\Admin\collectiondtl", 'LoanId', 'LoanId')->select('*', DB::raw('SUM(IntCollAmt) AS avg_IntCollAmt'));
    // }
}
