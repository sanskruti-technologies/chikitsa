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
<script type="text/javascript" charset="utf-8">
    $(window).load(function() {
		$(".expand-collapse-header").click(function () {
			if($(this).find("i").hasClass("fa-arrow-circle-down"))
			{
				$(this).find("i").removeClass("fa-arrow-circle-down");
				$(this).find("i").addClass("fa-arrow-circle-up");
			}else{
				$(this).find("i").removeClass("fa-arrow-circle-up");
				$(this).find("i").addClass("fa-arrow-circle-down");
			}

			$content = $(this).next('.expand-collapse-content');
			$content.slideToggle(500);

		});
		$('.datetimepicker').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollInput:false,
			scrollMonth:false,
			scrollTime:false,
		});
		$('#visit_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			<?php if(!$back_date_visit){ ?>
			minDate:0,
			<?php } ?>
			maxDate:0,
			scrollInput:false,
			scrollMonth:false,
			scrollTime:false,
		});
		$('#visit_time').datetimepicker({
			datepicker:false,
			step:<?=$time_interval*60;?>,
			format: '<?=$def_timeformate; ?>',
			formatTime:'<?=$def_timeformate; ?>',
			<?php if($clinic_start_time != '00:00' && $clinic_end_time !='24:00'){?>
			minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
			maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time . "+ $time_interval minute"));?>',
			<?php } ?>
			scrollInput:false,
			scrollMonth:false,
			scrollTime:false,
		});
		$('#followup_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollInput:false,
			scrollMonth:false,
			scrollTime:false,
		});
		$('#visit_date').change(function() {
			var startdate = $('#visit_date').val();
			var add_day=<?php echo $clinic_settings['next_followup_days']; ?> ;
			var formate_followup = moment(startdate,'DD MM YYYY').add(add_day, 'days').format('DD-MM-YYYY');
			console.log(formate_followup);
			$('#followup_date').val(formate_followup);
			//$('#followup_date').val(moment(startdate, '<?=$morris_date_format; ?>').add(<?=$clinic_settings['next_followup_days'];?>, 'day').format('<?=$morris_date_format; ?>'));
		});
		$('#reference_by').on('change', function (e) {
		var optionSelected = $("option:selected", this);
		var reference_add_option  = optionSelected.attr('reference_add_option');
		var placeholder  = optionSelected.attr('reference_placeholder');
		if(reference_add_option == 1){
			$('#reference_details').parent().show();
			$("#reference_details").attr("placeholder", placeholder);
		}else{
			$('#reference_details').parent().hide();
		}
	});
    });

$(document).ready(function(){
	var optionSelected = $("option:selected", this);
	var reference_add_option  = optionSelected.attr('reference_add_option');
	var placeholder  = optionSelected.attr('reference_placeholder');

	if(reference_add_option == 1){
		$('#reference_details').parent().show();
		$("#reference_details").attr("placeholder", placeholder);
	}else{
		$('#reference_details').parent().hide();
	}
<?php if (in_array("prescription", $active_modules)) { ?>

		var medicine_array = [<?php
				$i=0;
				foreach ($medicines as $medicine){
					if ($i>0) {echo ",";}
					echo '{value:"' . $medicine['medicine_name'] . '",id:"' . $medicine['medicine_id'] . '"}';
					$i++;
				}
			?>];
		$("#medicine_name").autocomplete({
			source: medicine_array,
			minLength: 1,//search after one characters
			select: function(event,ui){
				//do something
				$("#medicine_id").val(ui.item ? ui.item.id : '');

			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#medicine_name").val('');
					}
			},
		});
			$( "#add_medicine" ).click(function() {
											event.preventDefault();

											var medicine_count = parseInt( $( "#medicine_count" ).val());
											medicine_count = medicine_count + 1;
											$( "#medicine_count" ).val(medicine_count);

											var medicine = "<div><div class='col-md-2'><label for='medicine' style='display:block;text-align:left;'>Medicine</label><input type='text' name='medicine_name[]' id='medicine_name"+medicine_count+"' class='form-control'/><input type='hidden' name='medicine_id[]' id='medicine_id"+medicine_count+"' class='form-control'/></div>";
											medicine += "<div class='col-md-6'><label for='frequency' style='display:block;text-align:left;'>Frequency</label><div class='col-md-1'>M</div><div class='col-md-3'><input type='text' name='freq_morning[]' id='freq_morning' class='form-control'/></div><div class='col-md-1'>A</div><div class='col-md-3'><input type='text' name='freq_afternoon[]' id='freq_afternoon' class='form-control'/></div><div class='col-md-1'>N</div><div class='col-md-3'><input type='text' name='freq_evening[]' id='freq_evening' class='form-control'/></div></div>";
											medicine += "<div class='col-md-1'><label for='days' style='display:block;text-align:left;'>Days</label><input type='text' name='days[]' id='days' class='form-control'/></div>";
											medicine += "<div class='col-md-2'><label for='prescription_notes' style='display:block;text-align:left;'>Instructions</label><input type='text' name='prescription_notes[]' id='prescription_notes' class='form-control'/></div>";
											medicine += "<div class='col-md-1'><label></label><a href='#' id='delete_medicine"+medicine_count+"' class='btn btn-danger btn-sm square-btn-adjust'>Delete</a></div></div>";
											$( "#prescription_list" ).append(medicine);

											$("#delete_medicine"+medicine_count).click(function() {
												$(this).parent().parent().remove();
											});
											$("#medicine_name"+medicine_count).autocomplete({
												source: medicine_array,
												minLength: 1,//search after one characters
												select: function(event,ui){
													//do something
													$("#medicine_id"+medicine_count).val(ui.item ? ui.item.id : '');

												},
												change: function(event, ui) {
													if (ui.item == null) {
														$("#medicine_name"+medicine_count).val('');
													}
												},
											});
										});
	$("#add_medicine_submit").click(function(event) {
		event.preventDefault();
		var medicine_name = $("#add_medicine_name").val();
		console.log(medicine_array);
		$.post( "<?php echo site_url('prescription/add_medicine');?>",
			{medicine_name: medicine_name},
			function(data,status){
				data = JSON.parse(data);
				medicine_array.push(data)
				$( "#medicine_name" ).autocomplete('option', 'source', medicine_array);
			});
		});


	<?php } ?>
});
</script>


<?php
	$bal_amount=0;
	$total_amount=0;
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading expand-collapse-header"><i class="fa fa-arrow-circle-down"></i>
					<?php echo $this->lang->line('patient_details');?> <?php echo $this->lang->line('clickto_toggle_display');?>
				</div>
				<div class="panel-body expand-collapse-content collapsed">
					<div class="col-md-9">
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('id');?> :</label>
								<span><?php echo $patient['display_id']; ?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('ssn_id');?> :</label>
								<span><?php echo $patient['ssn_id']; ?></span>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('name');?> :</label>
								<span><?php echo $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name']; ?></span>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('display_name');?>:</label>
								<span><?php echo $patient['display_name']; ?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('reference_by');?> :</label>
								<?php
									$reference_by = $patient['reference_by'];
									if($patient['reference_by_detail'] != NULL){
										$reference_by .= $reference_by . $patient['reference_by_detail'];
									}
								?>
								<span><?php echo $reference_by; ?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('dob');?> :</label>
								<?php if($patient['dob'] != NULL) { ?>
								<span><?php echo date($def_dateformate,strtotime($patient['dob'])); ?></span>
								<?php } ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('gender');?> :</label>
								<span><?= $patient['gender']; ?></span>
							</div>
						</div>
						<?php
						$contacts = "";
						foreach($contact_details as $contact_detail){
							if($contact_detail['contact_id'] == $patient['contact_id']){
								if($contacts == ""){
									$contacts .= $contact_detail['detail'];
								}else{
									$contacts .= ",".$contact_detail['detail'];
								}
							}
						}
						?>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('mobile');?> :</label>
								<span><?= $contacts; ?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('email');?> :</label>
								<span><?= $addresses['email']; ?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label style="display:table-cell;"><?php echo $this->lang->line('address');?> :</label>
								<span><strong>(<?=$addresses['type']; ?>)</strong><br/>
									   <?=$addresses['address_line_1'];?><br/>
									   <?=$addresses['address_line_2'];?><br/>
									   <?=$addresses['area'];?><br/>
									   <?=$addresses['city'] . "," . $addresses['state'] . "," . $addresses['postal_code'] . "," . $addresses['country']; ?>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<?php if(isset($addresses['contact_image']) && $addresses['contact_image'] != ""){ ?>
								<img src="<?php echo base_url() . $addresses['contact_image']; ?>" height="150" width="150"/>
							<?php }else{ ?>
								<img src="<?php echo base_url() . "/uploads/images/Profile.png" ?>" height="150" width="150"/>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<a class="btn btn-primary" title="Edit" href="<?php echo site_url("patient/edit/" . $patient['patient_id']."/visit"); ?>">Edit</a>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading expand-collapse-header">
					<i class="fa fa-arrow-circle-up"></i>
					<?php echo $this->lang->line('new')." ".$this->lang->line('visit'). " " . $this->lang->line('toggle_display');?>
				</div>
				<div class="panel-body expand-collapse-content">
					<?php echo form_open('patient/visit/' . $patient_id,$appointment_id); ?>
					<div class="col-md-12">
						<input type="hidden" name="patient_id" value="<?= $patient_id; ?>"/>
						<input type="hidden" name="session_date_id" value="<?=$session_date_id; ?>"/>
						<div class="col-md-12">
							<?php if($session_date_id != NULL){ ?>
							<div class="alert alert-warning"><?=$this->lang->line('planned_visit');?></div>
							<?php } ?>
							<div class="col-md-4">
								<div class="form-group">
									<label for="visit_doctor"><?=$this->lang->line('doctor');?></label>
									<?php
										if ($user_level == 'Doctor') {
											$doctor_name = $doctors['name'];
											?><input type="text" name="doctor_name" class="form-control" readonly="readonly" value="<?=$doctor['name'];?>"/>
											<input type="hidden" name="doctor" value="<?=$doctor['doctor_id'];?>"/><?php
										}else{
											?>
											<select id="doctor" name="doctor" class="form-control">
												<option></option>
												<?php foreach ($doctors as $doctor) { ?>
												<option data-departments="<?=$doctor['department_id'];?>" value="<?php echo $doctor['doctor_id'] ?>" <?php if($appointment_doctor == $doctor['doctor_id']) echo "selected";?>><?= $doctor['name']; ?></option>
												<?php }	?>
											</select>
										<?php } ?>
										<?php echo form_error('doctor','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="visit_date"><?=$this->lang->line('visit')." ".$this->lang->line('date');?></label>
									<input type="text" name="visit_date" id="visit_date" value="<?php echo $curr_date; ?>" class="form-control"/>
									<?php echo form_error('visit_date','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="visit_time"><?php echo $this->lang->line('time');?></label>
									<input type="text" name="visit_time" id="visit_time" value="<?php echo $curr_time; ?>" class="form-control"/>
									<?php echo form_error('visit_time','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="type"><?php echo $this->lang->line('type');?></label>
									<select name="type" class="form-control">
										<option value="New Visit"><?php echo $this->lang->line('new')." ".$this->lang->line('visit');?></option>
										<option <?php if ($visits) {echo 'selected = "selected"';} ?> value="Established Patient"><?php echo $this->lang->line('established_patient');?></option>
									</select>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label for="appointment_reason"><?php echo $this->lang->line('reason');?></label>
									<input type="text" name="appointment_reason" id="appointment_reason" value="<?=$appointment_reason;?>" class="form-control"/>
									<?php echo form_error('reason','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label for="notes"><?php echo $this->lang->line('notes');?></label>
									<textarea rows="4" cols="100" class="form-control" name="notes"></textarea>
									<?php echo form_error('notes','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
						</div>
						<?php if (in_array("prescription", $active_modules)) { ?>
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
									<label for="patient_notes"><?php echo $this->lang->line('notes_for_patient');?></label>
									<textarea rows="4" cols="100" class="form-control" name="patient_notes"></textarea>
									<?php echo form_error('patient_notes','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php if (in_array("disease", $active_modules)) { ?>
						<div class="col-md-12">
							<div class="col-md-6">
								<label for="visit_diseases" style="display:block;text-align:left;"><?php echo $this->lang->line('diagnosed_diseases');?></label>
								<select id="disease" class="form-control" multiple="multiple" style="width:350px;" tabindex="4" name="disease[]">
									<?php foreach ($diseases as $disease) { ?>
										<option value="<?php echo $disease['disease_id']; ?>"><?= $disease['disease_name']; ?></option>
									<?php } ?>
								</select>
								<script>jQuery('#disease').chosen();</script>
							</div>
							<div class="col-md-6">
								<a href="#" id="add_related_treatment" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line('add_related_treatment');?></a>
							</div>

							<div class="modal fade" id="addTreatmentModal" tabindex="-1" role="dialog" aria-labelledby="addTreatmentModalLabel" aria-hidden="true" style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title" id="addTreatmentModalLabel"><?=$this->lang->line('add_related_treatment');?></h4>
										</div>
										<div class="modal-body">
											<table id="addTreatmentTable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<td></td>
														<td><?php echo $this->lang->line('treatment');?></td>
														<td><?php echo $this->lang->line('disease');?></td>
													</tr>
												</thead>
												<tbody>
													<?php foreach($diseases as $disease){?>
														<?php if($disease['treatments'] != ""){ ?>
														<?php $disease_treatments = explode(",",$disease['treatments']);?>
														<?php foreach($disease_treatments as $treatment){ ?>
														<tr class="disease<?=$disease['disease_id'];?>">
															<td><label>
																	<input class="disease_treatment_checkbox" type="checkbox" value="<?=$treatment;?>" checked>
																</label>
															</td>
															<td><?=$treatment_name[$treatment];?></td>
															<td><?=$disease['disease_name'];?></td>
														</tr>
														<?php } ?>
														<?php } ?>
													<?php } ?>
												</tbody>
											</table>
										</div>
										<div class="modal-footer">
											<input id="add_treatment_submit" type="submit" name="submit" value="Save" class="btn btn-primary" data-dismiss="modal"/>
											<button type="button" class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('close');?></button>
										</div>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php if (in_array("treatment", $active_modules)) { ?>
						<div class="col-md-12">
							<div class="col-md-4">
								<label for="visit_treatment" style="display:block;text-align:left;"><?php echo $this->lang->line('treatment');?></label>
								<select id="treatment" class="form-control" multiple="multiple" style="width:350px;" tabindex="4" name="treatment[]">
									<?php foreach ($treatments as $treatment) { ?>
										<option data-departments="<?=$treatment['departments'];?>" value="<?=$treatment['id'];?>"><?= $treatment['treatment']; ?></option>
									<?php } ?>
								</select>
								<script>
									$(window).load(function() {
										$('#treatment').chosen();
										$('#doctor').change(function() {

											$('#treatment').val([]);

											var departments = $(this).find(':selected').data('departments');
											departments = departments.toString();
											var department_array = departments.split(',');

											$("#treatment > option").each(function() {
												var treatment_departments = $(this).data('departments');
												treatment_departments = treatment_departments.toString();
												var show_option = false;
												$.each( department_array, function( index, department_id ) {
													if(treatment_departments.includes(department_id)){
														show_option = true;
													}
												});
												if(show_option){
													$(this).show();
												}else{
													$(this).hide();
												}
											});

											$('#treatment').trigger("chosen:updated");
										});
										$('#add_related_treatment').on('click',function(){
											event.preventDefault();
											$("#addTreatmentTable tbody tr").hide();

											var diseases = $("#disease").val();
											if(diseases != null){
												$.each(diseases, function( index, disease ) {
													$(".disease"+disease).show();
												});
											}
											//$('#invoice_id').val(invoice_id);
											$('#addTreatmentModal').modal({show:true});
										});
										$( "#add_treatment_submit" ).click(function() {
											event.preventDefault();

											$(".disease_treatment_checkbox").each(function() {
												if ($(this).is(":checked")) {
													var treatment_id = $(this).val();
													//console.log(treatment_id);
													$("#treatment option[value='" + treatment_id + "']").attr("selected", true);
													$('#treatment').trigger("chosen:updated");
												}
											});
										});
									});
								</script>
							</div>
						</div>
						<?php } ?>
						<?php if (in_array("lab", $active_modules)) { ?>
						<div class="col-md-12">
							<div class="col-md-4">
								<label for="lab_test" style="display:block;text-align:left;"><?php echo $this->lang->line('lab_tests');?></label>
								<select id="lab_test" class="form-control" multiple="multiple" style="width:350px;" name="lab_test[]">
									<?php foreach ($lab_tests as $lab_test) { ?>
										<option value="<?php echo $lab_test['test_id'] ?>"><?= $lab_test['test_name']; ?></option>
									<?php } ?>
								</select>
								<script>
									$(window).load(function() {
										$('#lab_test').chosen();
									});
								</script>
							</div>
						</div>
						<?php } ?>
						<?php if (in_array("prescription", $active_modules)) { ?>

						<script>
									$(window).load(function() {
										var medicine_array = [<?php
											$i=0;
											foreach ($medicines as $medicine){
												if ($i>0) {echo ",";}
												echo '{value:"' . $medicine['medicine_name'] . '",id:"' . $medicine['medicine_id'] . '"}';
												$i++;
											}
										?>];
										$("#medicine_name").autocomplete({
											source: medicine_array,
											minLength: 1,//search after one characters
											select: function(event,ui){
												//do something
												$("#medicine_id").val(ui.item ? ui.item.id : '');

											},
											change: function(event, ui) {
												 if (ui.item == null) {
													$("#medicine_name").val('');
													}
											},
										});
										$( "#add_medicine" ).click(function() {
											event.preventDefault();

											var medicine_count = parseInt( $( "#medicine_count" ).val());
											medicine_count = medicine_count + 1;
											$( "#medicine_count" ).val(medicine_count);

											var medicine = "<div><div class='col-md-2'><label for='medicine' style='display:block;text-align:left;'>Medicine</label><input type='text' name='medicine_name[]' id='medicine_name"+medicine_count+"' class='form-control'/><input type='hidden' name='medicine_id[]' id='medicine_id"+medicine_count+"' class='form-control'/></div>";
											medicine += "<div class='col-md-6'><label for='frequency' style='display:block;text-align:left;'>Frequency</label><div class='col-md-1'>M</div><div class='col-md-3'><input type='text' name='freq_morning[]' id='freq_morning' class='form-control'/></div><div class='col-md-1'>A</div><div class='col-md-3'><input type='text' name='freq_afternoon[]' id='freq_afternoon' class='form-control'/></div><div class='col-md-1'>N</div><div class='col-md-3'><input type='text' name='freq_evening[]' id='freq_evening' class='form-control'/></div></div>";
											medicine += "<div class='col-md-1'><label for='days' style='display:block;text-align:left;'>Days</label><input type='text' name='days[]' id='days' class='form-control'/></div>";
											medicine += "<div class='col-md-2'><label for='prescription_notes' style='display:block;text-align:left;'>Instructions</label><input type='text' name='prescription_notes[]' id='prescription_notes' class='form-control'/></div>";
											medicine += "<div class='col-md-1'><label></label><a href='#' id='delete_medicine"+medicine_count+"' class='btn btn-danger btn-sm square-btn-adjust'>Delete</a></div></div>";
											$( "#prescription_list" ).append(medicine);

											$("#delete_medicine"+medicine_count).click(function() {
												$(this).parent().parent().remove();
											});
											$("#medicine_name"+medicine_count).autocomplete({
												source: medicine_array,
												minLength: 1,//search after one characters
												select: function(event,ui){
													//do something
													$("#medicine_id"+medicine_count).val(ui.item ? ui.item.id : '');

												},
												change: function(event, ui) {
													if (ui.item == null) {
														$("#medicine_name"+medicine_count).val('');
													}
												},
											});
										});

									});
								</script>

						<div class="col-md-12">
							<div class="col-md-12">
								<label style="display:block;text-align:left;"><?php echo $this->lang->line('prescription');?></label>
							</div>
							<div class="col-md-12">
								<a href="#" id="add_medicine" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line('add_another_medicine');?></a>
								<a id="add_new_medicine" class="btn btn-primary square-btn-adjust"  data-toggle="modal" data-target="#myModal">Add Medicine</a>

								<input type="hidden" id="medicine_count" value="0"/>
							</div>
							<div id="prescription_list">
							<div class="col-md-2">
								<label for="medicine" style="display:block;text-align:left;"><?php echo $this->lang->line('medicine');?></label>
								<input type="text" name="medicine_name[]" id="medicine_name" class="form-control"/>
								<input type="hidden" name="medicine_id[]" id="medicine_id" class="form-control"/>
							</div>
							<div class="col-md-6">
								<label for="frequency" style="display:block;text-align:left;"><?php echo $this->lang->line('frequency');?></label>
								<div class="col-md-1">
									<?php echo $this->lang->line('morning');?>
								</div>
								<div class="col-md-3">
									<input type="text" name="freq_morning[]" id="freq_morning" class="form-control"/>
								</div>
								<div class="col-md-1">
									<?php echo $this->lang->line('afternoon');?>
								</div>
								<div class="col-md-3">
									<input type="text" name="freq_afternoon[]" id="freq_afternoon" class="form-control"/>
								</div>
								<div class="col-md-1">
									<?php echo $this->lang->line('night');?>
								</div>
								<div class="col-md-3">
								<input type="text" name="freq_evening[]" id="freq_evening" class="form-control"/>
								</div>
							</div>
							<div class="col-md-1">
								<label for="days" style="display:block;text-align:left;"><?php echo $this->lang->line('days');?></label>
								<input type="text" name="days[]" id="days" class="form-control"/>
							</div>
							<div class="col-md-2">
								<label for="prescription_notes" style="display:block;text-align:left;"><?php echo $this->lang->line('instructions');?></label>
								<input type="text" name="prescription_notes[]" id="prescription_notes" class="form-control"/>
							</div>
							</div>
						</div>
						<?php } ?>
						<?php if($session_date_id == NULL){ ?>
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<label for="followup_date"><?php echo $this->lang->line('next_follow_date');?></label>
									<input type="text" class="form-control" name="followup_date" id="followup_date" value="<?php echo date($def_dateformate, strtotime($next_followup_date)); ?>"/>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php if (in_array("marking",$active_modules)) {?>
							<div class="col-md-12">
								<div class="col-md-4">
									<a class="btn btn-primary square-btn-adjust" href="<?= site_url('marking/index') ."/". $patient['patient_id'] ."/". $this->input->post('doctor'); ?>"><?php echo $this->lang->line('marking');?></a>
								</div>
							</div>
						<?php } ?>
						<?php if (in_array("prescription", $active_modules)){
							if (file_exists(APPPATH."views/log/display_fields.".EXT)){
								$this->load->view('history/display_fields');
							}else{?>
								<div class="col-md-12">
							<div class="col-md-6">
								<?php if(isset($section_master)){ ?>
								<?php foreach($section_master as $section){ ?>
									<h3><?=$section['section_name'];?></h3>
									<?php $section_id = $section['section_id'];?>
									<?php foreach($section_fields as $field){?>
										<?php
										if(isset($patient_history_details[$field['field_id']])){
											$value = $patient_history_details[$field['field_id']];
										}else{
											$value = "";
										}?>
										<div class="form-group">
											<label for="history_<?=$field['field_id'];?>"><?=$field['field_label'];?></label>
										<?php if($field['field_type'] == "text"){?>
											<input type="input" class="form-control" name="history_<?=$field['field_id'];?>" value="<?=$value?>"/>
										<?php }elseif($field['field_type'] == "date"){ ?>
											<input type="input" class="form-control datetimepicker" name="history_<?=$field['field_id'];?>" value="<?=$value?>"/>
										<?php }elseif($field['field_type'] == "combo"){ ?>
											<select class="form-control" name="history_<?=$field['field_id'];?>">
												<?php foreach($field_options as $field_option){ ?>
													<?php if($field_option['field_id'] == $field['field_id']){?>
													<option value="<?=$field_option['option_value'];?>" <?php if($field_option['option_value'] == $value ){echo "selected";}?>><?=$field_option['option_label'];?></option>
													<?php } ?>
												<?php } ?>
											</select>
										<?php }elseif($field['field_type'] == "checkbox"){ ?>
											<?php foreach($field_options as $field_option){ ?>
												<?php if($field_option['field_id'] == $field['field_id']){?>
													<label class="checkbox">
														<input type="checkbox" name="history_<?=$field['field_id'];?>[]" value="<?=$field_option['option_value'];?>" <?php if(strpos($value,$field_option['option_value']) !== FALSE ){echo "checked";}?> /><?=$field_option['option_label'];?>
													</label>
												<?php } ?>
											<?php } ?>
										<?php }elseif($field['field_type'] == "radio"){ ?>

											<?php foreach($field_options as $field_option){ ?>
												<?php if($field_option['field_id'] == $field['field_id']){?>
													<div class="radio">
														<label>
															<input type="radio" name="history_<?=$field['field_id'];?>" id="history_<?=$field['field_id'];?>" value="<?=$field_option['option_value'];?>" checked=""><?=$field_option['option_label'];?>
														</label>
													</div>
												<?php } ?>
											<?php } ?>
										<?php } ?>
											<?php echo form_error($field['field_id'],'<div class="alert alert-danger">','</div>'); ?>
										</div>
									<?php } ?>
								<?php } ?>
								<?php } ?>
							</div>
						</div>
							<?php }
						}?>
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="form-group">
									<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" /><?php echo $this->lang->line('save');?></button>
									<?php  if($level != "Nurse"){?>
										<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" value="save_complete" /><?php echo $this->lang->line("save_complete");?></button>
									<?php } ?>
								</div>
							</div>
							<div class="col-md-4">
								<input type="hidden" name="appointment_id" value="<?=$appointment_id;?>"/>
								<?php if ($appointment_id != NULL) {
									$time = explode(":", $start_time); ?>
									<!--<div class="form-group">
										<a class="btn btn-primary btn-sm square-btn-adjust" href='<?//=base_url() . "index.php/appointment/change_status/" . $appointment_id . "/Complete";?>'><?php //echo $this->lang->line('complete');?></a>
									</div>-->
								<?php } ?>
							</div>
						</div>

					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading expand-collapse-header">
					<i class="fa fa-arrow-circle-up"></i>
					<?php echo $this->lang->line('visits');?> <?php echo $this->lang->line('toggle_display');?>
				</div>
				<div class="panel-body expand-collapse-content">
					<div >
						<table class="table table-striped table-bordered table-hover" id="visit_table">
						<thead>
							<tr>
								<th style="display:none;"></th>
								<th><?php echo $this->lang->line('date');?> <?php echo $this->lang->line('time');?></th>
								<th style="width:250px;"><?php echo $this->lang->line('notes');?></th>
								<th style="width:250px;"><?php echo $this->lang->line('patient_notes');?></th>
								<th><?php echo $this->lang->line('doctor');?></th>
								<?php if (in_array("gallery",$active_modules)) {?>
								<th><?php echo $this->lang->line('progress');?></th>
								<?php }?>
								<th><?php echo $this->lang->line('bill');?></th>
								<th><?php echo $this->lang->line('edit');?></th>
							</tr>
						</thead>
						<?php $i = 1; ?>
						<tbody>
						<?php if ($visits) { ?>
						<?php foreach ($visits as $visit) { ?>

							<tr>
								<td style="display:none;"><?= date('Y-m-d H:i:s', strtotime($visit['visit_date']. ' '. $visit['visit_time'])); ?></td>
								<td><?= date($def_dateformate, strtotime($visit['visit_date'])); ?> <?= date($def_timeformate, strtotime($visit['visit_time'])); ?></td>
								<td><?= $visit['notes']; ?><br /><?php
								$flag = FALSE;
								foreach ($visit_diseases as $visit_disease) {
									if($visit_disease['visit_id'] == $visit['visit_id']){
										if ($flag == FALSE) {
											echo "Diagnosis : ";
											echo $visit_disease['disease_name'];
											$flag = TRUE;
										} else {
											echo " ," . $visit_disease['disease_name'];
										}
									}

								}
								?>
								<br/>
								<?php
								$flag = FALSE;
								foreach ($visit_treatments as $visit_treatment) {
									if ($visit_treatment['visit_id'] == $visit['visit_id'] && $visit_treatment['type'] == 'treatment') {
										if ($flag == FALSE) {
											echo "Treatments : ";
											echo $visit_treatment['particular'];
											$flag = TRUE;
										} else {
											echo " ," . $visit_treatment['particular'];
										}
									}
								}
								?></td>
								<td><?= $visit['patient_notes']; ?><br/>
								<?php if (in_array("prescription", $active_modules)) { ?>
									<?php if ($this->prescription_model->is_prescription($visit['visit_id'])){ ?>
										<a target="_blank" class="btn btn-xs btn-primary square-btn-adjust" href="<?= site_url('prescription/print_prescription') . "/" . $visit['visit_id']; ?>"><?php echo $this->lang->line('print') . ' ' . $this->lang->line('prescription');?></a></br>
										<a class="btn btn-primary btn-xs square-btn-adjust" href="<?= site_url('prescription/edit_prescription') . "/" . $visit['visit_id']; ?>"><?php echo $this->lang->line('edit') . ' ' . $this->lang->line('prescription');?></a>
									<?php }else{ ?>
										<a target="_blank" class="btn btn-xs btn-primary square-btn-adjust" href="<?= site_url('prescription/add_prescription') . "/" . $visit['visit_id']; ?>"><?php echo $this->lang->line('add') . ' ' . $this->lang->line('prescription');?></a></br>
									<?php } ?>
								<?php } ?>
								<?php
								$flag = FALSE;
								foreach ($visit_lab_tests as $visit_lab_test) {
									if ($visit_lab_test['visit_id'] == $visit['visit_id']) {
										if ($flag == FALSE) {
											echo "<strong>Lab Tests :</strong> ";
											$flag = TRUE;
										} else {
											echo " ,";
										}
										if($visit_lab_test['file_name'] != NULL){
											echo "<a class='btn btn-xs btn-primary square-btn-adjust' href='".base_url('uploads/reports/'.$visit_lab_test['file_name'])."' target='_blank'>".$lab_test_name[$visit_lab_test['test_id']]."</a>";
										}else{
											echo $lab_test_name[$visit_lab_test['test_id']];
										}

									}
								}
								?>
								</td>
								<td><?php echo $visit['name']; ?></td>
								<?php if (in_array("gallery",$active_modules)) {?>
								<td><a class="btn btn-primary square-btn-adjust" href="<?= site_url('gallery/index') ."/". $visit['patient_id'] ."/". $visit['visit_id']; ?>"><?php echo $this->lang->line('gallery');?></a></td>
								<?php }?>
								<td>
									<?php echo $this->lang->line('total');?> : <?php echo currency_format($visit['total_amount']+ $visit[$tax_type.'_tax_amount']);if($currency_postfix) echo $currency_postfix; ?><br/>
									<?php echo $this->lang->line('balance');?> : <?php echo currency_format($visit['due_amount']);if($currency_postfix) {echo $currency_postfix;} ?><br/>
									<a class="btn btn-primary btn-sm square-btn-adjust" href="<?= site_url('bill') . "/edit/" . $visit['bill_id']; ?>"><?php echo $this->lang->line('bill');?></a>
									<a target="_blank" class="btn btn-primary btn-sm square-btn-adjust" href="<?= site_url('patient/print_receipt') . "/" . $visit['visit_id']; ?>"><?php echo $this->lang->line('print') . ' ' . $this->lang->line('bill');?></a>
								</td>
								<?php @$total_amount=$total_amount+$visit['total_amount']+ $visit[$tax_type.'_tax_amount']; ?>
								<?php $bal_amount=$bal_amount+$visit['due_amount']; ?>
								<td>
									<center>
										<a class="btn btn-sm btn-primary square-btn-adjust" href="<?= site_url('patient/edit_visit') . "/" . $visit['visit_id'] . "/" . $visit['patient_id']; ?>"><?php echo $this->lang->line('edit');?></a>
										<a class="btn btn-sm btn-primary square-btn-adjust" href="<?= site_url('history/print_visit_history') . "/" . $visit['visit_id']; ?>"><?php echo $this->lang->line('print').' '.$this->lang->line('history');?></a>
									</center>
								</td>
							</tr>
							<?php $i++; ?>
							<?php } ?>


							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th style="display:none;"></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<?php if (in_array("gallery",$active_modules)) {?>
								<th></th>
								<?php }?>
								<th style="text-align:right;"><?php echo $this->lang->line('total');?> :<?php echo currency_format($total_amount)?><br/>
								<?php echo $this->lang->line('balance');?> :  <?php echo currency_format($bal_amount)?></th>
								<th></th>

							</tr>
						</tfoot>
						</table>
						<script>
							$(document).ready	(function() {
								$('#visit_table').dataTable( {
									"order": [[ 0, "desc" ]]
								} );
							});
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Add Medicine</h4>
			</div>
			<?php echo form_open(); ?>
			<div class="modal-body">
					<div class="col-md-12"><label><?=$this->lang->line('medicine_name');?>:</label></div>
					<div class="col-md-12"><input type="text" id="add_medicine_name" name="medicine_name" class="form-control"/></div>
			</div>
			<div class="modal-footer">
					<input id="add_medicine_submit" type="submit" name="submit" value="Save" class="btn btn-primary" data-dismiss="modal"/>
					<button type="button" class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('close');?></button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>