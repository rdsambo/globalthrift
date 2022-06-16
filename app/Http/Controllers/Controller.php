<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function fin_year()
    {
    	 dd(auth()->check());
    	$finyear=explode("-", auth()->user()->financial_year);
        $finyr = $finyear[0].'-'.substr($finyear[1],2,2);
	    return $finyr;
    }
}
