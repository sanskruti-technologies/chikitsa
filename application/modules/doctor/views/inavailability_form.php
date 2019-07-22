<script type="text/javascript" charset="utf-8">
	$(window).load(function() {
		$('#start_time').datetimepicker({
			datepicker:false,
			format: '<?=$def_timeformate; ?>',
			formatTime:'<?=$def_timeformate; ?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
			<?php if($clinic_start_time != '00:00' && $clinic_end_time !='24:00'){?>
			minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
			maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
			<?php } ?>
		});
		$('#start_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
			minDate:0
		});
		$('#end_time').datetimepicker({
			datepicker:false,
			format: '<?=$def_timeformate; ?>',
			formatTime:'<?=$def_timeformate; ?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
			<?php if($clinic_start_time != '00:00' && $clinic_end_time !='24:00'){?>
			minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
			maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
			<?php } ?>
		});	
		$('#end_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
			minDate:0
		});
	});
	 $(function()
    {
        $('#start_time').timepicker({
            'minTime': '<?php echo $clinic_start_time; ?>',
            'maxTime': '<?php echo $clinic_end_time; ?>',
            'step' : '<?php echo ($time_interval * 60); ?>'
        });    
    });
    $(function()
    {
        $('#end_time').timepicker({
            'minTime': '<?php echo $clinic_start_time; ?>',
            'maxTime': '<?php echo $clinic_end_time; ?>',
            'step' : '<?php echo ($time_interval * 60); ?>'
        });    
    });		
function validate()
{
	if(document.getElementById('chkday').checked)
	{	
		document.getElementById('start_time').value ="<?php echo $clinic_start_time; ?>";
		document.getElementById('end_time').value ="<?php echo $clinic_end_time; ?>";
		$("#start_time").prop('readonly', true);
		$("#end_time").prop('readonly', true);
	}
	else
	{
		$("#start_time").prop('readonly', false);
		$("#end_time").prop('readonly', false);
	} 
}
</script>
<?php
	if(isset($availability)){
		$edit = TRUE;
		$start_time = $availability['start_time'];
		$end_time = $availability['end_time'];
		$start_time = date($def_timeformate,strtotime($start_time));
		$end_time = date($def_timeformate,strtotime($end_time));
		$start_date = date($def_dateformate, strtotime($availability['appointment_date']));
		$end_date = date($def_dateformate, strtotime($availability['end_date']));
		$doctor_id = $availability['doctor_id'];
	}else{
		$edit = FALSE;
		$start_time = "";
		$end_time = "";
		$start_date = "";
		$end_date = "";
	}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('doctor_unavailability');?> 
				</div>
			<div class="panel-body">
				<?php if($edit){
						echo form_open('doctor/edit_inavailability/'. $availability['appointment_id'].'/'.$availability['userid'].'/'.$availability['end_date']);
					}else{
						echo form_open('doctor/add_inavailability/');
					} 
				?>   
				<?php $level = $_SESSION['category']; ?>
				<div class="form-group">
					<label><?php echo $this->lang->line('doctor');?></label>
					<?php if ($level == 'Doctor')
					{  
						
						$doctor_name = $doctors['name'];
						$userid = $_SESSION['id'];
					 ?>
					<input type="hidden"  class="form-control"name="doctor" id="doctor" value="<?= $doctor_id?>" readonly="readonly"/><br/>
					<input type="text"  class="form-control"name="doctor_name" id="doctor" value="<?= $doctor_name?>" readonly="readonly"/><br/>
					<?php 
					}else{
						$userid = 0;
					?>
						<select name="doctor" class="form-control">  <option></option>
							<?php foreach ($doctors as $doctor) { ?>
							<?php $doctor_name = $doctor['title']." ".$doctor['first_name']." ".$doctor['middle_name']." ".$doctor['last_name']; ?>
							<option value="<?php echo $doctor['doctor_id'];?>"<?php if($doctor['doctor_id']== $doctor_id ) {echo 'selected';}?>><?= $doctor_name; ?></option>
							<?php } ?>
						</select> 
						<?php	
					}
					?>
					<input type="hidden" name="doctor_id" value="<?= $userid; ?>"/>
					<?php echo form_error('doctor','<div class="alert alert-danger">','</div>'); ?>
				
				</div>
				<?php 
					
				?>
				<div class="form-group">
					<label for="start_date"> <?php echo $this->lang->line('start_date');?></label>
					<input name="start_date" id="start_date" class="form-control" type="text" value="<?=$start_date;?>"/>
					<?php echo form_error('start_date','<div class="alert alert-danger">','</div>'); ?>
						
				</div>
				<div class="form-group">
					<label for="start_time"><?php echo $this->lang->line('start_time');?></label>
					<input name="start_time" id="start_time" class="form-control" type="input" value="<?php echo $start_time; ?>"/>
					<?php echo form_error('start_time','<div class="alert alert-danger">','</div>'); ?>
				</div>
				<div class="form-group">
					<label for="end_date"> <?php echo $this->lang->line('end_date');?></label>
					<input name="end_date" id="end_date" class="form-control" type="text"  value="<?= $end_date ; ?>"/>
					<?php echo form_error('end_date','<div class="alert alert-danger">','</div>'); ?>
				</div>
				<div class="form-group">
					<label for="end_time"> <?php echo $this->lang->line('end_time');?></label>
					<input name="end_time" id="end_time" class="form-control" type="input" value="<?php echo $end_time; ?>"/>
					<?php echo form_error('end_time','<div class="alert alert-danger">','</div>'); ?>
				</div>
				<script src="<?= base_url() ?>js/chosen.jquery.js" type="text/javascript"></script>
				<script type="text/javascript"> 
					var config = {
						'.chzn-select'           : {},
						'.chzn-select-deselect'  : {allow_single_deselect:true},
						'.chzn-select-no-single' : {disable_search_threshold:10},
						'.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
						'.chzn-select-width'     : {width:"95%"}
					}
					for (var selector in config) {
						$(selector).chosen(config[selector]);
					}
				</script>
				<div class="form-group">
					<button class="btn btn-primary" type="submit" name="submit" /><?php echo $this->lang->line('save');?></button>
					<a class="btn btn-primary" href="<?php echo base_url() . "/index.php/doctor/inavailability" ?>"><?php echo $this->lang->line('cancel');?></a>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>