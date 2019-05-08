<?php
	$list_col_1_value = "";
	$list_detail_id = 0; 
	if($edit){
		$list_col_1_value = $list_detail['list_col_1_value'];
		$list_detail_id = $list_detail['list_detail_id'];
	}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<?=$list['list_label'];?>
			</div>
			<div class="panel-body">
				<?php if($edit){ ?>
				<?php echo form_open('settings/edit_list_detail/'.$list_detail_id); ?>
				<?php }else{ ?>
				<?php echo form_open('settings/add_list_detail/'.$list_name); ?>
				<?php } ?>
					<input type="hidden" name="list_name" id="list_col_1" value="<?=$list_name;?>" class="form-control"/>
					<div class="form-group">
						<label for="list_col_1"><?php echo $list['list_col_1_label'];?></label>
						<input type="text" name="list_col_1" id="list_col_1" value="<?=$list_col_1_value;?>" class="form-control"/>
						<?php echo form_error('list_col_1','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary" /><?php echo $this->lang->line('save');?></button>
					</div>
				<?php echo form_close(); ?>
			</div>
			</div>
		</div>
	</div>
</div>	