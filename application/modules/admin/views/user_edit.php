<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
					<?php echo $this->lang->line('edit_user');?>
			</div>
			<?php $level = $user['level']; 
			$admin_name="admin";
			$level_name = $user['username'];
			?>
			<div class="panel-body">
			<?php echo form_open('admin/edit_user/'. $user['userid']); ?>
					<div class="form-group">
						<div class="form-group">
							<label><?php echo $this->lang->line('initial_password_message');?></label>
						</div>
						<?php //if($level == 'Administrator') { 
						if($level_name == $admin_name) { 						
						?>
						<label for="level"><?php echo $this->lang->line('category');?></label>
						<input type="text" name="level" id="level" value="<?php echo $user['level']; ?>" readonly="readonly" class="form-control"/><br/>
						<?php }else { ?>
						<label for="level"><?php echo $this->lang->line('category');?></label>
						<select name="level" class="form-control" required>  <option></option>
									<?php  foreach ($categories as $category) { ?>
									<option value="<?php echo $category['category_name'];?>" <?php if($category['category_name']== $user['level']) {echo 'selected';}?>><?= $category['category_name']; ?></option>
									<?php } ?>
						</select>
						<?php echo form_error('level','<div class="alert alert-danger">','</div>'); ?>
						<?php } ?>
					</div>
					<div class="form-group">
						<label for="name"><?php echo $this->lang->line('name');?></label> 
						<input type="text" name="name" id="name" value="<?php echo $user['name']; ?>"  class="form-control"/>
						<?php echo form_error('name','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">					
						<label for="username"><?php echo $this->lang->line('username');?></label> 
						<input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" readonly="readonly" class="form-control"/>
						<?php echo form_error('username','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">						
						<label for="password"><?php echo $this->lang->line('password');?></label> 
						<input type="password" name="newpassword" id="newpassword" value="" class="form-control"  />
						<?php echo form_error('newpassword','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">						
							<label for="passconf"><?php echo $this->lang->line('confirm_password');?></label> 
							<input type="password" name="passconf" id="passconf" value="" class="form-control" />
							<?php echo form_error('passconf','<div class="alert alert-danger">','</div>'); ?>
						</div>
					<div class="form-group">		
						<div class="col-md-2">
							<label for="is_active"><?php echo $this->lang->line('is_active');?></label> 
						</div>
						<div class="col-md-2">
							<input type="checkbox" <?php //if($level=="Administrator"){
								if($level_name == $admin_name) { 	
								?> disabled="disabled" name="is_act" id="is_act"<?php }else{ ?>  name="is_active" id="is_active" <?php } ?> value="1" <?php if($user['is_active']) echo "checked"; ?> class="form-control"/>
							<?php //if($level=="Administrator"){
								if($level_name == $admin_name) { 	
								$active=1;
								?>
							<input name="is_active" type="hidden" id="is_active" value="<?php echo $user['is_active']; ?>"/>
							<?php } ?>
						</div>
						<div class="col-md-8">
							&nbsp;
						</div>
						<div class="col-md-12">
							<?php echo form_error('is_active','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<button type="submit" name="submit" class="btn btn-primary" /><?php echo $this->lang->line('edit');?></button>
						</div>
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