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
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('payment_methods');?>
				</div>
				<div class="panel-body">
					<a href="<?= site_url("payment/insert_payment_method/");?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("payment_method");?></a>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="payment_methods_table">
							<thead>
								<tr>
									<th><?php echo $this->lang->line("sr_no");?></th>
									<th><?php echo $this->lang->line("payment_method");?></th>
									<th><?php echo $this->lang->line("action");?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach($payment_methods as $payment_method){ ?>
									<tr>
										<td><?=$i;?></td>
										<td><?=$payment_method['payment_method_name'];?></td>
										<td>
											<a class="btn btn-primary square-btn-adjust" href="<?=site_url('payment/edit_payment_method/'.$payment_method['payment_method_id']);?>"><?php echo $this->lang->line('edit');?></a>
											<a class="btn btn-danger square-btn-adjust confirmDelete" href="<?=site_url('payment/delete_payment_method/'.$payment_method['payment_method_id']);?>"><?php echo $this->lang->line('delete');?></a>
										</td>
									</tr>
									<?php $i++; ?>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!--End Advanced Tables -->
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$( window ).load(function() {

	$('.confirmDelete').click(function(){
		return confirm("<?=$this->lang->line('areyousure_delete');?>");
	})

    $("#payment_methods_table").dataTable({
		"pageLength": 50
	});
});
</script>
