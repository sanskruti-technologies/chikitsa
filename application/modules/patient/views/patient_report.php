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

		$("#patient_since").datetimepicker({

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



    });

	$(document).ready(function () {

		$("#select_all").click(function () {

			$(".field_checkbox").prop('checked', $(this).prop('checked'));

		});



		var table=$("#patient_report").DataTable({

			"pageLength": 50

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

<!-- Begin Page Content -->
<div class="container-fluid">
		<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('patient')." ".$this->lang->line('report');?></h5>	
		</div>
		<div class="card-body">

					<?php echo form_open('patient/patient_report'); ?>

					<div class="row">
					<div class="col-md-12">

						<label for="reference" style="display:block;text-align:left;"><?=$this->lang->line('reference_by');?></label>

						<select name="reference[]" id="reference" class="form-control" multiple="multiple">

							<option></option>

							<?php foreach ($reference_by as $reference) {?>

								<option value="<?=$reference['reference_id'];?>" <?php if(!empty($selected_reference)){if(in_array($reference['reference_id'], $selected_reference)) {echo "selected";}} ?>><?= $reference['reference_option'];?></option>

							<?php } ?>

							<input type="hidden" name="doctor_id" id="doctor_id" value="" />

						</select>

						<script>jQuery('#reference').chosen();</script>

					</div>

					</div></br>
					<div class="row right">
					<div class="col-md-12">

						<button type="submit" name="submit" class="btn square-btn-adjust btn-primary btn-sm"><?php echo $this->lang->line('go');?></button>

						<button type="submit" name="export_to_excel" class="btn square-btn-adjust btn-primary btn-sm"><?php echo $this->lang->line('export_to_excel');?></button>

						<button type="submit" name="print_report" class="btn square-btn-adjust btn-primary btn-sm"><?php echo $this->lang->line('print_report');?></button>

					</div>
					</div>

					<?php echo form_close(); ?>

		</div>
	</div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid">
		<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary">
				<?php echo $this->lang->line('patient')." ".$this->lang->line('report');?>
			</h5>
		</div>
		<div class="card-body">
							<div class="text-align">
								<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
								<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
							</div>&nbsp;
			<div class="table-responsive">

				<table class="table table-striped table-bordered table-hover display responsive nowrap" id="patient_report" >

					<thead>

						<tr>

							<th><?php echo $this->lang->line("sr_no");?></th>

							<th><?php echo $this->lang->line("id");?></th>

							<th><?php echo $this->lang->line("name");?></th>

							<th><?php echo $this->lang->line("phone_number");?></th>

							<th><?php echo $this->lang->line("email");?></th>

							<th><?php echo $this->lang->line("reference_by");?></th>

							<th><?php echo $this->lang->line("follow_up");?></th>

						</tr>

					</thead>

					<tbody>

						<?php $i=1; ?>

						<?php foreach($patient_report as $patient){

							$followup_date = "";

							if($patient['followup_date'] != '0000-00-00' && $patient['followup_date'] != NULL){

								$followup_date = date($def_dateformate,strtotime($patient['followup_date']));

							}

							?>

							<tr>

								<td><?=$i;?></td>

								<td><?php echo $patient['display_id'];?></td>

								<td><?php echo $patient['first_name'] . " " .$patient['middle_name']. "  ".$patient['last_name'];?></td>

								<td><?php echo $patient['phone_number'];?></td>

								<td><?php echo $patient['email'];?></td>

								<td><?php echo $patient['reference_by'];?></td>

								<td><?php echo $followup_date;?></td>

							</tr>

						<?php $i++; ?>

						<?php }?>

					</tbody>

				</table>

			</div>

		</div>
	</div>
</div>