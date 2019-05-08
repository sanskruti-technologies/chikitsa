<?php
//Converts Integer to Time. e.g. 9 -> 9:00 , 9.5 -> 9:30
function inttotime12($tm,$time_format) {
    //if ($tm >= 13) {  $tm = $tm - 12; }
    $hr = intval($tm);
    $min = ($tm - intval($tm)) * 60;
    $format = '%02d:%02d';
	$time = sprintf($format, $hr, $min); //H:i
	$time = date($time_format, strtotime($time));
    return $time;
}
//Convert Time to integer.e.g. 09:00 -> 9, 09:30 -> 9.5
function timetoint12($time)
{
	$hours = idate('H', strtotime($time));
	$minutes = idate('i', strtotime($time));
	
	return $hours + ($minutes/60);
}

function inttotime($tm) {
    $hr = intval($tm);
    $min = ($tm - intval($tm)) * 60;
    $format = '%02d:%02d';
    return sprintf($format, $hr, $min);
}
function timetoint($time) {
    $hrcorrection = 0;
    if (strpos($time, 'PM') > 0) { $hrcorrection = 12;}
    list($hours, $mins) = explode(':', $time);
    $mins = str_replace('AM', '', $mins);
    $mins = str_replace('PM', '', $mins);
    return $hours + $hrcorrection + ($mins / 60);
}
 
function nearest_timeinterval($start_time,$end_time,$time_interval,$time){
	
	$time_intervals = array();
	for ($i = $start_time; $i <= $end_time; $i = $i + ($time_interval/60)) {
		$time_intervals[] = round($i*100);
	}
	
	$prev_interval = 0;
	foreach($time_intervals as $curr_interval){
		if($curr_interval == $time){
			return $time;
		}else{
			if($time >= $prev_interval && $time < $curr_interval){
				if($prev_interval == 0){
					return $curr_interval;
				}else{
					$median = ($prev_interval + $curr_interval)/2;
					if ($time < $median){
						return $prev_interval;
					}else{
						return $curr_interval;
					}
				}
			}
		}
		$prev_interval = $curr_interval;	
	}
}
?>
