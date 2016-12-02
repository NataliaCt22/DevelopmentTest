<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convert extends Model
{	

 	private	$numbers = array(
	 		'one' => '1', 'two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 
	 		'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9', 'ten' => '10', 
	 		'eleven' => '11', 'twelve' => '12', 'thirteen' => '13', 'fourteen' => '14', 
	 		'fifteen' => '15', 'sixteen' => '16', 'seventeen' => '17', 'eighteen' => '18', 
	 		'nineteen' => '19', 'twenty' => '20', 'thirty' => '30', 'forty' => '40', 
	 		'fifty' => '50', 'sixty' => '60', 'seventy' => '70', 'eighty' => '80', 'ninety' => '90',
	    'hundred' => '100', 'thousand' => '1000', 'million' => '1000000', 'billion' => '1000000000',
      'trillion' => '1000000000000', 'quadrillion' => '1000000000000000','quintillion' => '1000000000000000000',
  );

  public function convertNumberWords($number) 
  {
  	$hyphen      = '-';    
    $separator   = ' ';        
  	
    if (!is_numeric($number)) 
    {
      return false;
    }
  
    $string = null;
  	  
    switch (true) 
    {
      case $number < 21:
        $string = array_search($number, $this->numbers);          
        break;
      
      case $number < 100:
        $tens   = ((int) ($number / 10)) * 10;
        $units  = $number % 10;
        $string = array_search($tens, $this->numbers);
        if ($units) 
        {
          $string .= $hyphen . array_search((int)$units, $this->numbers);
        }          
        break;
      
      case $number < 1000:
        $hundreds  = $number / 100;
        $remainder = $number % 100;          
        $string = array_search((int)$hundreds, $this->numbers) . ' ' . array_search(100, $this->numbers);
        if ($remainder) 
        {
        	$string .= $separator . $this->convertNumberWords($remainder);
        }          
        break;

      default:     
        $baseUnit = pow(1000, floor(log($number, 1000)));
        $numBaseUnits = (int) ($number / $baseUnit);
        $remainder = $number % $baseUnit;          
        $string = $this->convertNumberWords($numBaseUnits) . ' ' . array_search((int)$baseUnit, $this->numbers) .',';        	
        if ($remainder) 
        {
          $string .= $remainder < 100 ?  : $separator;
          $string .= $this->convertNumberWords($remainder);
        }
        break;
    }
    return $string;
	}
	
	public function convertWordsNumber($number) 
	{		
		$number = strtolower($number);
    $number = str_replace("-", " ", $number);
    $number = str_replace(",", "", $number);
    $number = trim($number); 
    $number = $this->validate($number);
    preg_match_all('#((?:^|and|,| |-)*(\b' . implode('\b|\b', array_keys($this->numbers)) . '\b))+#i', $number, $strings);
    $strings = $strings[0];
    $total = 0;

    foreach($strings as $string)
    {         
      $words = explode(' ',$string);            
      $numeral = '0';
      foreach($words as $word)
      {
        $word = trim($word);
        $value = $this->numbers[$word];        

        if(bccomp($value, 100) == -1)
        {
            $numeral = bcadd($numeral, $value);
            continue;
        }
        else if(bccomp($value, 100) == 0)
        {          
            $numeral = bcmul($numeral, $value);
            continue;
        }
        $numeral = bcmul($numeral, $value);
        $total = bcadd($total, $numeral);
        $numeral = '0';
	    }
	    $total = bcadd($total, $numeral);		          
		}    
		return $total;
	}

	public function validate($number) 
	{		
		$find= array();
		$numberExplode = explode(" ", $number);
    foreach ($numberExplode as $value)          
      array_push($find,array_key_exists($value,$this->numbers));  

		if(!in_array(false,$find))
			return $number;
		else		
			return false;		
	}
	
}
