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

        $( "#bill_from_date" ).datetimepicker({

			timepicker:false,

			format: '<?=$def_dateformate; ?>',

			scrollInput:false,

			scrollMonth:false,

			scrollTime:false

		});

        $( "#bill_to_date" ).datetimepicker({

			timepicker:false,

			format: '<?=$def_dateformate; ?>',

			scrollInput:false,

			scrollMonth:false,

			scrollTime:false,

			onShow:function( ct ){

				var FromDate = $('#bill_from_date').val();

				this.setOptions({

					minDate:FromDate?FromDate:false,

					formatDate:'<?=$def_dateformate; ?>'

				})

			}

		});

    });

</script>

<?php

	$level = $this->session->userdata('category');



	$title = set_value("title","");

	$patient_id = set_value("patient_id","");

	$display_id = set_value("display_id","");

	$patient_name = set_value("patient_name","");

	$phone_number = set_value("phone_number","");

	$email_id = set_value("email_id","");



?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line("bill")." ".$this->lang->line("report");?></h5>	
		</div>
		<div class="card-body">
			<?php echo form_open('patient/bill_detail_report') ?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="bill_from_date"><?php echo $this->lang->line("from_date");?></label>
						<input type="text" name="bill_from_date" id="bill_from_date" value="<?=date($def_dateformate, strtotime($bill_from_date));?>" class="form-control" autocomplete="off"/>
						<?php echo form_error('bill_from_date','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="bill_to_date"><?php echo $this->lang->line("to_date")?></label>
						<input type="text" name="bill_to_date" id="bill_to_date" value="<?=date($def_dateformate, strtotime($bill_to_date));?>" class="form-control" autocomplete="off"/>
						<?php echo form_error('bill_to_date','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
			</div>
			<?php if($level != 'Doctor'){ ?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
								<?php   $user_id = $this->session->userdata('id'); ?>
							<label for="doctor"><?php echo $this->lang->line("from_doctor");?></label>
						<select id="doctor" name="doctor[]" class="form-control" multiple="multiple" <?php if ($this->doctor_model->is_doctor($user_id)) { echo 'style = display:none;';} ?>>
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
							<option value="0"><?php echo $this->lang->line("all_clinic");?></option>
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
					<input type="text" name="display_id" id="display_id" value="<?=$display_id;?>" class="form-control" autocomplete="off"/>
				</div>
				<div class="col-md-3">
					<label for="patient"><?php echo $this->lang->line('patient');?></label>
					<input type="text"  name="patient_name" id="patient_name" value="<?=$patient_name;?>" class="form-control" autocomplete="off"/>
					<?php echo form_error('patient_id','<div class="alert alert-danger">','</div>'); ?>
				</div>
				<div class="col-md-3">
					<label for="phone"><?php echo $this->lang->line('mobile');?></label>
					<input type="text" name="phone_number" id="phone_number" value="<?=$phone_number;?>" class="form-control" autocomplete="off"/>
				</div>
				<div class="col-md-3">
					<label for="email_id"><?php echo $this->lang->line('email');?></label>
					<input type="text" name="email_id" id="email_id" value="<?=$email_id;?>" class="form-control" autocomplete="off"/>
				</div>
			</div></br>
			<div class="right">
			<div class="col-md-12">
					<button type="submit" name="submit" class="btn square-btn-adjust btn-primary btn-sm " /><?php echo $this->lang->line("go");?></button>
					<button type="submit" name="print_report" class="btn square-btn-adjust btn-primary btn-sm " /><i class="fa fa-print"></i> <?php echo $this->lang->line("print");?></button>
					<button type="submit" name="excel_report" class="btn square-btn-adjust btn-primary btn-sm " /><?php echo $this->lang->line("export_to_excel");?></button>
					<?php
						$selected_doctors_str = "0";
						if(!empty($selected_doctor)){
							$selected_doctors_str = implode("__",$selected_doctor);
						}
					?>
					<!--a href="<?= site_url('patient/bill_detail_report_export/'.$bill_from_date.'/'.$bill_to_date.'/'.$selected_doctors_str);?>" class="btn btn-primary" /><?php echo $this->lang->line("export_to_excel");?></a-->
			</div>
					</div>
			<input type="hidden" name="doctor_id" id="doctor_id" value="" />
			<?php echo form_close(); ?>
		</div>
	</div>	
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line("report");?></h5>	
		</div>
		<div class="card-body">
					<div class="text-align">
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
					</div>&nbsp;
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="bill_table">
					<thead>
						<tr>
							<th><?php echo $this->lang->line("sr_no");?></th>
							<!--th><?php echo $this->lang->line("clinic")." ".$this->lang->line("name");?></th-->
							<th><?php echo $this->lang->line("bill")." ".$this->lang->line("date");?></th>
							<th><?php echo $this->lang->line("doctor") . ' ' . $this->lang->line("name");?></th>
							<th><?php echo $this->lang->line("patient_id");?></th>
							<th><?php echo $this->lang->line("patient_name");?></th>
							<th><?php echo $this->lang->line("bill")." ".$this->lang->line("no");?></th>
							<th style="text-align:right;"><?php echo $this->lang->line('bill') . ' ' . $this->lang->line('amount');?></th>
							<th style="text-align:right;"><?php echo $this->lang->line('payment_amount');?></th>
							<th style="text-align:right;"><?php echo $this->lang->line('due_amount');?></th>
						</tr>
					</thead>
					<tbody>
					<?php $bill_amt=0; $pay_amt=0; $due_amt=0;?>
					<?php if ($reports) { ?>
					<?php $i=1;?>
					<?php foreach ($reports as $report) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<!--td><?php echo $report['clinic_name']; ?></td-->
							<?php $bill_date = date($def_dateformate,strtotime($report['bill_date'])); ?>
							<td><?php echo $bill_date; ?></td>
							<td><?php echo $report['doctor_name']; ?></td>
							<td><?php echo $report['patient_id']; ?></td>
										<td><?php echo $report['first_name'] . ' ' .$report['middle_name'] . ' ' . $report['last_name'] ?></td>
										<td><?php echo $report['bill_id']; ?></td>
										<td style="text-align:right;"><?php
									echo currency_format($report['total_amount'] + $report[$tax_type.'_tax_amount']);
									$bill_amt=$bill_amt+$report['total_amount']+ $report[$tax_type.'_tax_amount'];
								?></td>
							<td style="text-align:right;"><?php
									echo currency_format($report['pay_amount']);
									$pay_amt=$pay_amt+$report['pay_amount'];
								?>
							</td>
							<td style="text-align:right;"><?php
									echo currency_format($report['total_amount'] + $report[$tax_type.'_tax_amount'] - $report['pay_amount']);
									$due_amt=$due_amt+$report['total_amount'] + $report[$tax_type.'_tax_amount'] - $report['pay_amount'];
								?></td>
									</tr>
						<?php $i++; ?>
						<?php } ?>
						<script>
							$(window).load(function() {
								$('#bill_table').dataTable();
							});
						</script>
						<?php }else{ ?>
							<tr>
								<td colspan="10"><?php echo $this->lang->line('nobillsfound_for_selected_parameters'); ?></td>
							</tr>
						<?php } ?>
					</tbody>
					<thead>
						<tr>
							<th></th>
							<!--th></th-->
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th style="text-align:right;"><?php echo currency_format($bill_amt); ?></th>
							<th style="text-align:right;"><?php echo currency_format($pay_amt);  ?></th>
							<th style="text-align:right;"><?php echo currency_format($due_amt); ?></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>