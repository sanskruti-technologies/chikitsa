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
	$("#payment_table").dataTable({
		"pageLength": 50
	});
	$('.confirmDelete').click(function(){
		return confirm('<?=$this->lang->line('areyousure_delete');?>');
	});
});
</script>
<?php
function get_cases($payment_cases,$payment_id){
	$cases = "";
	foreach($payment_cases as $payment_case){
		if($payment_case['payment_id'] == $payment_id){
			$cases .= $payment_case['case_number'].",";
		}
	}
	return $cases;
}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-primary">
                <div class="panel-heading clearfix">
					<div class="row">
                        <div class="col-md-4 text-left nopadding"> <h2 class="titletable"><?php echo $this->lang->line("payment");?></h2></div>
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group"><a 	title="<?php echo $this->lang->line("add")." ".$this->lang->line("payment");?>"                        href="<?php echo base_url()."index.php/payment/insert/0/payment" ?>"
                                                class="btn btn-primary square-btn-adjust"><i class="fa fa-plus"></i>
                                <?php echo $this->lang->line("add")." ".$this->lang->line("payment");?>
                            </a>	
						</div>
				</div>
				<div class="panel-body table-responsive-25">
					<div class="table-responsive ">
						<table class="table table-striped table-bordered table-hover" 	 id="payment_table" >
							<thead>
								<tr>
									<th><?php echo $this->lang->line("sr_no");?></th>
									<th><?php echo $this->lang->line("date");?></th>
									<th><?php echo $this->lang->line("patient");?></th>
									<th><?php echo $this->lang->line("amount");?></th>
									<th><?php echo $this->lang->line("payment_mode");?></th>
									<?php if (in_array("snaap", $active_modules)) {	?>
									<th><?php echo $this->lang->line("cases");?></th>
									<?php } ?>
									<th><?php echo $this->lang->line("status");?></th>
									<th><?php echo $this->lang->line("action");?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; ?>
								<?php foreach ($payments as $payment):  ?>
								<?php if(isset($payment['pay_date']) && $payment['pay_date'] != '0000-00-00'){?>
								<?php $payment_date = $payment['pay_date']; ?>
								<?php $payment_date = date($def_dateformate,strtotime($payment['pay_date'])); ?>
								<?php }else{ ?>
								<?php $payment_date = "--"; ?>
								<?php } ?>
								<tr <?php if($payment['payment_status'] == 'rejected'){ echo "class='danger'";} elseif ($i%2 == 0) { echo "class='even'"; } else { echo "class='odd'"; } ?> >
									<td><?php echo $i; ?></td>
									<td><?php echo $payment_date; ?></td>
									<td><?php echo $payment['first_name'] . ' ' . $payment['middle_name'] . ' ' . $payment['last_name']; ?></td>
									<td style='text-align:right;'><?php echo currency_format($payment['pay_amount']); ?><?php if($currency_postfix) echo $currency_postfix; ?></td>
									<td><?php echo ucfirst($payment['pay_mode']); ?><?php if($payment['pay_mode'] == "cheque") {echo "  ( ".$payment['cheque_no']." )";} ?></td>
									<?php if (in_array("snaap", $active_modules)) {	?>
									<td><?php echo get_cases($payment_cases,$payment['payment_id']); ?></td>
									<?php } ?>
									<td><?php echo ucfirst($payment['payment_status']); ?></td>
								    <td>
									<a class="btn btn-primary btn-sm square-btn-adjust editbt" title="Edit" href="<?= site_url('payment/edit/'.$payment['payment_id'].'/payment');?>"><i class="fa fa-pencil"></i></a>
									<a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" title="delete" href="<?= site_url('payment/delete/'.$payment['payment_id'].'/payment');?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
									</td>
								</tr>
								<?php $i++; ?>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!--End Advanced Tables -->
		</div>
	</div>
</div>
