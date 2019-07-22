<script type="text/javascript">
function readURL(input) {
	if (input.files && input.files[0]) {//Check if input has files.
		var reader = new FileReader(); //Initialize FileReader.

		reader.onload = function (e) {
		$('#PreviewImage').attr('src', e.target.result);
		$("#PreviewImage").resizable({ aspectRatio: true, maxHeight: 300 });
		$('#remove_profile_image').show();
		};
		reader.readAsDataURL(input.files[0]);
	}else {
		$('#PreviewImage').attr('src', "#");
	}
}
$( window ).load(function() {
	
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	});
	$('#joining_date').datetimepicker({
		timepicker:false,
		format: '<?=$def_dateformate; ?>',
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
		$('#remove_profile_image').click(function(){
		$('#PreviewImage').attr('src', '<?php echo base_url()."/uploads/images/Profile.png"; ?>');
		$('#file_name').val('');
		var doctor_id = $(this).data('doctor_id');
		
		$.ajax({
				type: "GET",
				url: "<?=site_url('doctor/remove_profile_image/');?>" + doctor_id,
				success: function(response){
					console.log(response);	
					
				}
			});
		$(this).hide();
	});
	<?php if(!isset($doctor_details) || $contacts['contact_image'] == ""){ ?>
		$('#remove_profile_image').hide();
	<?php } ?>

});
<?php 
	$contact_id = 0;
	$title = set_value('title','');
	$first_name = set_value('first_name','');
	$middle_name = set_value('middle_name','');
	$last_name = set_value('last_name','');
	$profile_image = set_value('profile_image','');
	$address_type = set_value('type','');
	$address_line_1 = set_value('address_line_1','');
	$address_line_2 = set_value('address_line_2','');
	$city = set_value('city','');
	$state = set_value('state','');
	$country = set_value('country','');
	$postal_code = set_value('postal_code','');
	$joining_date = set_value('joining_date','');
	$experience = set_value('experience','');
	$specification = set_value('specification','');
	$gender  = set_value('gender','');
	$degree = set_value('gender','');
	$email = set_value('email','');
	$dob = set_value('dob','');
	$phone_number = set_value('phone_number','');
	$licence_number = set_value('licence_number','');
	//$department_id =0;
	$department_id=set_value('department_id[]','');
	$user_id = set_value('user_id','');	
	$description = set_value('description','');
	$username= set_value('username','');
	if(isset($contacts)){
		$title = set_value('title',$contacts['title']);
		$first_name = set_value('first_name',$contacts['first_name']);
		$middle_name = set_value('middle_name',$contacts['middle_name']);
		$last_name = set_value('last_name',$contacts['last_name']);
		$profile_image =set_value('profile_image', $contacts['contact_image']);
		$address_type = set_value('type',$contacts['type']);
		$address_line_1 = set_value('address_line_1',$contacts['address_line_1']);
		$address_line_2 = set_value('address_line_2',$contacts['address_line_2']);
		$city = set_value('city',$contacts['city']);
		$state =set_value('state', $contacts['state']);
		$country =set_value('country', $contacts['country']);
		$postal_code =set_value('postal_code', $contacts['postal_code']);
		$email = set_value('email',$contacts['email']);
		$phone_number =set_value('phone_number', $contacts['phone_number']);
		
	}
	if(isset($doctor_details)){
		$contact_id = $doctor_details['contact_id'];
		if($doctor_details['joining_date'] != NULL){
			$joining_date = set_value('joining_date',date($def_dateformate,strtotime($doctor_details['joining_date'])));	
		}else{
			$joining_date = set_value('joining_date','');;
		}
		if($doctor_details['dob'] != NULL){
			$dob =set_value('dob', date($def_dateformate,strtotime($doctor_details['dob'])));
		}else{
			$dob = set_value('dob','');;
		}
		$experience  = set_value('experience',$doctor_details['experience']);
		$specification =set_value('specification', $doctor_details['specification']);
		$gender = set_value('gender',$doctor_details['gender']);
		$degree = set_value('degree',$doctor_details['degree']);
		$licence_number = set_value('licence_number',$doctor_details['licence_number']);
		$department_id = set_value('department_id[]',$doctor_details['department_id']);
		$user_id =set_value('user_id', $doctor_details['userid']);
		$username = set_value('username',$user['username']);
		$description = set_value('description',$doctor_details['description']);
	}
?>
<?php $category = $_SESSION['category'];?>
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line("doctor") . ' ' . $this->lang->line("detail");?>
				</div>
				<div class="panel-body">
					<?php if ($file_error != ""){ ?>
						<div class="alert alert-danger"><?=$file_error;?></div>
					<?php } ?>
					<?php if ($doctor_id != 0){ ?>
						<?php echo form_open_multipart('doctor/doctor_detail/'.$doctor_id) ?>
						<input type="hidden" name="doctor_id" class="inline" value="<?=$doctor_id;?>"/>
						<input type="hidden" name="contact_id" class="inline" value="<?=$contact_id;?>"/>
					<?php }else{ ?>
						<?php echo form_open_multipart('doctor/doctor_detail/') ?>
					<?php } ?>
						
						
						<div class="col-md-12">
							<label for="first_name"><?php echo $this->lang->line("doctor");?> <?php echo $this->lang->line("name");?></label> 
						</div>
						<div class="col-md-3">
							<input type="input" class="form-control" name="title" placeholder="<?php echo $this->lang->line("title");?>" value="<?=$title; ?>"/>
							<?php echo form_error('title','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-3">
							<input type="input" class="form-control" name="first_name" placeholder="<?php echo $this->lang->line("first") . ' ' .$this->lang->line("name");?>" value="<?=$first_name; ?>"/>
							<?php echo form_error('first_name','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-3">
							<input type="input" class="form-control" name="middle_name" placeholder="<?php echo $this->lang->line("middle") . ' ' .$this->lang->line("name");?>" value="<?=$middle_name; ?>"/>
							<?php echo form_error('middle_name','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-3">
							<input type="input" class="form-control" name="last_name"  placeholder="<?php echo $this->lang->line("last") . ' ' .$this->lang->line("name");?>" value="<?=$last_name; ?>"/><br/>
							<?php echo form_error('last_name','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="gender"><?=$this->lang->line("gender");?></label> 
								<input type="radio" name="gender" value="male" <?php if($gender == 'male'){echo "checked='checked'";}?>/><?php echo $this->lang->line("male");?>
								<input type="radio" name="gender" value="female" <?php if($gender == 'female'){echo "checked='checked'";}?>/><?php echo $this->lang->line("female");?>
								<?php echo form_error('gender','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="degree"><?php echo $this->lang->line("degrees");?></label>
								<input type="input" name="degree" class="form-control" value="<?=$degree;?>"/>
								<?php echo form_error('degree','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="specification"><?=$this->lang->line("specialization");?></label>
								<input type="input" name="specification" value="<?=$specification;?>" class="form-control"/>
								<?php echo form_error('specification','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="experience"><?=$this->lang->line("experience");?></label>
								<input type="input" name="experience" value="<?=$experience;?>" class="form-control"/>
								<?php echo form_error('experience','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="email"><?php echo $this->lang->line("email");?></label>
								<input type="input" name="email" value="<?=$email;?>" class="form-control"/>
								<?php echo form_error('email','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="phone_number"><?php echo $this->lang->line("phone_number");?></label>
								<input type="input" name="phone_number" value="<?=$phone_number;?>" class="form-control"/>
								<?php echo form_error('phone_number','<div class="alert alert-danger">','</div>'); ?>
							</div>							
							
							<div class="form-group">
								<label for="joining_date"><?=$this->lang->line("joining_date");?></label> 
								<input type="text" name="joining_date" id="joining_date" value="<?=$joining_date;?>" class="form-control"/>
								<?php echo form_error('joining_date','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="dob"><?=$this->lang->line("dob");?></label> 
								<input type="text" name="dob" id="dob" value="<?=$dob;?>" class="form-control"/>
								<?php echo form_error('dob','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="licence_number"><?=$this->lang->line("licence_number");?></label> 
								<input type="input" name="licence_number" value="<?=$licence_number;?>" class="form-control"/>
								<?php echo form_error('licence_number','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<?php 
								if(!isset($doctor_details)){
									$department_id=implode(",",$department_id);
								}
								$doctors_department = explode(",",$department_id);
								
								?>
								<label for="department_id"><?=$this->lang->line("department");?></label>
								<select id="department_id" name="department_id[]" multiple="multiple" class="form-control">  <option></option>
									<?php if(isset($departments)) { ?>
										<?php  foreach ($departments as $department) { ?>
										<option value="<?=$department['department_id'] ?>" <?php if( in_array( $department['department_id'],$doctors_department)){echo "selected='selected'";}?>><?= $department['department_name']; ?> </option>
										<?php } ?>
									<?php } ?>
								</select>								
								<?php echo form_error('department_id','<div class="alert alert-danger">','</div>'); ?>
								<script>jQuery('#department_id').chosen();</script>
							</div>
							
							
						</div>
						<div class="col-md-6">
							<div class="form-group">	
								<?php if($profile_image!=""){ ?>
								<img id="PreviewImage" src="<?php echo base_url().$contacts['contact_image']; ?>" alt="<?=$this->lang->line("profile_image");?>"  height="100" />
								<?php }else{ ?>
								<img id="PreviewImage" src="<?php echo base_url()."images/Profile.png"; ?>" alt="<?=$this->lang->line("profile_image");?>"  height="100" />
								<?php } ?>
								
								<a id="remove_profile_image" data-doctor_id="<?=$doctor_id;?>" class="btn btn-danger btn-sm square-btn-adjust" ><?php echo $this->lang->line("remove")." ". $this->lang->line("doctor")." ".$this->lang->line("image");?></a>
								
								
								<input class="form-control" type="file" id="file_name" name="file_name" size="20" onchange="readURL(this);" />
								<?php echo form_error('file_name','<div class="alert alert-danger">','</div>'); ?>
								<input type="hidden" id="src" name="src" value="" />
							</div>
							<div class="form-group">
								<label for="type"><?php echo $this->lang->line("address")." ".$this->lang->line("type");?></label> 
								<select name="type" class="form-control">
									<option></option>
									<option value="Home" <?php if($address_type == "Home") {echo "selected='selected'";} ?>><?php echo $this->lang->line("home");?></option>
									<option value="Office" <?php if($address_type == "Office") {echo "selected='selected'";} ?>><?php echo $this->lang->line("office");?></option>
								</select>
								<?php echo form_error('type','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="address_line_1"><?php echo $this->lang->line("address")." ".$this->lang->line("line1");?></label> 
								<input type="input" name="address_line_1" value="<?=$address_line_1;?>" class="form-control"/>
								<?php echo form_error('address_line_1','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="address_line_2"><?php echo $this->lang->line("address")." ".$this->lang->line("line2");?></label> 
								<input type="input" name="address_line_2" value="<?=$address_line_2;?>" class="form-control"/>
								<?php echo form_error('address_line_2','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">	
								<label for="city"><?php echo $this->lang->line("city");?></label> 
								<input type="input" name="city" value="<?=$city;?>" class="form-control"/>
								<?php echo form_error('city','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">	
								<label for="state"><?php echo $this->lang->line("state");?></label> 
								<input type="input" name="state" value="<?=$state;?>" class="form-control"/>
								<?php echo form_error('state','<div class="alert alert-danger">','</div>'); ?>
							</div>		
							<div class="form-group">
								<label for="postal_code"><?php echo $this->lang->line("postal_code");?></label> 
								<input type="input" name="postal_code" value="<?=$postal_code;?>" class="form-control"/>
								<?php echo form_error('postal_code','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="country"><?php echo $this->lang->line("country");?></label> 
								<input type="input" name="country" value="<?=$country;?>" class="form-control"/>
								<?php echo form_error('country','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="description"><?php echo $this->lang->line("description");?></label> 
								<textarea type="input" name="description" class="form-control"><?=$description;?></textarea>
								<?php echo form_error('description','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<button class="btn square-btn-adjust btn-primary" type="submit" name="submit" /><?php echo $this->lang->line("save");?></button>
								<a href="<?php echo base_url()."index.php/doctor/index/" ?>" class="btn square-btn-adjust btn-primary" /><?php echo $this->lang->line("back");?></a>
								<?php if($category != 'Doctor'){ ?>
								<a href="<?php echo base_url()."index.php/doctor/delete_doctor/".$doctor_id ?>" class="btn square-btn-adjust btn-danger confirmDelete" /><?php echo $this->lang->line("delete");?></a>
								<?php } ?>
								<?php if($user_id != ""){ ?>
								<a class="btn square-btn-adjust btn-warning" href="<?php echo site_url("admin/edit_user/" . $user_id); ?>"><?php echo $this->lang->line("login").' ' .$this->lang->line("details");?></a>
								<?php } ?>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>