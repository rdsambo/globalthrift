<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\acgenled;

class acsubgrp extends Model
{
    protected $table= "acsubgrp";
    protected $guarded=[];
    public function acledger(){
        return $this->hasMany("App\Models\Admin\acgenled",'AcSubGrpId','AcSubGrpId');

    }

    // public function acledgerbalsheet(){
    //     // return $this->hasMany("App\Models\Admin\atcbdt",'DescId','DescId');
    //     return $this->join('acgenled','acgenled.AcSubGrpId','acsubgrp.AcSubGrpId')
    //                 ->join('atcbdt','atcbdt.DescId','acgenled.DescId')
    //                 ->groupby('acgenled.DescId')
    //                 ->selectRaw("sum(CASE WHEN DrCr='D' THEN Amt ELSE 0 END) as totaldr,
    //                              sum(CASE WHEN DrCr='C' THEN Amt ELSE 0 END) as totalcr,VoucherDt,acgenled.Desc,acgenled.DescId,acgenled.Desc");


    // }


}
