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
<script>
	function number_format (number, decimals, dec_point, thousands_sep) {
		// Strip all characters but numerical ones.
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function (n, prec) {
				var k = Math.pow(10, prec);
				return '' + Math.round(n * k) / k;
			};
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	}
	function currency_format(number){
		var currencySymbol = '<?=$currency_symbol;?>';
		var currencyPostfix = '<?=$currency_postfix;?>';
		return currencySymbol + number_format(number, 2, '.', ',') + currencyPostfix;
	}
	$(window).load(function(){
		<?php
			if(isset($patient)){
				?>$("#adjust_from_account_amount").html('<?=$patient['in_account_amount'];?>');
				$("#adjust_from_account_display").html(currency_format(<?=$patient['in_account_amount'];?>));
				<?php
			}else{
		?>
		var searcharrpatient=[<?php $i = 0;
		foreach ($patients as $p) {
			if ($i > 0) { echo ",";}
			echo '{value:"' . $p['first_name'] . " " . $p['middle_name'] . " " . $p['last_name'] . '",id:"' . $p['patient_id'] . '",in_account_amount:"'. $p['in_account_amount'] .'",display:"' . $p['display_id'] . '",num:"' . $p['phone_number'] . '"}';
			$i++;
		}?>];

		$("#patient_name").autocomplete({
			autoFocus: true,
			source: searcharrpatient,
			minLength: 1,//search after one characters
			select: function(event,ui){
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#adjust_from_account_amount").html(ui.item ? ui.item.in_account_amount : '');
				$("#adjust_from_account_display").html(ui.item ? currency_format(ui.item.in_account_amount) : '');

			}
		});
		<?php } ?>
		$('#refund_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate;?>',
			scrollInput:false,
			scrollMonth:false,
			scrollTime:false,
		});
	});
</script>
<?php
	if(isset($refund)){
		$refund_amount = $refund['refund_amount'];
		$refund_note = $refund['refund_note'];
		$refund_date = date($def_dateformate,strtotime($refund['refund_date']));
	}else{
		$refund_amount = "";
		$refund_date = "";
		$refund_note = "";
	}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<h2><?php echo $this->lang->line("issue_refund");?></h2>
				</div>
			</div>
			<div class="panel-body table-responsive-25">
			<?php if(isset($refund)){ ?>
			<?php echo form_open('payment/edit_refund/'.$refund_id) ?>
			<?php }else{ ?>
			<?php echo form_open('payment/add_issue_refund/') ?>
			<?php } ?>
			<div class="col-md-12">
				<label for="patient_name"><?php echo $this->lang->line('patient') . ' ' . $this->lang->line('name');?></label>
				<?php if(isset($refund)){ //Edit Mode ?>
					<input type="hidden" name="patient_id" id="patient_id" value="<?= $refund['patient_id']; ?>" />
					<input name="patient_name" id="patient_name" type="text" disabled="disabled" class="form-control" value="<?= $patient_name;?>"/><br />
					<?php echo form_error('patient_id','<	div class="alert alert-danger">','</div>'); ?>
				<?php }else{ //Insert Mode  ?>
					<input name="patient_name" id="patient_name" type="text" class="form-control" value=""/><br />

					<input type="hidden" name="patient_id" id="patient_id" value="" />
					<?php echo form_error('patient_id','<div class="alert alert-danger">','</div>'); ?>
				<?php } ?>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="title"><?=$this->lang->line('amount_in_account');?></label>
					<br/>
					<span id="adjust_from_account_display"></span>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="title"><?php echo $this->lang->line('refund_amount');?></label>
					<input type="text" name="refund_amount" id="refund_amount" class="form-control" value="<?=$refund_amount;?>" />
					<?php echo form_error('refund_amount','<div class="alert alert-danger">','</div>'); ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="title"><?php echo $this->lang->line('refund_date');?></label>
					<input type="text" name="refund_date" id="refund_date" class="form-control" value="<?=$refund_date;?>" />
					<?php echo form_error('refund_date','<div class="alert alert-danger">','</div>'); ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="refund_note"><?php echo $this->lang->line('refund_note');?></label>
					<textarea name="refund_note" id="refund_note" class="form-control" ><?=$refund_note;?></textarea>
					<?php echo form_error('refund_note','<div class="alert alert-danger">','</div>'); ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<input class="btn btn-primary btn-sm square-btn-adjust" type="submit" id="save_issue_refund" value="<?php echo $this->lang->line('save');?>" name="submit" />
					<a href="<?=site_url('payment/issue_refund');?>" class="btn btn-primary btn-sm square-btn-adjust"><?php echo $this->lang->line('back');?></a>
				</div>
			</div>

			<?php echo form_close(); ?>
			</div>
			</div>
		</div>
	</div>
</div>
