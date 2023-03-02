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

<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="row">

			<div class="col-md-12">

				<div class="alert alert-success">

					<div class="col-md-12">

					<?php

						//$current_version = $this->config->item('current_version');

						//$latest_version = $current_version;

						$found = false;

						$doc = new DOMDocument();

						$doc->load( "https://chikitsa.net/chikitsa.xml" );//xml file loading here

						echo "<h5>Changes in new version</h5>";

						echo "<ul>";

						$chikitsa = $doc->getElementsByTagName( "chikitsa" );

						foreach( $chikitsa as $c ){

							$download = $c->getElementsByTagName( "download" );

							foreach( $download as $d ){

								$module = $d->getElementsByTagName( "module" );

								foreach($module as $mn){

									if($mn->nodeValue == $module_name){

										$found = true;

										$change_log = $d->getElementsByTagName( "change_log" );

										foreach( $change_log as $cl){

											$changed = $cl->getElementsByTagName( "changed" );

											foreach($changed as $node) {

											echo "<br/><li> {$node->nodeValue} </li>";

											}

										}

										break;

									}

								}

								if($found) break;

							}

							if($found) break;

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
	</div>
</div>