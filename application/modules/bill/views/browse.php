<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	$("#bill_table").dataTable({
		"pageLength": 50
	});
	$('.confirmDelete').click(function(){
		return confirm("<?=$this->lang->line('areyousure_delete');?>");
	});
});
</script>
<script type="text/javascript" charset="utf-8">
    $(window).load(function() {
        $( "#from_date" ).datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollInput:false, 
			scrollMonth:false,
			scrollTime:false
		});
        $( "#to_date" ).datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollInput:false, 
			scrollMonth:false,
			scrollTime:false
		}); 
    });
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line("bills");?>
				</div>
				<div class="panel-body">
					<a 	title="<?php echo $this->lang->line("add")." ".$this->lang->line("bill");?>" 
						href="<?php echo base_url()."index.php/bill/insert/" ?>" 
						class="btn btn-primary square-btn-adjust">
							<?php echo $this->lang->line("add")." ".$this->lang->line("bill");?>
					</a>	
					<p></p>
					<div class="table-responsive">
						<div class="col-md-12" style="padding: 0px">
						<?php echo form_open('bill/index') ?>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" for="from_date"><?=$this->lang->line('from_date');?></label>
								<div class="controls">
									<input type="text" name="from_date" id="from_date" value="<?= date($def_dateformate,strtotime($from_date));?>" class="form-control"/>			
									<?php echo form_error('from_date','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" for="to_date"><?=$this->lang->line('to_date');?></label>
								<div class="controls">
									<input type="text" name="to_date" id="to_date" value="<?= date($def_dateformate,strtotime($to_date));?>" class="form-control"/>			
									<?php echo form_error('to_date','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="visit_doctor"><?=$this->lang->line('doctor');?></label>
									<select name="doctor_id" class="form-control">
										<option value="0"></option>
										<?php foreach ($doctors as $doctor) { 
										$selected = "";
										if($doctor['doctor_id'] == $doctor_id){
											$selected = "selected";	
										}
										?>
										
										<option value="<?php echo $doctor['doctor_id'] ?>" <?=$selected;?>><?= $doctor['name']; ?></option>
										<?php }	?>
									</select>
									<?php echo form_error('doctor_id','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
	
						<div class="col-md-3">
							<label class="control-label" for="voucher_no">&nbsp;</label>
							<div class="controls">
								<input type="submit" name="submit" class="btn btn-primary" value="<?=$this->lang->line('filter');?>" /> 
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
						<table class="table table-striped table-bordered table-hover" id="bill_table">
							<thead>
								<tr>
									<th><?php echo $this->lang->line("sr_no");?></th>
									<th><?php echo $this->lang->line("time");?></th>
									<th><?php echo $this->lang->line("patient_name");?></th>
									<th><?php echo $this->lang->line("doctor_name");?></th>
									<th><?php echo $this->lang->line("bill_amount");?></th>
									<th><?php echo $this->lang->line("paid_amount");?></th>
									<th><?php echo $this->lang->line("balance");?></th>
									<th><?php echo $this->lang->line("action");?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; 
								$total_amount = 0;
								$paid_amount = 0;
								$due_amount = 0;
								?>
								<?php foreach ($bills as $bill){  ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo date($def_dateformate,strtotime($bill['bill_date'])); ?></td>
									<td><?php echo $bill['first_name'] . ' ' . $bill['middle_name'] . ' ' . $bill['last_name']; ?></td>
									<td><?php echo $bill['doctor_name']; ?></td>
									<td style="text-align:right;"><?php echo currency_format($bill['total_amount']+$bill[$tax_type.'_tax_amount']); ?></td>
									<td style="text-align:right;"><?php echo currency_format($bill['pay_amount']); ?></td>
									<td style="text-align:right;"><?php echo currency_format($bill['due_amount']); ?></td>
									<td><a href="<?= site_url('bill/edit/'.$bill['bill_id']);?>" class="btn btn-sm btn-primary square-btn-adjust"><?php echo $this->lang->line("edit");?></a>
										<a target="_blank" class="btn btn-primary square-btn-adjust" href="<?= site_url('bill/print_receipt') . "/" . $bill['bill_id']; ?>"><?php echo $this->lang->line('print') . ' ' . $this->lang->line('bill');?></a>
										<a 	title="<?php echo $this->lang->line("payment");?>" 
						href="<?php echo base_url()."index.php/payment/insert/".$bill['patient_id']."/payment" ?>" 
						class="btn btn-primary square-btn-adjust"
					>
							<?php echo $this->lang->line("payment");?>
					</a>
									</td>
								</tr>
								<?php $i++; 
								$total_amount = $total_amount + $bill['total_amount']+$bill[$tax_type.'_tax_amount'];
								$paid_amount = $paid_amount + $bill['pay_amount'];
								$due_amount = $due_amount + $bill['due_amount'];
								?>
								<?php } ?>
							</tbody>
							<tfoot>
								<th colspan="4"><?php echo $this->lang->line("total");?></th>
								<td style="text-align:right;"><?=currency_format($total_amount);?></td>
								<td style="text-align:right;"><?=currency_format($paid_amount);?></td>
								<td style="text-align:right;"><?=currency_format($due_amount);?></td>
								<td></td>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<!--End Advanced Tables -->
		</div>
	</div>
</div>

