
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success">
				<div class="col-md-12">
				<?php 
					//$current_version = $this->config->item('current_version'); 
					//$latest_version = $current_version;
					$doc = new DOMDocument();
					$doc->load( "http://sanskruti.net/chikitsa/modules/chikitsa.xml" );//xml file loading here
					echo "<ul>";
					$chikitsa = $doc->getElementsByTagName( "chikitsa" );
					foreach( $chikitsa as $c ){
						$download = $c->getElementsByTagName( "download" );
						foreach( $download as $d ){
							$change_log = $c->getElementsByTagName( "change_log" );
							foreach( $change_log as $cl){
								echo "<h3>{$node->nodeName}</h3>";
								$changed = $d->getElementsByTagName( "changed" );
								foreach($changed as $node) {
								  echo "<br/><li> {$node->nodeValue} </li>";
								}
							}
						}
					}
					echo "</ul>";
					?>
				</div>
				<br/>
				<a href="<?=base_url() . "index.php/module/activate_module/" . $module_name;?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line('continue'); ?></a>
			</div>
		</div>
	</div>
</div>
