<html>
<head>
<style>
	label{font-weight:bold;margin-right:10px;}
	.form-control{border:none; border-bottom: 1px solid #ccc; border-radius:0px;box-shadow:none;}
	@media print {
			.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11,.col-md-12{
				float:left;
			}
		 .col-md-12 {
			width: 100%;
		  }
		  .col-md-11 {
			width: 91.66666667%;
		  }
		  .col-md-10 {
			width: 83.33333333%;
		  }
		  .col-md-9 {
			width: 75%;
		  }
		  .col-md-8 {
			width: 66.66666667%;
		  }
		  .col-md-7 {
			width: 58.33333333%;
		  }
		  .col-md-6 {
			width: 50%;
		  }
		  .col-md-5 {
			width: 41.66666667%;
		  }
		  .col-md-4 {
			width: 33.33333333%;
		  }
		  .col-md-3 {
			width: 25%;
		  }
		  .col-md-2 {
			width: 16.66666667%;
		  }
		  .col-md-1 {
			width: 8.33333333%;
		  }
		 .td_width {
			 width:20%;
		 }
	}
		
	.table-bordered{
		border-collapse:collapse;
	}
	.table-bordered > thead > tr > th,
	.table-bordered > tbody > tr > th,
	.table-bordered > tfoot > tr > th,
	.table-bordered > thead > tr > td,
	.table-bordered > tbody > tr > td,
	.table-bordered > tfoot > tr > td{
		border:1px solid #ddd;
	}
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td{
		padding:8px;
		line-height:1.42857143;
		vertical-align:top;
	}	
</style>
</head>

<body onload="window.print();">
<div id="page-inner">
<div class="row">
		<div class="col-md-12" style="border-bottom:1px;">
			<div class="col-md-3" style="text-align:center;"><br/>
				<div class="row">
					<div class="col-md-12">
					<!--address style="border:solid 1px black; border-radius: 25px;"--> 
						<address style="text-align:center;font-style: normal;"> 
							<h3 style="text-align: left;"><?=$clinic['clinic_name']?></h3>
							<h5 style="text-align: left;"><?=$clinic['tag_line']?></h5>
							<p style="text-align: left;"><?=$clinic['clinic_address']?></p>
							<p style="text-align: left;">
								<strong style="line-height: 1.42857143;"><?php echo $this->lang->line("landline") ;?> : </strong>
								<span style="line-height: 1.42857143;"><?=$clinic['landline']?></span>
								<strong style="line-height: 1.42857143;"><?php echo $this->lang->line("mobile_no") ;?> : </strong>
								<span style="line-height: 1.42857143;"><?=$clinic['mobile']?></span>
								<strong style="line-height: 1.42857143;"><?php echo $this->lang->line("email") ;?> : </strong>
								<span style="text-align: center;"><?=$clinic['email']?></span>
							</p>
						</address> 
					</div>
				</div>
			</div>
			
			<div class="col-md-6"><br/><br/>
				<center><h1 style=""><?php echo $this->lang->line("medical")." ".$this->lang->line("history") ;?> </h1></center>
			</div>
			<div class="col-md-3"></div>
		
		</div>	<hr>
		<div class="col-md-12">
			<br/>
			<table width="100%">
			<tr>
			<td>
			<div class="col-md-6">
				<div class="col-md-12">
					<span> <strong><?php echo $this->lang->line("patient")." ".$this->lang->line("name") ;?> : </strong><?php echo $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name']; ?></span>
				</div>
				<div class="col-md-12">
					<span> <strong><?php echo $this->lang->line("mobile_no") ;?> : </strong><?php echo $patient['phone_number']?></span>
				</div>
				<div class="col-md-12">
					<span> <strong><?php echo $this->lang->line("gender") ;?> : </strong><?php echo $patient['gender']?> </span>
				</div>
				<div class="col-md-12">
					<span> <strong><?php echo $this->lang->line("dob") ;?> : </strong><?php echo $patient['dob']?> </span>
				</div>
			</div>
			</td>
			<td>
			<div class="col-md-6">
				<div class="col-md-12">
					<span> <strong><?php echo $this->lang->line("patient")." ".$this->lang->line("address") ;?> : </strong><?php echo $contact['address_line_1'] . " " . $contact['address_line_2'] . " " . $contact['area']." " . $contact['city']; ?></span>
				</div>
				<div class="col-md-12">
					<span> <strong><?php echo $this->lang->line("email") ;?>  : </strong><?php echo $patient['email']?> </span>
				</div>
				<div class="col-md-12">
					<span> <strong><?php echo $this->lang->line("age") ;?> : </strong><?php echo $patient['age']?> </span>
				</div>
				<div class="col-md-12">
					<span> <strong><?=$this->lang->line("ssn_id")?> : </strong><?php echo $patient['ssn_id']?> </span>
				</div>
			</div>
			</td>
			</tr>
			</table>
		</div>
		<hr>
		<?php if (in_array("history", $active_modules)) { 
			if (file_exists(APPPATH."modules/history/views/show_display_functions".EXT)){
					$this->load->view('history/show_display_functions');
				?>
				<div class="col-md-12"> 
					<?php 
						//$file_display['display_file']=FALSE;
						$d['display_file']='FALSE';
						$this->load->view('history/show_patient_details_fields',$d);
					 ?>
				</div>
			<?php }
		} ?>
	
					
			
	
	<div class="col-md-12">		
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="bill_table" width="100%">
				<thead>
					<tr>
						<th  width="160px"><?php echo $this->lang->line("visit")." ".$this->lang->line("date")." & ".$this->lang->line("time");?></th>
						<th  width="160px"><?php echo $this->lang->line("doctor") . ' ' . $this->lang->line("name");?></th>
						<th><?php echo $this->lang->line("notes");?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					
						if(isset($visits)){
							$i=0;
							$j=1;
							foreach ($visits as $visit) { ?>
							<tr>
								<td><?php echo  date($def_dateformate,strtotime($visit['visit_date']))." ".date($def_timeformate, strtotime($visit['visit_time']));?></td>
								<td><?php echo $visit['name']; ?></td>
								<td><?php echo $visit['notes']; ?>
									<?php if (in_array("prescription", $active_modules)) { ?>
										<br/><strong>Pateint Notes : </strong><?php echo $visit['patient_notes']; ?>
										<br/><strong>Medicines : </strong>
										<?php	
											echo implode(",",$medicine_name[$i]);
											//if((sizeof($medicine_name)>0)&&($j<sizeof($medicine_name))){echo implode(",",$medicine_name[$j]);}?>

											
									<?php }?>
									<?php if (in_array("treatment", $active_modules)) {
											$treatment="";
										?>
										<br/><strong><?=$this->lang->line("treatment")?> : </strong>
										<?php foreach ($visit_treatments as $visit_treatment) {
													if ($visit_treatment['visit_id'] == $visit['visit_id'] && $visit_treatment['type'] == 'treatment') {
															$treatment=$treatment.",". $visit_treatment['particular'];
														}
													}
													echo substr($treatment,1);
												}
										?>

										<?php if (in_array("lab", $active_modules)) {
												echo "<br/><strong>Lab Tests :</strong> ";
												$labtestvalue="";
													if(isset($visit_lab_tests)){
														foreach ($visit_lab_tests as $visit_lab_test) {
															if ($visit_lab_test['visit_id'] == $visit['visit_id']) {
																//echo $lab_test_name[$visit_lab_test['test_id']];
																	$labtestvalue=$labtestvalue.",". $lab_test_name[$visit_lab_test['test_id']];
																
															}
															
														}
														echo substr($labtestvalue,1);
													}
												}
													?>
													<?php if (in_array("history", $active_modules)) { 
															if (file_exists(APPPATH."modules/history/views/show_display_fields".EXT)){
																$d['i']=$i;
																$d['display_file']='FALSE';
																$this->load->view('history/show_display_fields',$d);
															}
													 } ?>
								</td>
							</tr>
							<?php $i++;
							 $j++;
							}
						}
						?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
</body>
</html>