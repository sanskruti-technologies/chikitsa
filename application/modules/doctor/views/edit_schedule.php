<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	})

    $("#doctor_table").dataTable();
	
	$('#from_time').datetimepicker({
		datepicker:false,
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>',
		minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
		maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
		scrollTime:false,
		scrollInput:false,
	});
	
	$('#to_time').datetimepicker({
		datepicker:false,
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>',
		minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
		maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
		scrollTime:false,
		scrollInput:false,
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
<?php 	
	$days_of_week = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
					<?php echo $this->lang->line('doctor_schedule');?> 
			</div>
			<div class="panel-body">
			
			<?php echo form_open('doctor/edit_drschedule/'.$schedule['schedule_id']);
				 $level = $this->session->userdata('category');
				?>
				<div>
					<div class="form-group">
						<input type="hidden" name="schedule_id" value="<?= $schedule['schedule_id'];?>" />
						<label><?php echo $this->lang->line('doctor');?></label> 
						<?php if ($level == 'Doctor')
							{  
								$doctor_name =  $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name'];;
								$userid = $this->session->userdata('id');
							 ?>
							<input type="text" name="doctor" class="form-control" id="doctor" value="<?= $doctor_name?>" readonly="readonly"/><br/>
							<input type="hidden" name="doctor_id" class="form-control" id="doctor" value="<?= $schedule['doctor_id']?>" readonly="readonly"/><br/>
							<?php 
							}
							else
							{
								$userid = 0;
							?>
								<select name="doctor_id" class="form-control">  <option></option>
									<?php foreach ($doctors as $doctor) { ?>
										<option value="<?php echo $doctor['doctor_id'] ?>" <?php if($doctor['doctor_id'] == $schedule['doctor_id']){echo "selected";}?>><?= $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; ?></option>
									<?php } ?>
								</select>
															
						<?php }							
							 echo form_error('doctor','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div>
					<div class="form-group">
						<label> <?php echo $this->lang->line('day');?></label>
						<label class="checkbox-inline">
							<input type="checkbox" name="select-all" id="select-all" onClick="checkAll(this)"/><?php echo $this->lang->line('select_all'); ?>
						</label>
					</div>
					<div class="form-group"
						<?php foreach($days_of_week as $day){ ?>
							<label class="checkbox-inline">
								<input name="day[]" type="checkbox" <?php if(strpos($schedule['schedule_day'],$day) === false){}else{echo "checked";} ?> value="<?=$day;?>"><?=$day;?>
							</label>
						<?php } ?>
						<?php echo form_error('day','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div>
					<div class="form-group">
						<label for="from_time"><?php echo "From Time";?></label>						
						<input name="from_time" id="from_time" type="text" class="form-control" value="<?php echo $schedule['from_time'];?>"/>											
						<?php echo form_error('from_time','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				
				<div>
					<div class="form-group">
						 <label for="to_time"><?php echo "To Time";?></label>
						<input name="to_time" id="to_time" type="text" class="form-control" value="<?php  echo $schedule['to_time']; ?>"/>																	
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