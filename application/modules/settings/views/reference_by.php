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
<div id="page-inner">

	<div class="row">

		<div class="col-md-12">
			<div class="panel panel-primary" >
				<div class="panel-heading" >
					<?php echo $this->lang->line('reference_by');?>
				</div>
				<div class="panel-body" >
					<div class="col-md-12">
						<a href="<?=site_url('settings/add_reference');?>" class="btn btn-primary btn-sm square-btn-adjust"><?php echo $this->lang->line("add_reference_by");?></a>
					</div>
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="reference_by_table">
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
										<td><a class="btn btn-primary btn-sm square-btn-adjust" href="<?=site_url('settings/edit_reference/'.$reference['reference_id']);?>"><?php echo $this->lang->line("edit");?></a></td>
										<td><a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?=site_url('settings/delete_reference/'.$reference['reference_id']);?>"><?php echo $this->lang->line("delete");?></a></td>
									</tr>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$( window ).load(function() {

	$('.confirmDelete').click(function(){
		return confirm("<?=$this->lang->line('areyousure_delete');?>");
	})

    $("#reference_by_table").dataTable({
		"pageLength": 50
	});
});
</script>
