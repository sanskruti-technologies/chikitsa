<?php

/*
	This file is part of Chikitsa.

    Chikitsa is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Chikitsa is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Chikitsa.  If not, see <https://www.gnu.org/licenses/>.
*/
?>
<style>
a{
	text-decoration: none !important;
}

</style>
<script type="text/javascript" charset="utf-8">
$(window).load(function() {
	$("#extensions_table").dataTable({
		"pageLength": 50
	});    
	$('.confirmDeactivate').click(function(){
		return confirm("<?=$this->lang->line('areyousure_deactivate');?>");
	});
	$('.confirmClearData').click(function(){
		return confirm("<?=$this->lang->line('areyousure_cleardata');?>");
	});

	$('#activate_plugins').click(function(event) {
		event.preventDefault();
		//$( "#nag_screen_modal" ).modal('toggle');
	});
	$('#update').click(function(event) {
		event.preventDefault();
		var url = $( "#show_alert" ).attr("href");
		setTimeout(function(){ window.location.replace(url);}, 500);
	});
})
</script>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<?php
				if($connection_message != NULL){
					?><div class="alert alert-danger"><?=$connection_message;?></div><?php
				}
	?>
	<?php
			if($message != NULL){
				if($message_type == "error"){
					?><div class="alert alert-danger"><?=$message?></div><?php
				}else{
					?><div class="alert alert-success"><?=$message?></div><?php
				}
			}
	?>
	<!-- Download links -->
	<?php 
					$current_version = $this->config->item('current_version');
					$latest_version = $current_version;
					
					$chikitsa_content=json_decode($module_chikitsa['xml_content'],true);
					$download_link=$chikitsa_content['link'];
					$latest_version=$module_chikitsa['xml_version'];
					
					$current_version_int = (int)str_replace(".","",$current_version);
					$latest_version_int =  (int)str_replace(".","",$latest_version);
							
					if($current_version_int < $latest_version_int){ ?>
						<a id="show_alert" href="<?=site_url("module/dowload_chikitsa/".$download_link."/".$latest_version);?>" class="btn btn-success square-btn-adjust btn-sm"><?=$software_name;?> <?=$latest_version;?> <?=$this->lang->line('chikitsa_new_version_available');?></a>
					<?php }

	?>
		<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary">
				<?php echo $this->lang->line('extensions');?>
			</h5>
		</div>
		<div class="card-body">
			<div class="text-align">
			<a href="<?=base_url() . "index.php/module/add/";?>" class="btn square-btn-adjust btn-primary btn-sm "><?=$this->lang->line('add_extension');?></a>
			</div>
			<div class="col-md-12">
						<br/>
						<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover display responsive nowrap">
							<tr>
								<th><?php echo $this->lang->line('extensions'); ?></th>
								<th><?php echo $this->lang->line('description'); ?></th>
							</tr>
							<?php foreach($modules as $module) { ?>
							<?php
								if($module['license_key']==NULL || $module['license_key']==""){
									$module_message="Please Add License Key .";
									$style='style="color:#a94442 !important;"';
								}elseif($module['valid_till']=='1970-01-01'){
									$module_message="";
									$style='style="color:#a94442 !important;"';
								}elseif(strtotime(date("Y-m-d")) > strtotime($module['valid_till'])){
									$module_message="Expired ";
									$style='style="color:#a94442 !important;"';
								}elseif ($module['valid_till']!=NULL || $module['license_key']=="") {
									$module_message="Valid Till ".date($def_dateformate,strtotime($module['valid_till']));
									$style='style="color:#3c763d !important;"';
								}else{
									$module_message="License Key is either expired or is not valid. Please renew or purchase valid license key.";
									$style='style="color:#a94442 !important;"';
								}
							?>

								<tr>
									<td width="40%">
										<strong><?=$module['module_display_name'] ;?></strong>
										<br/><br/>
										<?php //Check if folder exists ?>
										<?php $dir_name =  './application/modules/'.$module['module_name']; ?>
										<?php if (file_exists($dir_name) && is_dir($dir_name)) {
											/**Check Module Status************************************************/
											if($module['module_status'] == 1) { ?>
												<a href="<?=base_url() . "index.php/module/deactivate_module/" . $module['module_name'];?>" style="color:#a94442;" class=" confirmDeactivate"><?=$this->lang->line('deactivate');?></a> <br/>
											<?php } else { ?>
										<?php if($module['license_status'] == 'active') {?>
												<a href="<?=base_url() . "index.php/module/activate_module/" . $module['module_name'];?>" class="" style="color:#3c763d;"><?=$this->lang->line('activate');?></a> <br/>
										<?php } ?>
										<a href="<?=base_url() . "index.php/module/clear_data/" . $module['module_name'];?>" class=" confirmClearData"><?=$this->lang->line('clear_data');?></a> <span>&nbsp;|</span>
														<?php }
														$module_name = $module['module_name'];
														foreach($module_license_status as $module_status){
									if($module_status['module_name'] == $module_name){
																if($module_status['module_status'] == 'update_required'){
									//	if($module_status['license_status'] == 'valid'){
																	if($module['license_status'] == 'active'){
																		?><a href="<?=base_url() . "index.php/module/update_extension/" . $module['module_name'];?>" class=""><?=$this->lang->line('update');?></a><span>&nbsp;|</span>
																		<?php
																	}else{
																		if($module['license_key'] == '' || $module['license_key'] == NULL ){
																			?><a href="https://chikitsa.net/" target="_blank"  class="">Add License Key To Update</a><span>&nbsp;|</span>
																			<?php
																		}else{
																			?><a href="https://chikitsa.net/" target="_blank"  class=""><?=$this->lang->line('renew_license_to_update');?></a><span>&nbsp;|</span>
																			<?php
																		}
																		
																	}
																}
																if($module['license_status'] == 'active'){
																	?><a href="<?=base_url() . "index.php/module/deactivate_license_key/" . $module['module_name'];?>" class="">Deactivate License Key</a><span>&nbsp;|</span>
																	<?php
																}
															}
														}

									?>

													<?php }else{  ?>
														<a href="#" class=""  style="color:#a94442;" ><?=$this->lang->line('file_missing');?></a> <span>&nbsp;|</span>
										<?php if($module['license_status'] == "active"){ ?>
										<a href="<?=site_url('module/download_extension/'. $module['module_name']);?>" class=""><?=$this->lang->line('download_extension');?></a><span>&nbsp;|</span>
										<?php } ?>
									<?php }  ?>


									<?php
									/**Check License Status************************************************/
									if($module['license_key'] != ""){
										if($module['license_status'] != "active"){?>
										<a href="<?=base_url() . "index.php/module/activate_license_key/" . $module['module_name'];?>" class=""><?=$this->lang->line('activate');?> <?=$this->lang->line('license_key');?></a><span>&nbsp;|</span>
									<?php } ?>
									<a href="<?=base_url() . "index.php/module/license_key/" . $module['module_name'];?>" class=""><?=$this->lang->line('edit');?> <?=$this->lang->line('license_key');?></a>
									<?php }else{  ?>
									<a href="<?=base_url() . "index.php/module/license_key/" . $module['module_name'];?>" class=""><?=$this->lang->line('add');?> <?=$this->lang->line('license_key');?>
									<?php }  ?>


									</td>
									<td>
										<?=$module['module_description'] ;?>
							<br/><br/>
							<b><?php echo $this->lang->line('version'); ?></b> <?=$module['module_version'] ;?>
							<br/><br/>
							<span <?=$style ?> ><?php echo $module_message;?></span>
									</td>
								</tr>
							<?php } ?>
						</table>
						</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="nag_screen_modal" tabindex="-1" role="dialog" aria-labelledby="myNagScreenLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title" id="myNagScreenLabel">Activate Plugins</h4>
		</div>
		<div class="modal-body">
			<p>Your following extensions are not activated.</p>
			<ul>
			<?php foreach($non_licence_activated_plugins as $non_licence_activated_plugin){ ?>
				<li><?=$non_licence_activated_plugin['module_display_name'];?></li>
			<?php } ?>
			</ul>
			<div class="alert alert-danger">If you upgrade now, they might stop working</div>
		</div>
		<div class="modal-footer">
			<a href="https://chikitsa.net/plugin-policy/" target="_blank" class="btn btn-primary activate_plugins btn-sm" >Know More</a>
			<a id="activate_plugins" class="btn btn-primary activate_plugins btn-sm" >Activate First</a>
			<a id="update" class="btn btn-danger remind_later btn-sm" >Update Anyway</a>
		</div>
	</div>
	</div>
</div>