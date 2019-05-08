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
	$('#dob').datetimepicker({		
		timepicker:false,
		format: '<?=$def_dateformate; ?>',
		scrollInput:false, 
		scrollMonth:false,
		scrollTime:false,
	});

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

			$('#age').val(ageString);
			
		}
	
	calculate_age();
	
	$('#dob').change(function(){
		calculate_age();
	});	
	
});
</script>
<?php
	if(isset($patient)){
		if($patient['dob'] == NULL){
			$dob = "";
		}else{
			$dob = date($def_dateformate,strtotime($patient['dob']));
		}
		$display_id = $patient['display_id'];
		$gender=$patient['gender'];
		$reference_by = $patient['reference_by'];
	}else{
		$dob = "";
		$display_id = "";
		$gender= "";
		$reference_by = "";
	}
	if(isset($contacts)){
		$contact_id = $contacts['contact_id']; 
		$contact_first_name = $contacts['first_name'];
		$contact_middle_name = $contacts['middle_name'];
		$contact_last_name = $contacts['last_name'];
		$contact_display_name = $contacts['display_name'];
		$contact_phone_number = $contacts['phone_number'];
		$contact_email = $contacts['email'];
		$contact_contact_image = $contacts['contact_image'];
		$contact_address_line_1 = $contacts['address_line_1'];
		$contact_address_line_2 = $contacts['address_line_2'];
		$contact_city = $contacts['city'];
		$contact_state = $contacts['state'];
		$contact_postal_code = $contacts['postal_code'];
		$contact_country = $contacts['country'];
	}else{
		$contact_id = 0;
		$contact_first_name = NULL;
		$contact_middle_name = NULL;
		$contact_last_name = NULL;
		$contact_display_name = NULL;
		$contact_phone_number = NULL;
		$contact_email = NULL;
		$contact_contact_image = NULL;
		$contact_address_line_1 = NULL;
		$contact_address_line_2 = NULL;
		$contact_city = NULL;
		$contact_state = NULL;
		$contact_postal_code = NULL; 
		$contact_country = NULL;
	}
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
						<div class="col-md-3">
							<label for="first_name"><?php echo $this->lang->line('name');?></label> 
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
								<label for="display_name"><?php echo $this->lang->line('display_name');?></label>
								<input type="input" name="display_name" class="form-control" value="<?php echo $contact_display_name; ?>"/>
								<?php echo form_error('display_name','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="gender"><?php echo "Gender";?></label> 
								<input type="radio" name="gender" value="male" <?php if($gender == 'male'){echo "checked='checked'";}?>/>Male
								<input type="radio" name="gender" value="female" <?php if($gender == 'female'){echo "checked='checked'";}?>/>Female
								<?php echo form_error('gender','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="dob"><?php echo $this->lang->line('dob');?></label>
								<input type="text" name="dob" id="dob" class="form-control"  value="<?php  echo $dob; ?>"/>
								<?php echo form_error('dob','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="age"><?php echo $this->lang->line('age');?></label>
								<input type="input" name="age" id="age" class="form-control" value="" readonly/>
								<?php echo form_error('age','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="reference_by">Reference By</label>
								<input type="input" name="reference_by" class="form-control" value="<?php echo $reference_by; ?>"/>
								<?php echo form_error('reference_by','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="phone_number"><?php echo $this->lang->line('phone_number');?></label>
								<input type="input" name="phone_number" class="form-control" value="<?php echo $contact_phone_number; ?>"/><br/>
								<?php echo form_error('phone_number','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="email"><?php echo $this->lang->line('email');?></label>
								<input type="input" name="email" class="form-control" value="<?php  echo $contact_email; ?>"/><br/>
								<?php echo form_error('email','<div class="alert alert-danger">','</div>'); ?>
							</div>
							
							
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<?php if($contact_contact_image!=""){ ?>
								<img id="PreviewImage" src="<?php echo base_url().$contacts['contact_image']; ?>" alt="Profile Image"  height="100" width="100" />
								<?php }else{ ?>
								<img id="PreviewImage" src="<?php echo base_url()."images/Profile.png"; ?>" alt="Profile Image"  height="100" width="100" />
								<?php } ?>
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
								<label for="type">Address Line 1</label> 
								<input type="input"  class="form-control" name="address_line_1" value="<?php echo $contact_address_line_1; ?>"/>
								<?php echo form_error('address_line_1','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="type">Address Line 2</label> 
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
							<div class="form-group">
								<button class="btn btn-primary" type="submit" name="submit" /><?php echo $this->lang->line('save');?></button>
								<a class="btn btn-primary" href="<?= site_url('patient/index');?>"  /><?php echo $this->lang->line('back');?></a>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>