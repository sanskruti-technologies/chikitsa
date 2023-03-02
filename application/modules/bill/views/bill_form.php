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
	$total = ($particular_total + $fees_total + $treatment_total + $item_total + $session_total);
	$time_interval = $time_interval*60;
	$patient_name = "";
	$ssn_id = "";
	$display_id = "";
	$phone_number = "";
	if(isset($patient)){
		$patient_name = $patient['title']." ".$patient['first_name']." ".$patient['middle_name']." ".$patient['last_name'];
		$ssn_id = $patient['ssn_id'];
		$display_id = $patient['display_id'];
		$phone_number = $patient['phone_number'];
	}else{
		$bill_date_value=set_value('bill_date','');
		$bill_time_value=set_value('bill_time','');
	}
	if(isset($doctor)){
		$doctor_name = $doctor['title']." ".$doctor['first_name']." ".$doctor['middle_name']." ".$doctor['last_name'];
		$doctor_department = $doctor['department_id'];
	}else{
		$doctor_name=set_value('doctor_name',"");
		$doctor_department=set_value('doctor_department',"");
	}
?>
<script type="text/javascript" charset="utf-8">
$(window).load(function(){
	$('.confirmDelete').click(function(){
		return confirm('<?=$this->lang->line("areyousure_delete");?>');
	});
	$('#foc').change(function() {
		if($(this).is(":checked")){
			$('#discount').val('<?=$total-$discount;?>');
		}else{
			$('#discount').val('');
		}
	});
	var tax_rate = $('option:selected', $("#bill_tax_rate")).attr('tax_rate');
	$("#bill_tax_amount").val(tax_rate);
	$( "#bill_tax_rate" ).change(function(){
		var tax_rate = $('option:selected', $("#bill_tax_rate")).attr('tax_rate');
		$("#bill_tax_amount").val(tax_rate);

	});

	$("#add_bill_form").validate({
		// Specify validation rules
		errorClass: "alert alert-danger no_margin",
		errorElement: "div",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			particular: {	required: true,	},
			particular_amount: {	required: true,number: true	},
			discount: { required: true,number: true },
			bill_tax_rate: {required: true,	},
			item_name: {required: true,	},
			item_amount: {required: true,number: true	},
			item_quantity: {
				required: true,		
			},
			fees_detail: {required: true,},
			fees_amount: {required: true,number: true},
			treatment: {required: true,},
			treatment_price: {required: true,number: true},
			lab_test: {required: true,},
			test_price: {required: true,number: true},
		},
		// Specify validation error messages
		messages: {
			particular: { required: "<?=$this->lang->line('please_enter_particular');?>" },
			particular_amount: { required: "<?=$this->lang->line('please_enter_particular_amount');?>",number: "<?=$this->lang->line('please_enter_particular_amount');?>" },
			discount: { required: "<?=$this->lang->line('please_enter_discount');?>",number: "<?=$this->lang->line('please_enter_discount');?>"	},
			bill_tax_rate: { required: "<?=$this->lang->line('please_enter_bill_tax_rate');?>" },
			item_name: {required: "<?=$this->lang->line('please_enter_item');?>"	},
			item_amount: {required: "<?=$this->lang->line('please_enter_item_amount');?>", number: "<?=$this->lang->line('please_enter_item_amount');?>"	},
			item_quantity: {required: "<?=$this->lang->line('please_enter_item_quantity');?>", 	},
			fees_detail: {required: "<?=$this->lang->line('please_enter_fees_detail');?>",},
			fees_amount: {required: "<?=$this->lang->line('please_enter_fees_amount');?>",number: "<?=$this->lang->line('please_enter_fees_amount');?>"},
			treatment: {required: "<?=$this->lang->line('please_enter_treatment');?>",},
			treatment_price: {required: "<?=$this->lang->line('please_enter_treatment_price');?>",number: "<?=$this->lang->line('please_enter_fees_amount');?>"},
			lab_test: {required: "<?=$this->lang->line('please_enter_lab_test');?>",},
			test_price: {required: "<?=$this->lang->line('please_enter_lab_test_price');?>",number: "<?=$this->lang->line('please_enter_lab_test_price');?>"},
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response) {
					//$("#addInquiryModal").modal("hide");
				}
			});
		}
	});
	var tax_rate = $('option:selected', $("#fees_tax_rate")).attr('tax_rate');

	$("#fees_tax_amount").val(tax_rate);

	$( "#fees_tax_rate" ).change(function(){

		var tax_rate = $('option:selected', $("#fees_tax_rate")).attr('tax_rate');

		$("#fees_tax_amount").val(tax_rate);

	});

	var tax_rate = $('option:selected', $("#item_tax_rate")).attr('tax_rate');

	$("#item_tax_amount").val(tax_rate);

	$( "#item_tax_rate" ).change(function(){

		var tax_rate = $('option:selected', $("#item_tax_rate")).attr('tax_rate');

		$("#item_tax_amount").val(tax_rate);

	});

	var tax_rate = $('option:selected', $("#treatment_rate")).attr('tax_rate');

	$("#treatment_rate").val(tax_rate);

	$( "#treatment_rate_name" ).change(function(){

		var tax_rate = $('option:selected', $("#treatment_rate_name")).attr('tax_rate');

		$("#treatment_rate").val(tax_rate);

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

				$("#available_quantity").html(ui.item ? ui.item.available_quantity : '');

				$("#item_id").val(ui.item ? ui.item.item_id : '');
				$("#item_quantity").val(1);

			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#item_id").val('');
					$("#item_amount").val('');
					$("#item_name").val('');

					$("#available_quantity").html('');

				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0)
				{
					$("#item_id").val('');
					$("#item_amount").val('');
					$("#item_name").val('');

					$("#available_quantity").html('');

				}
			}
		});
	<?php } ?>
	var list_fees=[];

	<?php
		$fees_list=array();
		if(isset($fees)){
		$list_fees_array = array();
		foreach ($doctors as $doc) {
			$list_fees_array[$doc['doctor_id']] = array();
		}
		foreach ($fees as $fee) {
			$fee_array = array('value'=>$fee['detail'],'amount' => $fee['fees']);
			$list_fees_array[$fee['doctor_id']][] = $fee_array;
			$fees_list[]=$fee_array;
		}
		echo "list_fees = ".json_encode($list_fees_array).";";
	?>
	var list_fees = <?= json_encode($fees_list); ?>;
	//console.log(list_fees);
	$("#fees_detail").autocomplete({
		autoFocus: true,
		source: list_fees,
		minLength: 1,//search after one characters

		select: function(event,ui){
			//do something
			$("#fees_detail").val(ui.item ? ui.item.value : '');
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

	<?php }	?>
	<?php
	/*$tax_rate_name[0] = "";
	$tax_rate_array[0] = 0;*/

	$treatement_array = array();
 	if (in_array("treatment",$active_modules)) { 
	foreach($treatments as $treatment){

		$row['value'] = $treatment['treatment'];

		$row['amount'] = $treatment['price'];
	

		$row['tax_id'] = $treatment['tax_id'];
/*
		$row['tax_rate_name'] = $tax_rate_name[$treatment['tax_id']];
		//$row['tax_rate'] = $tax_rate_array[$treatment['tax_id']];

		//	$row['treatment_rate'] = $treatment['price']*$tax_rate_array[$treatment['tax_id']]/100;
*/
		foreach($tax_rates as $tax_rate){
			if($treatment['tax_id']==$tax_rate['tax_id']){
				$row['tax_rate_name']=$tax_rate['tax_rate_name'];
				$row['tax_rate']=$tax_rate['tax_rate'];
				$row['treatment_rate'] = $treatment['price']*$row['tax_rate']/100;

			}
		}

		$row['departments'] = $treatment['departments'];

		$treatement_array[] = $row;

	}
 }
	if (in_array("treatment",$active_modules)) {?>

		var list_treatment = <?= json_encode($treatement_array); ?>
		
		
		$("#treatment").autocomplete({
			autoFocus: true,
			source: list_treatment,
			minLength: 1,//search after one characters
			select: function(event,ui){
				//do something
				$("#treatment_price").val(ui.item ? ui.item.amount : '');
				$("#treatment_rate_name").val(ui.item ? ui.item.tax_id : '');
				
				$("#treatment_rate_name_value").val(ui.item ? ui.item.tax_rate_name : '');
					
				/*$("#treatment_rate_name > option").each(function() {
						if($(this).val()==ui.item.tax_id){ 
							$(this).attr("selected","selected");    
						}
					});*/
				$("#treatment_rate").val(ui.item ? ui.item.tax_rate : '');

			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#treatment_price").val('');
					$("#treatment").val('');
					$("#treatment_rate_name").val('');
					$("#treatment_rate_name_value").val('');
					//$("#treatment_rate_name").find('option:eq(0)').prop('selected', true);
					$("#treatment_rate").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0)
				{
					$("#treatment_price").val('');
					$("#treatment").val('');
					$("#treatment_rate_name").val('');
					$("#treatment_rate_name_value").val('');
					//$("#treatment_rate_name").find('option:eq(0)').prop('selected', true);
					$("#treatment_rate").val('');
				}
			}
		});
	<?php }else{ ?>
		var list_treatment=[];
	<?php } ?>
	var searcharrpatient=[<?php $i = 0;
		foreach ($patients as $patient) {
			if ($i > 0) { echo ",";}
			echo '["' . $patient['display_id'] . '","' . $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] . '","' . $patient['phone_number'] . '","' . $patient['ssn_id'] . '","' . $patient['patient_id'] . '"]';
			$i++;
		}?>];
	var p_columns = [ {name: '<?php echo $this->lang->line("patient").$this->lang->line("id");?>', minWidth:'80px'},{name: '<?php echo $this->lang->line("name");?>', minWidth:'100px'}, {name: '<?php echo $this->lang->line('phone_number'); ?>', minWidth:'120px'},{name: '<?php echo $this->lang->line('ssn_id'); ?>', minWidth:'120px'},{name: '<?php echo $this->lang->line("id");?>', minWidth: '30px'}];
	var p_values=searcharrpatient;
	
	$("#patient_name").mcautocomplete({
              showHeader: true,
              columns: p_columns,
              source: p_values,
              select: function(event, ui) {
                  this.value = (ui.item ? ui.item[1]: '');
			$("#patient_id").val(ui.item ? ui.item[4] : '');
			$("#display_id").val(ui.item ? ui.item[0] : '');
			$("#phone_number").val(ui.item ? ui.item[2] : '');
			$("#ssn_id").val(ui.item ? ui.item[3] : '');
                  return false;
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
	$("#phone_number").mcautocomplete({
              showHeader: true,
              columns: p_columns,
              source: p_values,
              select: function(event, ui) {
                  this.value = (ui.item ? ui.item[2]: '');
			$("#patient_id").val(ui.item ? ui.item[4] : '');
			$("#display_id").val(ui.item ? ui.item[0] : '');
			$("#patient_name").val(ui.item ? ui.item[1] : '');
			$("#ssn_id").val(ui.item ? ui.item[3] : '');
                  return false;
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
	$("#display_id").mcautocomplete({
              showHeader: true,
              columns: p_columns,
              source: p_values,
              select: function(event, ui) {
                  this.value = (ui.item ? ui.item[0]: '');
			$("#patient_id").val(ui.item ? ui.item[4] : '');
			$("#patient_name").val(ui.item ? ui.item[1] : '');
			$("#phone_number").val(ui.item ? ui.item[2] : '');
			$("#ssn_id").val(ui.item ? ui.item[3] : '');
                  return false;
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
	$("#ssn_id").mcautocomplete({
              showHeader: true,
              columns: p_columns,
              source: p_values,
              select: function(event, ui) {
                  this.value = (ui.item ? ui.item[3]: '');
			$("#patient_id").val(ui.item ? ui.item[4] : '');
			$("#patient_name").val(ui.item ? ui.item[1] : '');
			$("#phone_number").val(ui.item ? ui.item[2] : '');
			$("#display_id").val(ui.item ? ui.item[0] : '');
                  return false;
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

		//Doctor AutoComplete
		var doctor=[<?php $i = 0;
			foreach ($doctors as $doc) {
				if ($i > 0) { echo ",";}
				echo '{value:"' . $doc['title']." ".$doc['first_name']." ".$doc['middle_name']." ".$doc['last_name']. '",department:"'.$doc['department_id'].'",id:"' . $doc['doctor_id'].'"}';
				$i++;
			}?>];
		$("#doctor_name").autocomplete({
			autoFocus: true,
			source: doctor,
			minLength: 1,//search after one characters
			select: function(event,ui){
				//do something
				$("#doctor_id").val(ui.item ? ui.item.id : '');
				$("#doctor_department").val(ui.item ? ui.item.department : '');
				$("#fees_section").show();
				var doctor_id = $('#doctor_id').val();
				$( "#fees_detail" ).autocomplete('option', 'source', list_fees[doctor_id]);

				var new_treatment_list = [];
				var doctor_department = $("#doctor_department").val();
				$.each(list_treatment , function(index, treatment) {

					var treatement_departments = [];

					if (treatment.departments != null) {

				  var treatement_departments = treatment.departments.split(',');

					}

				  var doctor_departments = doctor_department.split(',');
				  $.each(doctor_departments , function(i, doctor_department) {
					if(treatement_departments.indexOf(doctor_department) > -1){
						found = false;
						if(new_treatment_list.length > 0){
							$.each(new_treatment_list , function(index, new_treatment) {
								if (new_treatment.value == treatment.value){
									found = true;
								}
							});
						}
						if(!found){
							new_treatment_list.push(treatment);
						}
					}
				  });
				});
				$( "#treatment" ).autocomplete('option', 'source', new_treatment_list);

			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#doctor_name").val('');
					$("#doctor_id").val('');
					$("#doctor_department").val('');
					$("#fees_section").hide();
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0){
					$("#doctor_name").val('');
					$("#doctor_id").val('');
					$("#doctor_department").val('');
					$("#fees_section").hide();
				}
			}
		});
	<?php if(!isset($doctor_id) || $doctor_id == NULL){ ?>
		$("#fees_section").hide();
	<?php }else{ ?>
		var doctor_id = $('#doctor_id').val();
		$( "#fees_detail" ).autocomplete('option', 'source', list_fees[doctor_id]);
	<?php }?>
	<?php 	if(isset($visit_id)){ ?>
				$("#fees_section").show();
				var doctor_id = $('#doctor_id').val();
				$( "#fees_detail" ).autocomplete('option', 'source', list_fees[doctor_id]);
	<?php 	}?>

	$('#bill_date').datetimepicker({
		timepicker:false,
		format: '<?=$def_dateformate; ?>',
		scrollMonth:false,
		scrollTime:false,
		scrollInput:false,
	});
	$('#bill_time').datetimepicker({
		datepicker:false,
		step:<?=$time_interval;?>,
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>',
		<?php if($clinic_start_time != '00:00' && $clinic_end_time !='24:00'){?>
		minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
		maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
		<?php } ?>
		scrollMonth:false,
		scrollTime:false,
		scrollInput:false,
	});
	<?php
	//print_r($lab_tests);
	if (in_array("lab",$active_modules)) { ?>
		var list_lab_test=[<?php $i = 0;
			foreach ($lab_tests as $lab_test) {
				if ($i > 0) { echo ",";}
				echo '{value:"' . $lab_test['test_name'] . '",amount:"' . $lab_test['test_charges'] .'",test_id:"'.$lab_test['test_id'].'",tax_name:"'.$lab_test['tax_rate_name'].'",tax_rate:"'.$lab_test['tax_rate'].'"}';
				$i++;
			}?>];
		$("#lab_test").autocomplete({
			autoFocus: true,
			source: list_lab_test,
			minLength: 1,//search after one characters

			select: function(event,ui){
				//do something
				$("#test_price").val(ui.item ? ui.item.amount : '');
				$("#lab_test_id").val(ui.item ? ui.item.test_id : '');
				$("#lab_rate_name_value").val(ui.item ? ui.item.tax_name : '');
				$("#lab_rate").val(ui.item ? ui.item.tax_rate : '');
			},
			change: function(event, ui) {
				 if (ui.item == null) {
					$("#test_price").val('');
					$("#lab_test_id").val('');
					$("#lab_test").val('');
					$("#lab_rate_name_value").val('');
					$("#lab_rate").val('');
				}
			},
			response: function(event, ui) {
				if (ui.content.length === 0)
				{
					$("#test_price").val('');
					$("#lab_test").val('');
					$("#lab_test_id").val('');
					$("#lab_rate_name_value").val('');
					$("#lab_rate").val('');
				}
			}
		});
	<?php } ?>
});

</script>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?=$this->lang->line("new")." ".$this->lang->line("bill");?></h5>
		</div>
		<div class="card-body">
			<?php 
				$attributes = array('id' => 'add_bill_form');
				echo form_open('bill/edit/'.$bill_id,$attributes); 
			?>
			<div class="form-group">
					<?php if($bill_id != 0){?>
						<a class="btn btn-primary square-btn-adjust btn-sm" target="_blank" href="<?php echo site_url("bill/print_receipt/" . $bill_id); ?>"><i class="fa fa-print"></i>&nbsp;<?php echo $this->lang->line("receipt");?></a>
						<a class="btn btn-primary square-btn-adjust btn-sm" href="<?php echo site_url("payment/insert/" .$patient_id . "/bill"); ?>"><i class="fa fa-money"></i>&nbsp;<?php echo $this->lang->line("bill")." ".$this->lang->line("payment");?></a>
						<a class="btn btn-primary square-btn-adjust btn-sm" href="<?php echo site_url("patient/visit/" .$patient_id); ?>"><i class="fa fa-arrow-left"></i>&nbsp;Back to Visit</a>
						<a class="btn btn-primary  square-btn-adjust btn-sm" href="<?php echo site_url("bill/index"); ?>"><i class="fa fa-arrow-left"></i>&nbsp;Back to Bills</a>
						<?php if (in_array("alert", $active_modules)) {	?>
							<a class="btn btn-primary  square-btn-adjust btn-sm" href="<?php echo site_url("patient/email_bill/" . $bill_id."/".$patient_id ); ?>"><i class="fa fa-envelope"></i>&nbsp;Email Bill</a>
						<?php } ?>
						<?php
						$bill_date = date($def_dateformate,strtotime($bill['bill_date']));
						$bill_time = date($def_timeformate,strtotime($bill['bill_time']));
					}else{
						if($bill_date_value==""){
							$bill_date = date($def_dateformate);
						}else{
							$bill_date=$bill_date_value;
						}
						if($bill_time_value==""){
							$bill_time = date($def_timeformate);
						}else{
							$bill_time=$bill_time_value;
						}
					}?>
				<?php //echo validation_errors('<span class="alert alert-danger">', '</span>'); ?>
			</div>
			<div>
				<input type="hidden" name="bill_id" value="<?=$bill_id?>"/>
				<div class="col-md-12">
						<div class="panel panel-default">
								<div class="panel-heading">
									<h6><?= $this->lang->line('search')." ".$this->lang->line('patient');?></h6>
								</div>
							<div class="panel-body table-responsive-60">
								<div class="row">
									<div class="col-md-3">
										<label for="display_id"><?php echo $this->lang->line('patient_id');?></label>
										<input type="hidden" name="patient_id" id="patient_id" value="<?=$patient_id; ?>">
										<?php if(isset($visit_id) && $visit_id != 0){ ?>
												<input type="text" name="display_id" id="display_id" value="<?=$display_id; ?>" class="form-control" readonly autocomplete="off"/>
												<?php	}else { ?>
													<input type="text" name="display_id" id="display_id" value="<?=$display_id; ?>" class="form-control" autocomplete="off"/>
												<?php } ?>
									</div>
									<div class="col-md-3">
										<label for="patient"><?php echo $this->lang->line('patient_name');?></label>
										<?php if(isset($visit_id) && $visit_id != 0)
											{ ?>
												<input type="text" name="patient_name" id="patient_name" value="<?=$patient_name; ?>" class="form-control" readonly autocomplete="off"/>
											<?php	}else { ?>
												<input type="text" name="patient_name" id="patient_name" value="<?=$patient_name; ?>" class="form-control" autocomplete="off"/>
											<?php } ?>
									</div>
									<div class="col-md-3">
										<label for="phone"><?php echo $this->lang->line('mobile');?></label>
										<?php if(isset($visit_id) && $visit_id != 0)
												{ ?>
												<input type="text" name="phone_number" id="phone_number" value="<?=$phone_number; ?>" class="form-control" readonly autocomplete="off"/>
											<?php	}else { ?>
												<input type="text" name="phone_number" id="phone_number" value="<?=$phone_number; ?>" class="form-control" autocomplete="off"/>
											<?php } ?>
									</div>
									<div class="col-md-3">
										<label for="ssn_id"><?php echo $this->lang->line('ssn_id');?></label>
										<?php if(isset($visit_id) && $visit_id != 0){ ?>
											<input type="text" name="ssn_id" id="ssn_id" value="<?=$ssn_id; ?>" class="form-control" readonly autocomplete="off"/>
											<?php }else { ?>
												<input type="text" name="ssn_id" id="ssn_id" value="<?=$ssn_id; ?>" class="form-control" autocomplete="off"/>
											<?php } ?>
									</div>
								</div>
								<?php echo form_error('patient_id','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>&nbsp;
						<div class="row">
							<div class="form-group col-md-6">
								<label for="patient_name"><?php echo $this->lang->line("doctor");?></label>
								<?php if(isset($visit_id) && $visit_id != 0){
										$doctor_id=$doctor['doctor_id'];?>
										<input type="text" name="doctor_name" id="doctor_name" value="<?=$doctor_name; ?>" class="form-control" readonly autocomplete="off"/>
										<input type="hidden" name="doctor_id" id="doctor_id" value="<?= $doctor_id ?>"/>
										<input type="hidden" name="doctor_department" id="doctor_department" value="<?=$doctor_department;?>" />
									<?php	}else { ?>
										<input type="text" name="doctor_name" id="doctor_name" value="<?=$doctor_name; ?>" class="form-control" autocomplete="off"/>
										<input type="hidden" name="doctor_id" id="doctor_id" value="<?= @$doctor_id ?>"/>
										<input type="hidden" name="doctor_department" id="doctor_department" value="<?=$doctor_department;?>" />
									<?php } ?>
								<input type="hidden" name="appointment_id" id="appointment_id" value="<?=@$appointment_id ?>"/>
								<?php echo form_error('doctor_id','<div class="alert alert-danger">','</div>'); ?>
							</div>
						</div>
					
					<div class="row">
						<div class="form-group col-md-6">
							<label for="bill_date"><?php echo $this->lang->line("date");?></label>
							<?php if(isset($visit_id) && $visit_id != 0){
									?>
									<input type="text" name="bill_date" id="" value="<?=$bill_date; ?>" class="form-control" readonly autocomplete="off"/>
								<?php	}else { ?>
									<input type="text" name="bill_date" id="bill_date" value="<?=$bill_date; ?>" class="form-control" autocomplete="off"/>
								<?php } ?>
						<?php echo form_error('bill_date','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="form-group col-md-6">
							<label for="bill_time"><?php echo $this->lang->line("time");?></label>
							<?php if(isset($visit_id) && $visit_id != 0)
									{ ?>
									<input type="text" name="bill_time" id="" value="<?=$bill_time; ?>" class="form-control" readonly autocomplete="off"/>
								<?php	}else { ?>
									<input type="text" name="bill_time" id="bill_time" value="<?=$bill_time; ?>" class="form-control" autocomplete="off"/>
								<?php } ?>
						<?php echo form_error('bill_time','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
				</div>
			</div>
		
			<div class="table-responsive-60">
					<div class="row" style="padding-left:3px;">
						<a href="#" class="btn square-btn-adjust btn-primary btn-sm" data-toggle="modal" data-target="#myModalParticular"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add')." ".$this->lang->line('particular');?></a>
						<div class="modal fade" id="myModalParticular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add')." ".$this->lang->line('particular');?></h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<div class="form-group row" style="padding-left:10px;">
											<div class="col-md-12">
													<label><?php echo $this->lang->line("particular");?></label>
													<input type="hidden" name="action" value="particular">
													<input name="particular" id="particular" class="form-control" value="" autocomplete="off"/>
											</div>
											<div class="col-md-12">
													<label><?php echo $this->lang->line("amount");?></label>
													<input type="text" name="particular_amount" id="particular_amount" class="form-control" id="amount" autocomplete="off"/>
											</div>
											<?php if($tax_type == "item"){?>
												<div class="col-md-12">
													<label><?php echo $this->lang->line("tax");?></label>
													<select name="tax_id" class="form-control" id="bill_tax_rate">
														<?php foreach($tax_rates as $tax_rate){?>
															<option tax_rate="<?=$tax_rate['tax_rate'];?>" value="<?=$tax_rate['tax_id'];?>"><?=$tax_rate['tax_rate_name'];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-md-12">
													<label><?php echo $this->lang->line("rate");?></label>
													<input type="text" style="text-align:right;" name="tax_amount" id="bill_tax_amount" class="form-control" readonly autocomplete="off"/>
												</div>
											<?php } ?>
										</div>
									</div>							
									<div class="modal-footer">
									<button class="btn btn-primary square-btn-adjust btn-sm" type="submit" name="submit" value="particular" /><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line("add");?></button>
										<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
									</div>
								</div>
							</div>
						</div>
						<?php if (in_array("stock",$active_modules)) { ?>
							&nbsp;
							<a href="#" class="btn square-btn-adjust btn-primary btn-sm" data-toggle="modal" data-target="#myModalStock"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add')." ".$this->lang->line('stock')." ".$this->lang->line('item');?></a>
							<div class="modal fade" id="myModalStock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content">

										<div class="modal-header">
											<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add')." ".$this->lang->line('item');?></h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<div class="form-group row" style="padding-left:10px;">
												<div class="col-md-12">
												<label><?php echo $this->lang->line("item");?></label>
													<input type="hidden" name="action" value="item">
													<input type="hidden" name="item_id" id="item_id" value="">
													<input name="item_name" id="item_name" class="form-control" value="" autocomplete="off"/>
												</div>
												<div class="col-md-12">
												<label><?php echo $this->lang->line("quantity");?></label>
														<input type="text" name="item_quantity" id="item_quantity" class="form-control" autocomplete="off" />
													<small><?php echo $this->lang->line("available_quantity");?> <span id="available_quantity"></span></small>
												</div>				
												<div class="col-md-12">
												<label><?php echo $this->lang->line("amount");?></label>
													<input type="text" name="item_amount" id="item_amount" class="form-control" autocomplete="off"/>
												</div>
												<?php if($tax_type == "item"){?>
													<div class="col-md-12">
													<label><?php echo $this->lang->line("tax");?></label>
														<select name="item_tax_id" class="form-control" id="item_tax_rate">
															<?php foreach($tax_rates as $tax_rate){?>
																<option tax_rate="<?=$tax_rate['tax_rate'];?>" value="<?=$tax_rate['tax_id'];?>"><?=$tax_rate['tax_rate_name'];?></option>
															<?php } ?>
														</select>
													</div>
													<div class="col-md-12">
													<label><?php echo $this->lang->line("rate");?></label>
														<input type="text" style="text-align:right;" name="item_tax_rate" id="item_tax_amount" class="form-control" readonly  autocomplete="off"/>
													</div>
												<?php } ?>
												
											</div>
										</div>							
										<div class="modal-footer">
											<button class="btn btn-primary square-btn-adjust btn-sm" type="submit" name="submit" value="item" /><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line("add");?></button>
											<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
										</div>
									</div>
								</div>
							</div>
						<?php }?>
						<?php if (in_array("doctor",$active_modules)) {?>
							<div class="row" id="fees_section">
									&nbsp;
									<a href="#" class="btn square-btn-adjust btn-primary btn-sm" data-toggle="modal" data-target="#myModalFees"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add')." ".$this->lang->line('fees');?></a>
									<div class="modal fade" id="myModalFees" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add')." ".$this->lang->line('fees');?></h4>
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												</div>
												<div class="modal-body">
													<div class="form-group row" style="padding-left:10px;">
														<div class="col-md-12">
														<label><?php echo $this->lang->line("fees");?></label>
															<input type="hidden" name="action" value="fees">
															<input name="fees_detail" id="fees_detail" class="form-control" value="" autocomplete="off"/>
														</div>
														<div class="col-md-12">
														<label><?php echo $this->lang->line("amount");?></label>
															<input type="text" name="fees_amount" id="fees_amount" class="form-control" id="amount" autocomplete="off"/>
														</div>
														<?php if($tax_type == "item"){?>
												<div class="col-md-12">
													<label><?php echo $this->lang->line("tax");?></label>
													<select name="tax_id" class="form-control" id="fees_tax_rate">
														<?php foreach($tax_rates as $tax_rate){?>
															<option tax_rate="<?=$tax_rate['tax_rate'];?>" value="<?=$tax_rate['tax_id'];?>"><?=$tax_rate['tax_rate_name'];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-md-12">
													<label><?php echo $this->lang->line("rate");?></label>
													<input type="text" style="text-align:right;" name="tax_amount" id="fees_tax_amount" class="form-control" readonly autocomplete="off"/>
												</div>
											<?php } ?>
													</div>
												</div>							
												<div class="modal-footer">
												<button class="btn btn-primary  square-btn-adjust btn-sm" type="submit" name="submit" value="fees" /><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line("add");?></button>
													<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
												</div>
											</div>
										</div>
									</div>
							</div>
						<?php }?>
						<?php if (in_array("treatment",$active_modules)) {?>
								&nbsp;
								<a href="#" class="btn square-btn-adjust btn-primary btn-sm" data-toggle="modal" data-target="#myModalTreatment"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add')." ".$this->lang->line('treatment');?></a>
								<div class="modal fade" id="myModalTreatment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add')." ".$this->lang->line('treatment');?></h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											</div>
											<div class="modal-body">
												<div class="form-group row" style="padding-left:10px;">
													<div class="col-md-12">
													<label><?php echo $this->lang->line("treatment");?></label>
														<input type="hidden" name="action" value="treatment">
														<input name="treatment" id="treatment" class="form-control" value="" autocomplete="off"/>
													</div>
													<div class="col-md-12">
													<label><?php echo $this->lang->line("amount");?></label>
														<input type="text" name="treatment_price" id="treatment_price" class="form-control" autocomplete="off"/>
													</div>
													<?php if($tax_type == "item"){ ?>
														<!--<div class="col-md-12">
															<?php echo $this->lang->line("tax_rate_name");?>
															<input type="text" name="treatment_rate_name" readonly id="treatment_rate_name" class="form-control" />
														</div>
														<div class="col-md-12">
															<?php echo $this->lang->line("rate");?>
															<input type="text" style="text-align:right;" name="treatment_rate" id="treatment_rate" readonly class="form-control"  />
														</div>--> 
														<div class="col-md-12">
															<?php echo $this->lang->line("tax");?>
															
															<input type="text" name="treatment_rate_name_value" id="treatment_rate_name_value" class="form-control" autocomplete="off" readonly/>
															<input type="hidden" name="treatment_rate_name" id="treatment_rate_name" class="form-control" autocomplete="off"/>
															<!--<select name="treatment_rate_name" class="form-control" id="treatment_rate_name">
																<?php //foreach($tax_rates as $tax_rate){?>
																	<option tax_rate="<?=$tax_rate['tax_rate'];?>" value="<?=$tax_rate['tax_id'];?>"><?=$tax_rate['tax_rate_name'];?></option>
																<?php //} ?>
															</select>-->
														</div>
														<div class="col-md-12">
															<?php echo $this->lang->line("rate");?>
															<input type="text" style="text-align:right;" name="treatment_rate" id="treatment_rate" class="form-control" readonly />
														</div>
														<?php 
													} ?>
												</div>
											</div>							
											<div class="modal-footer">
												<button class="btn btn-primary square-btn-adjust btn-sm" type="submit" name="submit" value="treatment" /><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line("add");?></button>
												<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
											</div>
										</div>
									</div>
								</div>
						<?php }?>
						<?php if (in_array("lab",$active_modules)) {?>
								&nbsp;
								<a href="#" class="btn square-btn-adjust btn-primary btn-sm" data-toggle="modal" data-target="#myModalLab"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add')." ".$this->lang->line('lab_test');?></a>
								<div class="modal fade" id="myModalLab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add')." ".$this->lang->line('lab_test');?></h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											</div>
											<div class="modal-body">
												<div class="form-group row" style="padding-left:10px;">
													<div class="col-md-12">
													<label><?php echo $this->lang->line("lab_test");?></label>
														<input type="hidden" name="action" value="lab_test">
														<input type="hidden" id="lab_test_id" name="lab_test_id" class="form-control" value=""/>
														<input name="lab_test" id="lab_test" class="form-control" value="" autocomplete="off"/>	
													</div>
													<div class="col-md-12">
													<label><?php echo $this->lang->line("amount");?></label>
														<input type="text" name="test_price" id="test_price" class="form-control" autocomplete="off"/>
													</div>
													<?php if($tax_type == "item"){ ?>
														<div class="col-md-12">
															<?php echo $this->lang->line("tax");?>
															<input type="text" name="lab_rate_name_value" id="lab_rate_name_value" class="form-control" autocomplete="off" readonly/>
															<input type="hidden" name="lab_rate_name" id="lab_rate_name" class="form-control" autocomplete="off"/>
														</div>
														<div class="col-md-12">
															<?php echo $this->lang->line("rate");?>
															<input type="text" style="text-align:right;" name="lab_rate" id="lab_rate" class="form-control" readonly />
														</div>
														<?php 
													} ?>
												</div>
											</div>							
											<div class="modal-footer">
												<button class="btn btn-primary square-btn-adjust btn-sm" type="submit" name="submit" value="lab_test" /><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line("add");?></button>
												<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
											</div>
										</div>
									</div>
								</div>
						<?php } ?>
						&nbsp;
						<a href="#" class="btn square-btn-adjust btn-primary btn-sm" data-toggle="modal" data-target="#myModalDiscount"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add')." ".$this->lang->line('discount');?></a>
						<div class="modal fade" id="myModalDiscount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add')." ".$this->lang->line('discount');?></h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<div class="form-group row" style="padding-left:10px;">
												<div class="col-md-12">
												<label><?php echo $this->lang->line("discount");?></label>
													<input name="discount" id="discount" class="form-control" value="" autocomplete="off"/>
												</div>
												<div class="col-md-12">
												<?php if (in_array("doctor", $active_modules)) { ?>
													<label><?php echo $this->lang->line("foc");?></label>
													<input type="checkbox" name="foc" id="foc" class="form-control" value="" autocomplete="off"/>
												<?php } ?>
												</div>
											</div>
										</div>							
										<div class="modal-footer">
											<button class="btn btn-primary square-btn-adjust btn-sm" type="submit" name="submit" value="discount" /><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line("add");?></button>
											<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
										</div>
									</div>
								</div>
						</div>		
						<?php if($tax_type == "bill"){?>
								&nbsp;
								<a href="#" class="btn square-btn-adjust btn-primary btn-sm" data-toggle="modal" data-target="#myModalTax"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add')." ".$this->lang->line('tax');?></a>
								<div class="modal fade" id="myModalTax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add')." ".$this->lang->line('tax');?></h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											</div>
											<div class="modal-body">
												<div class="form-group row" style="padding-left:10px;">
													<div class="col-md-12">
													<label><?php echo $this->lang->line("tax");?></label>
														<select name="bill_tax_rate" class="form-control" id="bill_tax_rate">
															<?php foreach($tax_rates as $tax_rate){?>
																	<option value="<?=$tax_rate['tax_id'];?>" tax_rate="<?=$tax_rate['tax_rate'];?>"><?=$tax_rate['tax_rate_name'];?></option>
																<?php 	
															} ?>
														</select>
													</div>
													<div class="col-md-12">
													<label><?php echo $this->lang->line("percentage");?></label>
														<input type="text" style="text-align:right;" name="bill_tax_amount" id="bill_tax_amount" class="form-control" readonly  autocomplete="off"/>
													</div>
												</div>
											</div>							
											<div class="modal-footer">
												<button class="btn btn-primary square-btn-adjust btn-sm" type="submit" name="submit" value="tax" /><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line("add");?></button>
												<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
											</div>
										</div>
									</div>
								</div>		
						<?php } ?>
					</div> </br>
				<?php echo form_close(); ?>
			</div>
			<div class="panel-body table-responsive-25">
				<?php $this->load->view('bill/bill_table'); ?>
			</div>
		</div>
	</div>
</div>