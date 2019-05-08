<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line("refund");?>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<a href="<?=site_url('payment/add_issue_refund');?>" class="btn square-btn-adjust btn-primary"><?php echo $this->lang->line('add_refund');?></a>
		
					<table class="table table-striped table-bordered table-hover" id="patient_table">
						<thead>
							<tr>
								<th><?php echo $this->lang->line("sr_no");?></th>
								<th><?php echo $this->lang->line("date");?></th>
								<th><?php echo $this->lang->line("patient");?></th>
								<th><?php echo $this->lang->line("amount");?></th>
								<th><?php echo $this->lang->line("action");?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							<?php foreach ($refunds as $refund):  ?>
								<tr <?php if ($i%2 == 0) { echo "class='even'"; } else { echo "class='odd'"; }?> >
									<td><?php echo $i; ?></td>
									<td><?php echo date($def_dateformate,strtotime($refund['refund_date'])); ?></td>
									<td><?php echo $patient_name[$refund['patient_id']]; ?></td>
									<td><?php echo currency_format($refund['refund_amount']); ?></td>
									<td><a href="<?= site_url('payment/edit_refund/'.$refund['refund_id']);?>" class="btn btn-sm btn-primary square-btn-adjust"><?php echo $this->lang->line("edit");?></a>
										<a href="<?= site_url('payment/delete_refund/'.$refund['refund_id']);?>" class="btn btn-sm btn-danger square-btn-adjust confirmDelete"><?php echo $this->lang->line("delete");?></a>
									</td>
								</tr>
							<?php $i++; ?>
							<?php endforeach ?>
						</tbody>
					
				</div>				
			</div>
		</div>	
	</div>
</div>
</div>
	
