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
		$start_time_value = set_value('start_time',$appointment['start_time']);
		$end_time_value = set_value('end_time',$appointment['end_time']);
		$appointment_date_value = set_value('appointment_date',$appointment['appointment_date']);
		$appointment_reason = set_value('appointment_reason',$appointment['appointment_reason']);
		$status = set_value('status',$appointment['status']);
		$appointment_id = set_value('appointment_id',$appointment['appointment_id']);
	}else{
		//Add Appointment
		$header = $this->lang->line("new")." ".$this->lang->line("appointment");
		$patient_name = "";
		$title = set_value('title','');
		$start_time_value = set_value('start_time','');
		$time_interval = (int)$time_interval;
		$end_time_value = set_value('end_time',"");
		$appointment_reason = set_value('appointment_reason','');
		$appointment_date_value = set_value('appointment_date',"");
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
	if($appointment_date_value==""){
		$appointment_date=$appointment_date;
	}else{
		$appointment_date=$appointment_date_value;
	}
	if($start_time_value==""){
		$start_time=date($def_timeformate,strtotime($appointment_time));
	}else{
		$start_time=$start_time_value;
	}
	if($end_time_value==""){
		$end_time=date($def_timeformate, strtotime("$appointment_time + $time_interval minutes"));
	}else{
		$end_time=$end_time_value;
	}
?>


	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">

						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add')." ".$this->lang->line('patient');?></h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<?php $s_time = date('H:i',strtotime($start_time));?>
							<?php $time = explode(":", $s_time); ?>
							<?php 
							$attributes = array('id' => 'add_patient_form');
							echo form_open('appointment/insert_patient_add_appointment' . "/" . $time[0] . "/" . $time[1] . "/" . $appointment_date . "/" . $status . "/" . $selected_doctor_id."/0/",$attributes) ?>

								<div class="col-md-12">
									<label><?php echo $this->lang->line('name');?>:</label>
								</div>
								<div class="col-md-12">
								<div class="row">
								<div class="col-md-4"><input type="text" id="first_name" name="first_name" class="form-control" placeholder="first name" autocomplete="off"/>
								<?php echo form_error('first_name','<div class="alert alert-danger">','</div>'); ?>
								</div>
								<div class="col-md-4"><input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="middle name" autocomplete="off"/></div>
								<div class="col-md-4"><input type="text" id="last_name" name="last_name" class="form-control" placeholder="last name" autocomplete="off"/>
								<?php echo form_error('last_name','<div class="alert alert-danger">','</div>'); ?>
								</div>
								</div>
								</div>
								<div class="col-md-12"><label><?php echo $this->lang->line('email');?>:</label></div>
								<div class="col-md-12"><input type="text" id="email" name="email" class="form-control" autocomplete="off"/></div>
								
								<div class="col-md-12"><label><?php echo $this->lang->line('phone_number');?>:</label></div>
								<div class="col-md-12"><input type="text"  name="phone_number" class="form-control" autocomplete="off"/></div>

								<div class="col-md-12"><label><?php echo $this->lang->line('address_line_1');?>:</label></div>
								<div class="col-md-12"><input type="text" id="address_line_1" name="address_line_1" class="form-control" autocomplete="off"/></div>

								<div class="col-md-12"><label><?php echo $this->lang->line('address_line_2');?>:</label></div>
								<div class="col-md-12"><input type="text" id="address_line_2" name="address_line_2" class="form-control" autocomplete="off"/></div>
								
								<div class="col-md-12"><label><?php echo $this->lang->line('city');?>:</label></div>
								<div class="col-md-12"><input type="text" id="city" name="city" class="form-control" autocomplete="off"/></div>
								<div class="col-md-12">
									<div class="row">
									<div class="col-md-6"><label><?php echo $this->lang->line('gender');?>:</label></div>
									<div class="col-md-6"><label><?php echo $this->lang->line('dob');?>:</label></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row">
									<div class="col-md-6"><input type="radio" name="gender" value="male" /><?php echo $this->lang->line("male");?>
										<input type="radio" name="gender" value="female" /><?php echo $this->lang->line("female");?>
										<input type="radio" name="gender" value="other" /><?php echo $this->lang->line("other");?>
									</div>
									<div class="col-md-6"><input type="text" name="dob" id="dob" value="" class="form-control" autocomplete="off"/></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row">
									<div class="col-md-6"><label><?php echo $this->lang->line('reference_by');?>:</label></div>
									<div class="col-md-6"><label><?php echo $this->lang->line('reference_details');?>:</label></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row">
									<div class="col-md-6">
										<select name="reference_by" class="form-control" id="reference_by">
										<?php foreach($reference_by as $reference){?>
											<option reference_placeholder="<?php echo $reference['placeholder']; ?>" reference_add_option="<?php echo $reference['reference_add_option']; ?>" value="<?php echo $reference['reference_option']; ?>"><?php echo $reference['reference_option']; ?></option>
										<?php }?>
										</select>
									</div>
									<div class="col-md-6"><input type="text" name="reference_details" id="reference_details" value="" class="form-control" autocomplete="off"/></div>
									</div>
								</div>
								
							
						</div>
														
						<div class="modal-footer">
							<button class="btn btn-primary square-btn-adjust btn-sm" type="submit" name="submit" /><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add')." ".$this->lang->line('patient');?></button>
							<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
	</div>

	<!-- Begin Page Content -->
<div class="container-fluid">
		<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><?=$header;?></h6>
		</div>
		<div class="card-body">

			<a href="#" class="btn square-btn-adjust btn-primary btn-sm right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add')." ".$this->lang->line('patient');?></a><br/> &nbsp; <br/>

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
				<?php echo form_open('appointment/add/'.$a_date.'/'.$year.'/'.$month.'/'.$day.'/'.$hour.'/'.$min.'/'.$status.'/'.$patient_id) ?>
				<?php } ?>
				<input type="hidden" name="appointment_id" value="<?= $appointment_id; ?>"/>
				<input type="hidden" name="patient_id" id="patient_id" value="<?php if(isset($curr_patient)){echo $curr_patient['patient_id']; } ?>"/>
				<div class="panel panel-default" style="">
					<div class="panel-heading" style="margin-top: 3px;margin-left:-8px;margin-right: 2%;">
						<h6><?= $this->lang->line('search')." ".$this->lang->line('patient');?></h6>
					</div>
					<div class="row" style="margin-left:-8px;">
						<input type="hidden" name="title" id="title" value="<?= $title; ?>" class="form-control"/>
						<div class="col-md-6 col-lg-3">
							<label for="display_id"><?php echo $this->lang->line('patient_id');?></label>
							<input type="text" <?php //if(isset($session_date_id)){echo "readonly";}?> name="display_id" id="display_id" value="<?php if(isset($curr_patient)){echo $curr_patient['display_id']; } ?>" class="form-control" autocomplete="off"/>
						</div>
						<div class="col-md-6 col-lg-3">
							<label for="patient"><?php echo $this->lang->line('patient_name');?></label>
 							<input type="text" <?php //if(isset($session_date_id)){echo "readonly";}?> name="patient_name" id="patient_name" value="<?php if(isset($curr_patient)){echo $curr_patient['first_name']." " .$curr_patient['middle_name']." " .$curr_patient['last_name']; } ?>" class="form-control" autocomplete="off"/>
						</div>
						<div class="col-md-6 col-lg-3">
							<label for="phone"><?php echo $this->lang->line('mobile');?></label>
							<input type="text" <?php //if(isset($session_date_id)){echo "readonly";}?> name="phone_number" id="phone_number" value="<?php if(isset($curr_patient)){echo $curr_patient['phone_number']; } ?>" class="form-control" autocomplete="off"/>
						</div>
						<div class="col-md-6 col-lg-3">
							<label for="ssn_id"><?php echo $this->lang->line('ssn_id');?></label>
							<input type="text" <?php //if(isset($session_date_id)){echo "readonly";}?> name="ssn_id" id="ssn_id" value="<?php if(isset($curr_patient)){echo $curr_patient['ssn_id']; } ?>" class="form-control" autocomplete="off"/>
						</div>
					</div>
					<?php echo form_error('patient_id','<div class="alert alert-danger">','</div>'); ?>
				</div>
				<input type="hidden" name="session_date_id" value="<?=@$session_date_id;?>" /><br/>

				<?php if($level =="Doctor" /*|| isset($session_date_id)*/) {?>
				<div class="row" style="margin-left:0px;">
				<div class="col-md-6" >
					<div class="form-group">
						<label for="doctor"><?php echo $this->lang->line('doctor')." ".$this->lang->line('name');?></label>
						<input type="hidden" name="doctor_id" value="<?=$doctor['doctor_id'];?>" />
						<input type="text" class="form-control" name="doctor_name" value="<?=$doctor['name'];?>" readonly autocomplete="off"/>
						<?php //echo form_dropdown('doctor_id', $doctor_detail, $selected_doctor_id,'class="form-control"'); ?>
						<?php //echo form_error('doctor_id','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<?php }else{ ?>
				<div class="row" style="margin-left:0px;">
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
							<input type="text" name="appointment_date" id="appointment_date" value="<?= $appointment_date; ?>" class="form-control" autocomplete="off"/>
							<?php echo form_error('appointment_date','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
				</div>
				<div class="row" style="margin-left:0px;">
					<div class="col-md-4">
						<div class="form-group">
							<label for="start_time"><?php echo $this->lang->line('start_time');?></label>
							<input type="text" name="start_time" id="start_time" value="<?= date($def_timeformate,strtotime($start_time)); ?>" class="form-control" autocomplete="off"/>
							<?php echo form_error('start_time','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="end_time"><?=$this->lang->line('end_time');?></label>
							<input type="text" name="end_time" id="end_time" value="<?= date($def_timeformate,strtotime($end_time)); ?>" class="form-control" autocomplete="off"/>
							<?php echo form_error('end_time','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div> 
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label><?=$this->lang->line('reason');?></label>
						<input type="text" name="appointment_reason" id="appointment_reason" value="<?= $appointment_reason; ?>" class="form-control" autocomplete="off"/>
						<?php echo form_error('appointment_reason','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<br/>
				<div class="right">
				<div class="col-md-12 ">
					<div class="form-group">
						<button class="btn btn-primary square-btn-adjust btn-sm" type="submit" name="submit" value="save"/><?php echo $this->lang->line('save');?></button>
						<a class="btn btn-primary square-btn-adjust btn-sm" href="<?=base_url() . "index.php/appointment/index/";?>"><?=$this->lang->line('back_to_app');?></a>
						<?php if(isset($appointment)){ ?>
							<?php if(isset($bill)) {?>
							<a class="btn btn-primary square-btn-adjust btn-sm" href="<?=site_url("bill/edit/".$bill['bill_id']);?>"><?=$this->lang->line('bill');?></a>
							<?php } else{  ?>
							<a class="btn btn-primary square-btn-adjust btn-sm" href="<?=base_url() . "index.php/bill/insert/".$patient_id."/".$doctor['doctor_id']."/".$appointment['appointment_id'];?>"><?=$this->lang->line('bill');?></a>
							<?php } ?>
						<?php }else{ ?>
							<button class="btn btn-primary square-btn-adjust btn-sm" type="submit" name="submit" value="save_and_bill"/><?php echo $this->lang->line('save_and_bill');?></button>
						<?php } ?>
					</div>
				</div>
				</div>
				<br/>
				<div class="right">
				<div class="col-md-12">
					<div class="form-group">
				<?php if(isset($appointment)){ ?>
					<?php if ($status != 'Appointments') { ?>
						<a class="btn btn-primary square-btn-adjust btn-sm" href="<?=base_url() . "index.php/appointment/change_status/" . $appointment_id . "/Appointments";?>" ><?php echo $this->lang->line('appointment');?></a>
					<?php } ?>
					<?php if ($status != 'Cancel') { ?>
						<a class="btn btn-info square-btn-adjust btn-sm" href="<?=base_url() . "index.php/appointment/change_status/" . $appointment_id . "/Cancel";?>" ><?php echo $this->lang->line('cancel')." ".$this->lang->line('appointment');?></a>
					<?php } ?>
					<?php if ($status != 'Waiting') { ?>
						<a class="btn btn-warning square-btn-adjust btn-sm" href="<?=base_url() . "index.php/appointment/change_status/" . $appointment_id . "/Waiting";?>"><?php echo $this->lang->line('waiting');?></a>
					<?php } ?>
					<?php if ($status != 'Consultation') { ?>
						<a class="btn btn-danger square-btn-adjust btn-sm" href="<?=base_url() . "index.php/appointment/change_status/" . $appointment_id . "/Consultation";?>"><?php echo $this->lang->line('consultation');?></a>
					<?php } ?>
				<?php } ?>
				</div>
				</div>
				
				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

    $(window).on('load', function(){
		$(".expand-collapse-header").click(function () {
			if($(this).find("i").hasClass("fa-arrow-circle-down"))
			{
				$(this).find("i").removeClass("fa-arrow-circle-down");
				$(this).find("i").addClass("fa-arrow-circle-up");
			}else{
				$(this).find("i").removeClass("fa-arrow-circle-up");
				$(this).find("i").addClass("fa-arrow-circle-down");
			}

			$content = $(this).next('.expand-collapse-content');
			$content.slideToggle(500);

		});



		$('#appointment_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
		});
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

		$("#add_patient_form").validate({
			// Specify validation rules
			errorClass: "alert alert-danger no_margin",
			errorElement: "div",
			rules: {
				// The key name on the left side is the name attribute
				// of an input field. Validation rules are defined
				// on the right side
				first_name: {	required: true,	},
				last_name: {required: true,	},
			},
			// Specify validation error messages
			messages: {
				first_name: { required: "<?=$this->lang->line('please_enter_first_name');?>" },
				last_name: { required: "<?=$this->lang->line('please_enter_last_name');?>" },
			},
			// Make sure the form is submitted to the destination defined
			// in the "action" attribute of the form when valid
			submitHandler: function(form) {
				$(form).ajaxSubmit({
					success: function(response) {
						//$("#addInquiryModal").modal("hide");
					}
				});
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

	var searcharrpatient=[<?php $i = 0;
		foreach ($patients as $patient) {
			if ($i > 0) { echo ",";}
			echo '["' . $patient['display_id'] . '","' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '","' . $patient['phone_number'] . '","' . $patient['ssn_id'] . '","' . $patient['patient_id'] . '"]';
			$i++;
		}?>];
	var p_columns = [ {name: '<?php echo $this->lang->line("patient").$this->lang->line("id");?>', minWidth:'80px'},{name: '<?php echo $this->lang->line("name");?>', minWidth:'100px'}, {name: '<?php echo $this->lang->line('phone_number'); ?>', minWidth:'120px'},{name: '<?php echo $this->lang->line('ssn_id'); ?>', minWidth:'120px'},{name: '<?php echo $this->lang->line("id");?>', minWidth: '30px'}];
	var p_values=searcharrpatient;
	
	$("#patient_name").mcautocomplete({
              showHeader: true,
              columns: p_columns,
              source: p_values,
              select: function(event, ui) {
                  this.value = (ui.item ? ui.item[1]: '');
			$("#patient_id").val(ui.item ? ui.item[4] : '');
			$("#display_id").val(ui.item ? ui.item[0] : '');
			$("#phone_number").val(ui.item ? ui.item[2] : '');
			$("#ssn_id").val(ui.item ? ui.item[3] : '');
                  return false;
              },
		change: function(event, ui) {
		if (ui.item == null) {
			$("#patient_id").val('');
				$("#phone_number").val('');
				$("#display_id").val('');
				$("#patient_name").val('');
				$("#ssn_id").val('');
			}
			},
			response: function(event, ui) {
			if (ui.content.length === 0)
			{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#ssn_id").val('');
				}
			}
    });
	$("#phone_number").mcautocomplete({
              showHeader: true,
              columns: p_columns,
              source: p_values,
              select: function(event, ui) {
                  this.value = (ui.item ? ui.item[2]: '');
			$("#patient_id").val(ui.item ? ui.item[4] : '');
			$("#display_id").val(ui.item ? ui.item[0] : '');
			$("#patient_name").val(ui.item ? ui.item[1] : '');
			$("#ssn_id").val(ui.item ? ui.item[3] : '');
                  return false;
              },
		change: function(event, ui) {
		if (ui.item == null) {
			$("#patient_id").val('');
				$("#phone_number").val('');
				$("#display_id").val('');
				$("#patient_name").val('');
				$("#ssn_id").val('');
			}
			},
			response: function(event, ui) {
			if (ui.content.length === 0)
			{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#ssn_id").val('');
				}
			}
    });
	$("#display_id").mcautocomplete({
              showHeader: true,
              columns: p_columns,
              source: p_values,
              select: function(event, ui) {
                  this.value = (ui.item ? ui.item[0]: '');
			$("#patient_id").val(ui.item ? ui.item[4] : '');
			$("#patient_name").val(ui.item ? ui.item[1] : '');
			$("#phone_number").val(ui.item ? ui.item[2] : '');
			$("#ssn_id").val(ui.item ? ui.item[3] : '');
                  return false;
              },
		change: function(event, ui) {
		if (ui.item == null) {
			$("#patient_id").val('');
				$("#phone_number").val('');
				$("#display_id").val('');
				$("#patient_name").val('');
				$("#ssn_id").val('');
			}
			},
			response: function(event, ui) {
			if (ui.content.length === 0)
			{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#ssn_id").val('');
				}
			}
    });
	$("#ssn_id").mcautocomplete({
              showHeader: true,
              columns: p_columns,
              source: p_values,
              select: function(event, ui) {
                  this.value = (ui.item ? ui.item[3]: '');
			$("#patient_id").val(ui.item ? ui.item[4] : '');
			$("#patient_name").val(ui.item ? ui.item[1] : '');
			$("#phone_number").val(ui.item ? ui.item[2] : '');
			$("#display_id").val(ui.item ? ui.item[0] : '');
                  return false;
              },
		change: function(event, ui) {
		if (ui.item == null) {
			$("#patient_id").val('');
				$("#phone_number").val('');
				$("#display_id").val('');
				$("#patient_name").val('');
				$("#ssn_id").val('');
			}
			},
			response: function(event, ui) {
			if (ui.content.length === 0)
			{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#ssn_id").val('');
				}
			}
	});
});
</script>