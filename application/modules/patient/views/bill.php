<?php
	$total = ($particular_total + $fees_total + $treatment_total + $item_total);
?>
<script type="text/javascript" charset="utf-8">
$(window).load(function(){
	$('.confirmDelete').click(function(){
		return confirm('<?=$this->lang->line("areyousure_delete");?>');
	});
	
	$( "#tax_amount").val($( "#tax_rate" ).val());
	$( "#tax_rate" ).change(function() {
		$( "#tax_amount").val($( "#tax_rate" ).val() * $( "#particular_amount" ).val() / 100);
	});
	$( "#particular_amount" ).change(function() {
		$( "#tax_amount").val($( "#tax_rate" ).val() * $( "#particular_amount" ).val() / 100);
	});
	var tax_rate = $('option:selected', $("#bill_tax_rate")).attr('tax_rate');
	$("#bill_tax_amount").val(tax_rate);
	$( "#bill_tax_rate" ).change(function(){
		var tax_rate = $('option:selected', $("#bill_tax_rate")).attr('tax_rate');
		$("#bill_tax_amount").val(tax_rate);
	});
	
	<?php if(isset($fees)){ ?>
	var list_fees=[<?php $i = 0;
		foreach ($fees as $fee) {
			if ($i > 0) { echo ",";}
			echo '{value:"' . $fee['detail'] . '",amount:"' . $fee['fees'] . '"}';
			$i++;
		}?>];
	$("#fees_detail").autocomplete({
		
		autoFocus: true,
		source: list_fees,
		minLength: 1,//search after one characters
		
		select: function(event,ui){
			//do something
			$("#fees_amount").val(ui.item ? ui.item.amount : '');
			
		},
		change: function(event, ui) {
			 if (ui.item == null) {
				$("#fees_amount").val('');
				$("#fees_detail").val('');
			}
		},
		response: function(event, ui) {
			if (ui.content.length === 0) 
			{
				$("#fees_amount").val('');
				$("#fees_detail").val('');
			}
		}
	});  
	<?php } ?>
	$('#foc').change(function() {
		if($(this).is(":checked")){
			$('#discount').val('<?=$total-$discount;?>');
		}else{
			$('#discount').val('');
		}
	});
	<?php if (in_array("stock",$active_modules)) { ?>
		var items_list=[<?php $i = 0;
		foreach ($items as $item) {
			if ($i > 0) { echo ",";}
			echo '{value:"' . $item['item_name'] . '",amount:"' . $item['mrp'] . '",available_quantity:"'.$item['available_quantity'].'",item_id:"'.$item['item_id'].'"}';
			$i++;
		}?>];
		$("#item_name").autocomplete({
			autoFocus: true,
			source: items_list,
			minLength: 1,//search after one characters
			
			select: function(event,ui){
				//do something
				$("#item_amount").val(ui.item ? ui.item.amount : '');
				$("#available_quantity").val(ui.item ? ui.item.available_quantity : '');
				$("#item_id").val(ui.item ? ui.item.item_id : '');
				$("#item_quantity").val(1);
				
			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#item_id").val('');
					$("#item_amount").val('');
					$("#item_name").val('');
					$("#available_quantity").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#item_id").val('');
					$("#item_amount").val('');
					$("#item_name").val('');
					$("#available_quantity").val('');
				}
			}
		});
	<?php } ?>
	<?php if (in_array("doctor",$active_modules)) {?>
		var list_fees=[<?php $i = 0;
			foreach ($fees as $fee) {
				if ($i > 0) { echo ",";}
				echo '{value:"' . $fee['detail'] . '",amount:"' . $fee['fees'] . '"}';
				$i++;
			}?>];
		$("#fees_detail").autocomplete({
			autoFocus: true,
			source: list_fees,
			minLength: 1,//search after one characters
			
			select: function(event,ui){
				//do something
				$("#fees_amount").val(ui.item ? ui.item.amount : '');
				
			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#fees_amount").val('');
					$("#fees_detail").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#fees_amount").val('');
					$("#fees_detail").val('');
				}
			}
		});   
	<?php } ?>
	<?php if (in_array("treatment",$active_modules)) {
		$tax_rate_name[0] = "";
		$tax_rate_array[0] = 0;?>
		var list_fees=[<?php $i = 0;
			foreach ($treatments as $treatment) {
				if ($i > 0) { echo ",";}
				echo '{value:"' . $treatment['treatment'] . '",amount:"' . $treatment['price'] .'",tax_rate_name:"' . $tax_rate_name[$treatment['tax_id']] .'",treatment_rate:"' . ($treatment['price']*$tax_rate_array[$treatment['tax_id']])/100 . '"}';
				$i++;
			}?>];
		$("#treatment").autocomplete({
			autoFocus: true,
			source: list_fees,
			minLength: 1,//search after one characters
			
			select: function(event,ui){
				//do something
				$("#treatment_price").val(ui.item ? ui.item.amount : '');
				$("#treatment_rate_name").val(ui.item ? ui.item.tax_rate_name : '');
				$("#treatment_rate").val(ui.item ? ui.item.treatment_rate : '');
				
			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#treatment_price").val('');
					$("#treatment").val('');
					$("#treatment_rate_name").val('');
					$("#treatment_rate").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#treatment_price").val('');
					$("#treatment").val('');
					$("#treatment_rate_name").val('');
					$("#treatment_rate").val('');
				}
			}
		});   
	<?php } ?>
	<?php if (in_array("lab",$active_modules)) { ?>
		var list_lab_test=[<?php $i = 0;
			foreach ($lab_tests as $lab_test) {
				if ($i > 0) { echo ",";}
				echo '{value:"' . $lab_test['test_name'] . '",amount:"' . $lab_test['test_charges'] .'",id:"'.$lab_test['test_id'].'"}';
				$i++;
			}?>];
		$("#lab_test").autocomplete({
			autoFocus: true,
			source: list_lab_test,
			minLength: 1,//search after one characters
			
			select: function(event,ui){
				//do something
				$("#test_price").val(ui.item ? ui.item.amount : '');
				$("#test_id").val(ui.item ? ui.item.id : '');
			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#test_price").val('');
					$("#test_id").val('');
					$("#lab_test").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0) 
				{
					$("#test_price").val('');
					$("#test_id").val('');
					$("#lab_test").val('');
				}
			}
		});   
	<?php } ?>
});
</script>

<div id="page-inner">
	<div class="row">
		<div class="col-md-12">		
			<div class="panel panel-primary">
			<div class="panel-heading">
				<?=$this->lang->line("new")." ".$this->lang->line("bill");?>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<a class="btn btn-primary square-btn-adjust" href="<?=site_url("patient/visit/" . $patient_id ."/".$appointment_id); ?>"><?php echo $this->lang->line("back_to_visit");?></a>
					<a class="btn btn-primary square-btn-adjust" title="<?php echo $this->lang->line("print");?>" target="_blank" href="<?php echo site_url("patient/print_receipt/" . $visit_id); ?>"><?php echo $this->lang->line("print")." ".$this->lang->line("receipt");?></a>
					<a class="btn btn-primary square-btn-adjust" title="<?php echo $this->lang->line("payment");?>" href="<?php echo site_url("payment/insert/" . $patient_id . "/bill"); ?>"><?php echo $this->lang->line("bill")." ".$this->lang->line("payment");?></a>
					<?php if (in_array("alert", $active_modules)) {	?>
					<a class="btn btn-primary square-btn-adjust" href="<?php echo site_url("patient/email_bill/" . $visit_id."/".$patient_id ); ?>"><?php echo $this->lang->line("email_bill");?></a>
					<?php } ?>
					<span class="alert-danger"><?php echo validation_errors(); ?></span>
				</div>
				<div>
					<div class="form-group">
						<input type="hidden" name="visit_id" value="<?=$visit_id?>"/>
						<input type="hidden" name="patient_id" value="<?=$patient_id?>"/>
						<input type="hidden" name="bill_id" value="<?=$bill_id?>"/>
						<label for="bill_number"><?php echo $this->lang->line("bill_number");?>: <?php echo $bill_id;?></label><br/>
						<label for="doctor_name"><?php echo $this->lang->line("doctor_name");?>: <?php echo $doctor_name;?></label><br/>
						<label for="patient"><?php echo $this->lang->line("patient");?> : <?=$patient['first_name'] . " " . $patient['middle_name']. " " . $patient['last_name'];?></label><br/>
						<label for="bill_date"><?php echo $this->lang->line("date");?> : <?php echo $visit_date; ?></label>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<?php echo $this->lang->line("bill");?>
						</div>
						<div class="panel-body">
							<?php echo form_open('patient/bill/' . $visit_id . '/' . $patient_id) ?>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<?php echo $this->lang->line("particular");?>
										</div>
										<div class="col-md-2">
											<?php echo $this->lang->line("amount");?>
										</div>
										<?php if($tax_type == "item"){?>
										<div class="col-md-2">
											<?php echo $this->lang->line("tax");?>
										</div>
										<div class="col-md-3">
											
										</div>
										<?php } ?>
										<div class="col-md-3">
											
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<input type="hidden" name="action" value="particular">
											<input name="particular" id="particular" class="form-control" value=""/>
										</div>
										<div class="col-md-2">
											<input type="text" name="particular_amount" id="particular_amount" class="form-control" id="amount"/>
										</div>
										<?php if($tax_type == "item"){?>
										
										<div class="col-md-2">
											<select name="tax_rate" class="form-control" id="tax_rate">
												<?php foreach($tax_rates as $tax_rate){?>
													<option value="<?=$tax_rate['tax_rate'];?>"><?=$tax_rate['tax_rate_name'];?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-2">
											<input type="text" style="text-align:right;" name="tax_amount" id="tax_amount" class="form-control" readonly />
										</div>
										<?php } ?>
										<div class="col-md-2">
											<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" value="particular" /><?php echo $this->lang->line("add");?></button>
										</div>
									</div>						
								</div>
								<?php if (in_array("stock",$active_modules)) { ?>
								
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<?php echo $this->lang->line("item");?>
										</div>
										<div class="col-md-2">
											<?php echo $this->lang->line("quantity");?>
										</div>
										<div class="col-md-2">
											<?php echo $this->lang->line("available");?>
										</div>
										<div class="col-md-2">
											<?php echo $this->lang->line("amount");?>
										</div>
										<div class="col-md-3">
											
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<input type="hidden" name="action" value="item">
											<input type="hidden" name="item_id" id="item_id" value="">
											<input name="item_name" id="item_name" class="form-control" value=""/>
										</div>
										<div class="col-md-2">
											<input type="text" name="item_quantity" id="item_quantity" class="form-control" />
										</div>
										<div class="col-md-2">
											<input type="text" name="available_quantity" id="available_quantity" class="form-control" readonly="readonly" />
										</div>
										<div class="col-md-2">
											<input type="text" name="item_amount" id="item_amount" class="form-control" />
										</div>
										<div class="col-md-3">
											<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" value="item" /><?php echo $this->lang->line("add");?></button>
										</div>
									</div>						
								</div>
								<?php }?>
								<?php if (in_array("doctor",$active_modules)) {?>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<?php echo $this->lang->line("fees");?>
										</div>
										<div class="col-md-3">
											<?php echo $this->lang->line("amount");?>
										</div>
										<div class="col-md-3">
											
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<input type="hidden" name="action" value="fees">
											<input name="fees_detail" id="fees_detail" class="form-control" value=""/>
										</div>
										<div class="col-md-3">
											<input type="text" name="fees_amount" id="fees_amount" class="form-control" id="amount"/>
										</div>
										<div class="col-md-3">
											<button class="btn btn-primary  square-btn-adjust" type="submit" name="submit" value="fees" /><?php echo $this->lang->line("add");?></button>
										</div>
									</div>						
								</div>
								<?php }?>
								<?php if (in_array("treatment",$active_modules)) {?>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<?php echo $this->lang->line("treatment");?>
										</div>
										<div class="col-md-2">
											<?php echo $this->lang->line("amount");?>
										</div>
										<?php if($tax_type == "item"){?>
										<div class="col-md-2">
											<?php echo $this->lang->line("tax_rate_name");?>
										</div>
										<div class="col-md-2">
											<?php echo $this->lang->line("rate");?>
										</div>
										<?php } ?>
										<div class="col-md-3">
											
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<input type="hidden" name="action" value="treatment">
											<input name="treatment" id="treatment" class="form-control" value=""/>
										</div>
										<div class="col-md-2">
											<input type="text" name="treatment_price" id="treatment_price" class="form-control" id="amount"/>
										</div>
										<?php if($tax_type == "item"){?>
										<div class="col-md-2">
											<input type="text" name="treatment_rate_name" readonly id="treatment_rate_name" class="form-control" />
										</div>
										<div class="col-md-2">
											<input type="text" style="text-align:right;" name="treatment_rate" id="treatment_rate" readonly class="form-control"  />
										</div>
										<?php } ?>
										<div class="col-md-3">
											<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" value="treatment" /><?php echo $this->lang->line("add");?></button>
										</div>
									</div>						
								</div>
								<?php }?>
								<?php if (in_array("lab",$active_modules)) {?>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<?php echo $this->lang->line("lab_test");?>
										</div>
										<div class="col-md-2">
											<?php echo $this->lang->line("amount");?>
										</div>
										<?php if($tax_type == "item"){?>
										<div class="col-md-2">
											<?php echo $this->lang->line("tax_rate_name");?>
										</div>
										<div class="col-md-2">
											<?php echo $this->lang->line("rate");?>
										</div>
										<?php } ?>
										<div class="col-md-3">
											
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<input type="hidden" name="action" value="lab_test">
											<input type="hidden" name="test_id" id="test_id">
											<input name="lab_test" id="lab_test" class="form-control" value=""/>
										</div>
										<div class="col-md-2">
											<input type="text" name="test_price" id="test_price" class="form-control"/>
										</div>
										<?php if($tax_type == "item"){?>
										<div class="col-md-2">
											<input type="text" name="lab_test_rate_name" readonly id="lab_test_rate_name" class="form-control" />
										</div>
										<div class="col-md-2">
											<input type="text" style="text-align:right;" name="lab_test_rate" id="lab_test_rate" readonly class="form-control"  />
										</div>
										<?php } ?>
										<div class="col-md-3">
											<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" value="lab_test" /><?php echo $this->lang->line("add");?></button>
										</div>
									</div>						
								</div>
								<?php }?>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<?php echo $this->lang->line("discount");?>
										</div>
										<div class="col-md-3">
											<?php if (in_array("doctor", $active_modules)) { ?>
											<?php echo $this->lang->line("foc");?>
											<?php } ?> 
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<input type="hidden" name="action" value="discount">
											<input name="discount" id="discount" class="form-control" value=""/> 					
										</div>
										<div class="col-md-3">
											<?php if (in_array("doctor", $active_modules)) { ?>
											<input type="checkbox" name="foc" id="foc" class="form-control" value=""/> 					
											<?php } ?> 
										</div>
										<div class="col-md-3">
											<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" value="discount" /><?php echo $this->lang->line("add");?></button>
										</div>
									</div>
								</div>
								<?php if($tax_type == "bill"){?>
										
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<?php echo $this->lang->line("tax");?>
										</div>
										<div class="col-md-3">
											<?php echo $this->lang->line("percentage");?>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-3">
											<select name="bill_tax_rate" class="form-control" id="bill_tax_rate">
												<?php foreach($tax_rates as $tax_rate){?>
													<option value="<?=$tax_rate['tax_id'];?>" tax_rate="<?=$tax_rate['tax_rate'];?>"><?=$tax_rate['tax_rate_name'];?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-3">
											<input type="text" style="text-align:right;" name="bill_tax_amount" id="bill_tax_amount" class="form-control" readonly />
										</div>
										<div class="col-md-3">
											<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" value="tax" /><?php echo $this->lang->line("add");?></button>
										</div>
									</div>
								</div>
								<?php } ?>
							<?php echo form_close(); ?>
						</div>
					</div>
						
						
					<div class="panel panel-primary">
						<div class="panel-heading">
							<?php echo $this->lang->line("bill");?>
						</div>
						<div class="panel-body">
							<?php $this->load->view('bill/bill_table'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>