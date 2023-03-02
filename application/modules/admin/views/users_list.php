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
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('users');?></h5>
		</div>
		<div class="card-body">
		  	<?php if($message != NULL){ ?>
			<div class='alert alert-<?=$message['type'];?>'><?=$message['text'];?></div>
			<?php } ?>
			<div class="text-align">
			<a href='<?=site_url('admin/add_user');?>' class='btn square-btn-adjust btn-primary btn-sm '><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add_new_user');?></a>
			</div>
			<p></p>
			<div class="text-align">
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
						<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
			</div>&nbsp;
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover display responsive nowrap" id="patient_table">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('name');?></th>
							<th><?php echo $this->lang->line('username');?></th>
							<th><?php echo $this->lang->line('category');?></th>
							<th><?php echo $this->lang->line('is_active');?></th>
							<th><?php echo $this->lang->line('edit');?></th>
							<th><?php echo $this->lang->line('delete');?></th>
						</tr>
					</thead>
					<tbody>
					<?php $i=1; ?>
					<?php
					if($user){
					?>
					<?php foreach ($user as $u):  ?>
					<?php  if (($this->session->userdata('category') == 'System Administrator') || ($u['level'] != 'System Administrator')){ ?>
					<tr <?php if ($i%2 == 0) { echo "class='alt'"; } ?> >
						<td><?php echo $u['name']; ?></td>
						<td><?php echo $u['username']; ?></td>
						<td><?php echo $u['level']; ?></td>
						<td><?php if($u['is_active']) {echo "Yes";}else {echo "No";} ?></td>
						<td><a <?php if ($u['level'] == 'System Administrator') echo 'style="display:none;"' ?> class="btn square-btn-adjust btn-primary btn-sm" title="Visit" href="<?php echo site_url("admin/edit_user/" . $u['userid']); ?>"><i class="fa fa-edit"></i>&nbsp;<?php echo $this->lang->line('edit_user');?></a></td>
						<td><a <?php if ($u['level'] == 'System Administrator') echo 'style="display:none;"' ?> class="btn square-btn-adjust btn-danger btn-sm confirmDelete" title="<?php echo $this->lang->line('delete_user')." : " . $u['username'] ?>" href="<?php echo site_url("admin/delete/" . $u['userid']); ?>"><i class="fa fa-trash"></i>&nbsp;<?php echo $this->lang->line('delete_user');?></a></td>
					</tr>
					<?php $i++; ?>
					<?php } ?>
					<?php endforeach ?>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" charset="utf-8">

$(document).ready(function () {

   var table=$('#patient_table').DataTable();



	$('.confirmDelete').click(function(){

		return confirm("<?=$this->lang->line('areyousure_delete');?>");

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

} )

</script>