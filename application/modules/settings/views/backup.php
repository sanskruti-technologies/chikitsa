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
		<?=$this->lang->line("take_backup");?>
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
		<?php echo $this->lang->line("restore_backup");?>
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
