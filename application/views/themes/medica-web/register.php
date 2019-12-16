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

	function inttotime12($tm,$time_format) {
		//if ($tm >= 13) {  $tm = $tm - 12; }
		$hr = intval($tm);
		$min = ($tm - intval($tm)) * 60;
		$format = '%02d:%02d';
		$time = sprintf($format, $hr, $min); //H:i
		$time = date($time_format, strtotime($time));
		return $time;
	}
?>

			<!----start-content----->
			<div class="content">
				<div class="clear"> </div>
				<div class="book_appointment">
				<div class="wrap">
					<div class="grid_4_of_4 columns red">
						<h4><?php echo $this->lang->line('appointment') .' '. $this->lang->line('detail');?></h4>
					</div>
					<div class="grid_4_of_4 contact-form">
						<?php
							if($verify){
								echo form_open('frontend/verify_code/'.$doctor_id.'/'.$book_date.'/'.$book_time.'/'.$appointment_reason);
							}else{
								echo form_open('frontend/process_payment');
							}	?>
							<div class="boxs">
								<div class="section group">
									<div class="grid_1_of_4 images_1_of_4">
										<label><?php echo $this->lang->line('doctor');?>:</label>
										<input type="hidden" name="doctor_id" id="doctor_id" value="<?=$doctor_id;?>" readonly />
										<input type="text" name="doctor" id="doctor" value="<?=$doctor['name'];?>" readonly />
									</div>
									<div class="grid_1_of_4 images_1_of_4">
									    <label><?php echo $this->lang->line('date');?>:</label>
										<input type="text" name="appointment_date" id="appointment_date" value="<?=$book_date;?>" readonly />
									</div>
									<div class="grid_1_of_4 images_1_of_4">
										<label><?php echo $this->lang->line('from_time');?>:</label>
										<input type="text" name="start_time" id="start_time" value="<?=inttotime12($book_time,$def_timeformate);?>" readonly />
									</div>
									<?php
										$time_interval = $clinic['time_interval'];
										$end_time = $book_time+$time_interval;
									?>
									<div class="grid_1_of_4 images_1_of_4">
										<label><?php echo $this->lang->line('to_time');?>:</label>
										<input type="text" name="end_time" id="end_time" value="<?=inttotime12($end_time,$def_timeformate);?>" readonly />
									</div>
								</div>
							</div>
							<div class="boxs">
								<div class="section group">
									<div class="grid_1_of_4 images_1_of_4">
										<label><?php echo $this->lang->line('appointment_reason');?>:</label>
										<input type="text" name="appointment_reason" id="appointment_reason" value="<?= urldecode ($appointment_reason);?>" readonly />
									</div>
									<div class="grid_1_of_4 images_1_of_4">
										<label><?php echo $this->lang->line('charges');?>:</label>
										<input type="text" name="charges" id="charges" value="<?=$charges;?>" readonly />
									</div>

							<?php
							if($verify){ ?>
							</div>
						</div>

						<div class="boxs">
							<div class="section group">
								<div class="grid_1_of_4 images_1_of_4">
										<label><?php echo $this->lang->line('verification_code');?>:</label>
										<input type="text" name="verification_code" id="verification_code" value="" />
										<?php echo form_error('verification_code','<div class="alert alert-danger">','</div>'); ?>
								</div>
								<div class="grid_1_of_4 images_1_of_4">
									<button type="submit" name="submit" class="make_appointment_button"><?php echo $this->lang->line('verify');?></button>
								</div>
							<?php }else{
							if($logged_in){
								if(count($patients) > 1){
									//print_r($patients);
									?>
									<div class="section group">
										<div class="grid_4_of_4 contact-form">
											<label><?php echo $this->lang->line('select_patient');?>:</label>

											<table class="Patient_detail">
												<thead>
													<tr>
														<th></th>
														<th><?php echo $this->lang->line('patient_id');?></th>
														<th><?php echo $this->lang->line('patient_name');?></th>
													<tr>
												</thead>
												<tbody>
													<?php  foreach ($patients as $patient) { ?>
													<tr>
														<td><input type="radio" name="patient_id" value="<?=$patient['patient_id'];?>"></td>
														<td><?php echo $patient['display_id']; ?></td>
														<td><?php echo $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name']; ?></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
									</div>
									</div>

									<div class="boxs">
									<div class="section group">
									<div class="grid_1_of_4 images_1_of_4">
										<?php if($enable_ccavenue){?>
											<?php
												//Unique Transaction Id
												$transaction_id = 1;
											?>
											<input type="hidden" name="tid" value="<?=$transaction_id;?>" />
											<input type="hidden" name="merchant_id" value="<?=$ccavenue_merchant_id;?>" />
											<button type="submit" name="submit" class="make_appointment_button">Pay & Book Appointment</button>
										<?php }else{ ?>
											<button type="submit" name="submit" class="make_appointment_button">Book Appointment</button>
										<?php } ?>
									</div>
							<?php }else{
									?>
									</div>
								</div>
								<div class="boxs">
									<div class="section group">
									<div class="grid_1_of_4 images_1_of_4">
										<label><?php echo $this->lang->line('patient');?>:</label>
										<input type="hidden" name="patient_id" id="patient_id" value="" readonly />
										<input type="text" name="patient_name" id="patient_name" value="<?=$user_name;?>" readonly />
									</div>
									<div class="grid_1_of_4 images_1_of_4">
										<button type="submit" name="submit" class="make_appointment_button"><?php echo $this->lang->line('book').' '.$this->lang->line('appointment');?></button>
									</div>
									<?php } ?>

							<?php } } ?>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			<div class="clear"> </div>
			<div class="wrap">
			<div class="services">
				<div class="section group">
				<?php if(!isset($_SESSION['id']) && !$verify){ ?>
				<div class="service-content grid_1_of_4 images_1_of_4 contact-form">
					<h4><?php echo $this->lang->line('new') . ' ' . $this->lang->line('registration');?></h4>
					<?php echo form_open('frontend/register_patient/'.$doctor_id.'/'.$book_date.'/'.$book_time.'/'.$appointment_reason) ?>

							<label><?php echo $this->lang->line('name');?></label>

							<input type="text" id="first_name" name="first_name" placeholder="First Name"/>
							<?php echo form_error('first_name','<div class="alert alert-danger">','</div>'); ?>
							<input type="text" id="middle_name" name="middle_name" placeholder="Middle Name"/>
							<?php echo form_error('middle_name','<div class="alert alert-danger">','</div>'); ?>
							<input type="text" id="last_name" name="last_name" placeholder="Last Name"/>
							<?php echo form_error('last_name','<div class="alert alert-danger">','</div>'); ?>

							<label><?php echo $this->lang->line('email');?></label>
							<input type="text" id="email" name="email" placeholder="Email-Id"/>
							<?php echo form_error('email','<div class="alert alert-danger">','</div>'); ?>

							<label><?php echo $this->lang->line('password');?></label>
							<input type="password" id="password" name="password" placeholder="Enter Password"/>
							<?php echo form_error('password','<div class="alert alert-danger">','</div>'); ?>

							<button type="submit" name="submit" class="make_appointment_button"><?php echo $this->lang->line('register');?></button>

					<?php echo form_close(); ?>
				</div>
				<div class="services-sidebar grid_1_of_4 images_1_of_4 contact-form">
					<h4><?php echo $this->lang->line('login');?></h4>
					<?php echo form_open('frontend/login_patient/'.$doctor_id.'/'.$book_date.'/'.$book_time.'/'.$appointment_reason) ?>
						<?php if($message_from == "login_patient") {?>
							<div class="alert alert-danger"><?=$message;?></div>
						<?php }?>
						<label><?php echo $this->lang->line('email');?></label>
						<input type="text" id="login_email" name="login_email" placeholder="Enter Email-id"/>
						<?php echo form_error('login_email','<div class="alert alert-danger">','</div>'); ?>
						<label><?php echo $this->lang->line('password');?></label>
						<input type="password" id="login_password" name="login_password" placeholder="Enter Password"/>
						<?php echo form_error('login_password','<div class="alert alert-danger">','</div>'); ?>
						<button type="submit" name="submit" class="make_appointment_button"><?php echo $this->lang->line('login');?></button>
					<?php echo form_close(); ?>
				</div>
				<?php } ?>
				</div>
			</div>
			</div>


			</div>

			<!----End-content----->
		</div>
		<!---End-wrap---->


		