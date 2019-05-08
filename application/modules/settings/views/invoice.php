<?php
    if(!$invoice)
    {
        $static_prefix = '';
        $left_pad = '';
        $currency_symbol = '';
        $currency_postfix = '';
    }
    else
    {
        $static_prefix = $invoice['static_prefix'];
        $left_pad = $invoice['left_pad'];
        $currency_symbol = $invoice['currency_symbol'];
        $currency_postfix = $invoice['currency_postfix'];
    }
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
					<?php echo $this->lang->line('invoice_details');?>
			</div>
			<div class="panel-body">
			<?php echo form_open('settings/invoice') ?>
					<div class="form-group">
						 <label for="static_prefix"><?php echo $this->lang->line('static_prefix');?></label> 
						<input type="input" name="static_prefix" value="<?=$static_prefix; ?>" class="form-control"/>
						<?php echo form_error('static_prefix','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<label for="left_pad"><?php echo $this->lang->line('length_invoice');?> </label> 
						<input type="input" name="left_pad" value="<?=$left_pad; ?>" class="form-control"/>
						<?php echo form_error('left_pad','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<label for="currency_symbol"><?php echo $this->lang->line('curr_pre');?></label> 
						<input type="input" name="currency_symbol" value="<?=$currency_symbol; ?>" class="form-control"/>
						<?php echo form_error('currency_symbol','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<label for="currency_postfix"><?php echo $this->lang->line('curr_post');?></label> 
						<input type="input" name="currency_postfix" value="<?=$currency_postfix; ?>" class="form-control"/>
						<?php echo form_error('currency_postfix','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary" /><?php echo $this->lang->line('save');?></button>
					</div>
			<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>