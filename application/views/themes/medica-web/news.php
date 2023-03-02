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
	<!----start-content----->
			<div class="content">
				<div class="wrap">
					<div class="services">
						<div class="service-content grid_1_of_4 images_1_of_4">
							<h3>Latest News</h3>
							<?php $i = 1;?>
							<?php foreach($news as $n){?>
							<ul>
								<li><span><?=$i;?>.</span></li>
								<li><p><a href="#"><?=$n['news_title'];?></a><?=$n['news_content'];?></p></li>
								<div class="clear"> </div>
							</ul>
							<?php $i++; ?>
							<?php }?>
						</div>
						<?php if($enable_services){?>
						<div class="services-sidebar grid_1_of_4 images_1_of_4">
							<h3>WE PROVIDE</h3>
							 <ul>
								<?php foreach($services as $service){?>
							  	<li><a href="<?=site_url('frontend/services');?>"><?=$service['service_heading'];?></a></li>
								<?php }?>
					 		 </ul>
						</div>
						<?php }?>
						<div class="clear"> </div>
					</div>
				<div class="clear"> </div>
				</div>
			<!----End-content----->
		</div>
		<!---End-wrap---->
