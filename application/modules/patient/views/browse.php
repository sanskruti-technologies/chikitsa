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

	$level = $this->session->userdata('category');
?>
<style>
	/***************************************************************************************************/
	/**                                Responsive Angular JS Tables                                   **/
	/***************************************************************************************************/


	@media screen and (max-width: 1200px) { 
		
		table.responsive,
		table.responsive thead, 
		table.responsive tbody, 
		table.responsive tr, 
		table.responsive td { display: block; }
			
		table.responsive td{
			clear: both;
			
			position: relative;
			text-align: left;
			
		}	
		table.responsive .responsive_label {
			display: inline-block;
			left: 10px;
			font-weight:bold;
			width:130px !important; /* Width of Label*/
		}
		
		table.responsive tr {
			padding: 10px 0;
			position: relative;
		}
		table.responsive  thead { display: none; }
	}
	@media screen and (max-width: 500px) {
			
	table.responsive td{
		margin: 0;
		padding: 5px 1em;
		width: 100%;
		padding:2px !important;
		padding-left:10px !important;
		border:none !important;
	}
	table.responsive .responsive_label {
			font-size: .8em;
			padding-top: 0.2em;
			position: relative;
		left:0;
			display:block;
		}
		table.responsive td:last-child  { padding-bottom: 1rem !important; }
		
		
		table.responsive tr {
			background-color: white !important;
			border: 1px solid lighten(#398B93, 20%);
			border-radius: 10px;
			box-shadow: 2px 2px 0 rgba(0,0,0,0.1);
			margin: 0.5rem 0;
			padding: 0;
		}
		
		table.responsive { 
			border: none; 
			box-shadow: none;
			overflow: visible;
		}
	}

	@media screen and (min-width: 1201px) { 
		.responsive_label{display:none;}
	}
			
		
</style>

<!-- Begin Page Content -->
<div class="container-fluid">
		<!-- Page Heading -->
	<div class="card shadow mb-4">
				<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
						<h5 class="m-0 font-weight-bold text-primary">
							<?php echo $this->lang->line('patients');?>
						</h5>
				</div>
				<div class="card-body">
							<div class="row">
								<div class="col-md-12 text-align">
									<a title="<?php echo $this->lang->line("add")." ".$this->lang->line("patient");?>" href="<?php echo base_url()."index.php/patient/insert/" ?>" class="btn btn-primary square-btn-adjust btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line("add")." ".$this->lang->line("patient");?></a>
									<!--a href="#" class="btn square-btn-adjust btn-primary btn-sm" data-toggle="modal" data-target="#addInquiryModal"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add_inquiry');?></a-->
								</div>
								
							</div>
							&nbsp;
							<div class="modal fade" id="addInquiryModal" tabindex="-1" role="dialog" aria-labelledby="addInquiryModalLabel" aria-hidden="true" style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content">
    									<div class="modal-header">
											<h4 class="modal-title" id="addInquiryModalLabel"><?php echo $this->lang->line('add_inquiry');?></h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<?php
											$attributes = array('id' => 'add_inquiry_form');
											echo form_open(site_url('patient/add_inquiry'),$attributes);
										?>
										<div class="modal-body">
												<div class="col-md-12"><label><?php echo $this->lang->line('name');?>:</label></div>
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-4"><input type="text" id="first_name" name="first_name" class="form-control" placeholder="first name"/></div>
														<div class="col-md-4"><input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="middle name"/></div>
														<div class="col-md-4"><input type="text" id="last_name" name="last_name" class="form-control" placeholder="last name"/></div>
													</div>
												</div>

												<div class="col-md-12"><label><?php echo $this->lang->line('email_id');?>:</label></div>
												<div class="col-md-12"><input type="text" id="email" name="email" class="form-control"/></div>


												<div class="col-md-12"><label><?php echo $this->lang->line('mobile_no');?>:</label></div>
												<div class="col-md-12"><input type="text" id="phone_number" name="phone_number" class="form-control"/></div>
												<div class="col-md-12"><input type="hidden" id="return_page" name="return_page" value="index" class="form-control"/></div>

										</div>
										<div class="modal-footer">
											<button type="submit" class="btn square-btn-adjust btn-primary" ><?=$this->lang->line('save');?></button>
											<button type="button" class="btn square-btn-adjust btn-default" data-dismiss="modal"><?=$this->lang->line('close');?></button>
									</div>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>
	<div class="col-md-12" style="margin-top:15px;">

		<div class="table-responsive" ng-app="angularTable" ng-controller="listdata">
				<form class="form-inline">
			<div class="form-group">
				<label >Search</label>
				<input type="text" ng-model="search" class="form-control" >
			</div>
				</form>
				<table class="table table-striped table-bordered table-hover display responsive nowrap" id="patient_table">
					<thead>
						<tr>
							<th ng-click="sort('sr_no')">Sr. No.</th>
							<th ng-click="sort('ssn_id')">Adhar Number</th>
							<th ng-click="sort('patient_name')">Patient Name</th>
							<th ng-click="sort('phone_number')">Phone Number</th>
							<th ng-click="sort('email')">Email</th>
							<th ng-click="sort('visit')">Visit</th>
							<th ng-click="sort('follow_up')">Follow Up</th>
							<th ng-click="sort('is_deleted')">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr dir-paginate="patient in patients|orderBy:sortKey:reverse|filter:search|itemsPerPage:10">
							<td><span class="responsive_label" ng-click="sort('sr_no')">Sr. No.</span>
								{{patient.sr_no}}
							</td>
							<td><span class="responsive_label" ng-click="sort('ssn_id')">Adhar Number</span>
								{{patient.ssn_id}}
							</td>
							<td><span class="responsive_label" ng-click="sort('patient_name')">Patient Name</span>
								{{patient.patient_name}}
							</td>
							<td><span class="responsive_label" ng-click="sort('phone_number')">Phone Number</span>
								{{patient.phone_number}}
							</td>
							<td><span class="responsive_label" ng-click="sort('email')">Email</span>
								{{patient.email}}&nbsp;
							</td>
							<td>{{patient.visit}}		
							<a class='btn btn-primary btn-sm square-btn-adjust' title='Visit' href="<?= site_url('patient/visit/');?>{{patient.patient_id}}"><?php echo $this->lang->line("visit");?></a>
							</td>
							<td>
							<a class='btn btn-success btn-sm square-btn-adjust' title='Follow Up' href="<?= site_url('patient/followup/');?>{{patient.patient_id}}">{{patient.follow_up}}<?php echo $this->lang->line("follow up");?></a>
							</td>
							<td>{{patient.is_deleted}}
							<a class="btn btn-sm btn-primary square-btn-adjust" href="<?= site_url('patient/edit/');?>{{patient.patient_id}}"><i class="fa fa-edit"></i><?php echo $this->lang->line("edit");?></a>
							<a class='btn btn-danger btn-sm square-btn-adjust confirmDelete deletePatient' href="<?= site_url('patient/delete/');?>{{patient.patient_id}}" title="Delete"><?php echo $this->lang->line("delete"); ?></a>	
							</td>
						</tr>	
					</tbody>
				</table>
				<dir-pagination-controls
					max-size="5"
					direction-links="true"
					boundary-links="true" >
				</dir-pagination-controls>
			</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" charset="utf-8">

var app = angular.module('angularTable', ['angularUtils.directives.dirPagination']);
app.controller('listdata',function($scope, $http)
{
    $scope.patients = []; //declare an empty array
    $http.get("<?= site_url("/rest_api/get_patient"); ?>").success(function(response)
	{
        $scope.patients = response;  //ajax request to fetch data into $scope.data
    });
	$scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }
});

$(document).ready(function (){
	$('#show_columns').chosen();

  ({
		/*"ajax": {"url": "<?=site_url('patient/ajax_all_patients');?>"},
		"columns": [
			<?php foreach($show_columns as $show_column){ ?>
				{ "data": "<?=$show_column;?>" },
			<?php } ?>

        ],*/
		"pageLength": 50,
	});



	$("#add_inquiry_form").validate({
		// Specify validation rules
		errorClass: "alert alert-danger no_margin",
		errorElement: "div",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			first_name: {	required: true,	},
			last_name: {	required: true,	},
			phone_number: {	required: true,	}
		},
		// Specify validation error messages
		messages: {
			first_name: { required: "<?=$this->lang->line('please_enter_first_name');?>" },
			last_name: { required: "<?=$this->lang->line('please_enter_last_name');?>" },
			phone_number: { required: "<?=$this->lang->line('please_enter_mobile_number');?>" },
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response) {
					$("#addInquiryModal").modal("hide");
				}
			});
		}
	});

	
});

</script>