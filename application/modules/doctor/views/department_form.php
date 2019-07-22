<?php
	if(isset($department)){
		$department_id = $department['department_id'];
		$department_name = $department['department_name'];
		$edit = TRUE;
	}else{
		$edit = FALSE;
		$department_name = "";
	}
	
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php if($edit){ ?>
					<?php echo $this->lang->line("edit")." ".$this->lang->line("department");?>
					<?php }else{ ?>
					<?php echo $this->lang->line("add")." ".$this->lang->line("department");?>
					<?php } ?>
				</div>
				<div class="panel-body">
					<?php if($edit){ ?>
					<?php echo form_open_multipart('doctor/edit_department/') ?>						
						<input type="hidden" name="department_id" class="inline" value="<?=$department_id;?>"/>	
					<?php }else{ ?>
					<?php echo form_open_multipart('doctor/add_department/') ?>	
					<?php } ?>
						<div class="col-md-6">
							<div class="form-group">
								<label for="department_name"><?php echo $this->lang->line("department") . ' ' . $this->lang->line("name");?> </label>
								<input type="input" name="department_name" class="form-control" value="<?=$department_name?>"/>
								<?php echo form_error('department_name','<div class="alert alert-danger">','</div>'); ?>
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