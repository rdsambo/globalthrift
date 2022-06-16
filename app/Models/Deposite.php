<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


class Deposite extends Model
{
    //

    use Notifiable, SoftDeletes;
    protected $guarded=[];
}
