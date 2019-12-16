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
<script>
	$(window).load(function() {

		$('.confirmRestore').click(function(){
			return confirm("<?=$this->lang->line("irreversible_process");?>");
		});
		$('#sync_status_div').hide();
		$('#enable_sync').change(function(){
			if($('#enable_sync').is(':checked')){
				$('#sync_status_div').show();
			}else{
				$('#sync_status_div').hide();
			}

		});
		if($('#enable_sync').is(':checked')){
			$('#sync_status_div').show();
		}else{
			$('#sync_status_div').hide();
		}
		var radioValue = $("input[name='sync_status']:checked").val();
		if(radioValue == "online"){
			$('#offline_div').hide();
		}else{
			if(radioValue == "offline"){
				$('#offline_div').show();
			}
		}
		$("input[name='sync_status']").click(function(){
            var radioValue = $("input[name='sync_status']:checked").val();
			if(radioValue == "online"){
				$('#offline_div').hide();
            }else{
				if(radioValue == "offline"){
					$('#offline_div').show();
				}
			}
        });
	});
</script>
<div class="panel panel-primary">
	<div class="panel-heading">

			<h2><?=$this->lang->line("take_backup");?></h2>

	</div>
	<div class="panel-body">
		<a class="btn btn-success square-btn-adjust" href="<?php echo site_url("settings/take_backup/"); ?>"><?php echo $this->lang->line('take_backup');?></a>
		<br/><br/>
		<?php if(isset($error)){?>
			<div class="alert alert-danger">
				<?=$error;?>
			</div>
		<?php } ?>

	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h2><?php echo $this->lang->line("restore_backup");?></h2>
	</div>
	<div class="panel-body">
		<?php echo form_open_multipart('settings/restore_backup/'); ?>
			<?php if(isset($message)){?>
			<div class="alert alert-success">
				<?=$message;?>
			</div>
			<?php } ?>
			<div class="alert alert-danger">
			<?php echo $this->lang->line("irreversible_process");?>

			</div>
			<div class="form-group">
				<input type="file" id="backup" name="backup" class="form-control" size="20" />
			</div>
			<div class="form-group">
				<button class="btn btn-primary btn-sm square-btn-adjust confirmRestore" type="submit" name="submit" /><?php echo $this->lang->line('restore');?></button>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php if(in_array("sync", $active_modules)) { ?>
<div class="panel panel-primary">
	<div class="panel-heading">
		Synchronize
	</div>
	<div class="panel-body">
		<?php echo form_open('settings/synchronize/'); ?>
			<div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="enable_sync" name="enable_sync" value="1" <?php if($enable_sync == 1){echo "checked";};?>>Enable Sync
					</label>
				</div>
			</div>
			<div class="form-group" id="sync_status_div" style="display:none;">
				<div class="radio">
					<label>
						<input type="radio" name="sync_status" id="sync_status" value="offline" <?php if($sync_status == "offline"){ echo "checked";}?>>Offline
					</label>
				</div>
				<div class="form-group" id="offline_div" style="display:none;">
					<div class="form-group">
						<label for="online_url">Online URL</label>
						<input type="input" name="online_url" value="<?=$online_url;?>" class="form-control"/>
						<?php echo form_error('online_url','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="sync_status" id="sync_status" <?php if($sync_status == "online"){ echo "checked";}?> value="online">Online
					</label>
				</div>
			</div>
			<div class="form-group">
				<button class="btn btn-primary btn-sm square-btn-adjust" type="submit" name="submit" />Save</button>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php } ?>