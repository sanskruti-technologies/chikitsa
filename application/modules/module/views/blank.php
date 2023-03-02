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
<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-body">	
			<div class="row">

				<div class="col-md-12">

					<div id="logs">

					</div>

				</div>

			</div>
	  	</div>
	</div>
</div>