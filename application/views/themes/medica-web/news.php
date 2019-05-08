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
		

