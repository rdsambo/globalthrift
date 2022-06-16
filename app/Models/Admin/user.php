<?php

namespace App\Models\Admin;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class user extends Authenticatable
{
        use HasApiTokens;
       // use Notifiable, SoftDeletes;
        protected $table="users";
        protected $guarded=[];

        public function user_role(){
            return $this->hasOne('App\Models\Admin\UserPermission','user_id','id');
        }
}
