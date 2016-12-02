<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Operation;

class OperationController extends Controller
{
    public function add(Request $request)
    {
    	if($request->ajax())
    	{    		
    		$operation = new Operation();    	
	    	$operation->numberOne = $request->numberOne;
	    	$operation->numberTwo = $request->numberTwo;
	    	$adition = $operation->add();	    	
	    	return $adition;
    	}

    }
}