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
	<!----start-content----->
			<div class="content">
				<div class="book_appointment">
					<div class="wrap">
						<div class="grid_4_of_4 columns red">
							<h4>Make an appointment</h4>
						</div>
						<div class="grid_4_of_4 contact-form">
							<?php echo form_open('frontend/book_appointment') ?>
								<div class="boxs">
								<div class="section group">
									<div class="grid_1_of_4 images_1_of_4">
										<label>Select Doctor</label>
										<select name="doctor">
										<?php
											foreach($doctors as $doctor){
												echo "<option value=".$doctor['doctor_id'].">".$doctor['name']."</option>";
											}
										?>
										</select>
									</div>
									<div class="grid_1_of_4 images_1_of_4">
										<label>Select Date</label>
										<input type="text" placeholder="Appointment Date" name="appointment_date" id="appointment_date">
										<?php echo form_error('appointment_date','<div class="alert alert-danger">','</div>'); ?>
									</div>
									<div class="grid_1_of_4 images_1_of_4">
										<label>Reason For Visit</label>
										<input type="text" placeholder="Reason For Visit" name="appointment_reason" id="appointment_reason">
										<?php echo form_error('appointment_reason','<div class="alert alert-danger">','</div>'); ?>
									</div>
									<div class="grid_1_of_4 images_1_of_4">
										<button type="submit" name="submit" class="make_appointment_button">Make Appointment</button>
									</div>
								</div>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				<div class="clear"> </div>
			<!----End-content----->
		</div>
		<!---End-wrap---->
<script type="text/javascript">

    $(window).load(function(){
		$('#appointment_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
		});
	});
</script>
