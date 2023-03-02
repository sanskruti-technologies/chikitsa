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
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary right"><?php echo $this->lang->line('change') . " " .$this->lang->line('profile');?></h6>
		</div>
	    <div class="card-body">
						<?php echo form_open_multipart('admin/change_profile/'); ?>
						<div class="form-group">
							<label for="name"><?php echo $this->lang->line('name');?></label>
							<input type="text" class="form-control" name="name" id="name" value="<?php echo $user['name']; ?>" autocomplete="off"/>
							<?php echo form_error('name','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="form-group image_wrapper col-md-12 text-align">
							<?php if($user['profile_image']!=""){ ?>
							<img id="PreviewImage" src="<?php echo base_url()."uploads/profile_picture/". $user['profile_image']; ?>" alt="Profile Image"  height="100" width="100" />
							<?php }else{ ?>
							<img id="PreviewImage" src="<?php echo base_url()."uploads/images/Profile.png"; ?>" alt="Profile Image"  height="100" width="100" />
							<?php } ?>
							<?php if($user['profile_image']!="") {?>
							&nbsp;<a class="btn btn-danger btn-sm square-btn-adjust" href="<?=site_url('admin/remove_profile_image/'.$user['userid']);?>"><?php echo $this->lang->line('remove_profile_picture');?></a>
							<?php }?>
							</br>&nbsp;
							<input type="file" id="profile_image" name="profile_image" class="form-control" size="20" onchange="readURL(this);" autocomplete="off"/>
							<input type="hidden" id="src" name="src" value="<?php echo $user['profile_image']; ?>" />
							<?php echo form_error('profile_image','<div class="alert alert-danger">','</div>'); ?>
						</div>

						<div class="form-group">

							<label for="username"><?php echo $this->lang->line('username');?></label>

							<input type="text" class="form-control" name="username" id="username" value="<?php echo $user['username']; ?>" readonly="readonly" autocomplete="off"/>

							<?php echo form_error('username','<div class="alert alert-danger">','</div>'); ?>

						</div>

						<div class="form-group">

							<label for="oldpassword"><?php echo $this->lang->line('old_password');?></label>

							<input type="password" class="form-control"  name="oldpassword" id="oldpassword" value="" autocomplete="off"/>

							<?php echo form_error('oldpassword','<div class="alert alert-danger">','</div>'); ?>

						</div>

						<div class="form-group">

							<label for="newpassword"><?php echo $this->lang->line('new_password');?></label>

							<input type="password" class="form-control"  name="newpassword" id="newpassword" value="" autocomplete="off"/>

							<?php echo form_error('newpassword','<div class="alert alert-danger">','</div>'); ?>

						</div>

						<div class="form-group">

							<label for="passconf"><?php echo $this->lang->line('confirm_password');?></label>

							<input type="password" class="form-control"  name="passconf" id="passconf" value="" autocomplete="off"/>

							<?php echo form_error('passconf','<div class="alert alert-danger">','</div>'); ?>

						</div>

						<div class="form-group">

							<label for="prefered_language"><?php echo $this->lang->line('prefered_language');?></label>

							<select name="prefered_language" id="prefered_language" class="form-control" >

								<?php foreach ($languages as $key=>$language) { ?>

								<option value="<?php echo $key; ?>" <?php if($user['prefered_language'] == $key) { ?>selected="selected"<?php } ?>><?php echo $key; ?></option>

								<?php }?>

							</select>

						</div>

						<div class="form-group">

							<button type="submit" name="submit" class="btn square-btn-adjust btn-primary btn-sm right"><i class="fa fa-edit"></i> <?php echo $this->lang->line('edit');?></button>

						</div>

					<?php echo form_close(); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
function readURL(input) {
	if (input.files && input.files[0]) {//Check if input has files.
		var reader = new FileReader(); //Initialize FileReader.

		reader.onload = function (e) {
		$('#PreviewImage').attr('src', e.target.result);
		$("#PreviewImage").resizable({ aspectRatio: true, maxHeight: 300 });
		};
		reader.readAsDataURL(input.files[0]);
	}else {
		$('#PreviewImage').attr('src', "#");
	}
}
</script>