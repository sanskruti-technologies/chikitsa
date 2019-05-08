			<!----start-content----->
			<div class="content">
				<div class="wrap">
					<div class="services1">
						<h4>Our services</h4>
						
						<div class="boxs">
							<?php foreach($services as $service){?>
								<div class="grid_1_of_3 images_1_of_3">
									<div class="content-top-grid-header">
										<div class="content-top-grid-pic">
											<a href="#"><img src="<?php echo base_url().'/application/views/themes/medica-web/images/'.$service['service_image']; ?>" title="image-name"></a>
										</div>
										<div class="content-top-grid-title">
											<h3><?=$service['service_heading'];?></h3>
										</div>
										<div class="clear"> </div>
									</div>
									<p><?=$service['service_content'];?></p>
									<div class="clear"> </div>
								</div>
							<?php }?>
							<div class="clear"> </div>
					</div>
					
					</div>
				<div class="clear"> </div>
				</div>
			<!----End-content----->
		</div>
		<!---End-wrap---->
		