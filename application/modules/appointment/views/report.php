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
	$level = $this->session->userdata('category');

?>

<!-- Begin Page Content -->

<div class="container-fluid">

	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('appointment')." ".$this->lang->line('report');?></h5>
		</div>
		<div class="card-body">

			<?php echo form_open('appointment/appointment_report'); ?>

			<div class="col-md-12">

				<div class="row">

					<div class="col-md-3">

						<label><?php echo $this->lang->line('from_date');?></label>

						<input type="text" name="from_date" id="from_date" class="form-control" value="<?php if($from_date){ echo date($def_dateformate,strtotime($from_date));}?>" autocomplete="off"/>

					</div>

					<div class="col-md-3">

						<label><?php echo $this->lang->line('to_date');?></label>

						<input type="text" name="to_date" id="to_date" class="form-control" value="<?php if($to_date){ echo date($def_dateformate,strtotime($to_date));}?>" autocomplete="off"/>

					</div>

					<div class="col-md-3" <?php if($level == 'Doctor'){ echo 'style = display:none;';} ?>>

						<label><?php echo $this->lang->line('doctor');?></label>

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

			</div>

			<div class="col-md-12">

				<div class="row">

					<input type="hidden" name="patient_id" id="patient_id" value="<?php if(isset($curr_patient)){echo $curr_patient['patient_id']; } ?>"/>

				

					<div class="col-md-3">

						<label><?php echo $this->lang->line('patient_id');?></label>

						<input type="text" name="display_id" id="display_id" value="<?php if(isset($curr_patient)){echo $curr_patient['display_id']; } ?>" class="form-control" autocomplete="off"/>

					</div>

					<div class="col-md-3">

						<label><?php echo $this->lang->line('patient');?></label>

						<input type="text" name="patient_name" id="patient_name" value="<?php if(isset($curr_patient)){echo $curr_patient['first_name']." " .$curr_patient['middle_name']." " .$curr_patient['last_name']; } ?>" class="form-control" autocomplete="off"/>

						<?php echo form_error('patient_id','<div class="alert alert-danger">','</div>'); ?>

					</div>



					<div class="col-md-3">

						<label><?php echo $this->lang->line('mobile');?></label>

						<input type="text" name="phone_number" id="phone_number" value="<?php if(isset($curr_patient)){echo $curr_patient['phone_number']; } ?>" class="form-control" autocomplete="off"/>

					</div>

					<div class="col-md-3">

						<label><?php echo $this->lang->line('email');?></label>

						<input type="text" name="email_id" id="email_id" value="<?php if(isset($curr_patient)){echo $curr_patient['email']; } ?>" class="form-control" autocomplete="off"/>

					</div>

				</div>

			</div>
			</br>
			<div class="right">
			<div class="col-md-12">

				<button type="submit" name="submit" class="btn square-btn-adjust btn-primary btn-sm"><?php echo $this->lang->line('go');?></button>

				<button type="submit" name="export_to_excel" class="btn square-btn-adjust btn-primary btn-sm"><?php echo $this->lang->line('export_to_excel');?></button>

				<button type="submit" name="print_report" class="btn square-btn-adjust btn-primary btn-sm"><?php echo $this->lang->line('print_report');?></button>

			</div>
							</div>

			<?php echo form_close(); ?>
		</div>
	</div>
	
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('report');?></h5>
		</div>
		<div class="card-body">
					<div class="text-align">
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
					</div>&nbsp;
					<div class="table-responsive">

						<table class="table table-striped table-bordered table-hover display responsive nowrap" id="appointment_report" >

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



<script type="text/javascript" charset="utf-8">

	$(window).on('load', function(){

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

		var table=$('#appointment_report').DataTable();

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
				echo '[ "' . $patient['display_id'] . '","' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '","' . $patient['phone_number'] . '","' . $patient['email'] . '","' . $patient['patient_id'] . '"]';
				$i++;
			}?>];
		var p_columns = [{name: '<?php echo $this->lang->line("patient").$this->lang->line("id");?>', minWidth:'80px'}, {name: '<?php echo $this->lang->line("name");?>', minWidth:'100px'},  {name: '<?php echo $this->lang->line('phone_number'); ?>', minWidth:'110px'},{name: '<?php echo $this->lang->line('email'); ?>', minWidth:'120px'},{name: '<?php echo $this->lang->line("id");?>', minWidth: '30px'}];
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

</script>