<script type="text/javascript" charset="utf-8">
   $(function() {
        $( "#visit_date" ).datepicker({
            dateFormat: "<?=$def_dateformate; ?>",
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true
        });
    });
	$(function() {
        $( "#end_date" ).datepicker({
            dateFormat: "<?=$def_dateformate; ?>",
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true
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
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
					<?php echo $this->lang->line('doctor_availability');?> 
			</div>
			<div class="panel-body">
				<span class="err"><?php echo validation_errors(); ?></span>
				<?php echo form_open('appointment/edit_inavailability/'. $availability['appointment_id'].'/'.$availability['doctor_id'].'/'.$availability['end_date']) ?>   
				<?php $level = $this->session->userdata('category'); ?>
				<div class="form-group">
					<label><?php echo $this->lang->line('doctor');?></label>
					<?php if ($level == 'Doctor')
					{  
						$doctor_name = $doctors['name'];
					?>
					<input type="text"  class="form-control"name="doctor" id="doctor" value="<?= $doctor_name?>" readonly="readonly"/><br/>
					<?php 
					}else{
					?>
						<select name="doctor" class="form-control">  <option></option>
							<?php foreach ($doctors as $doctor) { ?>
							<option value="<?php echo $doctor['doctor_id'];?>"<?php if($doctor['doctor_id']== $availability['doctor_id']) {echo 'selected';}?>><?= $doctor['name']; ?></option>
							<?php } ?>
						</select> 
						<?php	
					}
					?>
				</div>
				<div class="form-group">
					<label for="visit_date"> <?php echo $this->lang->line('start_date');?></label>
					<input name="visit_date" class="form-control" type="date" value="<?php echo date('Y-m-d', strtotime($availability['appointment_date']));?>"/>
				</div>
				<div class="form-group">
					<label for="start_time"><?php echo $this->lang->line('start_time');?></label>
					<input name="start_time" class="form-control" type="time" value="<?php echo $availability['start_time']; ?>"/>
				</div>
				<div class="form-group">
					<label for="end_date"> <?php echo $this->lang->line('end_date');?></label>
					<input name="end_date" class="form-control" type="date"  value="<?php echo date('Y-m-d', strtotime($availability['end_date'])); ?>"/>
				</div>
				<div class="form-group">
					 <label for="end_time"> <?php echo $this->lang->line('end_time');?></label>
					<input name="end_time" class="form-control" type="time" value="<?php echo $availability['end_time']; ?>"/>
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
					<a class="btn btn-primary" href="<?php echo base_url() . "/index.php/appointment/inavailability" ?>"><?php echo $this->lang->line('cancel');?></a>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>