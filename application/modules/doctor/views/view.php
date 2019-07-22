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
</script>
<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	})
});
</script>
<?php 
	$contact_id = 0;
	$first_name = "";
	$middle_name = "";
	$last_name = "";
	$profile_image = "";
	$address_type = "";
	$address_line_1 = "";
	$address_line_2 = "";
	$city = "";
	$state = "";
	$country = "";
	$postal_code = "";
	$joining_date = "";
	$experience = "";
	$specification = "";
	$gender  = "";
	$degree = "";
	$email = "";
	$phone_number = "";
	$licence_number = "";
	$department_id = 0;
	if(isset($contacts)){
		$first_name = $contacts['first_name'];
		$middle_name = $contacts['middle_name'];
		$last_name = $contacts['last_name'];
		$profile_image = $contacts['contact_image'];
		$address_type = $contacts['type'];
		$address_line_1 = $contacts['address_line_1'];
		$address_line_2 = $contacts['address_line_2'];
		$city = $contacts['city'];
		$state = $contacts['state'];
		$country = $contacts['country'];
		$postal_code = $contacts['postal_code'];
		$email = $contacts['email'];
		$phone_number = $contacts['phone_number'];
		
	}
	if(isset($doctor_details)){
		$contact_id = $doctor_details['contact_id'];
		$joining_date = $doctor_details['joining_date'];
		$experience  = $doctor_details['experience'];
		$specification = $doctor_details['specification'];
		$gender = $doctor_details['gender'];
		$degree = $doctor_details['degree'];
		$licence_number = $doctor_details['licence_number'];
		$department_id = $doctor_details['department_id'];
	}
?>
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line("doctor") . ' ' . $this->lang->line("detail");?>
				</div>
				<div class="panel-body">
					<?if ($doctor_id != 0){ ?>
						<?php echo form_open_multipart('doctor/doctor_detail/'.$doctor_id) ?>
						<input type="hidden" name="doctor_id" class="inline" value="<?=$doctor_id;?>"/>
						<input type="hidden" name="contact_id" class="inline" value="<?=$contact_id;?>"/>
					<?}else{ ?>
						<?php echo form_open_multipart('doctor/doctor_detail/') ?>
					<?} ?>
						
						
						<div class="col-md-12">
							<div class="col-md-2">
								<label for="first_name"><?php echo $this->lang->line("doctor");?> <?php echo $this->lang->line("name");?></label> 
							</div>
							<div class="col-md-6">
								<label>&nbsp;</label>
								<!--Dr.-->
								<?= $title?>
								<?=$first_name; ?>
								<?=$middle_name; ?>
								<?=$last_name; ?>
							</div>
							
							<div class="col-md-4">
							<?php if($profile_image!=""){ ?>
								<img id="PreviewImage" src="<?php echo base_url().$contacts['contact_image']; ?>" alt="Profile Image"  height="100" width="100" />
								<?php }else{ ?>
								<img id="PreviewImage" src="<?php echo base_url()."images/Profile.png"; ?>" alt="Profile Image"  height="100" width="100" />
							<?php } ?>
							</div>
							
							<div class="col-md-2">
								<label for="degree"><?php echo $this->lang->line("degrees");?></label>
							</div>
							<div class="col-md-4">
								<label>&nbsp;</label>
								<?=$degree;?>
							</div>
							<div class="col-md-3">
								<label for="licence_number"><?php echo "License Number";?></label> 
							</div>
							<div class="col-md-3">
								<label>&nbsp;</label>
								<?=$licence_number;?>
							</div>
							<div class="col-md-2">
								<label for="specification"><?php echo $this->lang->line("specialization");?></label>
							</div>
							<div class="col-md-4">
								<label>&nbsp;</label>
								<?=$specification;?>
							</div>
							<div class="col-md-2">
								<label for="experience"><?php echo $this->lang->line("experience");?></label>
							</div>
							<div class="col-md-4">
								<label>&nbsp;</label>
								<?=$experience;?>
							</div>
							<div class="col-md-12">
								&nbsp;
							</div>
							<div class="col-md-2">
								<label for="email"><?php echo $this->lang->line("email");?></label>
							</div>
							<div class="col-md-4">
								<label>&nbsp;</label>
								<?=$email;?>
							</div>
							<div class="col-md-3">
								<label for="phone_number"><?php echo $this->lang->line("phone_number");?></label>
							</div>
							<div class="col-md-3">
								<label>&nbsp;</label>
								<?=$phone_number;?>
							</div>
							<div class="col-md-12">
								&nbsp;
							</div>
							<div class="col-md-2">
								<label for="joining_date"><?php echo "Joining Date";?></label> 
							</div>
							<div class="col-md-4">
								<label>&nbsp;</label>
								<?=$joining_date;?>
							</div>
							
							<div class="col-md-2">
								<label for="department_id"><?php echo "Department";?></label>
							</div>
							<div class="col-md-4">
								<label>&nbsp;</label>
								<?php if(isset($departments)) { ?>
									<?php  foreach ($departments as $department) { ?>
										<?php if($department['department_id'] == $department_id){ ?>
											<?= $department['department_name']; ?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</div>
							<div class="col-md-12">
								&nbsp;
							</div>
							<div class="col-md-2">
								<label for="gender"><?php echo "Gender";?></label> 
							</div>
							<div class="col-md-10">
								<label>&nbsp;</label>
								<?= ucfirst($gender);?>
							</div>
							<div class="col-md-2">
								<label for="type"><?php echo $this->lang->line("address");?></label> 
							</div>
							<div class="col-md-10">
								<strong><?=$address_type;?></strong><br/>
								<?=$address_line_1;?><br/>
								<?=$address_line_2;?><br/>
								<?=$city;?><br/>
								<?=$state;?><br/>
								<?=$postal_code;?><br/>
								<?=$country;?><br/>
							</div>
							<div class="col-md-6">
								<a href="<?php echo base_url()."index.php/doctor/index/" ?>" class="btn btn-primary" /><?php echo $this->lang->line("back");?></a>
							</div>
							<div class="col-md-2">
								<a class="btn btn-info btn-sm" href="<?php echo site_url("doctor/doctor_detail/" . $doctor_details['doctor_id']); ?>"><?php echo $this->lang->line("edit");?></a>
							</div>
							<div class="col-md-2">
								<a class="btn btn-warning btn-sm" href="<?php echo site_url("admin/edit_user/" . $doctor_details['userid']); ?>"><?php echo $this->lang->line("login").' ' .$this->lang->line("details");?></a>
							</div>
							<div class="col-md-2">
								<a class="btn btn-danger btn-sm confirmDelete" href="<?php echo site_url("doctor/delete_doctor/" . $doctor_details['doctor_id']."/".$doctor_details['contact_id']); ?>"><?php echo $this->lang->line("delete");?></a>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>