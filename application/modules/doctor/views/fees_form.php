<?php 
	if(isset($fees)){
		$edit = TRUE;
		$fees_id = $fees['id'];
		$fees_detail = $fees['detail'];
		$fees_fees = $fees['fees'];
		$fees_doctor_id = $fees['doctor_id'];
	}else{
		$edit = FALSE; 
		$fees_detail = "";
		$fees_fees = "";
		$fees_doctor_id = 0;
	}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line("fees");?>
				</div>
				<div class="panel-body">
					<?php if($edit) { ?>
						<?php echo form_open_multipart('doctor/edit_fees/') ?>						
					<?php }else{ ?>		
						<?php echo form_open_multipart('doctor/add_fee/') ?>	
					<?php } ?>			
						<div class="col-md-6">
							<div class="form-group">
								<?php if($edit){ ?>
								<input type="hidden" name="id" class="form-control" value="<?= $fees_id; ?>"/>
								<?php } ?>
								<label for="doctor"><?=$this->lang->line("doctor");?></label>
								<?php if($this->session->userdata('category') == 'Doctor'){ ?>
									<input type="hidden" name="doctor" class="form-control" value="<?= $doctor['doctor_id'] ?>"/>	
									<input type="text" readonly="readonly" name="doctor_name" class="form-control" value="<?= $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; ?>"/>	
								<?php }else{ ?>
									<select name="doctor" class="form-control">
										<option></option>
										<?php  foreach ($doctors as $doctor) { ?>
										<option value="<?php  echo $doctor['doctor_id'] ?>" <?php if($fees_doctor_id == $doctor['doctor_id']) {echo "selected='selected'"; }?> >
											<?= 'Dr. '. $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; ?>
										</option>
										<?php } ?>
									</select>
								<?php } ?>
								<?php echo form_error('doctor','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="detail"><?=$this->lang->line("detail");?></label>
								<input type="input" name="detail" class="form-control" value="<?= $fees_detail; ?>"/>
								<?php echo form_error('detail','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="fees"><?=$this->lang->line("fees");?></label>
								<input type="input" name="fees" class="form-control" value="<?= $fees_fees; ?>"/>
								<?php echo form_error('fees','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit" name="submit" /><?php echo $this->lang->line("save");?></button>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>