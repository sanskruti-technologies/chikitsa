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
<!-- Begin Page Content -->
<div class="container-fluid">
		<!-- Page Heading -->
	<div class="card shadow mb-4">
			<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
				<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('languages');?></h5>
			</div>
		<div class="card-body">
			<div class="text-align">
			<a class="btn square-btn-adjust btn-primary btn-sm " id="add_language"  data-toggle="modal" data-target="#addLanguageModal"><i class="fa fa-plus"></i>&nbsp;<?=$this->lang->line('add_language');?></a>
			<a href="#" class="btn square-btn-adjust btn-success btn-sm" data-toggle="modal" data-target="#uploadLanguageModal"><?=$this->lang->line('upload_language_file');?></a>
			</div>
			</br>&nbsp;	
			<div class="text-align">
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
					</br>&nbsp;
			</div>
			<div class="table-responsive">

						<table class="table table-striped table-bordered table-hover display responsive nowrap" id="tax_rate_table">

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

									<a class="btn btn-primary btn-sm square-btn-adjust edit_language btn-sm" data-toggle="modal" data-target="#addLanguageModal" data-language_name="<?=$language['language_name'];?>" data-is_rtl="<?=$language['is_rtl'];?>" data-language_id="<?=$language['language_id'];?>" ><i class="fa fa-edit"></i>&nbsp;<?php echo $this->lang->line("edit");?></a>

									<a class="btn btn-info btn-sm square-btn-adjust btn-sm" href="<?=site_url('settings/change_language_file/'.$language['language_name']);?>" ><i class="fa fa-edit"></i> <?php echo $this->lang->line("change_language_file");?></a>

									<a class="btn btn-danger btn-sm square-btn-adjust confirmDelete btn-sm" href="<?=site_url('settings/delete_language/'.$language['language_id']);?>"><i class="fa fa-trash" aria-hidden="true"></i> <?php echo $this->lang->line("delete");?></a>

								</td>

							</tr>

							<?php $i++; ?>

						<?php } ?>

					</tbody>

				</table>

			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="uploadLanguageModal" tabindex="-1" role="dialog" aria-labelledby="uploadLanguageModalLabel" aria-hidden="true" style="display: none;">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h4 class="modal-title" id="uploadLanguageModalLabel"><?=$this->lang->line('upload_language_file');?></h4>

				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

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

				<div class="col-md-12 text-align"><input type="checkbox" value="1" id="rtl" name="rtl" /> <?=$this->lang->line('right_to_left');?></div>

				</div>

			</div>

			<div class="modal-footer">

					<button type="submit" class="btn square-btn-adjust btn-primary btn-sm" ><?=$this->lang->line('save');?></button>

					<button type="button" class="btn square-btn-adjust btn-default btn-sm" data-dismiss="modal"><?=$this->lang->line('close');?></button>

			</div>

			<?php echo form_close(); ?>

		</div>

	</div>

</div>

<div class="modal fade" id="addLanguageModal" tabindex="-1" role="dialog" aria-labelledby="addLanguageModalLabel" aria-hidden="true" style="display: none;">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h4 class="modal-title" id="addLanguageModalLabel"><?=$this->lang->line('add_language');?></h4>

				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

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

					<div class="col-md-12 text-align"><input type="checkbox" value="1" id="add_rtl" name="rtl" /> <?=$this->lang->line('right_to_left');?></div>



					<!--div class="col-md-12">

							<label><?=$this->lang->line('reload_language_file');?>:</label><br/>

							<label><input type="checkbox" value="1" id="reload_language_file" name="reload_language_file" /> <?=$this->lang->line('reload_language_file');?></label><br/>

							<small>	<?=$this->lang->line('reload_language_file_instruction');?></small>

					</div-->



			</div>

			<div class="modal-footer">

					<button type="submit" class="btn square-btn-adjust btn-primary btn-sm" ><?=$this->lang->line('save');?></button>

					<button type="button" class="btn square-btn-adjust btn-default btn-sm" data-dismiss="modal"><?=$this->lang->line('close');?></button>

			</div>

			<?php echo form_close(); ?>

		</div>

	</div>

</div>

<script type="text/javascript" charset="utf-8">

$(document).ready(function () {



	$('.confirmDelete').click(function(){

		return confirm("<?=$this->lang->line('areyousure_delete');?>");

	})

	var table=$("#tax_rate_table").DataTable({

	"pageLength": 50

	});


	table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');

   

	$( ".set_as_default").click(function(){

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

	$('#btn-show-all-children').on('click', function(){
		// Expand row details
		table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
	});
	// Handle click on "Collapse All" button
	$('#btn-hide-all-children').on('click', function(){
		// Collapse row details
		table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
	});
	$('.confirmDelete').click(function(){
		return confirm("<?=$this->lang->line('areyousure_delete');?>");
	});

});
</script>