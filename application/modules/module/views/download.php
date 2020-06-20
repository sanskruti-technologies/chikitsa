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
function download_remote_file_with_curl($file_url, $save_to)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch,CURLOPT_URL,$file_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$file_content = curl_exec($ch);
	curl_close($ch);

	$downloaded_file = fopen($save_to, 'w');
	fwrite($downloaded_file, $file_content);
	fclose($downloaded_file);
}
function extract_zip($zip_file, $extract_path)
{
	$zip = new ZipArchive;
	if ($zip->open($zip_file) === TRUE) {
		$zip->extractTo($extract_path);
		$zip->close();
		return TRUE;
	} else {
		return FALSE;
	}
}
function delete_file($file_name){
	if(file_exists($file_name)){
		unlink ($file_name);
	}
}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success">
				<?php $module_name =  $module['module_name']; ?>
				<?php $download_zip = "http://sanskrutitech.in/chikitsa_module/" . $module_name . ".zip"; ?>
				<?php $download_sql = "http://sanskrutitech.in/chikitsa_module/" . $module_name . ".sql"; ?>
				<?php $download_path = "./application/modules_core/". $module_name . ".zip"; ?>
				<?php $extract_path = "./application/modules_core/"; ?>
				<?php $sql_file = "./application/modules_core/". $module_name . ".sql"; ?>
				<?=$this->lang->line('downloading_files');?>...<br/>
				<?php download_remote_file_with_curl($download_zip,$download_path); ?>
				<?php download_remote_file_with_curl($download_sql,$sql_file); ?>
				<?=$this->lang->line('unpacking_zip_package');?>...<br/>
				<?php if (extract_zip($download_path,$extract_path)){ ?>
					<?=$this->lang->line('installing');?> <?= $module_name; ?> <?=$this->lang->line('module');?>...<br/>
					<?php delete_file($download_path); ?>
				<?php } else { ?>
					<?=$this->lang->line('extraction_failed');?>...<br/>
				<?php }  ?>
				<a href="<?=base_url() . "index.php/module/activate_module/" . $module['module_id'];?>" class="btn btn-primary square-btn-adjust"><?=$this->lang->line('activate');?></a>
			</div>
		</div>
	</div>
</div>
