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
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<?php if ($error){
				echo "<div class='alert alert-danger'>$error</div>";
				?>
				<a href="<?=base_url() . "index.php/module/index/" ?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line('back'); ?></a>

				<?php
			}else{
			?>
			<?php
				$full_path = $file_upload['full_path'];
				$file_path = $file_upload['file_path'];
				$file_name = $file_upload['file_name'];
				$raw_name =  $file_upload['raw_name'];
			?>
			<div class="alert alert-success">
				<?php echo $this->lang->line('extracting'); ?> <?php echo $file_name; ?>...<br/>
				<?php
					$return_code = unzip($full_path,$file_path);
					if($return_code === TRUE){
						?><a href="<?=base_url() . "index.php/module/activate_module/" . $raw_name;?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line('activate'); ?></a><?php
					}else{
						?>
						<div class="alert alert-success">
						<?php echo $return_code; ?>
						</div>
						<?php
					}
				?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
