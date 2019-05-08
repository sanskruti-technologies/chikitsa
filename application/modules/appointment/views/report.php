<?php
	$level = $this->session->userdata('category');
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('appointment')." ".$this->lang->line('report');?>
				</div>
				<div class="panel-body">
					<?php echo form_open('appointment/appointment_report'); ?>
					<div class="col-md-12">
					<div class="col-md-3">
						<?php echo $this->lang->line('from_date');?>
						<input type="text" name="from_date" id="from_date" class="form-control" value="<?php if($from_date){ echo date($def_dateformate,strtotime($from_date));}?>" />
					</div>
					<div class="col-md-3">
						<?php echo $this->lang->line('to_date');?>
						<input type="text" name="to_date" id="to_date" class="form-control" value="<?php if($to_date){ echo date($def_dateformate,strtotime($to_date));}?>" />
					</div>
					<div class="col-md-3" <?php if($level == 'Doctor'){ echo 'style = display:none;';} ?>>
						<?php echo $this->lang->line('doctor');?>
						<select name="doctor" class="form-control">
							<option></option>
							<?php foreach ($doctors as $doctor) {?>
								<option value="<?php echo $doctor['doctor_id'] ?>" <?php if($doctor['doctor_id'] == $doctor_id){echo "selected='selected'";} ?>><?= $doctor['name'];?></option>
							<?php } ?>
							<input type="hidden" name="doctor_id" id="doctor_id" value="" />
						</select>
					</div>
					<?php 
						if (in_array("centers", $active_modules)) { ?>
						<div class="col-md-3">
						<?php echo $this->lang->line('clinic');?>
						<select name="clinic" class="form-control">
							<?php foreach($clinics as $clinic){ ?>
							<option value="<?=$clinic['clinic_id'];?>" <?php if($clinic['clinic_id'] == $clinic_id){echo "selected='selected'";} ?>><?=$clinic['clinic_name'];?></option>
							<?php } ?>
						</select>
						</div>
					<?php }
					?>
					</div>
					<div class="col-md-12">
						<input type="hidden" name="patient_id" id="patient_id" value="<?php if(isset($curr_patient)){echo $curr_patient['patient_id']; } ?>"/>
					
						<div class="col-md-3">
							<?php echo $this->lang->line('patient_id');?>
							<input type="text" name="display_id" id="display_id" value="<?php if(isset($curr_patient)){echo $curr_patient['display_id']; } ?>" class="form-control"/>
						</div>
						<div class="col-md-3">
							<?php echo $this->lang->line('patient');?>
							<input type="text" name="patient_name" id="patient_name" value="<?php if(isset($curr_patient)){echo $curr_patient['first_name']." " .$curr_patient['middle_name']." " .$curr_patient['last_name']; } ?>" class="form-control"/>
							<?php echo form_error('patient_id','<div class="alert alert-danger">','</div>'); ?>
						</div>

						<div class="col-md-3">
							<?php echo $this->lang->line('mobile');?>
							<input type="text" name="phone_number" id="phone_number" value="<?php if(isset($curr_patient)){echo $curr_patient['phone_number']; } ?>" class="form-control"/>
						</div>
						<div class="col-md-3">
							<?php echo $this->lang->line('email');?>
							<input type="text" name="email_id" id="email_id" value="<?php if(isset($curr_patient)){echo $curr_patient['email']; } ?>" class="form-control"/>
						</div>
					</div>
					<div class="col-md-12">
						<button type="submit" name="submit" class="btn btn-primary"><?php echo $this->lang->line('go');?></button>
						<button type="submit" name="export_to_excel" class="btn btn-primary"><?php echo $this->lang->line('export_to_excel');?></button>
						<button type="submit" name="print_report" class="btn btn-primary"><?php echo $this->lang->line('print_report');?></button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>	
		
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="appointment_report" >
							<thead>
								<tr>
									<th><?php echo $this->lang->line("sr_no");?></th>
									<?php if (in_array("centers", $active_modules)) { ?>
									<th width="100px;"><?php echo $this->lang->line('clinic')." ".$this->lang->line('name');?></th>
									<?php } ?>
									<th width="100px;"><?php echo $this->lang->line('doctor')." ".$this->lang->line('name');?></th>
									<th width="100px;"><?php echo $this->lang->line('patient')." ".$this->lang->line('name');?></th>
									<th width="100px;"><?php echo $this->lang->line('appointment')." ".$this->lang->line('date');?></th>
									<th width="100px;"><?php echo $this->lang->line('appointment')." ".$this->lang->line('time');?></th>
									<th><?php echo $this->lang->line('waiting_in');?></th>
									<th><?php echo $this->lang->line('waiting')." ".$this->lang->line('duration');?></th>
									<th><?php echo $this->lang->line('consultation_in');?></th>
									<th><?php echo $this->lang->line('consultation_out');?></th>
									<th><?php echo $this->lang->line('consultation')." ".$this->lang->line('duration');?></th>
									<th><?php echo $this->lang->line('view');?></th>
								</tr>
							</thead>
							<?php if ($app_reports) {?>
							<tbody>
								<?php $i=1; ?>
								<?php foreach ($app_reports as $report):  ?>
									<tr <?php if ($i%2 == 0) { echo "class='even'"; }else{ echo "class='odd'"; } ?> >
										<td><?=$i;?></td> 
										<?php if (in_array("centers", $active_modules)) { ?>
											<td><?=$report['clinic_name'];?></td>      
										<?php } ?>
										<td><?=$report['doctor_name'];?></td>      
										<td><?=$report['patient_name'];?></td>                
										<td><?=date($def_dateformate,strtotime($report['appointment_date'])); ?></td>
										<td><?=$report['appointment_time']; ?></td>
										<td><?=$report['waiting_in']; ?></td>
										<?php 
											$waiting_duration = "--";
											if(isset($report['waiting_in']) && isset($report['consultation_in'])){
												$waiting_duration = inttotime((strtotime($report['consultation_in'])-strtotime($report['waiting_in']))/60/60);
											}
										?>
										<td><?php if($waiting_duration != "--") {echo date('H:i:s',strtotime($waiting_duration));} else{echo $waiting_duration;} ?></td>
										<td><?=$report['consultation_in'];?></td>
										<td><?=$report['consultation_out'];?></td>
										<?php 
											$consultation_duration = "--";
											if(isset($report['consultation_out']) && isset($report['consultation_in'])){
												$consultation_duration = inttotime((strtotime($report['consultation_out'])-strtotime($report['consultation_in']))/60/60);
											}
										?>
										<td><?php if($consultation_duration != "--") {echo date('H:i:s',strtotime($consultation_duration));} else{echo $consultation_duration;} ?></td>
										<td>
										<?php if(isset($report['consultation_in'])) { ?>
										<a class="btn btn-primary square-btn-adjust" href="<?=site_url('appointment/view_appointment/'.$report['appointment_id']);?>"><?php echo $this->lang->line('view');?></a>
										<?php } ?>
										</td>
									</tr>
								
								<?php $i++; ?>
								<?php endforeach ?>
							</tbody>
							<?php } else { ?>
							<tbody>
								<tr>
									<?php if (in_array("centers", $active_modules)) { ?>
										<td colspan="10"><?php echo $this->lang->line('norecfound');?></td>
									<?php }else{ ?>
										<td colspan="9"><?php echo $this->lang->line('norecfound');?></td>
									<?php } ?>
								</tr>
							</tbody>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		
	</div>
</div>
<!-- JQUERY SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-1.11.3.min.js"></script>
<!-- JQUERY UI SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-ui.min.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery.metisMenu.min.js"></script>
 <!-- DATA TABLE SCRIPTS -->
<script src="<?= base_url() ?>assets/js/dataTables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/js/dataTables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>/assets/js/dataTables/moment.min.js"></script>
<script src="<?= base_url() ?>/assets/js/dataTables/datetime-moment.min.js"></script>
<!-- TimePicker SCRIPTS-->
<script src="<?= base_url() ?>assets/js/jquery.datetimepicker.min.js"></script>
<link href="<?= base_url() ?>assets/js/jquery.datetimepicker.css" rel="stylesheet" />
<!-- CUSTOM SCRIPTS -->
<script src="<?= base_url() ?>assets/js/custom.min.js"></script>
<script type="text/javascript" charset="utf-8">
	$(window).load(function() {
		$("#from_date").datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate;?>',
			scrollInput:false, 
			scrollMonth:false,
			scrollTime:false,
			maxDate: 0,
		});
		$("#to_date").datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate;?>',
			scrollInput:false, 
			scrollMonth:false,
			scrollTime:false,
			maxDate: 0,
		});
		<?php if ($app_reports) {?>
		$('#appointment_report').DataTable();
		 /*var table = $('#appointment_report').DataTable({
			"columnDefs": [
				{ "visible": false, "targets": 0 }
			],
			"order": [[ 0, 'asc' ]],
			"displayLength": 25,
			"drawCallback": function ( settings ) {
				var api = this.api();
				var rows = api.rows( {page:'current'} ).nodes();
				var last=null;
	 
				api.column(0, {page:'current'} ).data().each( function ( group, i ) {
					if ( last !== group ) {
						$(rows).eq( i ).before(
							'<tr class="group"><td colspan="7">'+group+'</td></tr>'
						);
	 
						last = group;
					}
				} );
			}
		} );*/
		<?php } ?>

		var searcharrpatient=[<?php $i = 0;
		foreach ($patients as $patient) {
			if ($i > 0) { echo ",";}
			echo '{value:"' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '",id:"' . $patient['patient_id'] . '",display:"' . $patient['display_id'] . '",num:"' . $patient['phone_number'] . '",email:"' . $patient['email'] . '"}';
			$i++;
		}?>];
		$("#patient_name").autocomplete({
			autoFocus: true,
			source: searcharrpatient,
			minLength: 1,//search after one characters
			
			select: function(event,ui){
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#phone_number").val(ui.item ? ui.item.num : '');
				$("#display_id").val(ui.item ? ui.item.display : '');
				$("#email_id").val(ui.item ? ui.item.email : '');
				
			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
					}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			}
		});   
		var searcharrdispname=[<?php $i = 0;
		foreach ($patients as $patient) {
			if ($i > 0) {
				echo ",";
			}
				echo '{value:"' . $patient['display_id'] . '",id:"' . $patient['patient_id'] . '",num:"' . $patient['phone_number'] . '",patient:"' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '",email:"' . $patient['email'] . '"}';
			$i++;
		}?>];
		$("#display_id").autocomplete({
			autoFocus: true,
			source: searcharrdispname,
			minLength: 1,//search after one characters
			select: function(event,ui)
			{
				//do something
			   $("#patient_id").val(ui.item ? ui.item.id : '');
			   $("#patient_name").val(ui.item ? ui.item.patient : '');
			   $("#phone_number").val(ui.item ? ui.item.num : '');
			   	$("#email_id").val(ui.item ? ui.item.email : '');
			},
			change: function(event, ui) 
			{
				if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			},
			response: function(event, ui) 
			{
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			}
		});   
		var searcharrmob=[<?php $i = 0;
		foreach ($patients as $patient) {
			if ($i > 0) {
				echo ",";
			}
				echo '{value:"' . $patient['phone_number'] . '",email:"' . $patient['email'] . '",id:"' . $patient['patient_id'] . '",display:"' . $patient['display_id'] . '",patient:"' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '",email:"' . $patient['email'] . '"}';
			$i++;
		}?>];
		$("#phone_number").autocomplete({
			autoFocus: true,
			source: searcharrmob,
			minLength: 1,//search after one characters
			select: function(event,ui){
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#patient_name").val(ui.item ? ui.item.patient : '');
				$("#display_id").val(ui.item ? ui.item.display : '');
				$("#email_id").val(ui.item ? ui.item.email : '');
			},
			change: function(event, ui) {
				if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			}
		});  
		var searchemail=[<?php $i = 0;
		foreach ($patients as $patient) {
			if ($i > 0) {
				echo ",";
			}
				echo '{value:"' . $patient['email'] . '",id:"' . $patient['patient_id'] . '",num:"' . $patient['phone_number'] . '",display:"' . $patient['display_id'] . '",patient:"' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '",email:"' . $patient['email'] . '"}';
			$i++;
		}?>];
		$("#email_id").autocomplete({
			autoFocus: true,
			source: searchemail,
			minLength: 1,//search after one characters
			select: function(event,ui){
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#phone_number").val(ui.item ? ui.item.num : '');
				$("#patient_name").val(ui.item ? ui.item.patient : '');
				$("#display_id").val(ui.item ? ui.item.display : '');
				$("#email_id").val(ui.item ? ui.item.email : '');
			},
			change: function(event, ui) {
				if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#email_id").val('');
				}
			}
		});  
    });
</script>