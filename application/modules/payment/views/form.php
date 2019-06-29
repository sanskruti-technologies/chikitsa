<?php  
	if(isset($payment)){
		$payment_additional_detail = $payment['additional_detail'];
		$payment_pay_amount = $payment['pay_amount'];
		$payment_pay_mode = $payment['pay_mode'];
		$payment_status = $payment['payment_status'];
		//echo $payment_status;
	} else {
		$payment_additional_detail = "";
		$payment_pay_amount = 0;
		$payment_pay_mode = "";
		$payment_status = "";
	}
	if(isset($patient)){
		$patient_first_name = $patient['first_name'];
		$patient_middle_name = $patient['middle_name'];
		$patient_last_name = $patient['last_name'];
		$patient_name = $patient_first_name . " " . $patient_middle_name . " " . $patient_last_name;
	}else{
		$patient_name = " " ;	
	}
	$ttl_due_amount = 0;
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

		var in_account_amount = <?=($patient['in_account_amount']!=NULL)?$patient['in_account_amount']:0;?>;
		$("#adjust_from_account_amount").html(in_account_amount);
		$("#adjust_from_account_display").html(currency_format(in_account_amount));
		
		<?php if(isset($patient_id) && $patient_id !=0 && !isset($payment)){ ?>
				
				var this_patient_id = <?=$patient_id;?>;
				var billArray = [
				<?php 
				$total_due_amount = 0;
				foreach($bills as $bill){
					$total_due_amount = $total_due_amount + $bill['due_amount'];	
					$bill_due_amount = currency_format($bill['due_amount']);
					if($currency_postfix) $bill_due_amount = $bill_due_amount . $currency_postfix;	
					echo '["'.$bill['bill_id'].'", "'.$bill['patient_id'].'","'. $bill_due_amount.'","'. $bill['due_amount'].'"],';
				}
				$total_due_amount = currency_format($total_due_amount );
				if($currency_postfix) $total_due_amount = $total_due_amount . $currency_postfix;	
				?>
				];
				var total_due_amount = 0;
				$("#bill_detail").empty();
				$("#bill_detail_footer").empty();
				$.each(billArray, function(i,val) {
					$.each(val, function(index,value) {
						if(index == 0){	//bill id
							bill_id = value;
						}
						if(index == 1){	//patient id
							patient_id = value;
						}
						if(index == 2){	//due amount string
							due_amount = value;
						}
						if(index == 3){	//due amount w/o string
							due_amount_val = value;
						}
						
					});
					if(this_patient_id == patient_id){
						$("#bill_detail").append("<tr><td><a href='<?=site_url('bill/edit/');?>/"+bill_id+"' class='btn btn-primary btn-sm square-btn-adjust'>"+bill_id+"</a><input type='hidden' name='bill_id[]' value='"+bill_id+"'/></td><td style='text-align:right;'>"+due_amount+"</td><td class='adjust_amount' style='text-align:right;' amount='"+due_amount_val+"'></td></tr>");
						total_due_amount = total_due_amount + parseFloat(due_amount_val);
					}
				});
				$("#bill_detail").append("<tr><td>Patient Account</td><td style='text-align:right;'></td><td style='text-align:right;' id='in_account'></td><input type='hidden' id='in_account_amount' name='in_account_amount' value=''/></tr>");
				$("#bill_detail_footer").append("<tr><th>Total</th><th style='text-align:right;'>"+currency_format(total_due_amount)+"<input type='hidden' id='total_due_amount' name='total_due_amount' value='"+total_due_amount+"'/></th><th style='text-align:right;' id='total_payment_amount'></th></tr>");
		<?php }else{ ?>
		var searcharrpatient=[<?php $i = 0;
		foreach ($patients as $p) {
			if ($i > 0) { echo ",";}
			echo '{value:"' . $p['first_name'] . " " . $p['middle_name'] . " " . $p['last_name'] . '",id:"' . $p['patient_id'] . '",in_account_amount:"'. $p['in_account_amount'] .'",display_id:"' . $p['display_id'] . '",num:"' . $p['phone_number'] . '"}';
			$i++;
		}?>];
		$("#patient_name").autocomplete({
			autoFocus: true,
			source: searcharrpatient,
			minLength: 1,//search after one characters
			
			select: function(event,ui){
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#display_id").val(ui.item ? ui.item.display_id : '');
				$("#adjust_from_account_amount").html(ui.item ? ui.item.in_account_amount : '');
				$("#adjust_from_account_display").html(ui.item ? currency_format(ui.item.in_account_amount) : '');
				load_bill_table(ui.item.id);
			},
			
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#patient_id").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#patient_name").val('');
					$("#display_id").val('');
				}
			}
		});
		var search_display_id=[<?php $i = 0;
		foreach ($patients as $p) {
			if ($i > 0) {
				echo ",";
			}
				echo '{value:"' . $p['display_id'] . '",id:"' . $p['patient_id'] . '",num:"' . $p['phone_number'] . '",in_account_amount:"'. $p['in_account_amount'] .'",patient:"' . $p['first_name'] . " " . $p['middle_name'] . " " . $p['last_name'] . '",ssn_id:"' . $p['ssn_id'] . '"}';
			$i++;
		}?>];
		$("#display_id").autocomplete({
			autoFocus: true,
			source: search_display_id,
			minLength: 1,//search after one characters
			select: function(event,ui)
			{
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#patient_name").val(ui.item ? ui.item.patient : '');
				$("#phone_number").val(ui.item ? ui.item.num : '');
			   	$("#ssn_id").val(ui.item ? ui.item.ssn_id : '');
				$("#adjust_from_account_amount").html(ui.item ? ui.item.in_account_amount : '');
				$("#adjust_from_account_display").html(ui.item ? currency_format(ui.item.in_account_amount) : '');
				load_bill_table(ui.item.id);
			},
			change: function(event, ui) 
			{
				if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#ssn_id").val('');
				}
			},
			response: function(event, ui) 
			{
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#ssn_id").val('');
				}
			}
		});   
		var searcharrmob=[<?php $i = 0;
		foreach ($patients as $p) {
			if ($i > 0) {
				echo ",";
			}
				echo '{value:"' . $p['phone_number'] . '",ssn_id:"' . $p['ssn_id'] . '",id:"' . $p['patient_id'] . '",in_account_amount:"'. $p['in_account_amount'] .'",display:"' . $p['display_id'] . '",patient:"' . $p['first_name'] . " " . $p['middle_name'] . " " . $p['last_name'] . '"}';
			$i++;
		}?>];
		$("#phone_number").autocomplete({
			autoFocus: true,
			source: searcharrmob,
			minLength: 1,//search after one characters
			select: function(event,ui){
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#patient_name").val(ui.item ? ui.item.patient : '');
				$("#display_id").val(ui.item ? ui.item.display : '');
				$("#ssn_id").val(ui.item ? ui.item.ssn_id : '');
				$("#adjust_from_account_amount").html(ui.item ? ui.item.in_account_amount : '');
				$("#adjust_from_account_display").html(ui.item ? currency_format(ui.item.in_account_amount) : '');
				load_bill_table(ui.item.id);
			},
			change: function(event, ui) {
				if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#ssn_id").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#ssn_id").val('');
				}
			}
		});  
		var search_ssn_id=[<?php $i = 0;
		foreach ($patients as $p) {
			if ($i > 0) {
				echo ",";
			}
				echo '{value:"' . $p['ssn_id'] . '",id:"' . $p['patient_id'] . '",num:"' . $p['phone_number'] . '",display:"' . $p['display_id'] . '",patient:"' . $p['first_name'] . " " . $p['middle_name'] . " " . $p['last_name'] . '",in_account_amount:"'. $p['in_account_amount'] .'"}';
			$i++;
		}?>];
		$("#ssn_id").autocomplete({
			autoFocus: true,
			source: search_ssn_id,
			minLength: 1,//search after one characters
			select: function(event,ui){
				//do something
				$("#patient_id").val(ui.item ? ui.item.id : '');
				$("#phone_number").val(ui.item ? ui.item.num : '');
				$("#patient_name").val(ui.item ? ui.item.patient : '');
				$("#display_id").val(ui.item ? ui.item.display : '');
				$("#adjust_from_account_amount").html(ui.item ? ui.item.in_account_amount : '');
				$("#adjust_from_account_display").html(ui.item ? currency_format(ui.item.in_account_amount) : '');
				load_bill_table(ui.item.id);
			},
			change: function(event, ui) {
				if (ui.item == null) {
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#ssn_id").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#patient_id").val('');
					$("#phone_number").val('');
					$("#display_id").val('');
					$("#patient_name").val('');
					$("#ssn_id").val('');
				}
			}
		});  
		function load_bill_table(this_patient_id){
			var billArray = [
				<?php 
				$total_due_amount = 0;
				foreach($bills as $bill){
					
					$total_due_amount = $total_due_amount + $bill['due_amount'];	
					$bill_due_amount = currency_format($bill['due_amount']);
					if($currency_postfix) $bill_due_amount = $bill_due_amount . $currency_postfix;	
					echo '["'.$bill['bill_id'].'", "'.$bill['patient_id'].'","'. $bill_due_amount.'","'. $bill['due_amount'].'"],';
				}
				?>
				];
			var bill_id;
			var patient_id;
			var due_amount;
			var total_due_amount = 0;
			var total_due_after_payment = 0;
			$("#bill_detail").empty();
			$("#bill_detail_footer").empty();
			$.each(billArray, function(i,val) {
				$.each(val, function(index,value) {
					if(index == 0){	//bill id
						bill_id = value;
					}
					if(index == 1){	//patient id
						patient_id = value;
					}
					if(index == 2){	//due amount string
						due_amount = value;
					}
					if(index == 3){	//due amount string
						due_amount_val = value;
					}
					
				});
				if(this_patient_id == patient_id){
					$("#bill_detail").append("<tr><td><a href='<?=site_url('bill/edit/');?>/"+bill_id+"' class='btn btn-primary btn-sm square-btn-adjust'>"+bill_id+"</a><input type='hidden' name='bill_id[]' value='"+bill_id+"'/></td><td style='text-align:right;'>"+due_amount+"</td><td style='text-align:right;' class='adjust_amount' amount='"+due_amount_val+"'></td></tr>");
					total_due_amount = parseInt(total_due_amount) + parseInt(due_amount_val);
				}
				
			});
			$("#bill_detail").append("<tr><td>Patient Account</td><td style='text-align:right;'></td><td style='text-align:right;' id='in_account'></td><input type='hidden' id='in_account_amount' name='in_account_amount' value=''/></tr>");
				
			$("#bill_detail_footer").append("<tr><th>Total</th><th style='text-align:right;'>"+currency_format(total_due_amount)+"<input type='hidden' id='total_due_amount' name='total_due_amount' value='"+total_due_amount+"'/></th><th style='text-align:right;' id='total_payment_amount'></th></tr>");
			$("#bill_detail_footer").append("<tr><th colspan='2'>Total Due After Payment</th><th style='text-align:right;' id='total_due_after_payment'>"+total_due_after_payment+"</th></tr>");
			
		}
		<?php } ?>
		$("#adjust_from_account").click(function () {
			if ($(this).is(":checked")) {
				$("#payment_amount").parent().hide();
				$("#payment_date").parent().hide();
				$("#paid_cash").parent().hide();
				$("#return_change").parent().hide();
				$("#pay_mode").parent().hide();
				$("#save_payment").val('Adjust Payment');
				
				var due_amount;
				var payment_amount;
				var adjust_amount;
				var total_due_after_payment = 0;
				
				payment_amount = parseFloat($("#adjust_from_account_amount").html());
				$('#total_payment_amount').html(currency_format(payment_amount));
				total_due_amount = parseFloat($("#total_due_amount").val());
				
				if(payment_amount > total_due_amount){
					in_account = payment_amount - total_due_amount;
					$('#in_account').html(currency_format(in_account));
					$('#in_account_amount').val(in_account);
				}else{
					in_account = 0;
					$('#in_account').html("");
					$('#in_account_amount').val(in_account);
				}
				$('.adjust_amount').each(function(){
					adjust_amount = 0;
					due_amount = parseFloat($(this).attr('amount'));
					if(due_amount <= payment_amount && payment_amount > 0){
						adjust_amount = due_amount;
						payment_amount = payment_amount - due_amount;
					}else{
						if(due_amount > payment_amount && payment_amount > 0){
							adjust_amount = payment_amount;
							payment_amount = 0;
						}	
					}
					total_due_after_payment =  total_due_after_payment + due_amount - adjust_amount;
					$(this).html(currency_format(adjust_amount) + '<input type="hidden" name="adjust_amount[]" value="'+adjust_amount+'" />');
				});
				$('#total_due_after_payment').html(currency_format(total_due_after_payment));
				
			} else {
				$("#payment_amount").parent().show();
				$("#payment_date").parent().show();
				$("#paid_cash").parent().show();
				$("#return_change").parent().show();
				$("#pay_mode").parent().show();
				$("#save_payment").val('Add Payment');
			}
		});
		$("#payment_amount").change(function() {
			var due_amount;
			var payment_amount;
			var adjust_amount;
			var total_due_after_payment = 0;
			
			payment_amount = parseFloat($("#payment_amount").val());
			total_due_amount = parseFloat($("#total_due_amount").val());
			if(payment_amount > total_due_amount){
				in_account = payment_amount - total_due_amount;
				$('#in_account').html(currency_format(in_account));
				$('#in_account_amount').val(in_account);
			}else{
				in_account = 0;
				$('#in_account').html("");
				$('#in_account_amount').val(in_account);
			}
			$('#total_payment_amount').html(currency_format(payment_amount));
			$('.adjust_amount').each(function(){
				adjust_amount = 0;
				due_amount = parseFloat($(this).attr('amount'));
		
				if(due_amount <= payment_amount && payment_amount > 0){
					adjust_amount = due_amount;
					payment_amount = payment_amount - due_amount;
				}else{
					if(due_amount > payment_amount && payment_amount > 0){
						adjust_amount = payment_amount;
						payment_amount = 0;
					}	
				}
				total_due_after_payment =  total_due_after_payment + due_amount - adjust_amount;
				$(this).html(currency_format(adjust_amount) + '<input type="hidden" name="adjust_amount[]" value="'+adjust_amount+'" />');
			});
			$('#total_due_after_payment').html(currency_format(total_due_after_payment));
		});	
		$('#payment_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate;?>',
			scrollInput:false, 
			scrollMonth:false,
			scrollTime:false,
		}); 
		
		if($( "#pay_mode" ).find(':selected').data('needs_cash_calc') == 1){
			$( "#cash_calculator" ).show();
		}else{
			$( "#cash_calculator" ).hide();
		}	
		if($( "#pay_mode" ).find(':selected').data('has_additional_details') == 1){
			$( "#additional_detail" ).parent().parent().show();
			var additional_detail_label = $( "#pay_mode" ).find(':selected').data('additional_detail_label');
			$( "#additional_detail_label" ).html(additional_detail_label);
				
		}else{
			$( "#additional_detail" ).parent().parent().hide();
		}	
		$( "#pay_mode" ).change(function() {
			
			if($(this).find(':selected').data('has_additional_details') == 1){
				$( "#additional_detail" ).parent().parent().show();
				var additional_detail_label = $(this).find(':selected').data('additional_detail_label');
				$( "#additional_detail_label" ).html(additional_detail_label);
				
			}else{
				$( "#additional_detail" ).parent().parent().hide();
			}
			
			if($(this).find(':selected').data('needs_cash_calc') == 1){
				$( "#cash_calculator" ).show();
			}else{
				$( "#cash_calculator" ).hide();
			}
		});
		
		
		$( "#paid_cash" ).change(function() {
			var paid_cash = $( "#paid_cash" ).val();
			var payment_amount = $( "#payment_amount" ).val();
			var return_change = paid_cash - payment_amount;
			$( "#return_change" ).val(return_change);
		});
		
	});
</script>

<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line("payment_form");?>
				</div>
				<div class="panel-body">
					<?php if($payment_status == 'rejected'){ ?>
							<div class='alert alert-danger'><?php echo $this->lang->line('this_payment_is_rejected');?></div>
					<?php } ?>
					<?php  if(!isset($payment)){ ?> 
					<?php echo form_open('payment/insert/'.$patient_id.'/'.$called_from) ?>
					<?php  }else{ ?> 
					<?php echo form_open('payment/edit/'.$payment_id.'/'.$called_from) ?>
					<?php  } ?> 
					<?php 
						if(isset($payment)){
							$payment_date = date($def_dateformate,strtotime($payment['pay_date'])); 
						}else{
							$payment_date = date($def_dateformate); 
						}
					?>
					<input type="hidden" name="payment_type" value="bill_payment" />
					<div class="col-md-12">
						
							<div class="panel panel-default">
								<div class="panel-heading">
									<?= $this->lang->line('search')." ".$this->lang->line('patient');?>
								</div>
								<div class="panel-body">
					
									<div class="col-md-3">
										<label for="display_id"><?php echo $this->lang->line('patient_id');?></label>
										<input type="text" <?php if(isset($patient)){echo "readonly";}?> name="display_id" id="display_id" value="<?php if(isset($patient)){echo $patient['display_id']; } ?>" class="form-control"/>
									</div>
									<div class="col-md-3">
										<label for="ssn_id"><?php echo $this->lang->line('ssn_id');?></label>
										<input type="text" <?php if(isset($patient)){echo "readonly";}?> name="ssn_id" id="ssn_id" value="<?php if(isset($patient)){echo $patient['ssn_id']; } ?>" class="form-control"/>
									</div>
									<div class="col-md-3">
										<label for="patient"><?php echo $this->lang->line('patient_name');?></label>
										<input type="text" <?php if(isset($patient)){echo "readonly";}?> name="patient_name" id="patient_name" value="<?php if(isset($patient)){echo $patient['first_name']." " .$patient['middle_name']." " .$patient['last_name']; } ?>" class="form-control"/>
										<?php echo form_error('patient_id','<div class="alert alert-danger">','</div>'); ?>
									</div>
									<div class="col-md-3">
										<label for="phone"><?php echo $this->lang->line('mobile');?></label>
										<input type="text" <?php if(isset($patient)){echo "readonly";}?> name="phone_number" id="phone_number" value="<?php if(isset($patient)){echo $patient['phone_number']; } ?>" class="form-control"/>
									</div>
								</div>
							</div>
							<input type="hidden" name="patient_id" id="patient_id" value="<?= $patient_id; ?>" />
							<?php echo form_error('patient_id','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="bill_table">
							<thead>
								<tr>
									<th><?php echo $this->lang->line("bill_no");?></th>
									<th style="text-align:right;"><?php echo $this->lang->line("due_amount");?></th>
									<th style="text-align:right;"><?php echo $this->lang->line("payment_adjustement");?></th>
								</tr>
							</thead>
							<?php if(isset($payment)){ //Edit Mode ?>
							<tbody id="bill_detail">
								<?php 
									$total_due_amount = 0;
									$total_adjust_amount = 0;
									foreach($adjusted_bills as $bill){ ?>
										<tr>
										<td>
											<a href="<?=site_url('bill/edit/'.$bill['bill_id']);?>" class="btn btn-primary btn-sm square-btn-adjust"><?=$bill['bill_id'];?></a>
											<input type='hidden' name='bill_id[]' value='<?=$bill['bill_id'];?>'/>
										</td>
										<?php 
										foreach($bills as $patient_bill){
											if($patient_bill['bill_id'] == $bill['bill_id']){
												$due_amount = $bill['adjust_amount'];
												$total_due_amount = $total_due_amount + $due_amount;
												$due_amount = currency_format($due_amount);
												if($currency_postfix) 
													$due_amount = $due_amount . $currency_postfix;	
											}
										}
										?>
										<td style="text-align:right;"><?=$due_amount;?></td>
										<?php 
										$adjust_amount = currency_format($bill['adjust_amount']);
										$total_adjust_amount = $total_adjust_amount + $bill['adjust_amount'];
										if($currency_postfix) $adjust_amount = $adjust_amount . $currency_postfix;	
										
										?>
										<td style="text-align:right;" class="adjust_amount" amount="<?=$bill['adjust_amount'];?>" ><?=$adjust_amount;?><input type="hidden" name="adjust_amount[]" value="<?=$bill['adjust_amount'];?>" /></td>
										
										</tr>
								<?php } 
										$total_due_after_payment = $total_due_amount - $total_adjust_amount;
										$total_due_after_payment = currency_format($total_due_after_payment);
										if($currency_postfix) $total_due_after_payment = $total_due_after_payment . $currency_postfix;	
										$ttl_due_amount = $total_due_amount;
										$total_due_amount = currency_format($total_due_amount);
										if($currency_postfix) $total_due_amount = $total_due_amount . $currency_postfix;	
										$in_account = $payment['pay_amount']- $total_adjust_amount;
										$total_adjust_amount = currency_format($total_adjust_amount);
										if($currency_postfix) $total_adjust_amount = $total_adjust_amount . $currency_postfix;	
								?>
								<tr>
									<td><?=$this->lang->line('patient_account');?></td>
									<td style='text-align:right;'></td>
									<td style='text-align:right;' id='in_account'><?=currency_format($in_account);?></td>
									<input type='hidden' id='in_account_amount' name='in_account_amount' value='<?=$in_account;?>'/>
								</tr>
							</tbody>
							<tfoot id="bill_detail_footer">
								<tr>
									<th><?php echo $this->lang->line("total");?></th>
									<th style="text-align:right;"><?=$total_due_amount;?><input type="hidden" name="total_due_amount" id="total_due_amount" value="<?=$ttl_due_amount;?>"/></th>
									<th style="text-align:right;" id="total_payment_amount"><?=$total_adjust_amount;?></th>
								</tr>
							</tfoot>
							<?php }else{ //Insert Mode  ?>
								<tbody id="bill_detail">
								</tbody>
								<tfoot id="bill_detail_footer">
								</tfoot>
							<?php } ?>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="title"><?=$this->lang->line('adjust_from_account');?></label>        
							<div class="checkbox">
								<label>
									<input type="checkbox" id="adjust_from_account" name="adjust_from_account" value="1"><span style="display:none;" id="adjust_from_account_amount"></span>
									<span id="adjust_from_account_display"></span>
								</label>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="title"><?php echo $this->lang->line('payment_amount');?></label>        
							<input type="text" name="payment_amount" id="payment_amount" class="form-control" value="<?=$payment_pay_amount;?>" />
							<?php echo form_error('payment_amount','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="title"><?php echo $this->lang->line('payment_date');?></label>        
							<input type="text" name="payment_date" id="payment_date" class="form-control" value="<?=$payment_date;?>" />
							<?php echo form_error('payment_date','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="title"><?php echo $this->lang->line('payment_mode');?></label>        
							<select name="pay_mode" id="pay_mode" class="form-control">
								<?php foreach($payment_methods as $payment_method){ ?>
									<option data-needs_cash_calc="<?=$payment_method['needs_cash_calc'];?>" data-has_additional_details="<?=$payment_method['has_additional_details'];?>" data-additional_detail_label="<?=$payment_method['additional_detail_label'];?>" value="<?=$payment_method['payment_method_name'];?>" <?php if ($payment_pay_mode == $payment_method['payment_method_name']) {echo "selected";} ?>><?=$payment_method['payment_method_name'];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label id="additional_detail_label" for="title"><?php echo $this->lang->line('additional_detail');?></label>        
							<input type="text" name="additional_detail" id="additional_detail" class="form-control" value="<?=$payment_additional_detail;?>" />
							<?php echo form_error('additional_detail','<div class="alert alert-danger">','</div>'); ?>
						</div>	
					</div>
					<div class="col-md-12" id="cash_calculator">
						<div class="col-md-6">
							<div class="form-group">
								<label for="title"><?php echo $this->lang->line('paid_cash');?></label>        
								<input type="text" name="paid_cash" id="paid_cash" class="form-control" value="" />
								<small><?php echo $this->lang->line('calculation_purpose_only');?></small>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="title"><?php echo $this->lang->line('return_change');?></label>        
								<input type="text" name="return_change" id="return_change" readonly="readonly" class="form-control" value="" />
							</div>	
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<?php if(!isset($payment)){ ?> 
							<input class="btn btn-primary" type="submit" id="save_payment" value="Add Payment" name="submit" />
							<?php }else{ ?> 
							<input class="btn btn-primary" type="submit" value="Update Payment" name="submit" />
							<?php } ?> 
						</div>
					</div>
					<?php if(!isset($payment)){ ?> 
						<div class="col-md-12">
							<div class="form-group">
								<a href="<?=site_url("appointment/index"); ?>" class="btn btn-primary" ><?php echo $this->lang->line('back_to_app');?></a>
							</div>
						</div>
					<?php } ?> 
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>			
