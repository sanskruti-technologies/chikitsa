<?php
	$level = $this->session->userdata('category'); 
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('patients');?>
				</div>
				<div class="panel-body">
					<div class="col-md-4">
						<a title="<?php echo $this->lang->line("add")." ".$this->lang->line("patient");?>" href="<?php echo base_url()."index.php/patient/insert/" ?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("patient");?></a>
						<a href="#" class="btn square-btn-adjust btn-primary" data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line('add_inquiry');?></a>
					</div>
					<div class="col-md-1">
						<label for="show_columns"><?php echo $this->lang->line('show_columns');?></label>
					</div>
					<?php ?>
					<?php echo form_open('patient/index/'); ?>
					<div class="col-md-6">
						<select name="show_columns[]" id="show_columns" class="form-control" multiple="multiple" >
							<option <?php if(in_array($this->lang->line('id'),$show_columns)) echo "selected";?>><?php echo $this->lang->line('id');?></option>
							<option <?php if(in_array($this->lang->line('name'),$show_columns)) echo "selected";?>><?php echo $this->lang->line('name');?></option>
							<option <?php if(in_array($this->lang->line('display')." ".$this->lang->line("name"),$show_columns)) echo "selected";?>><?php echo $this->lang->line("display")." ".$this->lang->line("name");?></option>
							<option <?php if(in_array($this->lang->line('phone_number'),$show_columns)) echo "selected";?>><?php echo $this->lang->line("phone_number");?></option>
							<option <?php if(in_array($this->lang->line('email'),$show_columns)) echo "selected";?>><?php echo $this->lang->line("email");?></option>
							<option <?php if(in_array($this->lang->line('reference_by'),$show_columns)) echo "selected";?>><?php echo $this->lang->line("reference_by");?></option>
							<option <?php if(in_array($this->lang->line('added_date'),$show_columns)) echo "selected";?>><?php echo $this->lang->line("added_date");?></option>
							<?php if($level != "Receptionist") { ?>
								<option <?php if(in_array($this->lang->line('visit'),$show_columns)) echo "selected";?>><?php echo $this->lang->line("visit");?></option>
							<?php } ?>
							<option <?php if(in_array($this->lang->line('follow_up'),$show_columns)) echo "selected";?>><?php echo $this->lang->line("follow_up");?></option>
							<?php if($level != "Receptionist") { ?>
								<option <?php if(in_array($this->lang->line('delete'),$show_columns)) echo "selected";?>><?php echo $this->lang->line("delete");?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-1">
						<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" /><?php echo $this->lang->line('go');?></button>
					</div>
					<?php echo form_close(); ?>
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content">
    									<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('add_inquiry');?></h4>
										</div>
										<?php echo form_open(); ?>
										<div class="modal-body">
												<div class="col-md-12"><label><?php echo $this->lang->line('name');?>:</label></div>
												<div class="col-md-4"><input type="text" id="first_name" name="first_name" class="form-control" placeholder="first name"/></div>										
												<div class="col-md-4"><input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="middle name"/></div>
												<div class="col-md-4"><input type="text" id="last_name" name="last_name" class="form-control" placeholder="last name"/></div>
											
											
												<div class="col-md-12"><label><?php echo $this->lang->line('email_id');?>:</label></div>
												<div class="col-md-12"><input type="text" id="email_id" name="email_id" class="form-control"/></div>
											
											
												<div class="col-md-12"><label><?php echo $this->lang->line('mobile_no');?>:</label></div>
												<div class="col-md-12"><input type="text" id="mobile_no" name="mobile_no" class="form-control"/></div>
											
										</div>
										<div class="modal-footer">
											<input id="add_inquiry_submit" type="submit" name="submit" value="Save" class="btn btn-primary" data-dismiss="modal"/>
											<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
										</div>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>
					
					<div class="col-md-12" style="margin-top:15px;">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="patient_table">
							<thead>
								<tr>
									<?php if(in_array($this->lang->line('id'),$show_columns)) {?>
									<th><?php echo $this->lang->line("id");?></th>
									<?php } ?>
									<?php if(in_array($this->lang->line('name'),$show_columns)) {?>
									<th><?php echo $this->lang->line("name");?></th>
									<?php } ?>
									<?php if(in_array($this->lang->line('display')." ".$this->lang->line("name"),$show_columns)) {?>
									<th><?php echo $this->lang->line("display")." ".$this->lang->line("name");?></th>
									<?php } ?>
									<?php if(in_array($this->lang->line('phone_number'),$show_columns)) {?>
									<th><?php echo $this->lang->line("phone_number");?></th>
									<?php } ?>
									<?php if(in_array($this->lang->line('email'),$show_columns)) {?>
									<th><?php echo $this->lang->line("email");?></th>
									<?php } ?>
									<?php if(in_array($this->lang->line('reference_by'),$show_columns)) {?>
									<th><?php echo $this->lang->line("reference_by");?></th>
									<?php } ?>
									<?php if(in_array($this->lang->line('added_date'),$show_columns)) {?>
									<th><?php echo $this->lang->line("added_date");?></th>
									<?php } ?>
									<?php if(in_array($this->lang->line('visit'),$show_columns)) {?>
									<?php if($level != "Receptionist") { ?>
									<th><?php echo $this->lang->line("visit");?></th>
									<?php } ?>
									<?php } ?>
									<?php if(in_array($this->lang->line('follow_up'),$show_columns)) {?>
									<th><?php echo $this->lang->line("follow_up");?></th>
									<?php } ?>
									<?php if(in_array($this->lang->line('delete'),$show_columns)) {?>
									<?php if($level != "Receptionist") { ?>
									<th><?php echo $this->lang->line("delete");?></th>
									<?php } ?>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
					</div>
				</div>
			</div>
			<!--End Advanced Tables -->
		</div>
	</div>
</div>
 <!-- JQUERY SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-1.11.3.min.js"></script>
<!-- JQUERY UI SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-ui.min.js"></script>
		<!-- BOOTSTRAP SCRIPTS -->
		<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
		<!-- METISMENU SCRIPTS -->
		<script src="<?= base_url() ?>assets/js/jquery.metisMenu.min.js"></script>
		 <!-- DATA TABLE SCRIPTS -->
		<script src="<?= base_url() ?>assets/js/dataTables/jquery.dataTables.min.js"></script>
		<script src="<?= base_url() ?>assets/js/dataTables/dataTables.bootstrap.min.js"></script>
		<script src="<?= base_url() ?>/assets/js/dataTables/moment.min.js"></script>
		<script src="<?= base_url() ?>/assets/js/dataTables/datetime-moment.min.js"></script>
		<!-- CUSTOM SCRIPTS -->
		<script src="<?= base_url() ?>assets/js/custom.min.js"></script>
		<!-- CHOSEN SCRIPTS-->
		<script src="<?= base_url() ?>assets/js/chosen.jquery.min.js"></script>
		<link href="<?= base_url() ?>assets/css/chosen.min.css" rel="stylesheet" />
		
<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	$('#show_columns').chosen();
	$(document).on('click', '.confirmDelete' , function() {
		 return confirm("Are you sure you want to delete?");
	});

    var patient_table =  $("#patient_table").dataTable({
		"ajax": {"url": "<?=site_url('patient/ajax_all_patients');?>"},
		"columns": [
			<?php foreach($show_columns as $show_column){ ?>
				{ "data": "<?=$show_column;?>" },	
			<?php } ?>
            
        ],
		"pageLength": 50
	});
	
	$("#add_inquiry_submit").click(function(event) {
		event.preventDefault();
		var first_name = $("#first_name").val();
		var middle_name = $("#middle_name").val();
		var last_name = $("#last_name").val();
		var email_id = $("#email_id").val();
		var mobile_no = $("#mobile_no").val();
		
		$.post( "<?php echo base_url(); ?>index.php/patient/add_inquiry",
			{first_name: first_name, middle_name: middle_name,last_name: last_name,email: email_id, phone_number:mobile_no},
			function(data,status){
				alert(data);
				location.reload();
			});
	});
});
</script>
