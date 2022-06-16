<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class TempDeposite extends Model
{
    //
    use Notifiable, SoftDeletes;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo('App\Models\Admin\user','collected_by');
    }

    public function account_no(){
        return $this->hasOne('App\Models\Admin\accountmaster','id','accountmaster_id');
    }

    public function scopeCustomFilter($query)
    {
        $query->when(request("collection_from_date"), function (Builder $query) {
            return $query->whereDate("collected_date", ">=", request("collection_from_date"));
        })->when(request("collection_to_date"), function (Builder $query) {
            return $query->whereDate("collected_date", "<=", request("collection_to_date"));
        })->when(request("collection_type"), function (Builder $query) {
            return $query->where("collection_type", request("collection_type"));
        })->when(request("lo_id"), function (Builder $query) {
            return $query->where("lo_id",  request("lo_id"));
        })->when(request("deposite_amount"), function (Builder $query) {
            return $query->where("deposite_amount",  request("deposite_amount"));
        });

        return $query;
    }
}
