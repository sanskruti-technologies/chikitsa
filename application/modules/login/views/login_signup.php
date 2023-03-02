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

<html>

<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Free & Open Source Software Chikitsa, Patient Management System is for Clinics and Hospital. Create Appointments , Maintain Patietn Records and Generate Bills.">
		<meta name="author" content="Sanskruti Technologies">
        <link rel="shortcut icon"  href="<?= base_url() ?>/favicon.ico"/>
		
		<title><?php echo $clinic['clinic_name'];?> - <?php echo $this->lang->line('sign_in'); ?></title>
		
		<!-- Custom fonts for this template-->
  		<link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<!-- Custom styles for this template-->
		<link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
		<!-- Chikitsa CSS-->
		<link href="<?= base_url() ?>assets/css/chikitsa.min.css" rel="stylesheet" />
		
	
</head>

<?php 
	$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	//$actual_link="https://base_demo.chikitsa.net";
	$str=$actual_link;
	$str= substr($str, strpos($str, "//") + 2);
	$subdomain= substr($str, 0, strpos($str, '.'));
?>

	<body>
 
	<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
					<h1 class="h4 text-gray-900 mb-4">
					<?php if($clinic['clinic_logo'] != NULL){  ?>
						<img src="<?php echo base_url().$clinic['clinic_logo']; ?>" alt="Logo"  height="80" width="130" />
					<?php  }elseif($clinic['clinic_name'] != NULL){  ?>
						<?= $clinic['clinic_name'];?>
					<?php  } else { ?>
						<?= $software_name;?>
					<?php }  ?>
					</h1>
				  </div>
					<?php if(isset($error)) { ?><div class="alert alert-danger"><?=$error;?></div><?php } ?>
					<?php if(isset($message)) { ?><div class="alert alert-info"><?=$message;?></div><?php } ?>
							
				  <?php 
					
					$attributes = array('class' => 'user', 'id' => 'login_form');
					echo form_open('login/valid_signin',$attributes); 
					?>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" id="username"  aria-describedby="emailHelp" placeholder="<?=$this->lang->line('your_username');?>" autocomplete="off">
					  <?php echo form_error('username','<div class="alert alert-danger">','</div>'); ?>	
					</div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="<?=$this->lang->line('your_password');?>" autocomplete="off">
					  <?php echo form_error('password','<div class="alert alert-danger">','</div>'); ?>	
					</div>
       
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block square-btn-adjust"><?php echo $this->lang->line('login');?></button>
					 <?php if($frontend_active){?>
					<a href="<?=site_url();?>" class="btn btn-primary btn-user btn-block square-btn-adjust"><?php echo $this->lang->line('back_to'); ?>&nbsp;<?= $clinic['clinic_name'];?></a>
					<a class="btn btn-primary btn-user btn-block square-btn-adjust" href="<?=site_url('login/forgot_password');?>"><?php echo $this->lang->line('forgot_password');?></a>

					<?php } ?>

					<div class="col-md-12"><br/>
						<?php if($subdomain=='demo' || $subdomain=='base_demo' ){?>
							<div class="row">
								<div class="col-md-4">
									<button type="submit" style="margin-top: 12px;border-radius: 10rem;" name="admin_login" id="admin_login" value="admin_login"  class="btn btn-primary square-btn-adjust">Login As Admin</button>
								</div>
								<div class="col-md-4">
									<button type="submit" style="margin-top: 12px;border-radius: 10rem;" name="doctor_login" id="doctor_login" value="doctor_login"   class="btn btn-primary square-btn-adjust">Login As Doctor</button>
								</div>
								<div class="col-md-4">
									<button type="submit" style="margin-top: 12px;border-radius: 10rem;" name="receptionist_login" id="receptionist_login" value="receptionist_login"  class="btn btn-primary square-btn-adjust">Login As Receptionist</button>
								</div>
						</div>
						<?php } ?>
					</div>

				  </form>
				 
				</div>
			</div>
		</div>
		
	</body>

</html>