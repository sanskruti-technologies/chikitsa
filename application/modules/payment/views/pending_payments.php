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

$(document).ready(function () {

	var table=$("#patient_table").DataTable({

		"pageLength": 50

	});

	$('.confirmApprove').click(function(){

		return confirm('<?=$this->lang->line('areyousure_approve');?>');

	});

	$('.confirmReject').click(function(){

		return confirm('<?=$this->lang->line('areyousure_reject');?>');

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

<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line("pending_payment");?></h5>
		</div>
		<div class="card-body">
			<div class="text-align">
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
			</div>&nbsp;
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover display responsive nowrap" id="patient_table">
					<thead>
						<tr>
							<th><?php echo $this->lang->line("sr_no");?></th>
							<th><?php echo $this->lang->line("date");?></th>
							<th><?php echo $this->lang->line("patient");?></th>
							<th><?php echo $this->lang->line("amount");?></th>
							<th><?php echo $this->lang->line("payment_mode");?></th>
							<th><?php echo $this->lang->line("additional_detail");?></th>
							<?php if (in_array("snaap", $active_modules)) {	?>
							<th><?php echo $this->lang->line("cases");?></th>
							<?php } ?>
							<th><?php echo $this->lang->line("action");?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						<?php foreach ($pending_payments as $payment):  ?>
						<?php if(isset($payment['pay_date']) && $payment['pay_date'] != '0000-00-00'){?>
						<?php $payment_date = $payment['pay_date']; ?>
						<?php $payment_date = date($def_dateformate,strtotime($payment['pay_date'])); ?>
						<?php }else{ ?>
						<?php $payment_date = "--"; ?>
						<?php } ?>
						<tr <?php if ($i%2 == 0) { echo "class='even'"; } else { echo "class='odd'"; }?> >
							<td><?php echo $i; ?></td>
							<td><?php echo $payment_date; ?></td>
							<td><?php echo $payment['first_name'] . ' ' . $payment['middle_name'] . ' ' . $payment['last_name']; ?></td>
							<td><?php echo currency_format($payment['pay_amount']); ?><?php if($currency_postfix) echo $currency_postfix; ?></td>
							<td><?php echo ucfirst($payment['pay_mode']); ?><?php if($payment['pay_mode'] == "cheque") {echo "  ( ".$payment['cheque_no']." )";} ?></td>
							<td><?=$payment['additional_detail'];?></td>
							<?php if (in_array("snaap", $active_modules)) {	?>
							<td><?php echo get_cases($payment_cases,$payment['payment_id']); ?></td>
							<?php } ?>
							<td>
								<a href="<?= site_url('payment/approve/'.$payment['payment_id']);?>" class="btn btn-sm btn-success square-btn-adjust confirmApprove"><?php echo $this->lang->line("approve");?></a>
								<a href="<?= site_url('payment/reject/'.$payment['payment_id']);?>" class="btn btn-sm btn-danger square-btn-adjust confirmReject"><?php echo $this->lang->line("reject");?></a>
								<a href="<?= site_url('payment/edit/'.$payment['payment_id']);?>" class="btn btn-sm btn-primary square-btn-adjust"><i class="fa fa-edit"> </i> <?php echo $this->lang->line("edit");?></a>
							</td>
						</tr>
						<?php $i++; ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>