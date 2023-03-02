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
$( window ).load(function() {

    $("#appointments").dataTable({
		"pageLength": 10,
		 "order": [[ 0, "desc" ]]
	});
	$("#payments").dataTable({
		"pageLength": 10,
		 "order": [[ 0, "desc" ]]
	});

});
</script>
			<!----start-content----->
			<div class="content">
				<div class="wrap">
					<!---start-contact---->
					<div class="contact">
						<?php if($logged_in){ ?>
							<div class="book_appointment">
								<div class="services">
									<div class="section group">
										<?php if($enable_online_appointment){?>
										<div class="service-content grid_1_of_4 images_1_of_4 contact-form">
											<a href="<?=site_url('frontend/book_my_appointment');?>" class="make_appointment_button"><?php echo $this->lang->line('book').' '.$this->lang->line('appointment');?></a>
										</div>
										<?php }?>
										<div class="service-content grid_1_of_4 images_1_of_4 contact-form">
											<h4>Appointment History</h4>
										</div>
										<div class="grid_4_of_4 contact-form">
											<table class="book_appointment_calendar" id="appointments">
												<thead>
													<tr>
														<th style="width:80px;">Date</th>
														<th style="width:130px;">Time</th>
														<th>Patient Name</th>
														<th>Doctor</th>
														<th>Reason</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($appointments as $appointment) {?>
													<tr>
														<td><?=$appointment['appointment_date'];?></td>
														<td><?=$appointment['start_time'];?> - <?=$appointment['end_time'];?></td>
														<td><?=$patients[$appointment['patient_id']];?></td>
														<td><?=$doctors[$appointment['doctor_id']];?></td>
														<td><?=$appointment['appointment_reason'];?></td>
														<td><?=$appointment['status'];?></td>
														<td>
															<?php if($appointment['status'] == "Complete"){ ?>
															<a class="btn btn-info" href="<?=site_url('frontend/appointment_detail/'.$appointment['appointment_id']);?>" class="">Details</a>
															<?php } ?>
															<?php if($appointment['status'] == "Pending" || $appointment['status'] == "Appointments"){ ?>
														    <a class="btn btn-danger" href="<?=site_url('frontend/cancel_appointment/'.$appointment['appointment_id']);?>">Cancel</a></td>
															<?php } ?>
													</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
										<div class="service-content grid_1_of_4 images_1_of_4 contact-form">
											<h4>Payment History</h4>
										</div>
										<div class="grid_4_of_4 contact-form">
											<table class="book_appointment_calendar" id="payments">
												<thead>
													<tr>
														<th>Date</th>
														<th>Patient Name</th>
														<th>Amount</th>
														<th>Payment Mode</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($payments as $payment) {?>
													<tr>
														<td style="text-align:right;"><?=date($def_dateformate,strtotime($payment['pay_date']));?></td>
														<td><?=$patients[$payment['patient_id']];?></td>
														<td style="text-align:right;"><?=currency_format($payment['pay_amount']); ?><?php if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
														<td><?php echo ucfirst($payment['pay_mode']); ?><?php if($payment['pay_mode'] == "cheque") {echo "  ( ".$payment['cheque_no']." )";} ?></td>
													</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						<?php }else{ ?>
							<div class="book_appointment">
								<?php if(isset($message_from) && $message_from == "main") { echo "<div class='alert alert-info'>".urldecode ( $message )."</div>";} ?>
								<div class="services">
									<div class="section group">
										<div class="service-content grid_1_of_4 images_1_of_4 contact-form">
											<h4><?php echo $this->lang->line('new') . ' ' . $this->lang->line('registration');?></h4>
											<?php echo form_open('frontend/register_user') ?>
												<?php if(isset($message_from) && $message_from == "register_user") { echo "<div class='alert alert-info'>".urldecode ( $message )."</div>";} ?>
												<label><?php echo $this->lang->line('name');?></label>
												<input type="text" id="first_name" name="first_name" placeholder="<?php echo $this->lang->line('first_name');?>"/>
												<?php echo form_error('first_name','<div class="alert alert-danger">','</div>'); ?>
												<input type="text" id="middle_name" name="middle_name" placeholder="<?php echo $this->lang->line('middle_name');?>"/>
												<?php echo form_error('middle_name','<div class="alert alert-danger">','</div>'); ?>
												<input type="text" id="last_name" name="last_name" placeholder="<?php echo $this->lang->line('last_name');?>"/>
												<?php echo form_error('last_name','<div class="alert alert-danger">','</div>'); ?>
												<label><?php echo $this->lang->line('email');?></label>
												<input type="text" id="email" name="register_email" placeholder="<?php echo $this->lang->line('email');?>"/>
												<?php echo form_error('register_email','<div class="alert alert-danger">','</div>'); ?>
												<label><?php echo $this->lang->line('password');?></label>
												<input type="password" id="password" name="register_password" placeholder="<?php echo $this->lang->line('password');?>"/>
												<?php echo form_error('register_password','<div class="alert alert-danger">','</div>'); ?>

												<button type="submit" name="submit" class="make_appointment_button"><?php echo $this->lang->line('register');?></button>

											<?php echo form_close(); ?>
										</div>
										<div class="services-sidebar grid_1_of_4 images_1_of_4 contact-form">
											<h4><?php echo $this->lang->line('login');?></h4>
											<?php echo form_open('frontend/login_user') ?>
												<?php if(isset($message_from) && $message_from == "login_user") { echo "<div class='alert alert-danger'>".$message."</div>";} ?>
												<label><?php echo $this->lang->line('email');?></label>
												<input type="text" id="login_email" name="login_email" placeholder="<?php echo $this->lang->line('email');?>"/>
												<?php echo form_error('login_email','<div class="alert alert-danger">','</div>'); ?>
												<label><?php echo $this->lang->line('password');?></label>
												<input type="password" id="login_password" name="login_password" placeholder="<?php echo $this->lang->line('password');?>"/>
												<?php echo form_error('login_password','<div class="alert alert-danger">','</div>'); ?>
												<button type="submit" name="submit" class="make_appointment_button"><?php echo $this->lang->line('login');?></button>
												<a href="<?=site_url('login/forgot_password');?>" class="make_appointment_button"><?php echo $this->lang->line('forgot_password');?></a>
											<?php echo form_close(); ?>
										</div>
									</div>
								</div>
								<div class="services">
									<div class="service-content grid_1_of_4 images_1_of_4 contact-form">
										<h4><?php echo $this->lang->line('verify_email');?></h4>
										<?php echo form_open('frontend/verify_account_code');?>
											<?php if(isset($message_from) && $message_from == "verify_account_code") { echo "<div class='alert alert-info'>".urldecode ( $message )."</div>";} ?>
											<label><?php echo $this->lang->line('email');?></label>
											<input type="text" id="verify_email" name="verify_email" placeholder="<?php echo $this->lang->line('email');?>"/>
											<?php echo form_error('verify_email','<div class="alert alert-danger">','</div>'); ?>
											<label><?php echo $this->lang->line('verification_code');?></label>
											<input type="text" id="verification_code" name="verification_code" placeholder="<?php echo $this->lang->line('verification_code');?>"/>
											<?php echo form_error('verification_code','<div class="alert alert-danger">','</div>'); ?>
											<button type="submit" name="submit" class="make_appointment_button"><?php echo $this->lang->line('verify');?></button>
										<?php echo form_close();?>
									</div>
									<div class="services-sidebar grid_1_of_4 images_1_of_4 contact-form">
										<h4><?php echo $this->lang->line('resend_code');?></h4>
										<?php echo form_open('frontend/resend_code') ?>

											<label><?php echo $this->lang->line('email');?></label>
											<input type="text" id="email" name="email" placeholder="<?php echo $this->lang->line('email');?>"/>
											<?php echo form_error('email','<div class="alert alert-danger">','</div>'); ?>
											<button type="submit" name="submit" class="make_appointment_button"><?php echo $this->lang->line('resend_code');?></button>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>
							<?php } ?>
					</div>
					<!---End-contact---->
				<div class="clear"> </div>
				</div>
			<!----End-content----->
		</div>
		<!---End-wrap---->
