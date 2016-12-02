<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Convert;

class Operation extends Model
{
  protected $fillable = [
    'numberOne', 'numberTwo',
  ];

  public function add()
  { 	
  	$convert = new Convert;
  	(int)$numberOne = $convert->convertWordsNumber($this->numberOne);
  	(int)$numberTwo = $convert->convertWordsNumber($this->numberTwo);
  	$total = 0; 	  	

    if($numberOne && $numberTwo)
    {
  		$total = $numberOne+$numberTwo;
  		$result = $convert->convertNumberWords($total);
  		return $result;
  	}
  	else
  		return 'zero';		
  }

}
