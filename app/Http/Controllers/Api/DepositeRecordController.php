<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\user;
use App\Models\TempDeposite;
use Illuminate\Http\Request;

class DepositeRecordController extends Controller
{
    //
    public function getrecord(){
        $record=TempDeposite::addSelect(['collctor_name' => user::select('username')
        ->whereColumn('collected_by', 'users.id')
        ->limit(1)
    ])->get();
        return response()->json([
            "status" => true,
            'message' => "you sucessfully get Deposite record",
            'record' => $record,
        ]);

    }
}
