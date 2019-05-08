<?php 
	if(isset($tax_rate)){
		$edit = TRUE;
		$tax_id = $tax_rate['tax_id'];
		$tax_rate_name = set_value('tax_rate_name',$tax_rate['tax_rate_name']);
		$tax_rate = set_value('tax_rate',$tax_rate['tax_rate']);
	}else{
		$edit = FALSE;
		$tax_rate_name = set_value('tax_rate_name','');
		$tax_rate = set_value('tax_rate','');
	}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('tax_rate');?>
			</div>
			<div class="panel-body">
				<?php if($edit){ ?>
				<?php echo form_open('settings/edit_tax_rate/'.$tax_id) ?>
				<?php }else{ ?>
				<?php echo form_open('settings/insert_tax_rate') ?>
				<?php } ?>
				<div class="form-group">
						<label for="tax_rate_name"><?php echo $this->lang->line('tax_rate')." ".$this->lang->line('name');?></label> 
						<input type="text" name="tax_rate_name" id="tax_rate_name" value="<?=$tax_rate_name;?>" class="form-control"/>
						<?php echo form_error('tax_rate_name','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<label for="tax_rate"><?php echo $this->lang->line('tax_rate')." ".$this->lang->line('percentage');?></label>
						<input type="text" name="tax_rate" id="tax_rate" value="<?=$tax_rate;?>" class="form-control"/>
						<?php echo form_error('tax_rate','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary" /><?php echo $this->lang->line('save');?></button>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>