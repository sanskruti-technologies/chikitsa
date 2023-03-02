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
<script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>

<?php

$start_string='{';
$end_string='}';
$doctor_str="";
$doctor_str.=$start_string;
foreach($doctors as $doctor){
	$string='"'.$doctor['doctor_id'].'":{"title":"'.$doctor['name'].'"},';
	$doctor_str.=$string;
}
$doctor_str.=$end_string;
?>

<script type="text/javascript" charset="utf-8">
	$(window).load(function(){
		$("#no_appointment_msg").hide();
		$(".todo").change(function() {
			var element = $(this);
			var id = $(this).val();
			if($(this).is(':checked')){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>index.php/appointment/todos_done/1/" + id,
					success: function(){
						element.parent().addClass("done");
					}
				});
			}else{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>index.php/appointment/todos_done/0/" + id,
					success: function(){
						element.parent().removeClass("done");
					}
				});
			}
		});

		$('#select_date').datetimepicker({
			timepicker:false,
			format: 'd F Y,l',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
			onChangeDateTime:function(dp,$input){
				var month= dp.getMonth() + 1;
				//$('#select_date').val(date('d F Y, l', strtotime(dp.getDate() . "-" . month . "-" . dp.getFullYear())));
				//alert(month);
				window.location='<?php echo base_url(); ?>index.php/appointment/index/'+dp.getFullYear()+'/'+month+'/'+dp.getDate();
			}
		});
		$('#activate_plugins').click(function(event) {
			event.preventDefault();
			$.post( "<?=site_url('module/reminde_later')?>");
			setTimeout(function(){ window.location.replace("<?=site_url('module/index');?>");}, 500);

		});
		$('#remind_later').click(function(event) {
			event.preventDefault();
			$.post( "<?=site_url('module/reminde_later')?>");
			$( "#nag_screen_modal" ).modal('toggle');
		});
		$('#remind_later2').click(function(event) {
			event.preventDefault();
			$.post( "<?=site_url('module/reminde_later')?>");
		//	$( "#nag_screen2_modal" ).modal('toggle');
		});
		$('#do_not_remind').click(function(event) {
			event.preventDefault();
			$.post( "<?=site_url('module/do_not_remind')?>");
		//	$( "#nag_screen2_modal" ).modal('toggle');
		});
		$('#activate_plugins2').click(function(event) {
			event.preventDefault();
			$.post( "<?=site_url('module/reminde_later')?>");
			setTimeout(function(){ window.location.replace("<?=site_url('module/index');?>");}, 500);

		});

			$("#add_inquiry_form").validate({
				// Specify validation rules
				errorClass: "alert alert-danger no_margin",
				errorElement: "div",
				rules: {
				  // The key name on the left side is the name attribute
				  // of an input field. Validation rules are defined
				  // on the right side
				  first_name: {	required: true,	},
				  last_name: {	required: true,	},
				  phone_number: {	required: true,	}
				},
				// Specify validation error messages
				messages: {
				  first_name: { required: "<?=$this->lang->line('please_enter_first_name');?>" },
				  last_name: { required: "<?=$this->lang->line('please_enter_last_name');?>" },
				  phone_number: { required: "<?=$this->lang->line('please_enter_mobile_number');?>" },
				},
				// Make sure the form is submitted to the destination defined
				// in the "action" attribute of the form when valid
				submitHandler: function(form) {
					$(form).ajaxSubmit({
						success: function(response) {
							$("#addInquiryModal").modal("hide");
						}
					});
				}
			  });
			function fetch_appointments(){
				$.get('<?=site_url("appointment/ajax_appointments_all/".$appointment_date);?>', function(data, status){
					$('#appointments').html("");
					var appointments = (JSON.parse(data));
					//console.log(appointments);
					//console.log(appointments.length);
					if(appointments.length==0){
						$('#no_appointment_msg').show();
					}
					var appointment = "";
					var width = 150;
					var columns = [];
					$.each( appointments, function( id, appointment ) {
						if(appointment.start_position in columns){
							columns[appointment.start_position]++;
						}else{
							columns[appointment.start_position] = 0;
						}
						if($("#" + appointment.end_position).length != 0) {
							var s_position = $( "#" + appointment.start_position ).position();
							var e_position = $( "#" + appointment.end_position ).position();
							var height = e_position.top - s_position.top - 2;

							var left = s_position.left + (columns[appointment.start_position]*width);
							var style = "position:absolute;top:"+ s_position.top +"px;left:" + left +"px;height:"+height+"px;";
							appointment = "<div id="+ appointment.appointment_id +" class='appointment_button' style='"+style+"'><a href='"+appointment.href+"' title='"+appointment.appointment_title+"' class='btn square-btn-adjust btn-sm btn-primary " + appointment.appointment_class + "' style='height:100%;padding-top:10%;' >"+appointment.appointment_title+"</a>"+appointment.next_link+""+appointment.cancel_link+"</div>";
							$('#appointment_table').append(appointment);
						}
					});
					
				});
			}

			function fetch_mobile_appointments(){
				$.get('<?=site_url("appointment/ajax_appointments/".$appointment_date);?>', function(data, status){
					//console.log(data);
					appointments = JSON.parse(data);
					
					/** mobile scheduler */
						var resources = <?php  echo $doctor_str?>;
						var date_string = $('#select_date').val();
						var date=date_string.split(",");

						
						var date_array=date[0].split(" ");
						var a_date=date_array[0];
						var month=date_array[1];
						var dat = new Date('1 ' + month + ' 1999');
						var month_number=dat.getMonth()+1;
						var year=date_array[2];
					
						var url='<?php echo base_url(); ?>index.php/appointment/add/'+a_date+'/'+year+'/'+month_number;
						mobileScheduler(date[0],url,appointments,resources);
				});
			}

			setInterval(function(){
				//fetch_appointments();
				//fetch_mobile_appointments();
			}, 60000);
			fetch_appointments();
			fetch_mobile_appointments();

	});
 
	function mobileScheduler(showDate,create_event_url,events,resources){
		var str="";
		str+="<div class='mobileScheduler'>";
		str+="<div class='calendar_plan'>";
		str+="<div class='right'><a href='"+create_event_url+"' class='btn square-btn-adjust btn-primary'><?=$this->lang->line('add_appointment');?></a></div>";
		//str+="<div class='schedulerHeader'><div class='col-md-12 row cl_title'>Today</div>";
		//str+="<div class='cl_copy cl_date'>"+showDate+"</div><div class='cl_add'>";
		//str+="<a href='"+create_event_url+"'><i class='fas fa-plus fa-2x'></i></a></div></div></div>";
		//console.log(events);
		if(events.length==0){
			//str+="</br><div class='right'><b>No Appointments available for this date</b></div>";
		}
		$.each(events, function(event_id,event_detail) {
			
			str+="<div class='calendar_events align_right'>";
			//str+="<p class='ce_title'>Upcoming Events</p>";
			str+='<a class="edit_event"  href="<?php echo base_url(); ?>index.php/appointment/edit_appointment/'+event_detail.appointment_id+'">';
			str+="<div class='event_item align_right' style='background-color:"+event_detail.dot_back_color+" !important;'>";
			//str+="<div class='ei_Dot dot_active' ></div>";
			str+="<div class='ei_Title'>"+event_detail.fromTime+"</div>";
			str+="<div class='ei_Copy'>"+event_detail.title+"</div>";
			str+="<div class='ei_Copy'>Doctor : "+resources[event_detail.resource]['title']+"</div>";
			str+="</div></a>";
		});
		str+="</div></div></div>";
		//return str;
		$('.mobileScheduler').html(str);
	}
</script>

<?php
	global $time_intervals;
	global $doctor_inavailability;
	global $doctors_details;
	global $doctors_schedules;
	global $day_of_week;
	global $g_day;
	global $g_month;
	global $g_year;
	global $holidays;
	global $workingdays;
	//echo $day;
	$day_of_week = date('l', strtotime($day . "-" . $month . "-" . $year));
	$g_day = $day;
	$g_month = $month;
	$g_year = $year;
	//echo $g_day;
	if($doctor_active){
		$doctor_inavailability = $inavailability;
		$doctors_details = $doctors_data;
		$doctors_schedules = $drschedules;
	}else{
		$doctor_inavailability = array();
		$doctors_details = array();
		$doctors_schedules = array();
	}

	$holidays = $exceptional_days;
	$workingdays = $working_days;

	function check_doctor_availability($i,$doctor_id){
		global $doctor_inavailability;
		global $doctors_details;
		global $doctors_schedules;
		global $day_of_week;
		global $g_day;
		global $g_month;
		global $g_year;


		$today = date('Y-m-d', strtotime($g_day . "-" . $g_month . "-" . $g_year));

		$doctor_is_available = TRUE;
		//Is this Doctors' Schedule Available?
		foreach ($doctors_details as $doctor_data){
			foreach ($doctors_schedules as $drschedules_availability){
				if($drschedules_availability['doctor_id']==$doctor_data['doctor_id']){
					if ($doctor_data['doctor_id']==$doctor_id){
						//Except Schedule, Doctor is not available
						$doctor_is_available = FALSE;
						break;
					}
				}
			}
		}
		//Is this Doctor's Schedule?
		foreach ($doctors_details as $doctor_data){
			if ($doctor_data['doctor_id']==$doctor_id){
				foreach ($doctors_schedules as $drschedules_availability){
					if($drschedules_availability['doctor_id']==$doctor_data['doctor_id']){
						if($drschedules_availability['schedule_day'] != NULL){
							$schedule_day = $drschedules_availability['schedule_day'];
							if (strpos($schedule_day,$day_of_week) !== false) {
								if ($i>= timetoint($drschedules_availability['from_time']) && $i< timetoint($drschedules_availability['to_time']) ){
									//Doctor is not available
									$doctor_is_available = TRUE;
									break;
								}
							}
						}else{
							$schedule_date = $drschedules_availability['schedule_date'];
							if(strtotime($schedule_date) == strtotime($today)){
								if ($i>= timetoint($drschedules_availability['from_time']) && $i<= timetoint($drschedules_availability['to_time']) ){
									//Doctor is not available
									$doctor_is_available = TRUE;
									break;
								}
							}
						}
					}
				}
			}
		}
		//Is Doctor Out?
		if ($doctor_is_available){
			foreach ($doctor_inavailability as $inavailability){
				if ($inavailability['doctor_id']==$doctor_id){
					if($today >= $inavailability['appointment_date'] && $today <= $inavailability['end_date']){
						if ($i>=timetoint($inavailability['start_time']) && $i<timetoint($inavailability['end_time'])){
							//Doctor is not available
							$doctor_is_available = FALSE;
						}
					}
				}
			}
		}
		return $doctor_is_available;
	}
	function is_holiday($today){
		global $holidays;
		global $workingdays;

		$holiday_reason = "";
		//For Working Days
		$day = date("N",strtotime(($today)));
		if (!in_array($day, $workingdays)){
			$holiday_reason = "Non Working Day";
		}
		//For Holidays
		foreach($holidays as $holiday){
			if($holiday['working_status'] == "Non Working")	{
				if(strtotime($holiday['working_date']) <= strtotime($today) && strtotime($holiday['end_date']) >= strtotime($today)){
					$holiday_reason = $holiday['working_reason'];
				}
			}elseif($holiday['working_status'] == "Half Day"){
				if(strtotime($holiday['working_date']) == strtotime($today)){
					//$holiday_reason = $holiday['working_reason'];
					$holiday_reason = $holiday['working_status'];
				}
			}else{
				if(strtotime($holiday['working_date']) == strtotime($today)){
					$holiday_reason = "";
				}
			}
		}
		return $holiday_reason;
}
	function is_half_day($i,$s_time,$e_time){
	if(($i>=$s_time) && ($i<$e_time)){
			return true;
		}else{
			return false;
		}

	}
?>
<?php   
	$a_date= $day;
	$user_id = $this->session->userdata('id'); 
	$fullday = date('l', strtotime($day . "-" . $month . "-" . $year));
	$today = date('Y-m-d', strtotime($appointment_date ));
	//echo $today;
	//Clinic Start Time and Clinic End Time
	$start_time = timetoint($start_time);
	$end_time = timetoint($end_time);
?>

<div class="container-fluid">
	<div id="appointments"></div>
	<div class="card shadow mb-4">
	<div class="card-body">
						<div class="col-md-12 alert alert-info" id="no_appointment_msg">
							<?=$this->lang->line('no_appointments_msg');?>
						</div>
		<!--<div class="row">-->
			<!--<div class="col-md-12">-->
						<?php

						$day = date('l', strtotime($day . "-" . $month . "-" . $year));

						$today = date('Y-m-d', strtotime($appointment_date ));

						//Clinic Start Time and Clinic End Time

						$start_time = timetoint($start_time);

						$end_time = timetoint($end_time);

						?>

						<div class="panel-heading">
							<input type="text" id="select_date" name="select_date" class="btn square-btn-adjust btn-success btn-sm right" value="<?=date('d F Y, l', strtotime($g_day . "-" . $month . "-" . $year));?>" autocomplete="off"/>
							<?php $day_date=$day;?>	
							<span>&nbsp;<br/><br/></span>
						</div>
						
						<div class="mobileScheduler"></div>
				
						<!--------------------------- Display Doctor's Screen  ------------------------------->

				<div class="desktopScheduler">
					<?php if ($this->doctor_model->is_doctor($user_id)) {?>
						<div class="row">
							<div class="col-md-2">
							<a href="<?=site_url('appointment/add');?>" class="btn square-btn-adjust btn-primary right"><?=$this->lang->line('add_appointment');?></a>
							</div>
							<!--div class="col-md-2">
							<a href="#" class="btn square-btn-adjust btn-primary right" data-toggle="modal" data-target="#addInquiryModal"><?=$this->lang->line('add_inquiry');?></a>
							</div-->
						</div>
						<div class="table-responsive"  style='position:relative;height:500px;'>
							<table id="appointment_table" class="table table-condensed table-striped table-bordered table-hover dataTable no-footer"  >

								<thead>

									<tr>

										<th><?=$this->lang->line('time');?></th>

										<th><?=$this->lang->line('appointments');?></th>

										<th><?=$this->lang->line('waiting');?></th>

										<th><?=$this->lang->line('consultation');?></th>

										<th><?=$this->lang->line('complete');?></th>

										<th><?=$this->lang->line('cancel');?></th>

										<!--th><?=$this->lang->line('pending');?></th-->

									</tr>

								</thead>

								<tbody>

									<?php

										global $time_intervals;

										$time_intervals = array();

										$is_holiday = is_holiday($today);

										for ($i = $start_time; $i < $end_time; $i = $i + ($time_interval/60)) {

											$time = explode(":",inttotime($i));

											$time_intervals[] = round($i*100);

											if ($is_holiday == ""){

												$doctor_is_available = check_doctor_availability($i,$doctor_id);

												if ($doctor_is_available){ ?>

												<tr>

													<th><?=inttotime12( $i ,$time_format);?></th><!-- Display the Time -->

													<td id="app<?=round($i*100);?>" class="appointments"><a href='<?=base_url() . "index.php/appointment/add/" .$a_date."/" . $year . "/" . $month . "/" . $day_date . "/" . $time[0] . "/" . $time[1] . "/Appointments/0/".$doctor_id ?>' class="add_appointment"></a></td>

													<td id="wai<?=round($i*100);?>" class="waiting"><a href='<?=base_url() . "index.php/appointment/add/" .$a_date."/" . $year . "/" . $month . "/" . $day_date . "/" . $time[0] . "/" . $time[1] . "/Waiting/0/".$doctor_id ?>' class="add_appointment" ></a></td>

													<td id="con<?=round($i*100);?>" class="consultation"><a href='<?=base_url() . "index.php/appointment/add/" .$a_date."/" . $year . "/" . $month . "/" . $day_date . "/" . $time[0] . "/" . $time[1] . "/Consultation/0/".$doctor_id ?>' class="add_appointment" ></a></td>

													<td id="com<?=round($i*100);?>" class="complete"></td>

													<td id="can<?=round($i*100);?>" class="cancel"></td>

													<!--td id="pend<?=round($i*100);?>" class="cancel"></td-->

												</tr>

												<?php }else{ ?>

												<tr>

													<th><?=inttotime12( $i ,$time_format);?></th><!-- Display the Time -->

													<td id="app<?=round($i*100);?>" style="background-color:grey;"></td>

													<td id="wai<?=round($i*100);?>" style="background-color:grey;"></td>

													<td id="con<?=round($i*100);?>" style="background-color:grey;"></td>

													<td id="com<?=round($i*100);?>" style="background-color:grey;"></td>

													<td id="can<?=round($i*100);?>" style="background-color:grey;"></td>

													<!--td id="pend<?=round($i*100);?>" style="background-color:grey;"></td-->

												</tr>

												<?php } ?>

											<?php }else{ ?>

												<tr>

													<th><?=inttotime12( $i ,$time_format);?></th><!-- Display the Time -->

													<td id="app<?=round($i*100);?>" style="background-color:#FF5599;color:white;;"><?=$is_holiday;?></td>

													<td id="wai<?=round($i*100);?>" style="background-color:#FF5599;color:white;;"><?=$is_holiday;?></td>

													<td id="con<?=round($i*100);?>" style="background-color:#FF5599;color:white;;"><?=$is_holiday;?></td>

													<td id="com<?=round($i*100);?>" style="background-color:#FF5599;color:white;;"><?=$is_holiday;?></td>

													<td id="can<?=round($i*100);?>" style="background-color:#FF5599;color:white;;"><?=$is_holiday;?></td>

													<!--td id="pend<?=round($i*100);?>" style="background-color:#FF5599;color:white;;"><?=$is_holiday;?></td-->

												</tr>

											<?php } ?>

									<?php } ?>

									<tr>

										<th></th><!-- Display the Time -->

										<td id="app<?=round($i*100);?>" class="appointments"></a></td>

										<td id="wai<?=round($i*100);?>" class="waiting"></a></td>

										<td id="con<?=round($i*100);?>" class="consultation"></a></td>

										<td id="com<?=round($i*100);?>" class="complete"></td>

										<td id="can<?=round($i*100);?>" class="cancel"></td>

										<!--td id="pend<?=round($i*100);?>" class="cancel"></td-->

									</tr>

								</tbody>

							</table>

						</div>

					<?php } else { ?>

							<!--------------------------- Display Administration's Screen / Staff Scrren  ------------------------------->

							<div class="table-responsive"  style='position:relative;overflow:scroll;height:500px;'>
								<div class="right">
								<a href="<?=site_url('appointment/add');?>" class="btn square-btn-adjust btn-primary "><?=$this->lang->line('add_appointment');?></a>
								
								<!--a href="#" class="btn square-btn-adjust btn-primary " data-toggle="modal" data-target="#addInquiryModal"><?=$this->lang->line('add_inquiry');?></a-->
								</div>

								<table id="appointment_table" class="table table-condensed table-striped table-bordered table-hover dataTable no-footer"  >

									<thead>

										<tr>

											<th><?=$this->lang->line('time');?></th>

											<?php

											foreach ($doctors as $doctor) {

												/*if (strlen($doctor['name'])>12){

													$doctor_name = substr($doctor['name'],0,9)."..." ;

												}else{

													$doctor_name = $doctor['name'];

												}*/
												$doctor_name = $doctor['name'];
											?>

											<th><?=$doctor_name;?></th>

											<?php } ?>

										</tr>

									</thead>

									<tbody>

										<?php

										global $time_intervals;

										$time_intervals = array();

										for ($i = $start_time; $i < $end_time; $i = $i + ($time_interval/60)){

											$time = explode(":",inttotime($i));

											$time_intervals[] = round($i*100);

											?>

												<tr>

												<th><?=inttotime12( $i ,$time_format);?></th><!-- Display the Time -->

											<?php

												$is_holiday = is_holiday($today);

												if ($is_holiday == ""){

													foreach ($doctors as $doctor) {

														$doctor_is_available = check_doctor_availability($i,$doctor['doctor_id']);

														if ($doctor_is_available){

															?><td id="<?=$doctor['doctor_id'];?>_<?=round($i*100);?>"><a href='<?=base_url() . "index.php/appointment/add/".$a_date."/"  . $year . "/" . $month . "/" . $day_date . "/" . $time[0] . "/" . $time[1] . "/Appointments/0/".$doctor['doctor_id'] ?>' class="add_appointment"></a></td>	<?php

														}else{

															?><td id="<?=$doctor['doctor_id'];?>_<?=round($i*100);?>" bgcolor="gray"></td><?php

														}

													}

												}elseif($is_holiday == "Half Day"){

													foreach($doctors as $doctor){

														foreach($holidays as $holiday){

															//print_r($holiday)."<br/>";

															if($holiday['working_status']== "Half Day"){

																$s_time=substr($holiday['start_time'],0,2);

																$e_time=substr($holiday['end_time'],0,2);

																break;

															}

														}

														if(is_half_day($i,$s_time,$e_time)){

															?><td id="<?=$doctor['doctor_id'];?>_<?=round($i*100);?>" style="background-color:#4d4d4d;color:white;"><?=$is_holiday;?></td><?php

														}else{

															?><td id="<?=$doctor['doctor_id'];?>_<?=round($i*100);?>"><a href='<?=base_url() . "index.php/appointment/add/" .$a_date."/" . $year . "/" . $month . "/" . $day_date . "/" . $time[0] . "/" . $time[1] . "/Appointments/0/".$doctor['doctor_id'] ?>' class="add_appointment"></a></td>	<?php

														}

													}

												}else{

													foreach ($doctors as $doctor) {

														?><td id="<?=$doctor['doctor_id'];?>_<?=round($i*100);?>" style="background-color:#FF5599;color:white;"><?=$is_holiday;?></td><?php

													}

												}

												?>

												</tr>

										<?php }

											$time = explode(":",inttotime($i));

											$time_intervals[] = round($i*100);

											?>

												<tr>

												<th></th>

												<?php

													foreach ($doctors as $doctor) {

														?><td id="<?=$doctor['doctor_id'];?>_<?=round($i*100);?>"></td><?php

													}?>

												</tr>



									</tbody>

								</table>

							</div>

					<?php } ?>
				</div>
						<br/>
						
							<div class="col-md-12 text-align">
									<span class="btn square-btn-adjust btn-primary btn-sm margin-button"><?=$this->lang->line('appointment');?></span>&nbsp;
								
									<span class="btn square-btn-adjust btn-danger btn-sm margin-button"><?=$this->lang->line('consultation');?></span>&nbsp;
								
									<span class="btn square-btn-adjust btn-warning btn-sm margin-button"><?=$this->lang->line('waiting');?></span>&nbsp;
								
									<span class="btn square-btn-adjust btn-grey btn-sm margin-button"><?=$this->lang->line('not_available');?></span>&nbsp;
								
									<span class="btn square-btn-adjust btn-success btn-sm margin-button"><?=$this->lang->line('complete') .' '. $this->lang->line('appointment');?></span>&nbsp;
								
									<span class="btn square-btn-adjust btn-info btn-sm margin-button"><?=$this->lang->line('cancelled') .' '. $this->lang->line('appointment');?></span>&nbsp;
								<!--div class="col-md-2">
									<span class="btn square-btn-adjust btn_pending"><?=$this->lang->line('pending');?></span>
								</div-->
							</div>
						
			</br></br>
			<div class="row col-md-12">
			<div class="col-md-6">
					<!--------------------------- Display Follow-Up  ------------------------------->
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary dropdown-item"><?php echo $this->lang->line('follow_ups');?></h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
									<table class="table table-condensed table-striped table-bordered table-hover dataTable no-footer responsive" id="followup_table">
										<thead>
											<th><?= $this->lang->line('follow_up') .' '. $this->lang->line('date');?></th>
											<th><?= $this->lang->line('doctor');?></th>
											<th><?= $this->lang->line('patient');?></th>
										</thead>
										<tbody>
										<?php
											if ($followups) {
											$i = 0;
											foreach ($followups as $followup) {
												foreach ($patients as $patient) {
													if ($followup['patient_id'] == $patient['patient_id']) {
														if ($followup['patient_id'] == $patient['patient_id']) {
															foreach ($doctors as $doctor) {
																if ($followup['doctor_id'] == $doctor['doctor_id']) {
																	$followup_date = $followup['followup_date'];
																	$patient_name = $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'];
																	?>
																<tr>
																		<td><?= date($def_dateformate, strtotime($followup_date));?></td>
																		<td><?=$doctor['name'];?></td>
																		<td><a href='<?= base_url() . "index.php/patient/followup/" . $patient['patient_id'] ;?>' ><?=$patient_name;?></a></td>
																	</tr>
														<?php
																}
															}
														}
														break;
													}
												}
											} ?>
											<?php }	?>
										</tbody>
									</table>
							</div>
						</div>
					</div>
			</div>
			<div class="col-md-6">
				<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary dropdown-item"><?php echo $this->lang->line('tasks');?></h6>
							</div>
							<div class="card-body">
								<?php echo form_open('appointment/todos'); ?>
									<div class="input-group">
										<input type="text" name="task"  class="form-control" autocomplete="off">
										<span class="form-group input-group-btn">
											<input type="submit" class="btn square-btn-adjust btn-primary" value='<?=$this->lang->line('submit');?>' />
										</span>
									</div>
								<?php echo form_close(); ?>
								<?php foreach ($todos as $todo) { ?>
									<div class="checkbox">
										<label class="<?php if ($todo['done'] == 1) {echo 'done';} else {echo 'not_done';} ?>">
											<input type="checkbox" class="todo" name='todo' <?php if ($todo['done'] == 1) {echo 'checked="checked"';} ?> value="<?=$todo['id_num'];?>" /><?=$todo['todo'];?>
										</label>
										<a class='todo_img' href='<?=base_url() . "index.php/appointment/delete_todo/" . $todo['id_num'];?>'><i class='fa fa-times'></i></a>
									</div><div class="block"></br></div>
								<?php } ?>
							</div>
				</div>
			</div>
			</div>

				
			<!--</div>-->
		<!--</div>-->
	</div>
	</div>
</div>
<div class="modal fade" id="nag_screen_modal" tabindex="-1" role="dialog" aria-labelledby="myNagScreenLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title" id="myNagScreenLabel">Activate Plugins</h4>
		</div>
		<div class="modal-body">
			<p>Your following extensions are not activated.</p>
			<ul>
			<?php foreach($non_licence_activated_plugins as $non_licence_activated_plugin){ ?>
				<li><?=$non_licence_activated_plugin['module_display_name'];?></li>
			<?php } ?>
			</ul>
			<p>Please activate them before 1st May.
			They will stop working in future releases without activation.</p>
		</div>
		<div class="modal-footer">
			<a id="activate_plugins" class="btn btn-primary activate_plugins btn-sm" >Go to Activation</a>
			<a id="remind_later" class="btn btn-danger remind_later btn-sm" >Remind Later</a>
		</div>
	</div>
	</div>
</div>

<div class="modal fade" id="nag_screen2_modal" tabindex="-1" role="dialog" aria-labelledby="myNagScreenLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title" id="myNagScreenLabel">Do Not Upgrade</h4>
		</div>
		<div class="modal-body">
			<p>You still have not activated following plugins.</p>
			<ul>
			<?php foreach($non_licence_activated_plugins as $non_licence_activated_plugin){ ?>
				<li><?=$non_licence_activated_plugin['module_display_name'];?></li>
			<?php } ?>
			</ul>
			<p>DO NOT UPGRADE CHIKITSA BEFORE ACTIVATING THEM OR THEY WILL STOP WORKING.</p>
		</div>
		<div class="modal-footer">
			<a id="activate_plugins2" class="btn btn-primary activate_plugins btn-sm" >Go to Activation</a>
			<a id="do_not_remind" class="btn btn-danger btn-sm" >Do not Remind Again</a>
			<a id="remind_later2" class="btn btn-warning remind_later btn-sm" >Remind Later</a>
		</div>
	</div>
	</div>
</div>

<div class="modal fade" id="addInquiryModal" tabindex="-1" role="dialog" aria-labelledby="addInquiryModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addInquiryModalLabel"><?=$this->lang->line('add_inquiry');?></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<?php
			$attributes = array('id' => 'add_inquiry_form');
			echo form_open(site_url('patient/add_inquiry'),$attributes);
			?>
			<div class="modal-body">
					<div class="col-md-12"><label><?=$this->lang->line('name');?>:</label></div>
					<div class="row">
					<div class="col-md-4"><input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" autocomplete="off"/></div>
					<div class="col-md-4"><input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="Middle Name" autocomplete="off"/></div>
					<div class="col-md-4"><input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" autocomplete="off"/></div>
					</div>

					<div class="col-md-12"><label><?=$this->lang->line('email_id');?>:</label></div>
					<div class="col-md-12"><input type="text" id="email" name="email" class="form-control" autocomplete="off"/></div>


					<div class="col-md-12"><label><?=$this->lang->line('mobile_no');?>:</label></div>
					<div class="col-md-12"><input type="text" id="phone_number" name="phone_number" class="form-control" autocomplete="off"/></div>
					<div class="col-md-12"><input type="hidden" id="return_page" name="return_page" value="new_inquiry_report" class="form-control"/></div>
			</div>
			<div class="modal-footer">
					<button type="submit" class="btn square-btn-adjust btn-primary btn-sm" ><?=$this->lang->line('save');?></button>
					<button type="button" class="btn square-btn-adjust btn-default btn-sm" data-dismiss="modal"><?=$this->lang->line('close');?></button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>