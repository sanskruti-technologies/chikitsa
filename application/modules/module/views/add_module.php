<script type="text/javascript" charset="utf-8">
$(window).load(function() {
    $('.confirmDeactivate').click(function(){
		return confirm(<?=$this->lang->line('areyousure_deactivate');?>);
	});	
} )
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
				<h3><?=$this->lang->line('add');?> <?=$this->lang->line('extensions');?></h3>
				<a href="<?=base_url() . "index.php/module/upload/";?>" class="btn btn-success square-btn-adjust confirmDeactivate"><?=$this->lang->line('upload_extension');?></a>
				<a href="<?=base_url() . "index.php/module/index/";?>" class="btn btn-success square-btn-adjust confirmDeactivate"><?=$this->lang->line('back');?></a>
				<br/><br/>
				<?php if (isset($error)) { ?><div class="alert alert-danger"><?php echo $error; ?></div> <?php } ?>
				<br/>
			</div>
			<div class="col-md-12">
				<?php
					$doc = new DOMDocument();
					$doc->load( "http://sanskruti.net/chikitsa/modules/chikitsa.xml" );//xml file loading here
					
					$downloads = $doc->getElementsByTagName( "download" );
					foreach( $downloads as $download ){
						$titles = $download->getElementsByTagName( "title" );
						$title = $titles->item(0)->nodeValue;
						$descriptions = $download->getElementsByTagName( "description" );
						$description = $descriptions->item(0)->nodeValue;
						$images = $download->getElementsByTagName( "image_link" );
						$image = $images->item(0)->nodeValue;
						$links = $download->getElementsByTagName( "download_link" );
						$link = $links->item(0)->nodeValue;
						$last_updateds = $download->getElementsByTagName( "last_updated" );
						$last_updated = $last_updateds->item(0)->nodeValue;
						$usd_prices = $download->getElementsByTagName( "usd_price" );
						$usd_price = $usd_prices->item(0)->nodeValue;
						$chikitsa_version = $download->getElementsByTagName( "chikitsa_version" );
						$required_version = $chikitsa_version->item(0)->nodeValue;
						$current_version = $this->config->item('current_version'); 
					
						$current_version_int = (int)str_replace(".","",$current_version);
						$required_version_int =  (int)str_replace(".","",$required_version);
						if($current_version_int < $required_version_int){
							$is_compatible = "This extension requires Chikitsa $required_version";
							$compatible_class = "alert-danger";
						}else{
							$is_compatible = "Compatible with this version of Chikitsa";
							$compatible_class = "alert-success";
						}
						
						
						?>
						<div class="col-md-4 single-module">
							<span class='image'><img src='<?=$image;?>'/></span>
							<span class='extension_name'><?=$title;?></span>
							<span class='extension_description'><?=$description;?></span>
							<span class='extension_price'>$<?=$usd_price;?></span>
							<span class='extension_last_updated'>Last Update : <?=date($def_dateformate,strtotime($last_updated));?></span>
							<div class='extension_is_compatible alert <?=$compatible_class;?>'><?=$is_compatible;?></div>
							<a class="btn btn-primary square-btn-adjust" href='<?=$link;?>'>Purchase</a>
						</div>
						<?php 
					}
				?>
				
			</div>
		
		</div>
	</div>
</div>