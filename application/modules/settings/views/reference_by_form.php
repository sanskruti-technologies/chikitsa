<?php
	$reference_option = "";
	$placeholder = "";
	$reference_add_option = 0;
	if(isset($reference)){
		$reference_id = $reference['reference_id'];
		$reference_option = $reference['reference_option'];
		$reference_add_option = $reference['reference_add_option'];
		$placeholder = $reference['placeholder'];
	}
?>
<div id="page-inner">
	
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary" >
				<div class="panel-heading" >
					<?php echo $this->lang->line('reference_by');?>
				</div>
				<div class="panel-body" >
				<?php if(isset($reference)){ 
					echo form_open('settings/edit_reference/'.$reference_id);
				}else{
					echo form_open('settings/add_reference');
				} ?>
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="form-group" >
								<label for="reference_option"><?php echo $this->lang->line('option');?></label> 
								<input type="input" name="reference_option" value="<?=$reference_option;?>" class="form-control"/>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group" >
								<label for="reference_add_option"><?php echo $this->lang->line('add_detail');?> 
								<input type="checkbox" name="reference_add_option" class="form-control" value="1" <?php if($reference_add_option ==1) { echo "checked"; } ?>/></label> 
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group" >
								<label for="placeholder"><?php echo $this->lang->line('placeholder');?></label> 
								<input type="input" name="placeholder" value="<?=$placeholder;?>" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="form-group" >
								<button type="submit" name="submit" class="btn btn-primary" /><?php echo $this->lang->line('save');?></button>
								<a class="btn btn-primary" href="<?=site_url('settings/reference_by');?>" ><?php echo $this->lang->line('back');?></a>
							</div> 
						</div> 
					</div>
					</div>
				<?php echo form_close(); ?>
				</div>
		</div>
	</div>
</div>