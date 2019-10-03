<script type="text/javascript">
function readURL(input) {
	if (input.files && input.files[0]) {//Check if input has files.
		var reader = new FileReader(); //Initialize FileReader.

		reader.onload = function (e) {
		$('#PreviewImage').attr('src', e.target.result);
		$("#PreviewImage").resizable({ aspectRatio: true, maxHeight: 300 });
		};
		reader.readAsDataURL(input.files[0]);
	}else {
		$('#PreviewImage').attr('src', "#");
	}
}

$(window).load(function(){
	$('.datetimepicker').datetimepicker({		
		timepicker:false,
		format: '<?=$def_dateformate; ?>',
		scrollInput:false, 
		scrollMonth:false,
		scrollTime:false,
	});
	$( "#add_contact_detail" ).click(function(e) {
		e.preventDefault();
		var contact_detail_count = parseInt( $( "#contact_detail_count" ).val());
		contact_detail_count = contact_detail_count + 1;
		$( "#contact_detail_count" ).val(contact_detail_count);
		
		var contact_detail = "<div class='col-md-12' style='padding-left:0;'><div class='col-md-3'><div class='radio'><label><input type='radio' name='default' value='"+contact_detail_count+"'>Default</label></div></div><div class='col-md-3' style='padding-left:0;'><select name='contact_type[]' class='form-control'><option value='mobile'>Mobile</option><option value='office'>Office</option><option value='residence'>Residence</option></select></div><div class='col-md-3'><input type='input' name='contact_detail[]' value='' class='form-control'/></div><div class='col-md-3'><a href='#' id='delete_contact_detail"+contact_detail_count+"' class='btn btn-danger btn-sm square-btn-adjust'>Delete</a></div></div>";
		$( "#contact_detail_list" ).append(contact_detail);
		
		$("#delete_contact_detail"+contact_detail_count).click(function(e) {			
			e.preventDefault();
			$(this).parent().parent().remove();
		});
	});
	<?php if (in_array("alert", $active_modules)) { ?>
	$('.email_alert').change(function() {	
		if($(this).prop("checked")){
			$(this).parent().parent().siblings().prop('checked', true);
			$(this).parent().parent().parent().parent().siblings().prop('checked', true);
		}
	});
	$('.sms_alert').change(function() {	
		if($(this).prop("checked")){
			$(this).parent().parent().siblings().prop('checked', true);
			$(this).parent().parent().parent().parent().siblings().prop('checked', true);
		}
	});
	<?php } ?>
	<?php 
		$i=1;
		if(!empty($contact_details)){
			foreach($contact_details as $contact_detail){
				?>	
				$("#delete_contact_detail<?=$i;?>").click(function() {			
					$(this).parent().parent().remove();
				});
				<?php
				$i++;
			}
		}
	?>
	function convertDateFormat(dateString){
		if('<?=$def_dateformate; ?>' == 'd-m-Y'){
			var dateArray = dateString.split("-");
			var d = new Date(dateArray[2], dateArray[1], dateArray[0]);
			var newDateString = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
		}else if('<?=$def_dateformate; ?>' == 'Y-m-d'){
			var dateArray = dateString.split("-");
			var d = new Date(dateArray[0], dateArray[1], dateArray[2]);
			var newDateString = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
		} 
		return newDateString;
	}
	function calculate_age() {
		if($('#dob').val() != ""){
			var dateString = $('#dob').val();
		
		dateString = convertDateFormat(dateString);
		
		var now = new Date();
		var today = new Date(now.getYear(),now.getMonth(),now.getDate());
		var yearNow = now.getYear();
		var monthNow = now.getMonth();
		var dateNow = now.getDate();

		var dateArray = dateString.split("-");
		var dob = new Date(dateArray[0], dateArray[1]-1, dateArray[2]);
			

		var yearDob = dob.getYear();
		var monthDob = dob.getMonth();
		var dateDob = dob.getDate();
		var age = {};
		var ageString = "";
		var yearString = "";
		var monthString = "";
		var dayString = "";


		yearAge = yearNow - yearDob;

		if (monthNow >= monthDob)
			var monthAge = monthNow - monthDob;
		else {
			yearAge--;
			var monthAge = 12 + monthNow -monthDob;
		}

		  if (dateNow >= dateDob)
			var dateAge = dateNow - dateDob;
		  else {
			monthAge--;
			var dateAge = 31 + dateNow - dateDob;

			if (monthAge < 0) {
			  monthAge = 11;
			  yearAge--;
			}
		  }

		  age = {
			  years: yearAge,
			  months: monthAge,
			  days: dateAge
			  };
		  if ( age.years > 1 ) yearString = " years";
		  else yearString = " year";
		  if ( age.months> 1 ) monthString = " months";
		  else monthString = " month";
		  if ( age.days > 1 ) dayString = " days";
		  else dayString = " day";


		  if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
			ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
		  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
			ageString = "Only " + age.days + dayString + " old!";
		  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
			ageString = age.years + yearString + " old. Happy Birthday!!";
		  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
			ageString = age.years + yearString + " and " + age.months + monthString + " old.";
		  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
			ageString = age.months + monthString + " and " + age.days + dayString + " old.";
		  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
			ageString = age.years + yearString + " and " + age.days + dayString + " old.";
		  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
			ageString = age.months + monthString + " old.";
		  else ageString = "Oops! Could not calculate age!";

			$('#age').val(age.years);
		}
		
			
	}
	
	calculate_age();
	
	$('#dob').change(function(){
		calculate_age();
	});	
	$('#reference_by').on('change', function (e) {
		var optionSelected = $("option:selected", this);
		var reference_add_option  = optionSelected.attr('reference_add_option');
		var placeholder  = optionSelected.attr('reference_placeholder');
		if(reference_add_option == 1){
			$('#reference_details').parent().show();
			$("#reference_details").attr("placeholder", placeholder);
		}else{
			$('#reference_details').parent().hide();
			$('#reference_details').val('');
		}
	});
	
	
});
$(document).ready(function(){
	var optionSelected = $("option:selected", this);
	var reference_add_option  = optionSelected.attr('reference_add_option');
	var placeholder  = optionSelected.attr('reference_placeholder');
	
	if(reference_add_option == 1){
		$('#reference_details').parent().show();
		$("#reference_details").attr("placeholder", placeholder);
	}else{
		$('#reference_details').parent().hide();
	}
});		
</script>
<?php
	if(isset($patient)){
		if($patient['dob'] == NULL){
			$dob = set_value('dob',"");
		}else{
			$dob = set_value('dob',date($def_dateformate,strtotime($patient['dob'])));
		}
		$age = $patient['age'];
		$blood_group = $patient['blood_group'];
		$display_id = set_value('display_id',$patient['display_id']);
		$ssn_id = set_value('ssn_id',$patient['ssn_id']);
		$gender = set_value('gender',$patient['gender']);
		$patient_reference_by = $patient['reference_by'];
		$patient_reference_by_detail = $patient['reference_by_detail'];		
	}else{
		$age =  set_value('age',"");
		$blood_group =  set_value('blood_group',"");
		$dob =  set_value('dob',"");
		$display_id = set_value('display_id',"");
		$ssn_id = set_value('ssn_id',"");
		$gender= set_value('gender',"");
		$reference_by = set_value('reference_by',"");
		//echo $reference_by;
		$reference_details = "";
		$patient_reference_by_detail = "";
	}
	if(isset($contacts)){
		$contact_id = $contacts['contact_id']; 
		$contact_title = set_value('title',$contacts['title']);
		$contact_first_name = $contacts['first_name'];
		$contact_middle_name = set_value('middle_name',$contacts['middle_name']);
		$contact_last_name = set_value('last_name',$contacts['last_name']);
		$contact_display_name = set_value('display_name',$contacts['display_name']);
		$contact_phone_number = set_value('phone_number',$contacts['phone_number']);
		$contact_second_number = set_value('second_number',$contacts['second_number']);
		$contact_email = set_value('email',$contacts['email']);
		$contact_contact_image = set_value('contact_image',$contacts['contact_image']);
		$contact_address_line_1 = set_value('address_line_1',$contacts['address_line_1']);
		$contact_address_line_2 = set_value('address_line_2',$contacts['address_line_2']);
		$contact_city = set_value('city',$contacts['city']);
		$contact_state = set_value('state',$contacts['state']);
		$contact_postal_code = set_value('postal_code',$contacts['postal_code']);
		$contact_country = set_value('country',$contacts['country']);
	}else{
		$contact_id = 0;
		$contact_title = set_value('title','');
		$contact_first_name = set_value('first_name','');
		$contact_middle_name = set_value('middle_name','');
		$contact_last_name = set_value('last_name','');
		$contact_display_name = set_value('display_name','');
		$contact_phone_number = set_value('phone_number','');
		$contact_second_number = set_value('second_number','');
		$contact_email = set_value('email','');
		$contact_contact_image = set_value('contact_image','');
		$contact_address_line_1 = set_value('address_line_1','');
		$contact_address_line_2 = set_value('address_line_2','');
		$contact_city = set_value('city','');
		$contact_state = set_value('state','');
		$contact_postal_code = set_value('postal_code',''); 
		$contact_country = set_value('country','');
	}
	function is_enabled($patient_alerts,$alert_name,$is_enabled){
		if($is_enabled == 1 && (count($patient_alerts)>0)){
			foreach($patient_alerts as $patient_alert){
				if($patient_alert['alert_name'] == $alert_name){
					if($patient_alert['is_enabled'] == 1){
						return "checked='checked'";
					}
				}
			}
		}elseif($is_enabled !=1){
			return "disabled ='disabled'";
		}else{
			return "checked='checked'";
		}
	}
	/*
	function is_enabled($patient_alerts,$alert_name,$is_enabled){
		if($is_enabled == 1){
			foreach($patient_alerts as $patient_alert){
				if($patient_alert['alert_name'] == $alert_name){
					if($patient_alert['is_enabled'] == 1){
						return "checked='checked'";
					}
				}
			}
		}else{
			return "disabled ='disabled'";
		}
	}*/
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('patient');?>
				</div>
				<div class="panel-body">
					<?php if (isset($patient_id)) {?>
					<?php echo form_open_multipart('patient/edit/'.$patient_id.'/'.$called_from) ?>
					<?php }else{?>
					<?php echo form_open_multipart('patient/edit/0/patient') ?>
					<?php }?>
					<?php if(isset($error)) {echo "<div class='alert alert-danger'>".$error."</div>";} ?>
					<?php if (isset($patient_id)) {?>
					<input type="hidden" name="contact_id" class="inline" value="<?= $contact_id; ?>"/>
					<input type="hidden" name="patient_id" class="inline" value="<?= $patient_id; ?>"/>
					<?php }?>
					<div class="col-md-12">
						<div class="col-md-1">
							<label for="first_name"><?php echo $this->lang->line('name');?></label> 
						</div>
						<div class="col-md-2">
							<input type="input" name="title" placeholder="Title" class="form-control" value="<?php echo $contact_title ?>"/>
							<?php echo form_error('title','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-3">
							<input type="input" name="first_name" placeholder="First Name" class="form-control" value="<?php echo $contact_first_name ?>"/>
							<?php echo form_error('first_name','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-3">
							<input type="input" name="middle_name" placeholder="Middle Name" class="form-control" value="<?php echo $contact_middle_name ?>"/>						
							<?php echo form_error('middle_name','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-3">
							<input type="input" name="last_name" placeholder="Last Name" class="form-control" value="<?php echo $contact_last_name ?>"/>
							<?php echo form_error('last_name','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-12">
						<p></p>
					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="form-group">
								<label for="display_id"><?php echo $this->lang->line('patient_id');?></label>
								<input type="input" name="display_id" class="form-control" value="<?php echo $display_id; ?>"/>
								<?php echo form_error('display_id','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="ssn_id"><?php echo $this->lang->line('ssn_id');?></label>
								<input type="input" name="ssn_id" class="form-control" value="<?php echo $ssn_id; ?>"/>
								<?php echo form_error('ssn_id','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="display_name"><?php echo $this->lang->line('display_name');?></label>
								<input type="input" name="display_name" class="form-control" value="<?php echo $contact_display_name; ?>"/>
								<?php echo form_error('display_name','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="gender"><?php echo $this->lang->line('gender');?></label> 
								<input type="radio" name="gender" value="male" <?php if($gender == 'male'){echo "checked='checked'";}?>/><?php echo $this->lang->line("male");?>
								<input type="radio" name="gender" value="female" <?php if($gender == 'female'){echo "checked='checked'";}?>/><?php echo $this->lang->line("female");?>
								<input type="radio" name="gender" value="other" <?php if($gender == 'other'){echo "checked='checked'";}?>/><?php echo $this->lang->line("other");?>
								<?php echo form_error('gender','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="dob"><?php echo $this->lang->line('dob');?></label>
								<input type="text" name="dob" id="dob" class="form-control datetimepicker"  value="<?php  echo $dob; ?>"/>
								<?php echo form_error('dob','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="age"><?php echo $this->lang->line('age');?></label>
								<input type="input" name="age" id="age" class="form-control" value="<?=$age;?>" />
								<?php echo form_error('age','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="blood_group"><?php echo $this->lang->line('blood_group');?></label>
								<select name="blood_group" class="form-control">
									<option value="" ><?php echo $this->lang->line('select_blood_group');?></option>
									<option value="A+" <?php if($blood_group == "A+") echo "selected"; ?>>A+</option>
									<option value="O+" <?php if($blood_group == "O+") echo "selected"; ?>>O+</option>
									<option value="B+" <?php if($blood_group == "B+") echo "selected"; ?>>B+</option>
									<option value="AB+" <?php if($blood_group == "AB+") echo "selected"; ?>>AB+</option>
									<option value="A-" <?php if($blood_group == "A-") echo "selected"; ?>>A-</option>
									<option value="O-" <?php if($blood_group == "O-") echo "selected"; ?>>O-</option>
									<option value="B-" <?php if($blood_group == "B-") echo "selected"; ?>>B-</option>
									<option value="AB-" <?php if($blood_group == "AB-") echo "selected"; ?>>AB-</option>
								</select>
								<?php echo form_error('blood_group','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="reference_by"><?php echo $this->lang->line('reference_by');?></label>
								<select name="reference_by" class="form-control" id="reference_by">
									<option></option>
									<?php foreach($references as $reference){?>
										<?php 
										$selected = "";
										if($patient['reference_by'] == $reference['reference_option']){
											$selected = "selected";	
										}else{
											if($reference['reference_option'] == "Doctor:"){
													$selected = "selected";		
											}
										}
										//echo $reference['reference_option'];
										//echo $patient['reference_by'];
										?>
										<option reference_placeholder="<?php echo $reference['placeholder']; ?>" reference_add_option="<?php echo $reference['reference_add_option']; ?>" value="<?php echo $reference['reference_option']; ?>" <?=$selected?>>
										<?php echo $reference['reference_option']; ?>
										</option>
									<?php }?>
								</select>
								<?php echo form_error('reference_by','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="reference_details"><?php echo $this->lang->line('reference_details')?></label>
								<input type="text" name="reference_details" id="reference_details" value="<?=$patient_reference_by_detail;?>" class="form-control"/>
							</div>
							<div id="contact_detail_list">
							<div class="form-group">
							<a href="#" id="add_contact_detail" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line('add_more_contact_number');?></a>
							</div>
							<?php 
								$count = 0;
								if(isset($contact_details)){
									$count = count($contact_details);
								}
							?>
							<input type="hidden" id="contact_detail_count" value="<?=$count;?>"/>
							
							
							<?php if(!empty($contact_details)){?>
								<?php $i=1; ?>
								<?php foreach($contact_details as $contact_detail){ ?>
									<div class="col-md-12" style="padding-left:0;">
									<div class="col-md-3">
										<div class="radio"><label><input name='default' type="radio" value="<?=$i;?>" <?php if($contact_detail['is_default'] == 1){echo "checked";}?>><?php echo $this->lang->line('default');?></label></div>
									</div>
									<div class="col-md-3" style="padding-left:0;">
										<select name="contact_type[]" class="form-control">
											<option value="mobile" <?php if($contact_detail['type'] == "mobile") echo "selected"; ?>><?php echo $this->lang->line('mobile');?></option>
											<option value="office" <?php if($contact_detail['type'] == "office") echo "selected"; ?>><?php echo $this->lang->line('office');?></option>
											<option value="residence" <?php if($contact_detail['type'] == "residence") echo "selected"; ?>><?php echo $this->lang->line('residence');?></option>
										</select>
									</div>
									<div class="col-md-3">
										<input type="input" name="contact_detail[]" value="<?=$contact_detail['detail'];?>" placeholder="Contact Number"  class="form-control"/>
									</div>
									<div class='col-md-3'>
										<a href='#' id='delete_contact_detail<?=$i;?>' class='btn btn-danger btn-sm square-btn-adjust'><?php echo $this->lang->line('delete');?></a>
									</div>
									</div>
									<?php $i++; ?>
								<?php } ?>
							<?php }else{ ?>
								<div class="col-md-12" style="padding-left:0;">
								<div class="col-md-3">
									<div class="radio"><label><input name='default' type="radio" value="<?=$i;?>" checked><?php echo $this->lang->line('default');?></label></div>
								</div>
								<div class="col-md-3" style="padding-left:0;">
									<select name="contact_type[]" class="form-control">
										<option value="mobile"><?php echo $this->lang->line('mobile');?></option>
										<option value="office"><?php echo $this->lang->line('office');?></option>
										<option value="residence"><?php echo $this->lang->line('residence');?></option>
									</select>
								</div>
								<div class="col-md-5">
									<input type="input" name="contact_detail[]" value="" placeholder="Contact Number"  class="form-control"/>
								</div>
								<div class="col-md-1">
									
								</div>
								</div>
							<?php } ?>
							
							<?php echo form_error('contact_detail[]','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="email"><?php echo $this->lang->line('email');?></label>
								<input type="input" name="email" class="form-control" value="<?php  echo $contact_email; ?>"/><br/>
								<?php echo form_error('email','<div class="alert alert-danger">','</div>'); ?>
							</div>
							
							
						</div>
						<div class="col-md-6">
							<div class="form-group image_wrapper">
								<?php if($contact_contact_image!=""){ ?>
								<img id="PreviewImage" src="<?php echo base_url().$contacts['contact_image']; ?>" alt="Profile Image"  height="100" width="100" />
								<?php }else{ ?>
								<img id="PreviewImage" src="<?php echo base_url()."uploads/images/Profile.png"; ?>" alt="Profile Image"  height="100" width="100" />
								<?php } ?>
								<?php if(isset($patient_id)) {?>
								<a class="btn btn-danger btn-sm square-btn-adjust" href="<?=site_url('patient/remove_profile_image/'.$patient_id.'/'.$called_from);?>"><?php echo $this->lang->line('remove_patient_image');?></a>
								<?php }?>
								<input type="file" id="userfile" name="userfile" class="form-control" size="20" onchange="readURL(this);" />
								<input type="hidden" id="src" name="src" value="<?php echo $contact_contact_image; ?>" />
								<?php echo form_error('userfile','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="type"><?php echo $this->lang->line('addresstype');?></label> 
								<select name="type" class="form-control">
									<option></option>
									<?php if(isset($contacts)){ ?>
									<option value="Home" <?php if ($contacts['type'] == "Home") { echo "selected"; } ?>><?php echo $this->lang->line('home');?></option>
									<option value="Office" <?php if ($contacts['type'] == "Office") { echo "selected"; } ?>><?php echo $this->lang->line('office');?></option>
									<?php }else{ ?>	
									<option value="Home" selected><?php echo $this->lang->line('home');?></option>
									<option value="Office" ><?php echo $this->lang->line('office');?></option>
									<?php } ?>
								</select>
								<?php echo form_error('type','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="type"><?php echo $this->lang->line('address_line_1');?></label> 
								<input type="input"  class="form-control" name="address_line_1" value="<?php echo $contact_address_line_1; ?>"/>
								<?php echo form_error('address_line_1','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="type"><?php echo $this->lang->line('address_line_2');?></label> 
								<input type="input" class="form-control" name="address_line_2" value="<?php echo $contact_address_line_2; ?>"/>
								<?php echo form_error('address_line_2','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="city"><?php echo $this->lang->line('city');?></label> 
								<input type="input" class="form-control" name="city" value="<?php echo $contact_city; ?>"/>
								<?php echo form_error('city','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="state"><?php echo $this->lang->line('state');?></label> 
								<input type="input" class="form-control" name="state" value="<?php echo $contact_state; ?>"/>
								<?php echo form_error('state','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="postal_code"><?php echo $this->lang->line('postal_code');?></label> 
								<input type="input" class="form-control" name="postal_code" value="<?php echo $contact_postal_code; ?>"/>
								<?php echo form_error('postal_code','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="country"><?php echo $this->lang->line('country');?></label> 
								<input type="input" class="form-control" name="country" value="<?php echo $contact_country; ?>"/>
								<?php echo form_error('country','<div class="alert alert-danger">','</div>'); ?>
							</div>    
							
						</div>
					</div>
					<?php if (in_array("history", $active_modules)){
						if (file_exists(APPPATH."modules/history/views/display_fields".EXT)){
								$this->load->view('history/display_fields'); 
							}else{?>
								<div class="col-md-12">
							<div class="col-md-6">
								<?php if(isset($section_master)){ ?>
								<?php foreach($section_master as $section){ ?>
									<h3><?=$section['section_name'];?></h3>
									<?php $section_id = $section['section_id'];?>
									<?php foreach($section_fields as $field){?>
										<?php 
										if(isset($patient_history_details[$field['field_id']])){
											$value = $patient_history_details[$field['field_id']];
										}else{
											$value = "";
										}?>
										<div class="form-group">
											<label for="history_<?=$field['field_id'];?>"><?=$field['field_label'];?></label> 
										<?php if($field['field_type'] == "text"){?>
											<input type="input" class="form-control" name="history_<?=$field['field_id'];?>" value="<?=$value?>"/>
										<?php }elseif($field['field_type'] == "date"){ ?>
											<input type="input" class="form-control datetimepicker" name="history_<?=$field['field_id'];?>" value="<?=$value?>"/>
										<?php }elseif($field['field_type'] == "combo"){ ?>
											<select class="form-control" name="history_<?=$field['field_id'];?>">
												<?php foreach($field_options as $field_option){ ?>
													<?php if($field_option['field_id'] == $field['field_id']){?>
													<option value="<?=$field_option['option_value'];?>" <?php if($field_option['option_value'] == $value ){echo "selected";}?>><?=$field_option['option_label'];?></option>
													<?php } ?> 
												<?php } ?> 
											</select>
										<?php }elseif($field['field_type'] == "checkbox"){ ?>
											<?php foreach($field_options as $field_option){ ?>
												<?php if($field_option['field_id'] == $field['field_id']){?>
													<label class="checkbox">
														<input type="checkbox" name="history_<?=$field['field_id'];?>[]" value="<?=$field_option['option_value'];?>" <?php if(strpos($value,$field_option['option_value']) !== FALSE ){echo "checked";}?> /><?=$field_option['option_label'];?>
													</label>
												<?php } ?> 
											<?php } ?> 
										<?php }elseif($field['field_type'] == "radio"){ ?>
											
											<?php foreach($field_options as $field_option){ ?>
												<?php if($field_option['field_id'] == $field['field_id']){?>
													<div class="radio">
														<label>
															<input type="radio" name="history_<?=$field['field_id'];?>" id="history_<?=$field['field_id'];?>" value="<?=$field_option['option_value'];?>" checked=""><?=$field_option['option_label'];?>
														</label>
													</div>
												<?php } ?> 
											<?php } ?> 
										<?php } ?> 
											<?php echo form_error($field['field_id'],'<div class="alert alert-danger">','</div>'); ?>
										</div>
									<?php } ?>
								<?php } ?>
								<?php } ?>
							</div>
						</div>
							<?php }
						}?>
					<?php if (in_array("alert", $active_modules) && isset($patient_id)) { ?>
					<div class="col-md-6">
						<h4><?=$this->lang->line('patient_wise_alert_settings');?></h4>
						<div class="form-group">
							<?php 
							foreach($alerts as $alert_level1){
								if(!isset($alert_level1['parent_alert']) || $alert_level1['parent_alert'] == ''){
								?>
									<div class="checkbox">
										<label>
											<input type="checkbox"  name="<?=$alert_level1['alert_type'];?>_alert[]" class="<?=$alert_level1['alert_type'];?>_alert" value="<?=$alert_level1['alert_name'];?>" <?=is_enabled($patient_alerts,$alert_level1['alert_name'],$alert_level1['is_enabled']);?>> <?=$alert_level1['alert_label'];?> 
											<?php //Level 2
												$i=0;
												$alerts_names=array();
												foreach($alerts as $alert_level2){
													$flag=false;
													if($alert_level2['parent_alert'] == $alert_level1['alert_name']){
														//Level 3
														foreach($alerts as $alert_level3){
															if($alert_level3['parent_alert'] == $alert_level2['alert_name']){
																$required_module = $alert_level3['required_module'];
																if(in_array($required_module, $active_modules) || $required_module == '') { 
																	if($alert_level3['alert_label']=="To Patient"){
																		$alerts_names[$i]=$alert_level3['alert_name'];
																		$flag=true;
																	}
																}
															}
														}
														if($flag==true){
															//display 2nd level
															?>
															<div class="checkbox">
																<label>
																	<input type="checkbox"  name="<?=$alert_level2['alert_type'];?>_alert[]" class="<?=$alert_level1['alert_type'];?>_alert" value="<?=$alerts_names[$i];?>" <?=	is_enabled($patient_alerts,$alerts_names[$i],$alert_level2['is_enabled']); ?>> <?=$alert_level2['alert_label'];?> 
																</label>
															</div>
														<?php } 
													}
													$i++;
												}
											?>
										</label>
									</div>
									<?php
								}
							} ?>
						</div>
					</div>
					<?php } ?>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="form-group">
								<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" /><?php echo $this->lang->line('save');?></button>
								<a class="btn btn-primary square-btn-adjust" href="<?= site_url('patient/index');?>"  /><?php echo $this->lang->line('back');?></a>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>