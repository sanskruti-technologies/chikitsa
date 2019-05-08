<script type="text/javascript" charset="utf-8">
$(window).load(function() {
    $('.confirmDeactivate').click(function(){
		return confirm(<?=$this->lang->line('areyousure_deactivate');?>);
	});	
} )
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
				<h3><?=$this->lang->line('upload_extension');?></h3>
				<br/>
				<?php if (isset($error)) { ?><div class="alert alert-danger"><?php echo $error; ?></div> <?php } ?>
				<br/>
				<h4><?=$this->lang->line('upload_extention_instruction');?></h4>
			</div>
			<div class="col-md-12">
				
				<?php echo form_open_multipart('module/upload_module/') ?>
					<div class="form-group">
						<input type="file" id="extension" name="extension" class="form-control" size="20" />
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-sm square-btn-adjust" type="submit" name="submit" /><?php echo $this->lang->line('install');?></button>
					</div>
				<?php echo form_close(); ?>
			</div>
			<div class="col-md-12">
				<a href="<?=base_url() . "index.php/module/index/";?>" class="btn btn-success square-btn-adjust confirmDeactivate"><?=$this->lang->line('back');?></a>
			</div>
		</div>
	</div>
</div>