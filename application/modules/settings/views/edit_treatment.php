<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('edit_treatment');?>
			</div>
			<div class="panel-body">
				<?php echo form_open('settings/edit_treatment/'.$treatment['id']) ?>
					<input type="hidden" name="treatment_id" id="treatment_id" value="<?php echo $treatment['id']; ?>" class="form-control"/>	
					<div class="form-group">
						<label for="treatment"><?php echo $this->lang->line('treatment');?></label> 
						<input type="text" name="treatment" id="treatment" value="<?php echo $treatment['treatment']; ?>" class="form-control"/>
						<?php echo form_error('treatment','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<label for="treatment_price"><?php echo $this->lang->line('charges_fees');?></label>
						<input type="text" name="treatment_price" id="treatment_price" value="<?php echo $treatment['price']; ?>" class="form-control"/>
						<?php echo form_error('treatment_price','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary" /><?php echo $this->lang->line('save');?></button>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>