<?php 
/*
	This file is part of Chikitsa.

    Chikitsa is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Chikitsa is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Chikitsa.  If not, see <https://www.gnu.org/licenses/>.
*/
?>
<?php
	if(isset($doctor)){
		$doctor_name = $doctor['name'];
		$doctor_id = $doctor['doctor_id'];
	}
	if(isset($appointment)){
		//Edit Appointment
		$header = $this->lang->line("edit")." ".$this->lang->line("appointment");
		$patient_name = $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'];
		$title = $appointment['title'];
		$appointment_id = $appointment['appointment_id'];
		$start_time = $appointment['start_time'];
		$end_time = $appointment['end_time'];
		$appointment_date = $appointment['appointment_date'];
		$status = $appointment['status'];
		$appointment_id = $appointment['appointment_id'];
	}else{
		//Add Appointment
		$header = $this->lang->line("new")." ".$this->lang->line("appointment");
		$patient_name = "";
		$title = "";
		$time_interval =  $time_interval*60;
		$start_time = date($def_timeformate, strtotime($appointment_time));
		$end_time = date($def_timeformate, strtotime("+$time_interval minutes", strtotime($appointment_time))); 
		
		$appointment_date = $appointment_date;
		$status = "Appointments";
	}
	$total = ($particular_total + $fees_total + $treatment_total + $item_total) - ((-1)*($balance));
?>

<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('appointment_details');?>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('patient_name');?>:</label>
								<span><?=$patient['first_name'].' '.$patient['middle_name'] .' '.$patient['last_name'];?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('doctor_name');?>:</label>
								<span><?=$doctor['name'];?></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('visit_date');?>:</label>
								<span><?=date($def_dateformate,strtotime($visit['visit_date']));?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('visit_time');?>:</label>
								<span><?=date($def_timeformate,strtotime($visit['visit_time']));?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('visit_type');?>:</label>
								<span><?=$visit['type'];?></span>
							</div>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="col-md-12">
							<div class="form-group">
									<label><?php echo $this->lang->line('reason');?>:</label>
									<span><?=$visit['appointment_reason'];?></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('notes');?>:</label>
								<span><?=$visit['notes'];?></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('patient_notes');?>:</label>
								<span><?=$visit['patient_notes'];?></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-12">
							<label><?php echo $this->lang->line('bill_details');?></label>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('bill_id');?>:</label>
								<span><?=$bill['bill_id'];?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('bill_date');?>:</label>
								<span><?=date($def_dateformate,strtotime($bill['bill_date']));?></span>
							</div>
						</div>
						<div class="col-md-12">
							<?php $this->load->view('bill/bill_table'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- JQUERY SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-1.11.3.js"></script>
<!-- JQUERY UI SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="<?= base_url() ?>assets/js/custom.js"></script>