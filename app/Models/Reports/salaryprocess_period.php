<?php

namespace App\models\reports;

use Illuminate\Database\Eloquent\Model;

class salaryprocess_period extends Model
{
    protected $table= "salaryprocess_period";
    protected $guarded=[];

    public function month(){
        return $this->belongsTo('App\Models\Reports\MonthMaster','Month','Month');
    }
}
