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
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('reference_by');?></h5>	
		</div>
		<div class="card-body" >

					<div class="col-md-12 text-align">

						<a href="<?=site_url('settings/add_reference');?>" class="btn btn-primary btn-sm square-btn-adjust "><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line("add_reference_by");?></a>
						</br>&nbsp;
					</div>

					<div class="col-md-12">
					<div class="text-align">
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
					</div>&nbsp;
						<div class="table-responsive">

							<table class="table table-striped table-bordered table-hover display responsive nowrap" id="reference_by_table">

								<thead>

									<tr>

										<th><?php echo $this->lang->line("option");?></th>

										<th><?php echo $this->lang->line("add_detail");?></th>

										<th><?php echo $this->lang->line("placeholder");?></th>

										<th><?php echo $this->lang->line("edit");?></th>

										<th><?php echo $this->lang->line("delete");?></th>

									</tr>

								</thead>

								<tbody>

									<?php foreach($reference_by as $reference){?>

									<tr>

										<td><?=$reference['reference_option'];?></td>

										<td><?php if($reference['reference_add_option'] ==1) {echo "Yes";}else{echo "No";} ?></td>

										<td><?=$reference['placeholder'];?></td>

										<td><a class="btn btn-primary btn-sm square-btn-adjust" href="<?=site_url('settings/edit_reference/'.$reference['reference_id']);?>"><i class="fa fa-edit"></i> <?php echo $this->lang->line("edit");?></a></td>

										<td><a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?=site_url('settings/delete_reference/'.$reference['reference_id']);?>"><i class="fa fa-trash" aria-hidden="true"></i> <?php echo $this->lang->line("delete");?></a></td>

									</tr>

									<?php }?>

								</tbody>

							</table>

						</div>

					</div>

		</div>
	</div>
</div>

<script type="text/javascript" charset="utf-8">

$(document).ready(function () {



	$('.confirmDelete').click(function(){

		return confirm("<?=$this->lang->line('areyousure_delete');?>");

	})



    var table=$("#reference_by_table").DataTable({

		"pageLength": 50

	});

	
	table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
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