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
<script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function (){

   var table=$("#new_inquires").DataTable({
		"pageLength": 50
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
		table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
		// Handle click on "Expand All" button
		$('#btn-show-all-children').on('click', function(){
			// Expand row details
			table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
		});

		// Handle click on "Collapse All" button
		$('#btn-hide-all-children').on('click', function(){
			// Collapse row details
			table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
		});
});
</script>
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- Page Heading -->
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
					<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line("new_inquires");?></h5>
				</div>
				
				<div class="card-body">
					<div class="row"><div class="col-lg-12 text-align"><a href="#" class="btn square-btn-adjust btn-primary btn-sm " data-toggle="modal" data-target="#addInquiryModal"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add_inquiry');?></a></div></div>
					&nbsp;
						<?php if ($patients_detail) { ?>
							<div class="text-align">
								<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
								<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
							</div>&nbsp;
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover display responsive nowrap" id="new_inquires" >
							<thead>
							<tr>
								<th><?php echo $this->lang->line("patient")." ".$this->lang->line("name");?></th>
								<th><?php echo $this->lang->line("phone_number");?></th>
								<th><?php echo $this->lang->line("email");?></th>
								<th><?php echo $this->lang->line("visit");?></th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($patients_detail as $patient_detail) { ?>
								<tr>
									<td><?php echo $patient_detail['patient_name']; ?></td>
									<td><?php echo $patient_detail['phone_number']; ?></td>
									<td><?php echo $patient_detail['email']; ?></td>
									<td><?php echo $patient_detail['count']; ?></td>
								</tr>
							<?php
							}
							?>
							</tbody>
						</table>
					</div>
						<?php }else{ ?>
							<?php echo $this->lang->line("no") . " " .$this->lang->line("new_inquires") . " " . $this->lang->line("found");?>
						<?php } ?>

				</div>
			</div>
	</div>
	<div class="modal fade" id="addInquiryModal" tabindex="-1" role="dialog" aria-labelledby="addInquiryModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="addInquiryModalLabel"><?=$this->lang->line('add_inquiry');?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<?php
				$attributes = array('id' => 'add_inquiry_form');
				echo form_open(site_url('patient/add_inquiry'),$attributes);
				?>
				<div class="modal-body">
						<div class="col-md-12"><label><?=$this->lang->line('name');?>:</label></div>
						<div class="row">
						<div class="col-md-4"><input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name"/></div>
						<div class="col-md-4"><input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="Middle Name"/></div>
						<div class="col-md-4"><input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name"/></div>
						</div>

						<div class="col-md-12"><label><?=$this->lang->line('email_id');?>:</label></div>
						<div class="col-md-12"><input type="text" id="email" name="email" class="form-control"/></div>


						<div class="col-md-12"><label><?=$this->lang->line('mobile_no');?>:</label></div>
						<div class="col-md-12"><input type="text" id="phone_number" name="phone_number" class="form-control"/></div>
						<div class="col-md-12"><input type="hidden" id="return_page" name="return_page" value="new_inquiry_report" class="form-control"/></div>
				</div>
				<div class="modal-footer">
						<button type="submit" class="btn square-btn-adjust btn-primary btn-sm" ><?=$this->lang->line('save');?></button>
						<button type="button" class="btn square-btn-adjust btn-default btn-sm" data-dismiss="modal"><?=$this->lang->line('close');?></button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

</body>
</html>