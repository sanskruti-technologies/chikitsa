<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo $this->lang->line("edit")." ".$this->lang->line("group");?>
				</div>
				<div class="panel-body">
					<?php echo form_open_multipart('doctor/edit_group/') ?>						
						<input type="hidden" name="id" class="inline" value="<?=$groups['id']?>"/>						
						<div class="col-md-6">
							<div class="form-group">
								<label for="group_name"><?php echo $this->lang->line("group")." ".$this->lang->line("name");?></label>
								<input type="input" name="group_name" class="form-control" value="<?=$groups['group_name']?>"/>
								<?php echo form_error('group_name','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit" name="submit" /><?php echo $this->lang->line("save");?></button>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>