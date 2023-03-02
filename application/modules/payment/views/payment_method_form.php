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

	$has_additional_details = "";

	$needs_cash_calc = "";

	$payment_pending = "";

	if(isset($payment_method)){

		$edit = TRUE;

		$payment_method_id = $payment_method['payment_method_id'];

		$payment_method_name = set_value('payment_method_name',$payment_method['payment_method_name']);

		$additional_detail_label = set_value('additional_detail_label',$payment_method['additional_detail_label']);

		if($payment_method['has_additional_details'] == 1){

			$has_additional_details = "checked";

		}

		if($payment_method['needs_cash_calc'] == 1){

			$needs_cash_calc = "checked";

		}

		if($payment_method['payment_pending'] == 1){

			$payment_pending = "checked";

		}

	}else{

		$edit = FALSE;

		$payment_method_name = set_value('payment_method_name','');

		$payment_method = set_value('payment_method','');

		$additional_detail_label = set_value('additional_detail_label','');

		$has_additional_details=set_value('has_additional_details','');
		if($has_additional_details == 1){

			$has_additional_details = "checked";

		}
		$needs_cash_calc=set_value('needs_cash_calc','');
		if($needs_cash_calc == 1){

			$needs_cash_calc = "checked";

		}
		$payment_pending=set_value('payment_pending','');
		if($payment_pending == 1){

			$payment_pending = "checked";

		}
	}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('payment_method');?></h5>
		</div>
		<div class="card-body">
				<?php if($edit){ ?>
			<?php echo form_open('payment/edit_payment_method/'.$payment_method_id) ?>
			<?php }else{ ?>
			<?php echo form_open('payment/insert_payment_method') ?>
			<?php } ?>
			<div class="form-group">
				<label for="payment_method_name"><?php echo $this->lang->line('payment_method')." ".$this->lang->line('name');?></label>
				<input type="text" name="payment_method_name" id="payment_method_name" value="<?=$payment_method_name;?>" class="form-control"/>
				<?php echo form_error('payment_method_name','<div class="alert alert-danger">','</div>'); ?>
			</div>
			<div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="has_additional_details" id="has_additional_details" value="1" <?=$has_additional_details;?>><?=$this->lang->line('has_additional_details');?>
					</label>
				</div>
			</div><div class="block"></br></div>
			<div class="form-group">
				<label for="additional_detail_label"><?php echo $this->lang->line('additional_detail_label');?></label>
				<input type="text" name="additional_detail_label" id="additional_detail_label" value="<?=$additional_detail_label;?>" class="form-control"/>
				<?php echo form_error('additional_detail_label','<div class="alert alert-danger">','</div>'); ?>
			</div><div class="block"></br></div>
			<div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="needs_cash_calc" id="needs_cash_calc" value="1" <?=$needs_cash_calc;?>><?=$this->lang->line('needs_cash_calc');?>
					</label>
				</div>
			</div><div class="block"></br></div>
			<div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="payment_pending" id="payment_pending" value="1" <?=$payment_pending;?>><?=$this->lang->line('payment_pending');?>
					</label>
				</div>
			</div><div class="block"></br></div>
			<div class="right">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary square-btn-adjust btn-sm" /><?php echo $this->lang->line('save');?></button>
					<a class="btn btn-info square-btn-adjust btn-sm" href="<?=site_url('payment/payment_methods'); ?>"><?php echo $this->lang->line('back');?></a>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>


<script type="text/javascript" charset="utf-8">

$( window ).load(function() {



	$('.confirmDelete').click(function(){

		return confirm("<?=$this->lang->line('areyousure_delete');?>");

	});



    $("#tax_rate_table").dataTable({

		"pageLength": 50

	});

	$("#additional_detail_label").parent().hide();

	<?php

	if(isset($payment_method) && is_array($payment_method)){

			if($payment_method['has_additional_details'] == 1){ ?>

		$("#additional_detail_label").parent().show();

	<?php }else{ ?>

		$("#additional_detail_label").parent().hide();

	<?php } }?>

	$('#has_additional_details').click(function(){

		if($('#has_additional_details').is(":checked"))

			$("#additional_detail_label").parent().show();

		else

			$("#additional_detail_label").parent().hide();

	});
		if($('#has_additional_details').is(":checked"))

			$("#additional_detail_label").parent().show();

		else

			$("#additional_detail_label").parent().hide();


});

</script>