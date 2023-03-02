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
	<script type="text/javascript">
		$(document).ready(function () {

			var table=$('#bill_table').DataTable();

			table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
			$('#btn-show-all-children').on('click', function(){
				// Expand row details
				table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
			});
			// Handle click on "Collapse All" button
			$('#btn-hide-all-children').on('click', function(){
				// Collapse row details
				table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
			});
			$('.confirmDelete').click(function(){
				return confirm("<?=$this->lang->line('areyousure_delete');?>");
			});
		});
		$(window).load(function(){

		
			var searcharrpatient=[<?php $i = 0;
			foreach ($patients as $patient) {
				if ($i > 0) { echo ",";}
				echo '[ "' . $patient['display_id'] . '","' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '","' . $patient['phone_number'] . '","' . $patient['email'] . '","' . $patient['patient_id'] . '"]';
				$i++;
			}?>];
			var p_columns = [ {name: '<?php echo $this->lang->line("patient").$this->lang->line("id");?>', minWidth:'80px'}, {name: '<?php echo $this->lang->line("name");?>', minWidth:'100px'}, {name: '<?php echo $this->lang->line('phone_number'); ?>', minWidth:'110px'},{name: '<?php echo $this->lang->line('email'); ?>', minWidth:'120px'},{name: '<?php echo $this->lang->line("id");?>', minWidth: '30px'}];
			var p_values=searcharrpatient;
			$("#patient_name").mcautocomplete({
					showHeader: true,
					columns: p_columns,
					source: p_values,
					select: function(event, ui) {
						this.value = (ui.item ? ui.item[1]: '');
					$("#patient_id").val(ui.item ? ui.item[4] : '');
					$("#display_id").val(ui.item ? ui.item[0] : '');
					$("#phone_number").val(ui.item ? ui.item[2] : '');
					$("#email_id").val(ui.item ? ui.item[3] : '');
						return false;
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
			$("#phone_number").mcautocomplete({
					showHeader: true,
					columns: p_columns,
					source: p_values,
					select: function(event, ui) {
						this.value = (ui.item ? ui.item[2]: '');
					$("#patient_id").val(ui.item ? ui.item[4] : '');
					$("#display_id").val(ui.item ? ui.item[0] : '');
					$("#patient_name").val(ui.item ? ui.item[1] : '');
					$("#email_id").val(ui.item ? ui.item[3] : '');
						return false;
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
			$("#display_id").mcautocomplete({
					showHeader: true,
					columns: p_columns,
					source: p_values,
					select: function(event, ui) {
						this.value = (ui.item ? ui.item[0]: '');
					$("#patient_id").val(ui.item ? ui.item[4] : '');
					$("#patient_name").val(ui.item ? ui.item[1] : '');
					$("#phone_number").val(ui.item ? ui.item[2] : '');
					$("#email_id").val(ui.item ? ui.item[3] : '');
						return false;
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
			$("#email_id").mcautocomplete({
					showHeader: true,
					columns: p_columns,
					source: p_values,
					select: function(event, ui) {
						this.value = (ui.item ? ui.item[3]: '');
					$("#patient_id").val(ui.item ? ui.item[4] : '');
					$("#patient_name").val(ui.item ? ui.item[1] : '');
					$("#phone_number").val(ui.item ? ui.item[2] : '');
					$("#display_id").val(ui.item ? ui.item[0] : '');
						return false;
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


			$( "#visit_from_date" ).datetimepicker({
				timepicker:false,
				format: '<?=$def_dateformate; ?>',
				scrollInput:false,
				scrollMonth:false,
				scrollTime:false
			});
			$( "#visit_to_date" ).datetimepicker({
				timepicker:false,
				format: '<?=$def_dateformate; ?>',
				scrollInput:false,
				scrollMonth:false,
				scrollTime:false,
				onShow:function( ct ){
					var FromDate = $('#visit_from_date').val();
					this.setOptions({
						minDate:FromDate?FromDate:false,
						formatDate:'<?=$def_dateformate; ?>'
					})
				}
			});
		});
	</script>
<?php
$disable="";
if($patient_details){
	//echo $patient_details['first_name']."<br/>";
	//print_r($patient_details);
	
	$patient_id = set_value('patient_id',$patient_details['patient_id']);
	$display_id = set_value('display_id',$patient_details['display_id']);
	$patient_name = set_value('patient_name',$patient_details['patient_name']);
	
	$phone_number = set_value('phone_number',$patient_details['phone_number']);
	$email_id = set_value('email_id',$patient_details['email']);
	$title = set_value('title',$patient_details['title']);
	$disable="readonly";
	
}else{
	$title = set_value("title","");
	$patient_id = set_value("patient_id","");
	$display_id = set_value("display_id","");
	$patient_name = set_value("patient_name","");
	$phone_number = set_value("phone_number","");
	$email_id = set_value("email_id","");
}
		$level = $this->session->userdata('category');
		
	?>


<!-- Begin Page Content -->
<div class="container-fluid">
		<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary">
				<?php echo $this->lang->line("medical")." ".$this->lang->line("history")." ".$this->lang->line("report");?>
			</h5>
		</div>
		<div class="card-body">
				<?php echo form_open('patient/visit_report') ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="visit_from_date"><?php echo $this->lang->line("from_date");?></label>
								<input type="text" name="visit_from_date" id="visit_from_date" value="<?=date($def_dateformate, strtotime($visit_from_date));?>" class="form-control"/>
								<?php echo form_error('visit_from_date','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="visit_to_date"><?php echo $this->lang->line("to_date")?></label>
								<input type="text" name="visit_to_date" id="visit_to_date" value="<?=date($def_dateformate, strtotime($visit_to_date));?>" class="form-control" />
								<?php echo form_error('visit_to_date','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
					</div>
						<?php if($level != 'Doctor'){ ?>
						<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="doctor"><?php echo $this->lang->line("from_doctor");?></label>
								<select id="doctor" name="doctor[]" class="form-control" multiple="multiple" <?php if ($level == 'Doctor') { echo 'style = display:none;';} ?>>
									<?php foreach ($doctors as $doctor) { ?>
										<option <?php if(!empty($selected_doctor)){if(in_array($doctor['doctor_id'], $selected_doctor)) {echo "selected";}} ?> value="<?php echo $doctor['doctor_id'] ?>"><?= $doctor['name']; ?></option>
									<?php } ?>
								</select>
								<script>jQuery('#doctor').chosen();</script>
								<?php echo form_error('doctor','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
						</div>
						<?php } ?>
						<?php if (in_array("centers", $active_modules)) { ?>
							<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<label for="clinic_id"><?php echo $this->lang->line("center");?></label>
								<select id="clinic_id" name="clinic_id" class="form-control" >
									
									<?php foreach($clinics as $clinic){ ?>
									<option value="<?=$clinic['clinic_id'];?>" <?php if($clinic['clinic_id'] == $clinic_id){echo "selected='selected'";} ?>><?=$clinic['clinic_name'];?></option>
									<?php } ?>
								</select>
								<script>jQuery('#doctor').chosen();</script>
								<?php echo form_error('doctor','<div class="alert alert-danger">','</div>'); ?>
							</div>
							</div>
						</div>
						<?php } ?>
						<div class="row">
								<input type="hidden" name="patient_id" id="patient_id" value="<?= $patient_id; ?>" class="form-control"/>
								<div class="col-md-3">
									<label for="display_id"><?php echo $this->lang->line('patient_id');?></label>
									<input <?=$disable?> type="text" name="display_id" id="display_id" value="<?=$display_id;?>" class="form-control"/>
								</div>
								
								<div class="col-md-3">
									<label for="patient"><?php echo $this->lang->line('patient');?></label>
									<input <?=$disable?> type="text"  name="patient_name" id="patient_name" value="<?=$patient_name;?>" class="form-control"/>
									<?php echo form_error('patient_name','<div class="alert alert-danger">','</div>'); ?>
								</div>

								<div class="col-md-3">
									<label for="phone"><?php echo $this->lang->line('mobile');?></label>
									<input <?=$disable?> type="text" name="phone_number" id="phone_number" value="<?=$phone_number;?>" class="form-control"/>
								</div>
								<div class="col-md-3">
									<label for="email_id"><?php echo $this->lang->line('email');?></label>
									<input <?=$disable?>  type="text" name="email_id" id="email_id" value="<?=$email_id;?>" class="form-control"/>
								</div>
						</div></br>
						<div class="row right">
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" name="submit" class="btn square-btn-adjust btn-primary btn-sm" /><?php echo $this->lang->line("go");?></button>
								<button type="submit" name="print_report" formtarget="_blank" class="btn square-btn-adjust btn-primary btn-sm" /><i class="fa fa-print"></i> <?php echo $this->lang->line("print");?></button>
								<?php
									$selected_doctors_str = "0";
									if(!empty($selected_doctor)){
										$selected_doctors_str = implode("__",$selected_doctor);
									}
								?>
							</div>
						</div>
						</div>
						<input type="hidden" name="doctor_id" id="doctor_id" value="" />
				<?php echo form_close(); ?>
		</div>
	</div>
</div>

<div class="container-fluid">
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary">
				<?php echo $this->lang->line("medical")." ".$this->lang->line("history")." ".$this->lang->line("report");?>
			</h5>
		</div>
		<div class="card-body">
					<div class="text-align">
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
					</div>&nbsp;
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover display responsive nowrap" id="bill_table">
					<thead>
						<tr>
							<th><?php echo $this->lang->line("sr_no");?></th>
							<th><?php echo $this->lang->line("visit")." ".$this->lang->line("date");?></th>
							<th><?php echo $this->lang->line("visit")." ".$this->lang->line("time");?></th>
							<th><?php echo $this->lang->line("doctor") . ' ' . $this->lang->line("name");?></th>
							<th><?php echo $this->lang->line("notes");?></th>
							<?php if ((in_array("prescription", $active_modules)) || (in_array("history", $active_modules))) {?>
								<th><?php echo $this->lang->line("patient") . ' ' .$this->lang->line("notes");?></th>
							<?php } ?>
							
						</tr>
					</thead>
					<tbody>
						<?php
						 if (in_array("history", $active_modules)) { 
							if (file_exists(APPPATH."modules/history/views/show_display_functions".EXT)){
								$this->load->view('history/show_display_functions');
							}
					 	}
						if(isset($visits)){
							$i=0;
							$j=1;
							if($level == 'Doctor'){ 
								foreach ($visits as $visit) { ?>
										<tr>
											<td><?php echo $j; ?></td>
											<td><?php echo  date($def_dateformate,strtotime($visit['visit_date']))?></td>
											<td><?php echo date($def_timeformate, strtotime($visit['visit_time'])); ?></td>
											<td><?php echo $visit['name']; ?></td>
											<td><?php echo $visit['notes']; ?> <br/>
													<?php if (in_array("treatment", $active_modules)) {
														$treatment="";
													?>
													<br/><strong><?=$this->lang->line("treatment")?> : </strong>
													<?php		foreach ($visit_treatments as $visit_treatment) {
															if ($visit_treatment['visit_id'] == $visit['visit_id'] && $visit_treatment['type'] == 'treatment') {
																$treatment=$treatment.",". $visit_treatment['particular'];
																	}
																}
																echo substr($treatment,1);
														}
													?>
													<?php if (in_array("lab", $active_modules)) {
														echo "<br/><strong>Lab Tests :</strong> ";
														$labtestvalue="";
															if(isset($visit_lab_tests)){
																foreach ($visit_lab_tests as $visit_lab_test) {
																	if ($visit_lab_test['visit_id'] == $visit['visit_id']) {
																		//echo $lab_test_name[$visit_lab_test['test_id']];
																			$labtestvalue=$labtestvalue.",". $lab_test_name[$visit_lab_test['test_id']];
																		
																	}
																	
																}
																echo substr($labtestvalue,1);
															}
														}
															?>
											</td>
											<?php if ((in_array("prescription", $active_modules)) || (in_array("history", $active_modules))) {?>
												<td>
													<?php if (in_array("prescription", $active_modules)) { ?>
														<br/><strong>Pateint Notes : </strong><?php echo $visit['patient_notes']; ?>
														<br/><strong>Medicines : </strong>
														<?php	
															echo implode(",",$medicine_name[$i]); 
														?>
													<?php } ?>
													<?php if (in_array("history", $active_modules)) { 
															if (file_exists(APPPATH."modules/history/views/show_display_fields".EXT)){
																$d['i']=$i;
																$d['display_file']=TRUE;
																$this->load->view('history/show_display_fields',$d);
															}
													 } ?>
												</td>

											<?php } ?>
										</tr>
												
										<?php	$i++; $j++;	
									
									}
							}else{

								foreach($doctors as $doctor){
									foreach ($visits as $visit) { 
										if($doctor['doctor_id']==$visit['doctor_id']){?>
										<tr>
											<td><?php echo $j; ?></td>
											<td><?php echo  date($def_dateformate,strtotime($visit['visit_date']))?></td>
											<td><?php echo date($def_timeformate, strtotime($visit['visit_time'])); ?></td>
											<td><?php echo $visit['name']; ?></td>
											<td><?php echo $visit['notes']; ?> <br/>
												<?php if (in_array("treatment", $active_modules)) {
														$treatment="";
													?>
													<br/><strong><?=$this->lang->line("treatment")?> : </strong>
													<?php	
														foreach ($visit_treatments as $visit_treatment) {
															if ($visit_treatment['visit_id'] == $visit['visit_id'] && $visit_treatment['type'] == 'treatment') {
														$treatment=$treatment.",". $visit_treatment['particular'];
															}
														}
														echo substr($treatment,1);
														}
													?>
											<?php if (in_array("lab", $active_modules)) {
												echo "<br/><strong>".$this->lang->line("lab_test")." :</strong> ";
												$labtestvalue="";
													if(isset($visit_lab_tests)){
														foreach ($visit_lab_tests as $visit_lab_test) {
															if ($visit_lab_test['visit_id'] == $visit['visit_id']) {
																//echo $lab_test_name[$visit_lab_test['test_id']];
																	$labtestvalue=$labtestvalue.",". $lab_test_name[$visit_lab_test['test_id']];
																
															}
															
														}
														echo substr($labtestvalue,1);
													}
												}
													?>
											</td>
											<?php if ((in_array("prescription", $active_modules)) || (in_array("history", $active_modules))) {?>
												<td>
													<?php if (in_array("prescription", $active_modules)) { ?>
														<br/><strong><?=$this->lang->line("patient")." ".$this->lang->line("notes")?> : </strong><?php echo $visit['patient_notes']; ?>
														<br/><strong><?=$this->lang->line("medicines")?> : </strong>
														<?php	
															echo implode(",",$medicine_name[$i]); 
														?>
													<?php } ?>
													<?php if (in_array("history", $active_modules)) { 
															if (file_exists(APPPATH."modules/history/views/show_display_fields".EXT)){
																$d['i']=$i;
																$this->load->view('history/show_display_fields',$d);
															}
													 } ?>
												</td>

											<?php } ?>
											
											</tr>
												
										<?php	$i++; $j++;	
										}
									}
								}
							}		
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>