
<?php 	
	
	$days_of_week = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	$level = $this->session->userdata('category');
	if(isset($schedule)){
		$edit = TRUE;
		$schedule_day = $schedule['schedule_day'];
		
		$schedule_from_time = date($def_timeformate,strtotime($schedule['from_time']));
		$schedule_to_time = date($def_timeformate,strtotime($schedule['to_time']));
		
		if($schedule['schedule_date'] != "" && $schedule['schedule_date'] != "0000-00-00"){
			$schedule_date = date($def_dateformate,strtotime($schedule['schedule_date']));
			$selected = "date";
		}else{
			$schedule_date = "";
			$selected = "day";
		}
		
		$schedule_doctor_id = $schedule['doctor_id'];
	}else{
		$edit = FALSE;
		$schedule_day = "";
		$schedule_from_time = "";
		$schedule_to_time = "";
		$schedule_date = "";
		$schedule_doctor_id = "";
		$selected = "day";
	}
	
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
					<?php echo $this->lang->line('doctor_schedule');?> 
			</div>
			<div class="panel-body">
			
			<?php 
				if($edit){
					echo form_open('doctor/edit_drschedule/'.$schedule['schedule_id']);?>
					<input type="hidden" name="schedule_id" value="<?= $schedule['schedule_id'];?>" />
				<?php }else{
					echo form_open('doctor/add_doctor_schedule/'.$schedule_doctor_id);
				} 
				?>
				<div>
					<div class="form-group">
						
						<label><?php echo $this->lang->line('doctor');?></label> 
						<?php if ($level == 'Doctor' || isset($doctor))
							{  
								$doctor_name =  "Dr." . $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name'];
								$userid = $this->session->userdata('id');
							 ?>
							<input type="text" name="doctor" class="form-control" id="doctor" value="<?= $doctor_name?>" readonly="readonly"/>
							<input type="hidden" name="doctor_id" class="form-control" id="doctor" value="<?= $doctor['doctor_id']?>" readonly="readonly"/>
							<?php 
							}
							else
							{
								$userid = 0;
							?>
								<select name="doctor_id" class="form-control"><option></option>
									<?php foreach ($doctors as $doctor) { ?>
										<option value="<?php echo $doctor['doctor_id'] ?>" <?php if($doctor['doctor_id'] == $schedule_doctor_id){echo "selected";}?>><?= 'Dr. '.$doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; ?></option>
									<?php } ?>
								</select>
															
						<?php }							
							 echo form_error('doctor_id','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div>
					<div class="form-group">
						<input type="radio" name="selection" value="date" <?php if($selected == 'date') {echo "checked";} ?>> <?php echo $this->lang->line('date');?> <br/>
						<input type="radio" name="selection" value="day" <?php if($selected == 'day') {echo "checked";} ?>> <?php echo $this->lang->line('day');?>
					</div>
				</div>
				<div id='date_group'>
					<div class="form-group">
						<label><?php echo $this->lang->line('date');?></label> 
						<input type="text" name="schedule_date" class="form-control" id="schedule_date" value="<?=$schedule_date;?>" /><br/>					
						<?php echo form_error('schedule_date','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div id='day_group'>
					<div class="form-group">
						<label> <?php echo $this->lang->line('day');?></label>
						<label class="checkbox-inline">
							<input type="checkbox" name="select-all" id="select-all" onClick="checkAll(this)"/><?php echo $this->lang->line('select_all'); ?>
						</label>
					</div>
					<div class="form-group"
						<?php foreach($days_of_week as $day){ ?>
							<label class="checkbox-inline">
								<input name="day[]" type="checkbox" <?php if(strpos($schedule_day,$day) === false){}else{echo "checked";} ?> value="<?=$day;?>"><?=$day;?>
							</label>
						<?php } ?>
						<?php echo form_error('day','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div>
					<div class="form-group">
						<label for="from_time"><?php echo "From Time";?></label>						
						<input name="from_time" id="from_time" type="text" class="form-control" value="<?php echo $schedule_from_time;?>"/>											
						<?php echo form_error('from_time','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				
				<div>
					<div class="form-group">
						 <label for="to_time"><?php echo "To Time";?></label>
						<input name="to_time" id="to_time" type="text" class="form-control" value="<?php echo $schedule_to_time; ?>"/>																	
						<?php echo form_error('to_time','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<script src="<?= base_url() ?>js/chosen.jquery.js" type="text/javascript"></script>
				
				<div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary" /><?php echo $this->lang->line('save');?></button>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	
	$('#schedule_date').datetimepicker({
		timepicker:false,
		format: '<?=$def_dateformate;?>'
    });    
	$('#from_time').datetimepicker({
		datepicker:false,
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>',
		<?php if($clinic_start_time != '00:00' && $clinic_end_time !='24:00'){?>
		minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
		maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
		<?php } ?>
		scrollTime:false,
		scrollInput:false,
	});
	
	$('#to_time').datetimepicker({
		datepicker:false,
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>',
		<?php if($clinic_start_time != '00:00' && $clinic_end_time !='24:00'){?>
		minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
		maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
		<?php } ?>
		scrollTime:false,
		scrollInput:false,
	});
	
	var radioValue = $("input[name='selection']:checked").val();
	if(radioValue == 'day'){
		$('#date_group').hide();
		$('#schedule_date').val("");
		$('#day_group').show();
		
	}else{
		$('#day_group').hide();
		$('input[name="day[]"]').removeAttr('checked');
		$('#date_group').show();
	}
    $("input[type='radio']").click(function(){
		var radioValue = $("input[name='selection']:checked").val();
			if(radioValue == 'day'){
                $('#date_group').hide();
				$('#schedule_date').val("");
				$('#day_group').show();
				
            }else{
				$('#day_group').hide();
				$('input[name="day[]"]').removeAttr('checked');
				$('#date_group').show();
			}
    });
});
function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
</script>