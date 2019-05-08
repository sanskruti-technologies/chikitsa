<?php

function slugify($text){ 
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  if (empty($text))
  {
    return 'n-a';
  }

  return $text;
}

function hide_characters($text){
	$string_array = str_split($text);
	
	$return_text = "";
	
	for($i=0;$i<strlen($text);$i++){
		if($i%3==2){
			$return_text .= 'x';
		}else{
			$return_text .= $string_array[$i];
		}
	}
	return $return_text;
}
 
?>
