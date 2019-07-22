<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo $this->lang->line("add")." Type";?>
				</div>
				<div class="panel-body">
					<?php echo form_open_multipart('doctor/edit_type/') ?>						
						<input type="hidden" name="type_id" class="inline" value="<?=$types['type_id']?>"/>						
						<div class="col-md-6">
							<div class="form-group">
								<label for="type"><?php echo $this->lang->line("type")." ".$this->lang->line("name");?></label>
								<input type="input" name="type_name" class="form-control" value="<?=$types['type_name']?>"/>
								<?php echo form_error('type','<div class="alert alert-danger">','</div>'); ?>
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