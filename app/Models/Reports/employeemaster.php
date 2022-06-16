<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class employeemaster extends Model
{
    protected $table= "employeemaster";
    protected $guarded=[];

    public function tempsal(){
        return $this->hasMany('App\Models\Reports\tempsalary','Emp_Code','Employee_Code');
    }
}
