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
									<th><?php echo $this->lang->line('total');?></th>
									<th colspan="2"><?php echo $this->lang->line('tax');?></th>
									<th><?php echo $this->lang->line('invoice')." ".$this->lang->line('total');?></th>
								</tr>
								<?php foreach($bill_details as $bill_detail){
											if(($bill_detail['type'] == "tax")!=NULL) {?>
								<tr>
									<th colspan="6"></th>
									<th><?php echo $this->lang->line('name');?></th>
									<th><?php echo $this->lang->line('amount');?></th>
									<th></th>
								</tr>
								<?php 
								break;} } ?>
							</thead>
							<?php if ($tax_report) {?>
							<tbody>
								<?php $i=1;
								$grand_total = 0;								
								$tax_total = 0;			
								?>
								<?php foreach ($tax_report as $row):  ?>
									<?php 
										$tax_count = 0;
										$tax_rows = "";
										$tax_first_row = "";
										
										foreach($bill_details as $bill_detail){
											if($bill_detail['bill_id'] == $row['bill_id'] && $bill_detail['type'] == "tax") {
												if($tax_first_row == ""){
													$tax_first_row .= "<td>".$bill_detail['particular']."</td>";
													$tax_first_row .= "<td style='text-align: right;'>".currency_format($bill_detail['amount'])."</td>";
												
												}else{
													$tax_rows .= "<tr>";
													$tax_rows .= "<td>".$bill_detail['particular']."</td>";
													$tax_rows .= "<td style='text-align: right;'>".currency_format($bill_detail['amount'])."</td>";
													$tax_rows .= "</tr>";
												}
												$tax_count ++;
											}
										}
										$tax_rows .= "";
										
										if($tax_first_row == ""){
											$tax_first_row .= "<td>&nbsp;</td>";
											$tax_first_row .= "<td>&nbsp;</td>";
											$tax_count = 1;
										}
									?>
									<tr <?php if ($i%2 == 0) { echo "class='even'"; }else{ echo "class='odd'"; } ?> >
										<td rowspan="<?=$tax_count;?>"><?php echo $i;?></td>
										<td rowspan="<?=$tax_count;?>"><?=$row['display_id'];?></td>      
										<td rowspan="<?=$tax_count;?>"><?=$row['first_name']." ".$row['middle_name']." ".$row['last_name'];?></td>                
										<td rowspan="<?=$tax_count;?>"><?=$row['bill_id']; ?></td>
										<td rowspan="<?=$tax_count;?>"><?=date($def_dateformate,strtotime($row['bill_date'])); ?></td>
										<td rowspan="<?=$tax_count;?>" style="text-align:right;"><?=currency_format($row['total_amount']);?></td>
										
										<?php echo $tax_first_row; ?>
										<td rowspan="<?=$tax_count;?>" style="text-align:right;"><?=currency_format($row['tax_amount'] + $row['total_amount']); ?></td>
									</tr>
									<?php echo $tax_rows; ?>
										
								<?php $i++; ?>
								<?php $grand_total = $grand_total + $row['total_amount']; ?>
								<?php $tax_total = $tax_total + $row['tax_amount']; ?>
								<?php endforeach ?>
							<tfoot>
								<tr>
									<th colspan="5"><?php echo $this->lang->line('total');?></th>
									<th style="text-align:right;"><?=currency_format($grand_total);?></th>
									<th></th>
									<th style="text-align:right;"><?=currency_format($tax_total);?></th>
									<th style="text-align:right;"><?=currency_format($grand_total + $tax_total);?></th>
								</tr>
							</tfoot>
							</tbody>
							<?php } ?>
						
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
    });
</script>