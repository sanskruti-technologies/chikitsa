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
		<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('about');?></h6>
		</div>
	    <div class="card-body">
            <h4> <?php  echo $software_name." " .$version['current_version'] ?></h4>
			<p><strong><?php echo $this->lang->line('website');?> : </strong><a href="<?php echo $website_url;?>"><?php echo $website_text;?></a> <br>
			<strong><?php echo $this->lang->line('support');?> : </strong><a href="<?php echo $support_url;?>"><?php echo $support_text;?></a></p>
			<br>
			<?php  echo $about_us_content; ?>
        </div>
    </div>
</div>