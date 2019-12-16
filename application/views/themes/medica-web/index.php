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
	<!---start-images-slider---->
			<div class="image-slider">
						<!-- Slideshow 1 -->
					    <ul class="rslides rslides1" id="slider1" style="max-width: 2500px;">
						  <li id="rslides1_s0" class="" style="display: block; float: none; position: absolute; opacity: 0; z-index: 1; -webkit-transition: opacity 600ms ease-in-out; transition: opacity 600ms ease-in-out;">
					      	<img src="<?php echo base_url().'/application/views/themes/medica-web/images/'.$frontend_settings['slider_image1']; ?>" alt="">
					      	<div class="slider-info">
					      		<p><?=$frontend_settings['heading1'];?></p>
					      		<span><?=$frontend_settings['description1'];?></span>
					      		<a href="<?=$frontend_settings['btn_link1'];?>"><?=$frontend_settings['btn_text1'];?></a>
					      	</div>
					      </li>
					      <li id="rslides1_s1" class="" style="display: block; float: none; position: absolute; opacity: 0; z-index: 1; -webkit-transition: opacity 600ms ease-in-out; transition: opacity 600ms ease-in-out;">
					      	<img src="<?php echo base_url().'/application/views/themes/medica-web/images/'.$frontend_settings['slider_image2']; ?>" alt="">
					      	<div class="slider-info">
					      		<p><?=$frontend_settings['heading2'];?></p>
					      		<span><?=$frontend_settings['description2'];?></span>
					      		<a href="<?=$frontend_settings['btn_link2'];?>"><?=$frontend_settings['btn_text2'];?></a>
					      	</div>
					      </li>
					      <li id="rslides1_s2" class="" style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; -webkit-transition: opacity 600ms ease-in-out; transition: opacity 600ms ease-in-out;">
							<img src="<?php echo base_url().'/application/views/themes/medica-web/images/'.$frontend_settings['slider_image3']; ?>" alt="">
					      	<div class="slider-info">
					      		<p><?=$frontend_settings['heading3'];?></p>
					      		<span><?=$frontend_settings['description3'];?></span>
					      		<a href="<?=$frontend_settings['btn_link3'];?>"><?=$frontend_settings['btn_text3'];?></a>
					      	</div>
					      </li>
					    </ul>
						 <!-- Slideshow 1 -->
					</div>
			<!---End-images-slider---->
			<!----start-content----->
			<div class="content">
				<?php if($enable_online_appointment){?>
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
				<?php }?>
				<div class="clear"> </div>
				<div class="content-top-grids">
					<div class="wrap">
					<div class="boxs">
						<div class="grid_1_of_3 images_1_of_3">
							<div class="content-top-grid-header">
								<div class="content-top-grid-pic">
									<a href="<?=$frontend_settings['sec1linkurl1'];?>"><img src="<?=base_url();?>application/views/themes/medica-web/icons/<?=$frontend_settings['sec1icon1'];?>.png" title="image-name" /></a>
								</div>
								<div class="content-top-grid-title">
									<h3><?=$frontend_settings['sec1heading1'];?></h3>
								</div>
								<div class="clear"> </div>
							</div>
								<p><?=$frontend_settings['sec1desc1'];?></p>
								<a class="grid-button" href="<?=$frontend_settings['sec1linkurl1'];?>"><?=$frontend_settings['sec1linktext1'];?></a>
								<div class="clear"> </div>
						</div>
						<div class="grid_1_of_3 images_1_of_3">
							<div class="content-top-grid-header">
								<div class="content-top-grid-pic">
									<a href="#"><img src="<?=base_url();?>application/views/themes/medica-web/icons/<?=$frontend_settings['sec2icon1'];?>.png" title="image-name" /></a>
								</div>
								<div class="content-top-grid-title">
									<h3><?=$frontend_settings['sec2heading1'];?></h3>
								</div>
								<div class="clear"> </div>
							</div>
								<p><?=$frontend_settings['sec2desc1'];?></p>
								<a class="grid-button" href="<?=$frontend_settings['sec2linkurl1'];?>"><?=$frontend_settings['sec2linktext1'];?></a>
								<div class="clear"> </div>
						</div>
						<div class="grid_1_of_3 images_1_of_3">
							<div class="content-top-grid-header">
								<div class="content-top-grid-pic">
									<a href="<?=$frontend_settings['sec3linkurl1'];?>"><img src="<?=base_url();?>application/views/themes/medica-web/icons/<?=$frontend_settings['sec3icon1'];?>.png" title="image-name" /></a>
								</div>
								<div class="content-top-grid-title">
									<h3><?=$frontend_settings['sec3heading1'];?></h3>
								</div>
								<div class="clear"> </div>
							</div>
								<p><?=$frontend_settings['sec3desc1'];?></p>
								<a class="grid-button" href="<?=$frontend_settings['sec3linkurl1'];?>"><?=$frontend_settings['sec3linktext1'];?></a>
								<div class="clear"> </div>
						</div>
						<div class="clear"> </div>
					</div>
					</div>
				</div>
				<div class="clear"> </div>
				<div class="boxs">
					<div class="wrap">
						<div class="section group">
							<div class="grid_1_of_3 images_1_of_3">
								  <h3><?=$frontend_settings['bsec1heading'];?></h3>
								  <?=$frontend_settings['bsec1content'];?>
							</div>
							<div class="grid_1_of_3 images_1_of_3">
								  <h3><?=$frontend_settings['bsec2heading'];?></h3>
								  <?=$frontend_settings['bsec2content'];?>
							</div>
							<div class="grid_1_of_3 images_1_of_3">
								  <h3><?=$frontend_settings['bsec3heading'];?></h3>
								  <?=$frontend_settings['bsec3content'];?>
							</div>
						</div>
					</div>
					</div>
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
