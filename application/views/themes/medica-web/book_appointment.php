<?php
/*
	This file is part of Chikitsa.

    Chikitsa is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Chikitsa is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Chikitsa.  If not, see <https://www.gnu.org/licenses/>.
*/
?>
<?php
function inttotime($tm) {
    $hr = intval($tm);
    $min = ($tm - intval($tm)) * 60;
    $format = '%02d:%02d';
    return sprintf($format, $hr, $min);
}

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
function is_available($appointments,$date,$time,$time_interval){
	foreach($appointments as $appointment){
		if(strtotime($appointment['appointment_date']) == strtotime($date)){
			$appointment_start_time = strtotime($appointment['appointment_date'] .' ' .$appointment['start_time']);
			$appointment_end_time = strtotime($appointment['appointment_date'] .' ' .$appointment['end_time']);
			$start_time = strtotime($date .' ' .$time);
			$end_time = $start_time + ($time_interval*60*60);
			if($appointment_start_time >= $start_time && $appointment_start_time <= $end_time){
					return FALSE;
			}
			if($appointment_end_time >= $start_time && $appointment_end_time <= $end_time){
					return FALSE;
			}

		}
	}
	return TRUE;
}
function timetoint($time) {
    $hrcorrection = 0;
    if (strpos($time, 'PM') > 0) { $hrcorrection = 12;}
    list($hours, $mins) = explode(':', $time);
    $mins = str_replace('AM', '', $mins);
    $mins = str_replace('PM', '', $mins);
    return $hours + $hrcorrection + ($mins / 60);
}
?>


			<!----start-content----->
			<div class="content">
				<div class="clear"> </div>
				<div class="content-top-grids" style="background-color: #e9f5fb;">

				<div class="wrap">

		          <div class="grid_4_of_4 contact-form">
					<div class="row">
				       <div class="col_4">
						   <select name="doctor" style="padding: 8px; display: block; border: 1px solid #289cd8;  outline: none; font-family: 'Open Sans', sans-serif;font-size: 1em; color: #777;">
						   <?php

							 foreach($doctors as $doctor){
								$selected = "";
								if($doctor['doctor_id'] == $doctor_id){
									$selected = " selected='selected' ";
								}
								echo "<option value='".$doctor['doctor_id']."'" . $selected . ">".$doctor['name']."</option>";
							}
						    ?>
						  </select>
						</div>
						<button  id="btnShow" type="submit" name="submit" style="padding:10px" class="make_appointment_button" value="Show Popup">Select Doctor</button>
					</div>


						<div class="clear"> </div>
						<table class="book_appointment_calendar" style="background-color: #FFF">
							<thead>
								<tr>
									<th>Time</th>
									<?php
										$display_date = date($def_dateformate, strtotime($start_date));
										while(strtotime($display_date) <= strtotime($end_date)){
											echo "<th>$display_date</th>";
											$display_date = date($def_dateformate, strtotime($display_date.'+1 days'));
										}
									?>
								</tr>
							</thead>
							<tbody>
								<?php
								//Clinic Start Time and Clinic End Time
								$start_time = timetoint($start_time);
								$end_time = timetoint($end_time);

								for ($i = $start_time; $i < $end_time; $i = $i + $time_interval) {
										$time = explode(":",inttotime($i));
										$time_intervals[] = $i*100;
										//echo $time;
										?>
										<tr>
											<th><?=inttotime12( $i ,$def_timeformate);?></th>
											<?php
											$display_date = date($def_dateformate, strtotime($start_date));
											while(strtotime($display_date) <= strtotime($end_date)){
												if(is_available($appointments,$display_date,inttotime12( $i ,$def_timeformate),$time_interval)){?>
												<td><a href="<?=site_url('frontend/register/'.$doctor.'/'.$display_date.'/'.$i.'/'.$appointment_reason);?>" class="book_appointment"></a></td>
												<?php }else{?>
													<td class="booked"></td>
												<?php }
												$display_date = date($def_dateformate, strtotime($display_date.'+1 days'));
											}?>
										</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="clear"> </div>
			</div>

			<div class="clear"> </div>





			<!----End-content----->
		</div>
		<!---End-wrap---->
