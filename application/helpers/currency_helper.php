<?php
function get_number_format_settings(){
    //the database functions can not be called from within the helper
    //so we have to explicitly load the functions we need in to an object
    //that I will call ci. then we use that to access the regular stuff.
    $ci=& get_instance();
    $ci->load->database();
    
    

    //select the required fields from the database

    $ci->db->select('currency_symbol,number_of_decimal,decimal_symbol,thousands_separator,currency_postfix');

    
    
    //tell the db class the criteria
    $ci->db->where('invoice_id', 1);
    
    

    //supply the table name and get the data
    $query = $ci->db->get('invoice');
    
    

    foreach($query->result() as $row):
 
 

        //get the full name by concatinating the first and last names

        $number_format['currency_symbol'] = $row->currency_symbol;

        $number_format['number_of_decimal'] = $row->number_of_decimal;

        $number_format['decimal_symbol'] = $row->decimal_symbol;

        $number_format['thousands_separator'] = $row->thousands_separator;

        $number_format['currency_postfix'] = $row->currency_postfix;

 
 
    endforeach;
    
    

    return $number_format;

}







//convert numbers to currency format
if ( ! function_exists('currency_format'))
{
  function currency_format($number)
  {

	/*$number_format = get_number_format_settings();

    $currencySymbol = $number_format['currency_symbol'];

    $decimalPlaces = $number_format['number_of_decimal'];

    $decimalSymbol = $number_format['decimal_symbol'];

    $thousandsSeparator = $number_format['thousands_separator'];

	$currencyPostfix = $number_format['currency_postfix'];
	
	*/
	$ci = get_instance(); // CI_Loader instance
	
	$currencySymbol = $ci->config->item('currencySymbol');
	$decimalPlaces =  $ci->config->item('decimalPlaces');
	$decimalSymbol = $ci->config->item('decimalSymbol');
	$thousandsSeparator = $ci->config->item('thousandsSeparator');
	$currencyPostfix =  $ci->config->item('currencyPostfix');

		return $currencySymbol. number_format($number, $decimalPlaces, $decimalSymbol, $thousandsSeparator).$currencyPostfix;

  }
}

function numberTowords($num){ 
	$ones = array( 
		0 => "",
		1 => "One", 
		2 => "Two", 
		3 => "Three", 
		4 => "Four", 
		5 => "Five", 
		6 => "Six", 
		7 => "Seven", 
		8 => "Eight", 
		9 => "Nine", 
		10 => "Ten", 
		11 => "Eleven", 
		12 => "Twelve", 
		13 => "Thirteen", 
		14 => "Fourteen", 
		15 => "Fifteen", 
		16 => "Sixteen", 
		17 => "Seventeen", 
		18 => "Eighteen", 
		19 => "Nineteen" 
	); 
	$tens = array( 
		0 => "",
		1 => "Ten",
		2 => "Twenty", 
		3 => "Thirty", 
		4 => "Forty", 
		5 => "Fifty", 
		6 => "Sixty", 
		7 => "Seventy", 
		8 => "Eighty", 
		9 => "Ninety" 
		); 
		
		

	$hundreds = array( 
		"Hundred", 
		"Thousand", 
		"Million", 
		"Billion", 
		"Trillion", 
		"Quadrillion" 
		); 
	$num = number_format($num,2,".",","); 
	$num_arr = explode(".",$num); 
	$wholenum = $num_arr[0]; 
	$decnum = $num_arr[1]; 
	$whole_arr = array_reverse(explode(",",$wholenum)); 
	krsort($whole_arr); 
	$rettxt = ""; 
	foreach($whole_arr as $key => $i){ 
		if($i < 20){ 
			$rettxt .= $ones[$i]; 
		}elseif($i < 100){ 
			$rettxt .= $tens[substr($i,0,1)]; 
			$rettxt .= " ".$ones[substr($i,1,1)]; 
		}else{ 
			$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
			$rettxt .= " ".$tens[substr($i,1,1)]; 
			$rettxt .= " ".$ones[substr($i,2,1)]; 
		} 
		if($key > 0){ 
			$rettxt .= " ".$hundreds[$key]." "; 
		} 
	} 
	if($decnum > 0){ 
		$rettxt .= " and "; 
		if($decnum < 20){ 
			$rettxt .= $ones[$decnum]; 
		}elseif($decnum < 100){ 
			$rettxt .= $tens[substr($decnum,0,1)]; 
			$rettxt .= " ".$ones[substr($decnum,1,1)]; 
		} 
	} 
	return $rettxt; 

}
?>