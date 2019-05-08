<!--display on Click of Appointment page -->
<?php
	if(isset($doctor)){
		$doctor_name = $doctor['name'];
		$doctor_id = $doctor['doctor_id'];
	}
	if(isset($appointment)){
		//Edit Appointment
		$header = $this->lang->line("edit")." ".$this->lang->line("appointment");
		$first_name=set_value('first_name',$curr_patient['first_name']);
		$middle_name=set_value('middle_name',$curr_patient['middle_name']);
		$last_name=set_value('last_name',$curr_patient['last_name']);
		$patient_name = $curr_patient['first_name'] . " " . $curr_patient['middle_name'] . " " . $curr_patient['last_name'];
		$title = set_value('title',$appointment['title']);
		$appointment_id = set_value('appointment_id',$appointment['appointment_id']);
		$start_time = set_value('start_time',$appointment['start_time']);
		$end_time = set_value('end_time',$appointment['end_time']);
		$appointment_date = set_value('appointment_date',$appointment['appointment_date']);
		$appointment_reason = set_value('appointment_reason',$appointment['appointment_reason']);
		$status = set_value('status',$appointment['status']);
		$appointment_id = set_value('appointment_id',$appointment['appointment_id']);
		}else{
		//Add Appointment
		$header = $this->lang->line("new")." ".$this->lang->line("appointment");
		$patient_name = "";
		$title = set_value('title','');
		$start_time = date($def_timeformate,strtotime($appointment_time));
		$time_interval = (int)$time_interval;
		$end_time = date($def_timeformate, strtotime("$appointment_time + $time_interval minutes")); 
		$appointment_reason = set_value('appointment_reason','');
		$appointment_date = $appointment_date;
		$status = "Appointments";
		$first_name = set_value('first_name','');
		$middle_name = set_value('middle_name','');
		$last_name = set_value('last_name','');
		
		$phone_number = set_value('phone_number','');
		$second_number = set_value('second_number','');
		$email = set_value('email','');
		$address_line_1 = set_value('address_line_1','');
		$address_line_2 = set_value('address_line_2','');
		$city = set_value('city','');
	}
	if(isset($curr_patient)){
		$patient_id = $curr_patient['patient_id'];
	}else{
		$patient_id = 0;
	}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<?php if(!isset($appointment) && !isset($curr_patient)){ ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('add')." ".$this->lang->line('patient');?>
				</div>
				<div class="panel-body">
					<?php $s_time = date('H:i',strtotime($start_time));?>
					<?php $time = explode(":", $s_time); ?>
					<?php echo form_open('appointment/insert_patient_add_appointment' . "/" . $time[0] . "/" . $time[1] . "/" . $appointment_date . "/" . $status . "/" . $selected_doctor_id."/0/") ?>    	
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="form-group">
								<label for="first_name"><?php echo $this->lang->line('first')." ".$this->lang->line('name');?></label>
								<input type="text" name="first_name" value="<?= $first_name ?>" class="form-control"/>
								<?php echo form_error('first_name','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="middle_name"><?php echo $this->lang->line('middle')." ".$this->lang->line('name');?></label>
								<input type="text" name="middle_name" value="<?= $middle_name ?>"  class="form-control"/>
								<?php echo form_error('middle_name','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="last_name"><?php echo $this->lang->line('last')." ".$this->lang->line('name');?></label>
								<input type="text" name="last_name" value="<?= $last_name ?>" class="form-control"/>
								<?php echo form_error('last_name','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="form-group">
								<label for="phone_number"><?php echo $this->lang->line('phone_number')?></label>
								<input type="text" name="phone_number" value="<?= $phone_number ?>" class="form-control"/>
								<?php echo form_error('phone_number','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="second_number"><?php echo $this->lang->line('second_number')?></label>
								<input type="text" name="second_number" value="<?= $second_number ?>" class="form-control"/>
								<?php echo form_error('second_number','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="email"><?php echo $this->lang->line('email')?></label>
								<input type="text" name="email" value="<?= $email ?>" class="form-control"/>
								<?php echo form_error('email','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="form-group">
								<label for="type"><?php echo $this->lang->line('address_line_1');?></label> 
								<input type="input"  class="form-control" name="address_line_1" value="<?= $address_line_1 ?>"/>
								<?php echo form_error('address_line_1','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="type"><?php echo $this->lang->line('address_line_2');?></label> 
								<input type="input" class="form-control" name="address_line_2" value="<?= $address_line_2 ?>"/>
								<?php echo form_error('address_line_2','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="city"><?php echo $this->lang->line('city');?></label> 
								<input type="input" class="form-control" name="city" value="<?= $city ?>"/>
								<?php echo form_error('city','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="form-group">
								<label for="dob"><?php echo $this->lang->line('dob')?></label>
								<input type="text" name="dob" id="dob" value="" class="form-control"/>
								<?php echo form_error('dob','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="form-group">
								<label for="reference_by"><?php echo $this->lang->line('reference_by')?></label>
								<select name="reference_by" class="form-control" id="reference_by">
									<?php foreach($reference_by as $reference){?>
										<option reference_placeholder="<?php echo $reference['placeholder']; ?>" reference_add_option="<?php echo $reference['reference_add_option']; ?>" value="<?php echo $reference['reference_option']; ?>"><?php echo $reference['reference_option']; ?></option>
									<?php }?>
								</select>
								<?php echo form_error('reference_by','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="reference_details"><?php echo $this->lang->line('reference_details')?></label>
								<input type="text" name="reference_details" id="reference_details" value="" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="form-group">
								<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" /><?php echo $this->lang->line('add')." ".$this->lang->line('patient');?></button>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<?php } ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?=$header;?>
				</div>
				<div class="panel-body">
					<?php if(isset($session_date_id)){ ?>
					<div class="alert alert-warning"><?=$this->lang->line("planned_appointment");?></div>		
					<?php } ?>
					<?php $timezone = $this->settings_model->get_time_zone();
						if (function_exists('date_default_timezone_set'))
							date_default_timezone_set($timezone);
						$appointment_date = date($def_dateformate,strtotime($appointment_date)); ?>
					<?php if(isset($appointment)){ ?>
					<?php echo form_open('appointment/edit_appointment/'.$appointment['appointment_id']) ?>
					<?php }else{ ?>
					<?php echo form_open('appointment/add/'.$year.'/'.$month.'/'.$day.'/'.$hour.'/'.$min.'/'.$status.'/'.$patient_id) ?>
					<?php } ?>
					<input type="hidden" name="appointment_id" value="<?= $appointment_id; ?>"/>
					<input type="hidden" name="patient_id" id="patient_id" value="<?php if(isset($curr_patient)){echo $curr_patient['patient_id']; } ?>"/>
					<div class="panel panel-default">
						<div class="panel-heading">
							<?= $this->lang->line('search')." ".$this->lang->line('patient');?>
						</div>
						<div class="panel-body">
							<input type="hidden" name="title" id="title" value="<?= $title; ?>" class="form-control"/>
							<div class="col-md-3">
								<label for="display_id"><?php echo $this->lang->line('patient_id');?></label>
								<input type="text" <?php if(isset($session_date_id)){echo "readonly";}?> name="display_id" id="display_id" value="<?php if(isset($curr_patient)){echo $curr_patient['display_id']; } ?>" class="form-control"/>
							</div>
							<div class="col-md-3">
								<label for="patient"><?php echo $this->lang->line('patient');?></label>
								<input type="text" <?php if(isset($session_date_id)){echo "readonly";}?> name="patient_name" id="patient_name" value="<?php if(isset($curr_patient)){echo $curr_patient['first_name']." " .$curr_patient['middle_name']." " .$curr_patient['last_name']; } ?>" class="form-control"/>
								<?php echo form_error('patient_id','<div class="alert alert-danger">','</div>'); ?>
							</div>

							<div class="col-md-3">
								<label for="phone"><?php echo $this->lang->line('mobile');?></label>
								<input type="text" <?php if(isset($session_date_id)){echo "readonly";}?> name="phone_number" id="phone_number" value="<?php if(isset($curr_patient)){echo $curr_patient['phone_number']; } ?>" class="form-control"/>
							</div>
							<div class="col-md-3">
								<label for="email_id"><?php echo $this->lang->line('email');?></label>
								<input type="text" <?php if(isset($session_date_id)){echo "readonly";}?> name="email_id" id="email_id" value="<?php if(isset($curr_patient)){echo $curr_patient['email']; } ?>" class="form-control"/>
							</div>
						</div>
					</div>
					<input type="hidden" name="session_date_id" value="<?=@$session_date_id;?>" />
							
					<?php if($level =="Doctor" || isset($session_date_id)) {?>
					<div class="col-md-6">
						<div class="form-group">
							<label for="doctor"><?php echo $this->lang->line('doctor')." ".$this->lang->line('name');?></label>
							<input type="hidden" name="doctor_id" value="<?=$doctor['doctor_id'];?>" />
							<input type="text" class="form-control" name="doctor_name" value="<?=$doctor['name'];?>" readonly/>
							<?php //echo form_dropdown('doctor_id', $doctor_detail, $selected_doctor_id,'class="form-control"'); ?>
							<?php //echo form_error('doctor_id','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<?php }else{ ?>
					<div class="col-md-6">
						<div class="form-group">
							<label for="doctor"><?php echo $this->lang->line('doctor')." ".$this->lang->line('name');?></label>
							<?php 
								$doctor_detail = array();
								foreach ($doctors as $doctor_list){
									$doctor_detail[$doctor_list['doctor_id']] = $doctor_list['name'];
								}
							?>
							<?php echo form_dropdown('doctor_id', $doctor_detail, $selected_doctor_id,'class="form-control"'); ?>
							<?php echo form_error('doctor_id','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<?php } ?>
					<div class="col-md-4">
						<div class="form-group">
							<label for="appointment_date"><?php echo $this->lang->line('date');?></label>
							<input type="text" name="appointment_date" id="appointment_date" value="<?= $appointment_date; ?>" class="form-control"/>
							<?php echo form_error('appointment_date','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="start_time"><?php echo $this->lang->line('start_time');?></label>
							<input type="text" name="start_time" id="start_time" value="<?= date($def_timeformate,strtotime($start_time)); ?>" class="form-control"/>
							<?php echo form_error('start_time','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="end_time"><?=$this->lang->line('end_time');?></label>
							<input type="text" name="end_time" id="end_time" value="<?= date($def_timeformate,strtotime($end_time)); ?>" class="form-control"/>
							<?php echo form_error('end_time','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group">
							<label><?=$this->lang->line('reason');?></label>
							<input type="text" name="appointment_reason" id="appointment_reason" value="<?= $appointment_reason; ?>" class="form-control"/>
							<?php echo form_error('appointment_reason','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<br/>
					<div class="col-md-12">
						<div class="form-group">
							<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" value="save"/><?php echo $this->lang->line('save');?></button>
							<a class="btn btn-primary square-btn-adjust" href="<?=base_url() . "index.php/appointment/index/";?>"><?=$this->lang->line('back_to_app');?></a>
							<?php if(isset($appointment)){ ?>
								<a class="btn btn-primary square-btn-adjust" href="<?=base_url() . "index.php/bill/insert/".$patient_id."/".$doctor['doctor_id']."/".$appointment['appointment_id'];?>"><?=$this->lang->line('bill');?></a>
							<?php }else{ ?>
								<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" value="save_and_bill"/><?php echo $this->lang->line('save_and_bill');?></button>
							<?php } ?>
						</div>
					</div>
					<br/>
					<div class="col-md-12">
						<div class="form-group">
					<?php if(isset($appointment)){ ?>
						<?php if ($status != 'Appointments') { ?>
							<a class="btn btn-primary square-btn-adjust" href="<?=base_url() . "index.php/appointment/change_status/" . $appointment_id . "/Appointments";?>" ><?php echo $this->lang->line('appointment');?></a>
						<?php } ?>
						<?php if ($status != 'Cancel') { ?>
							<a class="btn btn-info square-btn-adjust" href="<?=base_url() . "index.php/appointment/change_status/" . $appointment_id . "/Cancel";?>" ><?php echo $this->lang->line('cancel')." ".$this->lang->line('appointment');?></a>
						<?php } ?>
						<?php if ($status != 'Waiting') { ?>
							<a class="btn btn-warning square-btn-adjust" href="<?=base_url() . "index.php/appointment/change_status/" . $appointment_id . "/Waiting";?>"><?php echo $this->lang->line('waiting');?></a>
						<?php } ?>
						<?php if ($status != 'Consultation') { ?>
							<a class="btn btn-danger square-btn-adjust" href="<?=base_url() . "index.php/appointment/change_status/" . $appointment_id . "/Consultation";?>"><?php echo $this->lang->line('consultation');?></a>
						<?php } ?>
					<?php } ?>
					</div>
						
					</div>
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- JQUERY SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-1.11.3.min.js"></script>
<!-- JQUERY UI SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-ui.min.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery.metisMenu.min.js"></script>
<!-- TimePicker SCRIPTS-->
<script src="<?= base_url() ?>assets/js/jquery.datetimepicker.min.js"></script>
<script src="<?= base_url() ?>/assets/js/dataTables/moment.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="<?= base_url() ?>assets/js/custom.min.js"></script>

<script type="text/javascript">
 
    $(window).load(function(){
 
		var searcharrpatient=[<?php $i = 0;
		foreach ($patients as $patient) {
			if ($i > 0) { echo ",";}
			echo '{value:"' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '",id:"' . $patient['patient_id'] . '",display:"' . $patient['display_id'] . '",num:"' . $patient['phone_number'] . '",email:"' . $patient['email'] . '"}';
			$i++;
		}?>];
		$("#patient_name").autocomplete({
			autoFocus: true,
			source: searcharrpatient,
			minLength: 1,//search after one characters
			
			select: function(event,ui){
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#phone_number").val(ui.item ? ui.item.num : '');
				$("#display_id").val(ui.item ? ui.item.display : '');
				$("#email_id").val(ui.item ? ui.item.email : '');
				
			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
					}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			}
		});   
		var searcharrdispname=[<?php $i = 0;
		foreach ($patients as $patient) {
			if ($i > 0) {
				echo ",";
			}
				echo '{value:"' . $patient['display_id'] . '",id:"' . $patient['patient_id'] . '",num:"' . $patient['phone_number'] . '",patient:"' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '",email:"' . $patient['email'] . '"}';
			$i++;
		}?>];
		$("#display_id").autocomplete({
			autoFocus: true,
			source: searcharrdispname,
			minLength: 1,//search after one characters
			select: function(event,ui)
			{
				//do something
			   $("#patient_id").val(ui.item ? ui.item.id : '');
			   $("#patient_name").val(ui.item ? ui.item.patient : '');
			   $("#phone_number").val(ui.item ? ui.item.num : '');
			   	$("#email_id").val(ui.item ? ui.item.email : '');
			},
			change: function(event, ui) 
			{
				if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			},
			response: function(event, ui) 
			{
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			}
		});   
		var searcharrmob=[<?php $i = 0;
		foreach ($patients as $patient) {
			if ($i > 0) {
				echo ",";
			}
				echo '{value:"' . $patient['phone_number'] . '",email:"' . $patient['email'] . '",id:"' . $patient['patient_id'] . '",display:"' . $patient['display_id'] . '",patient:"' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '",email:"' . $patient['email'] . '"}';
			$i++;
		}?>];
		$("#phone_number").autocomplete({
			autoFocus: true,
			source: searcharrmob,
			minLength: 1,//search after one characters
			select: function(event,ui){
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#patient_name").val(ui.item ? ui.item.patient : '');
				$("#display_id").val(ui.item ? ui.item.display : '');
				$("#email_id").val(ui.item ? ui.item.email : '');
			},
			change: function(event, ui) {
				if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			}
		});  
		var searchemail=[<?php $i = 0;
		foreach ($patients as $patient) {
			if ($i > 0) {
				echo ",";
			}
				echo '{value:"' . $patient['email'] . '",id:"' . $patient['patient_id'] . '",num:"' . $patient['phone_number'] . '",display:"' . $patient['display_id'] . '",patient:"' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '",email:"' . $patient['email'] . '"}';
			$i++;
		}?>];
		$("#email_id").autocomplete({
			autoFocus: true,
			source: searchemail,
			minLength: 1,//search after one characters
			select: function(event,ui){
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#phone_number").val(ui.item ? ui.item.num : '');
				$("#patient_name").val(ui.item ? ui.item.patient : '');
				$("#display_id").val(ui.item ? ui.item.display : '');
				$("#email_id").val(ui.item ? ui.item.email : '');
			},
			change: function(event, ui) {
				if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			}
		});  
		/*$('#appointment_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
		}); */
		 var unavailableDates = [
		 <?php 
		 $dates = "";
		 foreach($working_days as $working_day){
			if($working_day['working_status'] == 'Non Working'){
				if($dates != ""){
					$dates .= ",";
				}
				$dates .= "\"".date('Y-n-j',strtotime($working_day['working_date'])) ."\"";
			}
		 }
		 echo $dates;
		 ?>];
		 

		function unavailable(date) {
			dmy = date.getFullYear() + "-" + (date.getMonth() + 1)  + "-" + date.getDate();
			if ($.inArray(dmy, unavailableDates) == -1) {
				return [true, ""];
			} else {
				return [false, "", "Unavailable"];
			}
		}
		$('#appointment_date').datepicker({ dateFormat: '<?=$morris_date_format; ?>',beforeShowDay: unavailable }); 	
		$('#start_time').datetimepicker({
			datepicker:false,
			step:<?=$time_interval;?>,
			format: '<?=$def_timeformate; ?>',
			formatTime:'<?=$def_timeformate; ?>',
			<?php if($clinic_start_time != '00:00' && $clinic_end_time !='24:00'){?>
			minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
			maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
			<?php } ?>
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
		}); 
		$('#end_time').datetimepicker({
			datepicker:false,
			step:<?=$time_interval;?>,
			format: '<?=$def_timeformate; ?>',
			formatTime:'<?=$def_timeformate; ?>',
			<?php if($clinic_start_time != '00:00' && $clinic_end_time !='24:00'){?>
			minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
			maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
			<?php } ?>
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
		}); 
		
		$('#dob').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
		}); 
		
		$('#start_time').change(function() {
			var starttime = $('#start_time').val();
			$('#end_time').val(moment(starttime, '<?=$morris_time_format; ?>').add('<?=$time_interval; ?>', 'minutes').format('<?=$morris_time_format; ?>'));
		});
		
		
		
		$('#reference_by').on('change', function (e) {
			var optionSelected = $("option:selected", this);
  	        var reference_add_option  = optionSelected.attr('reference_add_option');
			var placeholder  = optionSelected.attr('reference_placeholder');
			
			if(reference_add_option == 1){
				$('#reference_details').parent().parent().show();
				$("#reference_details").attr("placeholder", placeholder);
			}else{
				$('#reference_details').parent().parent().hide();
			}
		});
});

$(document).ready(function(){
	var optionSelected = $("option:selected", this);
	var reference_add_option  = optionSelected.attr('reference_add_option');
	var placeholder  = optionSelected.attr('reference_placeholder');
	
	if(reference_add_option == 1){
		$('#reference_details').parent().parent().show();
		$("#reference_details").attr("placeholder", placeholder);
	}else{
		$('#reference_details').parent().parent().hide();
	}
});		
</script>