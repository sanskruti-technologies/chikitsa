<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('tax')." ".$this->lang->line('report');?>
				</div>
				<div class="panel-body">
					<?php echo form_open('bill/tax_report'); ?>
					<div class="col-md-12">
					<div class="col-md-3">
						<?php echo $this->lang->line('from_date');?>
						<input type="text" name="from_date" id="from_date" class="form-control" value="<?php if($from_date){ echo date($def_dateformate,strtotime($from_date));}?>" />
					</div>
					<div class="col-md-3">
						<?php echo $this->lang->line('to_date');?>
						<input type="text" name="to_date" id="to_date" class="form-control" value="<?php if($to_date){ echo date($def_dateformate,strtotime($to_date));}?>" />
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
									<th><?php echo $this->lang->line('patient')." ".$this->lang->line('id');?></th>
									<th><?php echo $this->lang->line('patient')." ".$this->lang->line('name');?></th>
									<th><?php echo $this->lang->line('invoice')." #";?></th>
									<th><?php echo $this->lang->line('invoice')." ".$this->lang->line('date');?></th>
									<th><?php echo $this->lang->line('taxable_revenue');?></th>
									<th><?php echo $this->lang->line('non_taxable_revenue');?></th>
									<th><?php echo $this->lang->line('total');?></th>
									<th><?php echo $this->lang->line('tax_revenue');?></th>
									<th><?php echo $this->lang->line('discount');?></th>
									<th><?php echo $this->lang->line('invoice') ." ".$this->lang->line('total');?></th>
									
								</tr>
							</thead>
							<?php 
							$total_taxable_revenue = 0;
							$total_non_taxable_revenue = 0;
							$grand_total = 0;
							$total_tax_revenue = 0;
							$total_discount = 0;
							?>
							<?php if ($tax_report) {?>
							<tbody>
								<?php $i=1; ?>
								<?php foreach ($tax_report as $row):  ?>
									<tr <?php if ($i%2 == 0) { echo "class='even'"; }else{ echo "class='odd'"; } ?> >
										<td><?php echo $i;?></td>
										<td><?=$row['display_id'];?></td>      
										<td><?=$row['first_name']." ".$row['middle_name']." ".$row['last_name'];?></td>                
										<td><?=$row['bill_id']; ?></td>
										<td><?=date($def_dateformate,strtotime($row['bill_date'])); ?></td>
										<td style="text-align:right;"><?=currency_format($row['taxable_amount']);?></td>
										<td style="text-align:right;"><?=currency_format($row['non_taxable_amount']);?></td>
										<td style="text-align:right;"><?=currency_format($row['taxable_amount'] + $row['non_taxable_amount']);?></td>
										<td style="text-align:right;"><?=currency_format($row[$tax_type.'_tax_amount']);?></td>
										<td style="text-align:right;"><?=currency_format($row['discount']);?></td>
										
										<td style="text-align:right;"><?=currency_format($row['taxable_amount'] + $row['non_taxable_amount'] + $row[$tax_type.'_tax_amount'] - $row['discount']);?></td>
									</tr>
								
								<?php $i++;
								$total_taxable_revenue = $total_taxable_revenue + $row['taxable_amount'];
								$total_non_taxable_revenue = $total_non_taxable_revenue + $row['non_taxable_amount'];
								$grand_total = $grand_total + $row['taxable_amount'] + $row['non_taxable_amount'];
								$total_tax_revenue = $total_tax_revenue + $row[$tax_type.'_tax_amount'];
								$total_discount = $total_discount + $row['discount'];
								?>
								<?php endforeach ?>
							</tbody>
							<?php } ?>
							<tfoot>
								<tr>
									<th colspan="5"><?php echo $this->lang->line("total");?></th>
									<th style="text-align:right;"><?=currency_format($total_taxable_revenue);?></th>
									<th style="text-align:right;"><?=currency_format($total_non_taxable_revenue);?></th>
									<th style="text-align:right;"><?=currency_format($grand_total);?></th>
									<th style="text-align:right;"><?=currency_format($total_tax_revenue);?></th>
									<th style="text-align:right;"><?=currency_format($total_discount);?></th>
									<th style="text-align:right;"><?=currency_format($grand_total + $total_tax_revenue - $total_discount);?></th>
									
								</tr>
							</tfoot>
						<table>
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
 <!-- DATA TABLE SCRIPTS -->
<script src="<?= base_url() ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/js/dataTables/dataTables.bootstrap.js"></script>
<script src="<?= base_url() ?>/assets/js/dataTables/moment.min.js"></script>
<script src="<?= base_url() ?>/assets/js/dataTables/datetime-moment.js"></script>
<!-- TimePicker SCRIPTS-->
<script src="<?= base_url() ?>assets/js/jquery.datetimepicker.js"></script>
<link href="<?= base_url() ?>assets/js/jquery.datetimepicker.css" rel="stylesheet" />
<!-- CUSTOM SCRIPTS -->
<script src="<?= base_url() ?>assets/js/custom.js"></script>
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
		$('#appointment_report').DataTable();
    });
</script>