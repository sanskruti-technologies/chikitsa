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

$rtl_values[0] = "No";
$rtl_values[1] = "Yes";
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('languages');?>
				</div>
				<div class="panel-body">
					<a class="btn square-btn-adjust btn-primary" id="add_language" ><?=$this->lang->line('add_language');?></a>
					<a href="#" class="btn square-btn-adjust btn-success" data-toggle="modal" data-target="#uploadLanguageModal"><?=$this->lang->line('upload_language_file');?></a>

					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="tax_rate_table">
							<thead>
								<tr>
									<th><?php echo $this->lang->line("id");?></th>
									<th><?php echo $this->lang->line("language_name");?></th>
									<th><?php echo $this->lang->line("rtl");?></th>
									<th><?php echo $this->lang->line("is_default");?></th>
									<th><?php echo $this->lang->line("action");?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach($languages as $language){ ?>
									<tr>
										<td><?=$i;?></td>
										<td><?=$language['language_name'];?></td>
										<td><?=$rtl_values[$language['is_rtl']];?></td>
										<td>
												<?php if($language['is_default'] == 1){ ?>
													<i class="fa fa-check fa-lg"></i>
												<?php }else{ ?>
													<a class="btn btn-warning square-btn-adjust btn-sm" href="<?php echo site_url('settings/set_as_default') . '/' . $language['language_id']; ?>"><?php echo $this->lang->line('set_as_default');?></a>
												<?php } ?>
										</td>
										<td>
											<a class="btn btn-primary btn-sm square-btn-adjust edit_language" data-language_name="<?=$language['language_name'];?>" data-is_rtl="<?=$language['is_rtl'];?>" data-language_id="<?=$language['language_id'];?>" ><i class="fa fa-pencil"></i> <?php echo $this->lang->line("edit");?></a>
											<a class="btn btn-info btn-sm square-btn-adjust" href="<?=site_url('settings/change_language_file/'.$language['language_name']);?>" ><i class="fa fa-pencil"></i> <?php echo $this->lang->line("change_language_file");?></a>
											<a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?=site_url('settings/delete_language/'.$language['language_id']);?>"><i class="fa fa-trash" aria-hidden="true"></i> <?php echo $this->lang->line("delete");?></a>
										</td>
									</tr>
									<?php $i++; ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!--End Advanced Tables -->
		</div>
	</div>
</div>
<div class="modal fade" id="uploadLanguageModal" tabindex="-1" role="dialog" aria-labelledby="uploadLanguageModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="uploadLanguageModalLabel"><?=$this->lang->line('upload_language_file');?></h4>
			</div>
			<?php
			$attributes = array('id' => 'upload_language_file');
			echo form_open('settings/upload_language_file',$attributes);
			?>
			<div class="modal-body">
				<div class="form-group">
					<div class="col-md-12"><label><?=$this->lang->line('language_name');?>:</label></div>
					<select  class="form-control" name="language_name">
						<?php foreach ($pending_folders as $language) { ?>
							<option value="<?php echo $language; ?>" ><?php echo $language; ?></option>
					  <?php }?>
					</select>
				</div>
				<div class="form-group">
				<div class="col-md-12"><label><?=$this->lang->line('rtl');?>:</label></div>
				<div class="col-md-12"><label><input type="checkbox" value="1" id="rtl" name="rtl" /> <?=$this->lang->line('right_to_left');?></label></div>
				</div>
			</div>
			<div class="modal-footer">
					<button type="submit" class="btn btn-primary" ><?=$this->lang->line('save');?></button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('close');?></button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<div class="modal fade" id="addLanguageModal" tabindex="-1" role="dialog" aria-labelledby="addLanguageModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="addLanguageModalLabel"><?=$this->lang->line('add_language');?></h4>
			</div>
			<?php
			$attributes = array('id' => 'add_language_form');
			echo form_open('settings/save_language',$attributes);
			?>
			<div class="modal-body">
					<input type="hidden" name="language_id" id="language_id" value="0" />
					<div class="col-md-12"><label><?=$this->lang->line('language_name');?>:</label></div>
					<div class="col-md-12"><input type="text" id="language_name" name="language_name" class="form-control"/></div>

					<div class="col-md-12"><label><?=$this->lang->line('rtl');?>:</label></div>
					<div class="col-md-12"><label><input type="checkbox" value="1" id="add_rtl" name="rtl" /> <?=$this->lang->line('right_to_left');?></label></div>

					<div class="col-md-12">
							<label><?=$this->lang->line('reload_language_file');?>:</label><br/>
							<label><input type="checkbox" value="1" id="reload_language_file" name="reload_language_file" /> <?=$this->lang->line('reload_language_file');?></label><br/>
							<small>	<?=$this->lang->line('reload_language_file_instruction');?></small>
					</div>

			</div>
			<div class="modal-footer">
					<button type="submit" class="btn btn-primary" ><?=$this->lang->line('save');?></button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><?=$this->lang->line('close');?></button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$( window ).load(function() {

	$('.confirmDelete').click(function(){
		return confirm("<?=$this->lang->line('areyousure_delete');?>");
	})

    $("#tax_rate_table").dataTable({
		"pageLength": 50
	});
	$( ".set_as_default").click(function()){
		var language_id = $(this).data( "language_id" );
	});
	$( "#add_language" ).click(function() {
		$("#addLanguageModalLabel").html("<?=$this->lang->line('add_language');?>");
		 $("#reload_language_file").parent().parent().hide();
		 	$( "#add_language_form" ).validate().resetForm();
			$('#language_name').removeClass("alert-danger");
		 $('#language_id').val(0);
		 $('#language_name').val("");
		 $('#rtl').prop('checked', false);
		  $("#addLanguageModal").modal("show");
	});
	$( ".edit_language" ).click(function() {
		$( "#add_language_form" ).validate().resetForm();
		$('#language_name').removeClass("alert-danger");
		var language_id = $(this).data( "language_id" );
		var language_name = $(this).data( "language_name" );
		$("#addLanguageModalLabel").html("<?=$this->lang->line('edit_language');?>");
		var is_rtl = $(this).data( "is_rtl" );
		console.log(is_rtl);
		$("#reload_language_file").parent().parent().show();
		$('#language_id').val(language_id);
		$('#language_name').val(language_name);
		if(is_rtl == 1){
				$('#add_rtl').prop('checked', true);
		}else{
				$('#add_rtl').prop('checked', false);
		}
		console.log(is_rtl);
    $("#addLanguageModal").modal("show");
  });

	jQuery.validator.addMethod("notin", function(value, element, param) {
		console.log($.inArray(value, param));
    return this.optional(element) || $.inArray(value, param) <= -1; // <-- Check if the value is in the array.
	}, "");

	const isaddmode = function(element){
	  return $("#language_id").val() == 0;
	};
	$("#add_language_form").validate({
		// Specify validation rules
		errorClass: "alert alert-danger no_margin",
		errorElement: "div",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			language_name: {	required: true,
												notin: {
									        param: <?php echo json_encode($language_array); ?>,
									        depends: isaddmode
									      }

											}
		},
		// Specify validation error messages
		messages: {
			language_name: { required: "<?=$this->lang->line('please_enter_language_name');?>",
											 notin : "Language Name already exists"}
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		/*submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response) {
					$("#addLanguageModal").modal("hide");
				}
			});
		}*/
		});
});
</script>
