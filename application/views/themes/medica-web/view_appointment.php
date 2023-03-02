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
<?php
	if(isset($doctor)){
		$doctor_name = $doctor['name'];
	}
	if(isset($appointment)){
		//Edit Appointment
		$header = $this->lang->line("edit")." ".$this->lang->line("appointment");
		$patient_name = $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'];
		$title = $appointment['title'];
		$appointment_id = $appointment['appointment_id'];
		$start_time = $appointment['start_time'];
		$end_time = $appointment['end_time'];
		$appointment_date = $appointment['appointment_date'];
		$status = $appointment['status'];
		$appointment_id = $appointment['appointment_id'];
	}else{
		//Add Appointment
		$header = $this->lang->line("new")." ".$this->lang->line("appointment");
		$patient_name = "";
		$title = "";
		$time_interval =  $time_interval*60;
		$start_time = date($def_timeformate, strtotime($appointment_time));
		$end_time = date($def_timeformate, strtotime("+$time_interval minutes", strtotime($appointment_time)));

		$appointment_date = $appointment_date;
		$status = "Appointments";
	}
	$total = ($particular_total + $fees_total + $treatment_total + $item_total) - ((-1)*($balance));
?>


<div class="page-inner">
	<div class="wrap">

		<div class="col-md-12">
			<div class="appointment_detail grid_4_of_4 images_4_of_4">
				<h3>Appointment Details</h3>
			</div>
			<div class="panel panel-primary">
				<div class="panel-body">

					<div class="grid_1_of_3 images_1_of_3">
						<div class="col-md-4">
							<div class="form-group">
							<div class="book_appointment">
								<label><?php echo $this->lang->line('patient_name');?>:</label>
								</div>
								<span><?=$patient['first_name'].' '.$patient['middle_name'] .' '.$patient['last_name'];?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<div class="book_appointment">
								<label><?php echo $this->lang->line('doctor_name');?>:</label>
								</div>
								<span><?=$doctor['name'];?></span>
							</div>
						</div>
					</div>

					<div class="grid_1_of_3 images_1_of_3">
						<div class="col-md-4">
						<div class="book_appointment">
								<label><?php echo $this->lang->line('visit_date');?>& Time:&nbsp</label>
								</div>
								<span><?=date($def_dateformate,strtotime($visit['visit_date']));?>&nbsp<?=date($def_timeformate,strtotime($visit['visit_time']));?></span>
							</div>

						<div class="col-md-4">
							<div class="form-group">
							<div class="book_appointment">
								<label><?php echo $this->lang->line('visit_type');?>:&nbsp </label>
								</div>
								<span><?=$visit['type'];?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<div class="book_appointment">
								<label><?php echo $this->lang->line('reason');?> For Appointment:</label>
									</div>
									<span><?=$visit['appointment_reason'];?></span>
							</div>
						</div>
					</div>
					<div class="grid_1_of_3 images_1_of_3">
						<div class="col-md-12">
							<div class="form-group">
							<div class="book_appointment">
								<label><?php echo $this->lang->line('notes');?>:</label>
								</div>
								<span><?=$visit['patient_notes'];?></span>
							</div>
						</div>
					</div>
				</div>
				<?php if (in_array("prescription", $active_modules)) { ?>
				<div class="grid_1_of_3 images_1_of_3" style="width:100%;margin:0px;" >
					<div class="book_appointment">
						<h4 style="font-size:25px">Prescription</h4>
					</div>
					<div class="table-responsive">
						<table class="book_appointment_calendar" style="font-family:'Open Sans', sans-serif">
							<thead>
								<tr>
									<th>Medicine</th>
									<th>Frequency ( M - A - N )</th>
									<th>Days</th>
									<th>Instructions</th>
								</tr>
							</thead>
							<tbody>
							<?php if (!empty($prescriptions)) {  ?>
								<?php foreach($prescriptions as $prescription){ ?>
									<tr>
										<td><?=$prescription['medicine_id'] ?></td>
										<td><?=$prescription['freq_morning'] . "-" . $prescription['freq_afternoon'] . "-" . $prescription['freq_night'] ?></td>
										<td><?=$prescription['for_days'] ?></td>
										<td><?=$prescription['instructions'] ?></td>
									</tr>
								<?php } ?>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php } ?>
					<div class="grid_1_of_3 images_1_of_3" style="width:100%;margin:0px;" >
						<div class="col-md-12" >
						<div class="book_appointment">
							<h4 style="font-size:25px"><?php echo $this->lang->line('bill_details');?></h4></div>
						</div>
						<div style="margin-left:0px">
						<div class="grid_1_of_3 images_1_of_3">
							<div class="form-group">
							<div class="book_appointment">
								<label><?php echo $this->lang->line('bill_id');?>:</label>
								</div>
								<span><?=$bill['bill_id'];?></span>
							</div>

						</div>
						<div class="grid_1_of_3 images_1_of_3">
							<div class="form-group">
							<div class="book_appointment">
								<label><?php echo $this->lang->line('bill_date');?>:</label>
								</div>
								<span><?=date($def_dateformate,strtotime($bill['bill_date']));?></span>
							</div>
						</div>
						</div>
				</div>
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="book_appointment_calendar" style="font-family:'Open Sans', sans-serif">
									<thead>
										<tr>
											<th><span style="color: #FFF"><?php echo $this->lang->line('particular');?></span></th>
											<th><?php echo $this->lang->line('quantity');?></th>
											<th><?php echo $this->lang->line('mrp');?></th>
											<th><?php echo $this->lang->line('amount');?></th>
										</tr>
									</thead>
									<tbody>
										<?php if ($bill_details != NULL) {  ?>
											<?php $current_type=''; ?>
											<?php foreach($bill_details as $bill_detail){ ?>
											<?php 	if ($current_type=='') { ?>
											<?php		$current_type=$bill_detail['type']; ?>
											<?php	}elseif($current_type <> $bill_detail['type']){  ?>
											<tr>
												<?php if($current_type == "fees"){ ?>
													<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
													<th style="text-align:right;"><?=currency_format($fees_total);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
												<?php }elseif($current_type == "item"){ ?>
													<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
													<th style="text-align:right;"><?=currency_format($item_total);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
												<?php }elseif($current_type == "particular"){ ?>
													<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
													<th style="text-align:right;"><?=currency_format($particular_total);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
												<?php }elseif($current_type == "treatment"){ ?>
													<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
													<th style="text-align:right;"><?=currency_format($treatment_total);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
												<?php }elseif($current_type == "disount"){ ?>
													<!-- Do Nothing -->
												<?php } ?>
											</tr>
											<?php
												$current_type=$bill_detail['type'];
											}
											?>
											<?php if($current_type != "discount"){ ?>
												<tr>
													<td><?php echo $bill_detail['particular'] ?></td>
													<td style="text-align:right;"><?php echo $bill_detail['quantity'] ?></td>
													<td style="text-align:right;"><?php echo currency_format($bill_detail['mrp']);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
													<td style="text-align:right;"><?php echo currency_format($bill_detail['amount']);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
												</tr>
												<?php } ?>
											<?php } ?>
										<?php if($current_type == "fees"){ ?>
												<tr>
												<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
												<th style="text-align:right;"><?=currency_format($fees_total);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
												</tr>
											<?php }elseif($current_type == "item"){ ?>
												<tr>
												<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
												<th style="text-align:right;"><?=currency_format($item_total);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
												</tr>
											<?php }elseif($current_type == "particular"){ ?>
												<tr>
												<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
												<th style="text-align:right;"><?=currency_format($particular_total);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
												</tr>
											<?php }elseif($current_type == "treatment"){ ?>
												<tr>
												<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
												<th style="text-align:right;"><?=currency_format($treatment_total);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
												</tr>
											<?php }elseif($current_type == "discount"){ ?>
												<!-- Do Nothing -->
											<?php } ?>
											<tr class='total'>
												<th style="text-align:left;" colspan="3" ><?php echo $this->lang->line("total");?></th>
												<th style="text-align:right;"><?= currency_format($total);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
											</tr>
											<tr>
												<th style="text-align: left;" colspan="3" ><?php echo $this->lang->line("discount");?></th>
												<th style="text-align: right;"><?= currency_format($discount);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
											</tr>
											<tr>
												<th style="text-align: left;" colspan="3" ><?php echo $this->lang->line("to_be_paid");?></th>
												<th style="text-align: right;"><?= currency_format($total - $discount);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
											</tr>
											<tr>
												<th style="text-align: left;" colspan="3" ><?php echo $this->lang->line("amount_paid");?></th>
												<th style="text-align: right;"><?= currency_format($paid_amount);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>


			</div>
			</div>
			</div>
