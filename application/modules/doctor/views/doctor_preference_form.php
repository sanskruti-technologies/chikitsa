<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	})

    $("#doctor_table").dataTable();
	$('#from_time').datetimepicker({
		datepicker:false,
		minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
		maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>'
    });    
    $('#to_time').datetimepicker({
		datepicker:false,
		minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
		maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>'
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
	if(!empty($doctor_preference)){
		$preference_id = $doctor_preference['preference_id'];
		$doctor_id = $doctor_preference['doctor_id'];
		$doctor_name = $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; 
		$max_patient = $doctor_preference['max_patient'];
	}else{
		$max_patient = 1;
		if ($level == 'Doctor' || isset($doctor)) {
			//$doctor_name = $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; 
			$doctor_name=$doctor['name'];
			$doctor_id = $doctor['doctor_id'];
		} else {
			$doctor_id = 0;
		}
	}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
			<?php
			 echo $this->lang->line('doctor') . ' ' .$this->lang->line('preferences');
			 
			 ?>
			</div>
			<div class="panel-body">
			
			<?php
				if(isset($doctor_preference)){
					//echo form_open('doctor/edit_preference/'.$preference_id);
					echo form_open('doctor/edit_preference/'.$doctor_id);
				}else{
					echo form_open('doctor/insert_preference/');
				}
				$level = $this->session->userdata('category');
				?>
				<div>
					<div class="form-group">
						<label><?php echo $this->lang->line('doctor');?></label> 
						<?php if ($level == 'Doctor' || isset($doctor_id)) { ?>
							<input type="hidden" name="doctor" class="form-control" value="<?php echo $doctor_id; ?>" readonly="readonly"/>
							<input type="text" name="doctor_name" class="form-control" id="doctor_name" value="<?= $doctor_name; ?>" readonly="readonly"/><br/>
						<?php } else { ?>
							<select name="doctor" class="form-control">  
								<option></option>								
								<?php foreach ($doctors as $doctor) { ?>
								<option value="<?php echo $doctor['doctor_id'] ?>" <?php if($doctor_id==$doctor['doctor_id']){ echo "selected readonly";}?> >
									<?= $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; ?>
								</option>
								<?php } ?>
							</select>
						<?php }							
							 echo form_error('doctor','<div class="alert alert-danger">','</div>'); ?>
							 <input type="hidden" name="doctor_id" value="<?= $doctor_id; ?>"/>	
					</div>
				</div>
				<div>
					<div class="form-group">
						<label for="max_patient"><?php echo $this->lang->line('max_patient');?></label>						
						<input name="max_patient" id="max_patient" type="text" class="form-control" value="<?=$max_patient;?>"/>											
						<?php echo form_error('max_patient','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div>
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