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
<div class="panel panel-primary">	
	<div class="panel-heading">
		<?php echo $this->lang->line('users');?>
	</div>
	<div class="panel-body">
		<?php if($message != NULL){ ?>
			<div class='alert alert-<?=$message['type'];?>'><?=$message['text'];?></div>
		<?php } ?>
		<a href='<?=site_url('admin/add_user');?>' class='btn btn-primary square-btn-adjust'><?php echo $this->lang->line('add_new_user');?></a>
		<p></p>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="patient_table">
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
				<td><a <?php if ($u['level'] == 'System Administrator') echo 'style="display:none;"' ?> class="btn btn-primary square-btn-adjust" title="Visit" href="<?php echo site_url("admin/edit_user/" . $u['userid']); ?>"><?php echo $this->lang->line('edit_user');?></a></td>
				<td><a <?php if ($u['level'] == 'System Administrator') echo 'style="display:none;"' ?> class="btn btn-danger square-btn-adjust confirmDelete" title="<?php echo $this->lang->line('delete_user')." : " . $u['username'] ?>" href="<?php echo site_url("admin/delete/" . $u['userid']); ?>"><?php echo $this->lang->line('delete_user');?></a></td>
			</tr>
			<?php $i++; ?>
			<?php } ?>
			<?php endforeach ?>
			<?php } ?>
			</tbody>
			</div>		
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
<!-- CUSTOM SCRIPTS -->
<script src="<?= base_url() ?>assets/js/custom.min.js"></script>
<script type="text/javascript" charset="utf-8">
$(window).load(function() {
    $('#patient_table').dataTable();
	
	$('.confirmDelete').click(function(){
		return confirm("<?=$this->lang->line('areyousure_delete');?>");
	});	
} )
</script>