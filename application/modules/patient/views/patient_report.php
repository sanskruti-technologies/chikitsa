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
	
		$("#patient_report").dataTable({
			"pageLength": 50
		});
	});
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('patient')." ".$this->lang->line('report');?>
				</div>
				<div class="panel-body">
					<?php echo form_open('patient/patient_report'); ?>
					<div class="col-md-12">
					<div class="col-md-3">	
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
				<div class="panel-heading">
					<?php echo $this->lang->line('patient')." ".$this->lang->line('report');?>
				</div>
				<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="patient_report" >
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
	</div>
</div>