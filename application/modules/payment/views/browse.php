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

$(document).ready(function (){

	var table = $("#payment_table").DataTable({

		"pageLength": 50

	});

	 

	$('.confirmDelete').click(function(){

		return confirm('<?=$this->lang->line('areyousure_delete');?>');

	});

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


		table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
		// Handle click on "Expand All" button
		$('#btn-show-all-children').on('click', function(){
			// Expand row details
			table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
		});

		// Handle click on "Collapse All" button
		$('#btn-hide-all-children').on('click', function(){
			// Collapse row details
			table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
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
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line("payment");?></h5>
		</div>
	<div class="card-body">
		<div class="form-group">
			<a 	title="<?php echo $this->lang->line("add")." ".$this->lang->line("payment");?>" href="<?php echo base_url()."index.php/payment/insert/0/payment" ?>" class="btn btn-primary square-btn-adjust btn-sm right"><i class="fa fa-plus"></i>
					<?php echo $this->lang->line("add")." ".$this->lang->line("payment");?>
			</a>
		</div><div class="block"></br></div>
			<?php echo form_open('payment/index') ?>
				<div class="row">
					<div class="col-md-3">
							<label class="control-label" for="from_date"><?=$this->lang->line('from_date');?></label>
							<div class="controls">
								<input type="text" name="from_date" id="from_date" value="<?= date($def_dateformate,strtotime($from_date));?>" class="form-control"/>
								<?php echo form_error('from_date','<div class="alert alert-danger">','</div>'); ?>
							</div>
					</div>
					<div class="col-md-3">
								<label class="control-label" for="to_date"><?=$this->lang->line('to_date');?></label>
								<div class="controls">
									<input type="text" name="to_date" id="to_date" value="<?= date($def_dateformate,strtotime($to_date));?>" class="form-control"/>
									<?php echo form_error('to_date','<div class="alert alert-danger">','</div>'); ?>
								</div>
					</div>
					<div class="col-md-6">
							<label class="control-label" for="voucher_no">&nbsp;</label>
							<div class="controls dropdown-item">
								<!--input type="submit" name="submit" class="btn btn-primary" value="<?=$this->lang->line('filter');?>" /-->
								<button name="submit" class="btn square-btn-adjust btn-primary" value=""><i class='fa fa-filter'></i> <?=$this->lang->line('filter');?></button>
							</div>
					</div>
				</div><br/>
			<?php echo form_close(); ?>
					
			<div class="text-align">
			<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
			<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
			</div>&nbsp;
		<div class="table-responsive-25">
			<div class="table-responsive ">
					<table class="table table-striped table-bordered table-hover display responsive nowrap" id="payment_table" >
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
								<td style='text-align:right;'><?php echo currency_format($payment['pay_amount']); ?></td>
								<td><?php echo ucfirst($payment['pay_mode']); ?><?php if($payment['pay_mode'] == "cheque") {echo "  ( ".$payment['cheque_no']." )";} ?></td>
								<?php if (in_array("snaap", $active_modules)) {	?>
								<td><?php echo get_cases($payment_cases,$payment['payment_id']); ?></td>
								<?php } ?>
								<td><?php echo ucfirst($payment['payment_status']); ?></td>
								<td>
								<a class="btn btn-primary btn-sm square-btn-adjust editbt" title="Edit" href="<?= site_url('payment/edit/'.$payment['payment_id'].'/payment');?>"><i class="fa fa-edit"></i><?=$this->lang->line('edit');?></a>
								<a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" title="delete" href="<?= site_url('payment/delete/'.$payment['payment_id'].'/payment');?>"><i class="fa fa-trash" aria-hidden="true"></i><?=$this->lang->line('delete');?></a>
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
</div>