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
$( window ).load(function() {
	$("#issue_refund_table").dataTable({
		"pageLength": 50
	});
	$('.confirmDelete').click(function(){
		return confirm('<?=$this->lang->line('areyousure_delete');?>');
	});
});
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
			<div class="row">
                        <div class="col-md-4 text-left nopadding"> <h2 class="titletable"><?php echo $this->lang->line("refund");?></h2></div>
					</div>
			</div>
			<div class="panel-body table-responsive-25">
                        	<div class="form-group">
								<a href="<?=site_url('payment/add_issue_refund');?>" class="btn square-btn-adjust btn-primary"><?php echo $this->lang->line('add_refund');?></a>
							</div>

				<div class="table-responsive ">
					<table class="table table-striped table-hover display responsive nowrap" id="issue_refund_table">
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
									<td>
									<!--a href="<?= site_url('payment/edit_refund/'.$refund['refund_id']);?>" class="btn btn-sm btn-primary square-btn-adjust"><?php echo $this->lang->line("edit");?></a-->
									<a class="btn btn-primary btn-sm square-btn-adjust editbt" title="Edit" "<?= site_url('payment/edit_refund/'.$refund['refund_id']);?>"><i class="fa fa-pencil"></i></a>
									
									
									<!--a href="<?= site_url('payment/delete_refund/'.$refund['refund_id']);?>" class="btn btn-sm btn-danger square-btn-adjust confirmDelete"><?php echo $this->lang->line("delete");?></a-->
									<a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" title="delete" href="<?= site_url('payment/delete_refund/'.$refund['refund_id']);?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
									
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
