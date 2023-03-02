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
<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?=$frontend_settings['page_title'];?></title>

		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?=base_url();?>application/views/themes/medica-web/css/responsiveslides.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="<?=base_url();?>application/views/themes/medica-web/js/responsiveslides.min.js"></script>
		<script src="<?=base_url();?>application/views/themes/medica-web/js/jquery.ultimate-burger-menu.js"></script>

		<!-- TimePicker SCRIPTS-->
		<script src="<?= base_url() ?>assets/js/jquery.datetimepicker.js"></script>
		<link href="<?= base_url() ?>assets/js/jquery.datetimepicker.css" rel="stylesheet" />
		<link href="<?= base_url() ?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
		<script src="<?= base_url() ?>assets/js/dataTables/jquery.dataTables.js"></script>
		<script src="<?= base_url() ?>assets/js/dataTables/dataTables.bootstrap.js"></script>
		<link href="<?= base_url() ?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
		<script src="<?= base_url() ?>/assets/js/dataTables/moment.min.js"></script>
		<script src="<?= base_url() ?>/assets/js/dataTables/datetime-moment.js"></script>
		  <script>
		    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 1
			      $("#slider1").responsiveSlides({
			        maxwidth: 2500,
			        speed: 600
			      });
				});
				$(document).ready(function(){
					$('.top-nav .wrap').burgerMenu({
						buttonBg: '#007DAD',
						lineColor: 'white',
						menuBackground: '#007DAD',
						linkBackground: '#007DAD',
						linkColor: 'white',
						linkBorderBottom: 'none',
						menuWidth: '70%',
						fixed: true,
						showFromWidth: 0, // show the burger menu if window width >= 0
						showUntilWidth: 750, // hide the burger menu if window width >= 640
					});
				});
		  </script>
		  <link href="<?=base_url();?>application/views/themes/medica-web/css/style.css" rel="stylesheet" type="text/css"  media="all" />
	</head>
	<body>
		<!---start-wrap---->
			<!---start-header---->
			<div class="header">
					<div class="top-header">
						<div class="wrap">
						<div class="top-header-left">
							<p><?=$frontend_settings['header_contact_number'];?></p>
						</div>
						<div class="right-left">
							<?php
								if($user_logged_in){
									?>
									<ul>
										<li>Welcome, <?=$user_name;?></li>
										<li class="sign"><a href="<?=site_url('login/logout');?>">Log out</a></li>
									</ul>
									<?php
								}else{
									?>
									<ul>
										<li class="login"><a href="<?=site_url('login/index');?>">Login</a></li>
										<li class="sign"><a href="<?=site_url('frontend/register');?>">Sign up</a></li>
									</ul>
									<?php
								}

							?>

						</div>
						<div class="clear"> </div>
					</div>
				</div>
					<div class="main-header">
						<div class="wrap">
							<div class="social-links">
								<ul>
									<?php if($frontend_settings['facebook'] !=''){ ?>
									<li><a href="http://<?=$frontend_settings['facebook'];?>"><img src="<?=base_url();?>/application/views/themes/medica-web/images/facebook.png" title="facebook" /></a></li>
									<?php } ?>
									<?php if($frontend_settings['twitter'] !=''){ ?>
									<li><a href="http://<?=$frontend_settings['twitter'];?>"><img src="<?=base_url();?>/application/views/themes/medica-web/images/twitter.png" title="twitter" /></a></li>
									<?php } ?>
									<div class="clear"> </div>
								</ul>
							</div>
							<div class="logo">
								<?php if($clinic['clinic_logo'] != NULL){  ?>
									<a class="navbar-brand" style="padding:0px;background:#FFF;" href="<?= site_url("frontend/index"); ?>">
										<img src="<?php echo base_url().$clinic['clinic_logo']; ?>" alt="Logo"  height="60" width="260" />
									</a>
								<?php  }elseif($clinic['clinic_name'] != NULL){  ?>
									<a href="<?= site_url("frontend/index"); ?>">
										<p><?= $clinic['clinic_name'];?></p>
									</a>
								<?php  } else { ?>
									<a class="navbar-brand" href="<?= site_url("frontend/index"); ?>">
										<a href="index.html"><img src="<?=base_url();?>/assets/medica-web/images/logo.png" title="logo" /></a>
									</a>
								<?php }  ?>
							</div>

							<div class="clear"> </div>
						</div>
					</div>
					<div class="clear"> </div>
					<div class="top-nav">
						<div class="wrap">
							<ul>
								<li <?php if($active == "index") {echo 'class="active"';}?>><a href="<?=site_url('frontend/index');?>">Home</a></li>
								<?php if($enable_about){?>
								<li <?php if($active == "about") {echo 'class="active"';}?>><a href="<?=site_url('frontend/about');?>">About</a></li>
								<?php } ?>
								<?php if($enable_services){?>
									<li <?php if($active == "services") {echo 'class="active"';}?>><a href="<?=site_url('frontend/services');?>">Services</a></li>
								<?php } ?>
								<?php if($enable_news){?>
									<li <?php if($active == "news") {echo 'class="active"';}?>><a href="<?=site_url('frontend/news');?>">News</a></li>
								<?php } ?>
								<li <?php if($active == "contact") {echo 'class="active"';}?>><a href="<?=site_url('frontend/contact');?>">Contact</a></li>
								<li <?php if($active == "my_account") {echo 'class="active"';}?>><a href="<?=site_url('frontend/my_account');?>">My Account</a></li>
								<div class="clear"> </div>
							</ul>
						</div>
					</div>
			</div>
