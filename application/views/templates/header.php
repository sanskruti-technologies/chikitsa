<!DOCTYPE html>
<!--
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
-->
<?php

	if(!isset($level)){

		$level = $this->session->userdata('category');

	}

	if(!isset($clinic_id)){

		$clinic_id = 1;

		if($this->session->userdata('clinic_id') != NULL ){

			$clinic_id = $this->session->userdata('clinic_id');

		}

		$this->db->where('clinic_id', $clinic_id);

		$query = $this->db->get('clinic');

		$clinic = $query->row_array();

	}

	if(!isset($active_modules)){

		//Active Modules

		$this->db->where('module_status', 1);

		$this->db->select('module_name');

		$query=$this->db->get('modules');

		$result =  $query->result_array();

		$active_modules = array();

		foreach($result as $row){

			$active_modules[]= $row['module_name'];

		}

	}



	if(!isset($user)){

		$user_id = $_SESSION['id'];

		$this->db->where('userid', $user_id);

		$query = $this->db->get('users');

		$user = $query->row_array();

	}



	if(!isset($login_page)){

		$this->db->where('ck_key', 'login_page');

		$query = $this->db->get('data');

		$data = $query->row_array();

		$login_page = $data['ck_value'];



		$parent_name="";

		$result_top_menu = $this->menu_model->find_menu($parent_name,$level);

		foreach ($result_top_menu as $top_menu){

			$id = $top_menu['id'];

			$parent_name = $top_menu['menu_name'];

			if($this->menu_model->has_access($top_menu['menu_name'],$level)){

				if($this->menu_model->is_module_active($top_menu['required_module'])){

					$result_sub_menu = $this->menu_model->find_menu($parent_name,$level);

					$rowcount= count($result_sub_menu);

					if($rowcount != 0){

						foreach ($result_sub_menu as $sub_menu){

							if($this->menu_model->has_access($sub_menu['menu_name'],$level)){

								if($this->menu_model->is_module_active($sub_menu['required_module'])){

									$login_page = $sub_menu['menu_url'];

									break;

								}

							}

						}

					}else{

						$login_page = $top_menu['menu_url'];

						break;

					}

				}

			}

		}

	}



	$language_name = $this->config->item('language');

	if($this->session->userdata('prefered_language') !== NULL){

		$language_name = $this->session->userdata('prefered_language') ;

	}

	$query = $this->db->get_where('language_master',array('language_name'=>$language_name));

	$language_master = $query->row_array();

	$is_rtl = $language_master['is_rtl'];

?>
<html lang="en">
    <head>
		<title><?= $clinic['clinic_name'] .' - ' .$clinic['tag_line'];?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Free & Open Source Software Chikitsa, Patient Management System is for Clinics and Hospital. Create Appointments , Maintain Patietn Records and Generate Bills.">
		<meta name="author" content="Sanskruti Technologies">

		<!--link rel="shortcut icon"  href="<?= base_url() ?>/favicon.ico"/-->
		<link rel="shortcut icon"  href="<?= base_url() ?>/<?=$clinic['favicon_logo'] ?>"/>

		<title><?= $clinic['clinic_name'] .' - ' .$clinic['tag_line'];?></title>
        <!-- Custom fonts for this template -->
	    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	    <!--<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">-->

		<!-- Custom styles for this template -->
		<link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

		<!-- Custom styles for this page -->
		<link href="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
		<link href="<?= base_url() ?>assets/vendor/datatables/responsive.dataTables.min.css" rel="stylesheet">

		<!-- Schedule Master CSS -->
		<!--link href="<?= base_url() ?>assets/vendor/schedule-template-master/css/style.css" rel="stylesheet"-->

		<!-- Bootstrap core JavaScript-->
		<script src="<?= base_url() ?>assets/vendor/jquery/jquery-1.11.3.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/jquery/jquery-ui.min.js"></script>
		<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Core plugin JavaScript-->
		<script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
		<!-- Custom scripts for all pages-->
		<script src="<?= base_url() ?>assets/js/sb-admin-2.js"></script>
		<!-- autocomplete -->
		<link href="<?= base_url() ?>assets/vendor/css/jquery-ui-1.9.1.custom.min.css" rel="stylesheet">




		<!-- Page level custom scripts -->
		<!--script src="<?= base_url() ?>assets/js/demo/datatables-demo.js"></script-->
   
    <!-- CHOSEN SCRIPTS-->
    <script src="<?= base_url() ?>assets/vendor/chosen/chosen.jquery.min.js"></script>
    <link href="<?= base_url() ?>assets/vendor/chosen/chosen.min.css" rel="stylesheet">
	
    <!-- Page level plugins -->
    <script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

	   <!-- Datetime Picker -->
    <link href="<?= base_url() ?>assets/vendor/datetimepicker/jquery.datetimepicker.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/vendor/datetimepicker/jquery.datetimepicker.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/moment.js" ></script>

	<script src="<?= base_url() ?>assets/vendor/schedule-template-master/js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
	<script src="<?= base_url() ?>assets/vendor/schedule-template-master/js/main.js"></script>
	<!-- JQuery script -->
	<script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
	
	<!--Textarea -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/textarea/app.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/textarea/textarea.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/textarea/jodit.min.css" />
	<script src="<?= base_url(); ?>assets/textarea/jodit.js"></script>

	
	<!-- Calender css -->
	<link href="<?= base_url() ?>assets/vendor/calender/calender.css" rel="stylesheet"/>
	
	
	<!-- CHIKITSA STYLES-->
    <link href="<?= base_url() ?>assets/css/chikitsa.css" rel="stylesheet">
	<?php if($is_rtl == 1){?>
		<link href="<?= base_url() ?>assets/css/rtl.css" rel="stylesheet" />
	<?php }?>
	<link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet" />

	<!-- Sketch SCRIPTS-->
	<script src="<?= base_url() ?>assets/js/sketch.min.js"></script>
	
		<!---script call-->
		<script src="<?= base_url() ?>assets/js/angular.js"></script>

		<script src="<?= base_url() ?>assets/js/dirPagination.js"></script>
	</head>
	<body id="page-top" class="sidebar-toggled">
		<!-- Page Wrapper -->
		<div id="wrapper">
