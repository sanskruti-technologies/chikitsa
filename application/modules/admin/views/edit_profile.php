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
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('change') . " " .$this->lang->line('profile');?>
				</div>
				<?php $level = $user['level']; ?>
				<div class="panel-body">
					<?php echo form_open('admin/change_profile/'); ?>
						
						<div class="form-group">
							<label for="name"><?php echo $this->lang->line('name');?></label>
							<input type="text" class="form-control" name="name" id="name" value="<?php echo $user['name']; ?>" />
							<?php echo form_error('name','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="form-group">
							<label for="username"><?php echo $this->lang->line('username');?></label>
							<input type="text" class="form-control" name="username" id="username" value="<?php echo $user['username']; ?>" readonly="readonly"/>
							<?php echo form_error('username','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="form-group">
							<label for="oldpassword"><?php echo $this->lang->line('old_password');?></label>
							<input type="password" class="form-control"  name="oldpassword" id="oldpassword" value="" />
							<?php echo form_error('oldpassword','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="form-group">
							<label for="newpassword"><?php echo $this->lang->line('new_password');?></label>
							<input type="password" class="form-control"  name="newpassword" id="newpassword" value=""/>
							<?php echo form_error('newpassword','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="form-group">
							<label for="passconf"><?php echo $this->lang->line('confirm_password');?></label>
							<input type="password" class="form-control"  name="passconf" id="passconf" value=""/>
							<?php echo form_error('passconf','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary"><?php echo $this->lang->line('edit');?></button>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
    </div>
</div>	
<!-- JQUERY SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-1.11.3.js"></script>
<!-- JQUERY UI SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="<?= base_url() ?>assets/js/custom.js"></script>
