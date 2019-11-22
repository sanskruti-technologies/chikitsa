
<script type="text/javascript" charset="utf-8">
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

$( window ).load(function() {
	
    $('#start_time').datetimepicker({
		datepicker:false,
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>'
    });    
    $('#end_time').datetimepicker({
		datepicker:false,
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>'
    });    
	
	$('#full_day').change(function() {
		 $("#start_time").prop("disabled", $(this).is(':checked'));
		 $("#end_time").prop("disabled", $(this).is(':checked'));
	});
	$("#start_time").prop("disabled", $('#full_day').is(':checked'));
	$("#end_time").prop("disabled", $('#full_day').is(':checked'));
});
</script>
<?php
	
    if (!isset($center))
    {
		$clinic_id = 1;
		$clinic_logo = set_value('clinic_logo','');
        $clinic_name = set_value('clinic_name','');
		$clinic_code = set_value('clinic_code','');
        $tag_line = set_value('tag_line','');
        $start_time = set_value('start_time','');
        $end_time = set_value('end_time','');
        $time_interval = set_value('time_interval','');
        $next_followup_days = set_value('next_followup_days','');
        $clinic_address = set_value('clinic_address','');
        $clinic_landline = set_value('landline','');
        $clinic_mobile = set_value('mobile','');
        $clinic_website = set_value('website','');
        $clinic_email = set_value('email','');
		$facebook = set_value('facebook','');
		$twitter = set_value('twitter','');
		$google_plus = set_value('google_plus','');
		$max_patient = set_value('max_patient','');
		$full_day = 0;
    }
    else
    {
		
		$clinic_id = set_value('clinic_id',$center['clinic_id']);
		$clinic_logo = set_value('clinic_logo',$center['clinic_logo']);
        $clinic_name = set_value('clinic_name',$center['clinic_name']);
		$clinic_code = set_value('clinic_code',$center['clinic_code']);
        $tag_line = set_value('tag_line',$center['tag_line']);
        $start_time = set_value('start_time',$center['start_time']);
		$start_time = date($def_timeformate,strtotime($start_time));
        $end_time = set_value('end_time',$center['end_time']);
		$end_time = date($def_timeformate,strtotime($end_time));
		
		$full_day = 0;
		if($center['start_time'] == "00:00" && $center['end_time'] == "24:00"){
			$full_day = 1;
		}
			
        $time_interval = set_value('time_interval',$center['time_interval']);
        $next_followup_days = set_value('next_followup_days',$center['next_followup_days']);
        $clinic_address = set_value('clinic_address', $center['clinic_address']);
        $clinic_landline = set_value('landline',$center['landline']);
        $clinic_mobile = set_value('mobile',$center['mobile']);
        $clinic_email = set_value('email',$center['email']);
		$clinic_website = set_value('website',$center['website']);
		$facebook = set_value('facebook',$center['facebook']);
		$twitter = set_value('twitter',$center['twitter']);
		$google_plus = set_value('google_plus',$center['google_plus']);
		$max_patient = set_value('max_patient',$center['max_patient']);
    }
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<h2><?php echo $this->lang->line('center_details');?></h2>
					</div>
				</div>
				<div class="panel-body table-responsive-25">
					<?php if (in_array("centers", $active_modules) ) { 					?>
						<?php if (isset($center)){ ?>
						<?php echo form_open_multipart('centers/edit_center/'.$clinic_id) ?>
						<input type="hidden" name="clinic_id" value="<?=$clinic_id; ?>" class="form-control"/>
						<?php }else{ ?>
						<?php echo form_open_multipart('centers/add_center/') ?>
						<?php } ?>	
					<?php }else{ ?>
						<?php echo form_open_multipart('settings/clinic') ?>
						<input type="hidden" name="clinic_id" value="<?=$clinic_id; ?>" class="form-control"/>
					<?php } ?>
					<div class="col-md-8">
						<div class="form-group">
							<label for="clinic_logo"><?php echo $this->lang->line('center_logo');?></label><br/>
							
							<?php if($clinic_logo!=""){ ?>
							<img id="PreviewImage" src="<?php echo base_url().$clinic_logo; ?>" alt="Clinic Logo"   />
							<?php }else{ ?>
							<img id="PreviewImage" src="<?php echo base_url()."uploads/images/blank_logo.png"; ?>" alt="Clinic Logo"   />
							<?php } ?>
							<a href="<?= site_url("settings/remove_clinic_logo"); ?>" class="btn btn-sm square-btn-adjust btn-danger" ><?php echo $this->lang->line('remove_logo');?></a>
							<br>
							<input type="file" id="clinic_logo" name="clinic_logo" class="form-control" size="20" onchange="readURL(this);" style="margin-top:5px;padding-top:5px" />
							<span><?php echo $this->lang->line('preferred_size');?></span>
							<?php if(isset($error)){?>
								<div class='alert alert-danger'><?=$error;?></div>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-8">	
						<div class="form-group">
							<label for="clinic_name"><?php echo $this->lang->line('center_name');?></label> 
							<input type="input" name="clinic_name" value="<?=$clinic_name; ?>" class="form-control"/>
							
							<?php echo form_error('clinic_name','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-4">	
						<div class="form-group">
							<label for="clinic_code"><?php echo $this->lang->line('center_code');?></label> 
							<input type="input" name="clinic_code" value="<?=$clinic_code; ?>" class="form-control"/>
							<?php echo form_error('clinic_code','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-8">	
						<div class="form-group">
							<label for="tag_line"><?php echo $this->lang->line('tag_line');?></label> 
							<input type="input" name="tag_line" value="<?=$tag_line; ?>" class="form-control"/>
							<?php echo form_error('tag_line','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-6">	
						<div class="form-group">	
							<label for="clinic_address"><?php echo $this->lang->line('address');?></label> 
							<textarea rows="4" name="clinic_address" class="form-control"><?=$clinic_address; ?></textarea>
							<?php echo form_error('clinic_address','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-6">	
						<div class="form-group">
							<label for="landline"><?php echo $this->lang->line('landline');?></label> 
							<input type="input" name="landline" class="form-control" value="<?=$clinic_landline; ?>"/>
							<?php echo form_error('landline','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="mobile"><?php echo $this->lang->line('mobile');?></label> 
							<input type="input" name="mobile" value="<?=$clinic_mobile; ?>" class="form-control"/>
							<?php echo form_error('mobile','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email"><?php echo $this->lang->line('email');?></label> 
							<input type="input" name="email" value="<?=$clinic_email; ?>" class="form-control"/>
							<?php echo form_error('email','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="website"><?php echo $this->lang->line('website');?></label> 
							<input type="input" name="website" value="<?=$clinic_website; ?>" class="form-control"/>
							<?php echo form_error('website','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="full_day"><?php echo $this->lang->line('full_day');?></label> 
							<div class="checkbox1">
								<label>
									<input type="checkbox" name="full_day" id="full_day" value="1" <?php if($full_day == 1) echo "checked";?>><?php echo $this->lang->line('clinic_runs_full_day');?>
								</label>
							</div>
							<?php echo form_error('full_day','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="start_time"><?php echo $this->lang->line('start_time');?></label> 
							<input type="input" name="start_time" id="start_time" value="<?=$start_time; ?>" class="form-control"/>
							<?php echo form_error('start_time','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="end_time"><?php echo $this->lang->line('end_time');?></label> 
							<input type="input" name="end_time" id="end_time" value="<?=$end_time; ?>" class="form-control"/>
							<?php echo form_error('end_time','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="time_interval"><?php echo $this->lang->line('appointment_time_interval');?> </label> 
							<input type="text" name="time_interval" value="<?=$time_interval;?>" class="form-control"/>
							<small>(<?php echo $this->lang->line('in_minutes');?>)</small>
							<?php echo form_error('time_interval','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="next_followup_days"><?php echo $this->lang->line('next_follow_up');?></label> 
							<input type="input" class="form-control" name="next_followup_days" id="next_followup_days" value="<?=$next_followup_days; ?>"/>
							<span><?php echo $this->lang->line('numbersof_days_between_two_appointments');?></span>
							<?php echo form_error('next_followup_days','<div class="alert alert-danger">','</div>'); ?>	
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="max_patient"><?php echo $this->lang->line('max_patient');?></label> 
							<input type="input" class="form-control" name="max_patient" id="max_patient" value="<?=$max_patient; ?>"/>
							<?php echo form_error('max_patient','<div class="alert alert-danger">','</div>'); ?>	
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary square-btn-adjust" /><?php echo $this->lang->line('save');?></button>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>