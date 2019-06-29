<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
		<!--------------------Payment Methods----------------->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('payment_methods');?>
			</div>
			<div class="panel-body">
				<a href="<?= site_url("settings/insert_payment_method/");?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("payment_method");?></a>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tax_rate_table">
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
										<a class="btn btn-primary btn-sm square-btn-adjust" href="<?=site_url('settings/edit_payment_method/'.$payment_method['payment_method_id']);?>"><?php echo $this->lang->line("edit");?></a>
										<a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?=site_url('settings/delete_payment_method/'.$payment_method['payment_method_id']);?>"><?php echo $this->lang->line("delete");?></a>
									</td>
								</tr>
								<?php $i++; ?>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-------------------------Tax Rates ------------------->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('tax_rates');?>
			</div>
			<div class="panel-body">
				<a href="<?= site_url("settings/insert_tax_rate/");?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("tax_rate");?></a>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="tax_rate_table">
						<thead>
							<tr>
								<th><?php echo $this->lang->line("id");?></th>
								<th><?php echo $this->lang->line("tax_rate")." ".$this->lang->line("name");?></th>
								<th><?php echo $this->lang->line("tax_rate")." ".$this->lang->line("percentage");?></th>
								<th><?php echo $this->lang->line("action");?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							<?php foreach($tax_rates as $tax_rate){ ?>
								<tr>
									<td><?=$i;?></td>
									<td><?=$tax_rate['tax_rate_name'];?></td>
									<td><?=$tax_rate['tax_rate'];?></td>
									<td>
										<a class="btn btn-primary btn-sm square-btn-adjust" href="<?=site_url('settings/edit_tax_rate/'.$tax_rate['tax_id']);?>">Edit</a>
										<a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?=site_url('settings/delete_tax_rate/'.$tax_rate['tax_id']);?>">Delete</a>
									</td>
								</tr>
								<?php $i++; ?>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-------------------------Reference By ------------------->
		<div class="panel panel-primary" >
			<div class="panel-heading" >
				<?php echo $this->lang->line('reference_by');?>
			</div>
			<div class="panel-body" >
					<a href="<?=site_url('settings/add_reference');?>" class="btn btn-primary btn-sm square-btn-adjust"><?php echo $this->lang->line("add_reference_by");?></a>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="patient_table">
							<thead>
								<tr>
									<th><?php echo $this->lang->line("option");?></th>
									<th><?php echo $this->lang->line("add_detail");?></th>
									<th><?php echo $this->lang->line("placeholder");?></th>
									<th><?php echo $this->lang->line("edit");?></th>
									<th><?php echo $this->lang->line("delete");?></th>
								</tr>	
							</thead>
							<tbody>
								<?php foreach($reference_by as $reference){?>
								<tr>
									<td><?=$reference['reference_option'];?></td>
									<td><?php if($reference['reference_add_option'] ==1) {echo "Yes";}else{echo "No";} ?></td>
									<td><?=$reference['placeholder'];?></td>
									<td><a class="btn btn-primary btn-sm square-btn-adjust" href="<?=site_url('settings/edit_reference/'.$reference['reference_id']);?>"><?php echo $this->lang->line("edit");?></a></td>
									<td><a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?=site_url('settings/delete_reference/'.$reference['reference_id']);?>"><?php echo $this->lang->line("delete");?></a></td>
								</tr>	
								<?php }?>
							</tbody>
						</table>
					</div>
			</div>
		</div>
		<!-------------------------Contact Details ----------------->
		<!--div class="panel panel-primary" >
			<div class="panel-heading" >
				<?php echo $this->lang->line('contact_details');?>
			</div>
			<div class="panel-body" >
					<a href="<?=site_url('settings/add_list_detail/contact_details');?>" class="btn btn-primary btn-sm square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("contact_details");?></a>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="patient_table">
							<thead>
								<tr>
									<th><?=$contact_details_list['list_col_1_label'];?></th>
									<th><?php echo $this->lang->line("edit");?></th>
									<th><?php echo $this->lang->line("delete");?></th>
								</tr>	
							</thead>
							<tbody>
								<?php foreach($contact_details as $contact_detail_type){?>
								<tr>
									<td><?=$contact_detail_type['list_col_1_value'];?></td>
									<td><a class="btn btn-primary btn-sm square-btn-adjust" href="<?=site_url('settings/edit_list_detail/'.$contact_detail_type['list_detail_id']);?>"><?php echo $this->lang->line("edit");?></a></td>
									<td><a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?=site_url('settings/delete_list_detail/'.$contact_detail_type['list_detail_id']);?>"><?php echo $this->lang->line("delete");?></a></td>
								</tr>	
								<?php }?>
							</tbody>
						</table>
					</div>
			</div>
		</div-->
		<!-------------------------Disease ------------------->
		<?php if (in_array("disease", $active_modules)){ ?>
		<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('diseases');?>
				</div>
				<div class="panel-body">
					<a title="<?php echo $this->lang->line("add")." ".$this->lang->line("disease");?>" href="<?php echo base_url()."index.php/disease/insert/" ?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("disease");?></a>
					
					
						<table class="table table-striped table-bordered table-hover dataTable no-footer" id="diseases" >
						<thead>
							<tr>
								<th><?php echo $this->lang->line('sr_no');?></th>
								<th><?php echo $this->lang->line('disease');?></th>
								<th><?php echo $this->lang->line('treatments');?></th>
								<th><?php echo $this->lang->line('edit');?></th>
								<th><?php echo $this->lang->line('delete');?></th>
							</tr>
						</thead>
						<?php if ($diseases) { ?>
						<tbody>
						<?php $i=1; $j=1;
						$tax_rate_name[0] = "";
						$tax_rate_array[0] = "0";
						?>
						<?php foreach ($diseases as $disease): ?>
						<tr <?php if ($i%2 == 0) { echo "class='even'"; } else {echo "class='odd'";}?> >
							<td><?php echo $j; ?></td>
							<td><?php echo $disease['disease_name']; ?></td>
							<?php $treatments = explode(",",$disease['treatments']); ?>
							<td><?php foreach($treatments as $treatment){ ?>
							<?php if(isset($treatment_name[$treatment])) { echo $treatment_name[$treatment].",";} ?>
							<?php } ?>
							</td>
							<td><a class="btn btn-primary btn-sm square-btn-adjust" href="<?php echo site_url("disease/edit/" . $disease['disease_id']); ?>"><?php echo $this->lang->line('edit');?></a></td>
							<td><a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?php echo site_url("disease/delete/" . $disease['disease_id']); ?>"><?php echo $this->lang->line('delete');?></a></td>
						</tr>
						<?php $i++; $j++;?>
						<?php endforeach ?>
					</tbody>
					<?php }else{ ?>
					<tbody>
						<tr><td colspan='4'>No Diseases added. Add a disease.</td></tr>
					</tbody>
					<?php } ?>			
				</table>
			</div>  
			
				
				
		</div>
		<?php } ?>
		<!-------------------------Treatments ------------------->
		<?php if (in_array("treatment", $active_modules)){ ?>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('treatments');?>
			</div>
			<div class="panel-body">
				<a href="<?= site_url("treatment/insert");?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("treatment");?></a>
				
				<table class="table table-striped table-bordered table-hover dataTable no-footer" id="treatments" >
					<thead>
						<tr>
							<th><?php echo $this->lang->line('no');?></th>
							<th><?php echo $this->lang->line('treatment_name');?></th>
							<th><?php echo $this->lang->line('treatment_charges');?></th>
							<th>Tax Rate Name</th>
							<th>Share Type</th>
							<th><?php echo $this->lang->line('edit');?></th>
							<th><?php echo $this->lang->line('delete');?></th>
						</tr>
					</thead>
					<tbody>
					<?php $i=1; $j=1;
						$tax_rate_name[0] = "";
						$tax_rate_array[0] = "0";
					?>
					<?php foreach ($treatments as $treatment):
						if( $treatment['tax_id'] != NULL){
							$tax_rate =" (". $tax_rate_array[$treatment['tax_id']]."%)";
							$tax_name = $tax_rate_name[$treatment['tax_id']];
						}else{
							$tax_rate = "";
							$tax_name = "";
						}
						if($treatment['share_type'] == 'percentage'){
							$share_amount = $treatment['share_amount'] . "%";
						}else{
							$share_amount = currency_format($treatment['share_amount']);
						}
					?>
					<tr <?php if ($i%2 == 0) { echo "class='even'"; } else {echo "class='odd'";}?> >
						<td><?php echo $j; ?></td>
						<td><?php echo $treatment['treatment']; ?></td>
						<td class="right"><?php echo currency_format($treatment['price']);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>                
						<td><?php echo $tax_name.$tax_rate; ?></td>
						<td><?php echo ucfirst($treatment['share_type']) . " : " .$share_amount; ?></td>
						<td><a class="btn btn-primary btn-sm square-btn-adjust" title="Visit" href="<?php echo site_url("treatment/edit_treatment/" . $treatment['id']); ?>"><?php echo $this->lang->line('edit');?></a></td>
						<td><a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" title="<?php echo $this->lang->line('delete_treatment')." : " . $treatment['treatment'] ?>" href="<?php echo site_url("treatment/delete_treatment/" . $treatment['id']); ?>"><?php echo $this->lang->line('delete');?></a></td>
					</tr>
					<?php $i++; $j++;?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	
	</div>
		<?php } ?>
		<!--------------------Medicines----------------------->
		<?php if (in_array("prescription", $active_modules)){ ?>
			<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('medicines');?>
			</div>
			<div class="panel-body">
				<a title="<?php echo $this->lang->line("add")." ".$this->lang->line("medicine");?>" href="<?php echo site_url("prescription/insert_medicine") ?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("medicine");?></a>
						
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="medicine_table">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('sr_no');?></th>
							<th><?php echo $this->lang->line('medicine');?></th>
							<th><?php echo $this->lang->line('edit');?></th>
							<th><?php echo $this->lang->line('delete');?></th>
						</tr>									
					</thead>
					<tbody>
					<?php $i=1; ?>
					<?php foreach ($medicines as $medicine): ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $medicine['medicine_name'] ?></td>
						<td><a class="btn btn-primary btn-sm square-btn-adjust" title="Edit" href="<?php echo site_url("prescription/edit_medicine/" . $medicine['medicine_id']); ?>"><?php echo $this->lang->line('edit');?></a></td>
						<td><a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" title="<?php echo  $this->lang->line('delete_item')." :" . $medicine['medicine_name']?>" href="<?php echo site_url("prescription/delete_medicine/" . $medicine['medicine_id']); ?>"><?php echo $this->lang->line('delete');?></a></td>
					</tr>
					 <?php $i++; ?>
					<?php endforeach ?>
					</tbody>
					
					</table>
				</div>
			</div>
			</div>
		<?php } ?>
		<!--------------------Tests----------------------->
		<?php if (in_array("lab", $active_modules)){ ?>
			<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('lab_tests');?>
			</div>
			<div class="panel-body">
				<a title="<?php echo $this->lang->line("add")." ".$this->lang->line("test");?>" href="<?php echo site_url("lab/insert_test") ?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("test");?></a>
						
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="test_table">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('sr_no');?></th>
							<th><?php echo $this->lang->line('test');?></th>
							<th><?php echo $this->lang->line('charges');?></th>
							<th><?php echo $this->lang->line('edit');?></th>
							<th><?php echo $this->lang->line('delete');?></th>
						</tr>									
					</thead>
					<tbody>
					<?php $i=1; ?>
					<?php foreach ($tests as $test): ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $test['test_name'] ?></td>
						<td><?php echo currency_format($test['test_charges']);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
						<td><a class="btn btn-primary btn-sm square-btn-adjust" href="<?php echo site_url("lab/edit_test/" . $test['test_id']); ?>"><?php echo $this->lang->line('edit');?></a></td>
						<td><a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?php echo site_url("lab/delete_test/" . $test['test_id']); ?>"><?php echo $this->lang->line('delete');?></a></td>
					</tr>
					 <?php $i++; ?>
					<?php endforeach ?>
					</tbody>
					
					</table>
				</div>
			</div>
			</div>
		<?php } ?>
		
	</div>
</div>	