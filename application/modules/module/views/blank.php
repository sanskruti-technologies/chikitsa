<script> 
    $( document ).ready(function () {
		$("#logs").append("<?=$this->lang->line('updating_to_latest');?>");
		$("#logs").append("<?=$this->lang->line('donot_close_browser');?>");
		$("#logs").append("<?=$this->lang->line('download_chikitsa');?>");
		// Get the zip file
        $.get("<?=site_url('module/get_latest_chikitsa');?>/<?=$file;?>/<?=$latest_version;?>", function (response) {
			$("#logs").append(response+"<br/>");
			$("#logs").append("<?=$this->lang->line('unzip_file');?>");
			$.get("<?=site_url('module/unzip_chikitsa');?>/<?=$latest_version;?>", function (response) {
				$("#logs").append(response+"<br/>");
				window.location.replace("<?=site_url();?>");
			});  
        });
      });
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div id="logs">
			</div>
		</div>
	</div>
</div>