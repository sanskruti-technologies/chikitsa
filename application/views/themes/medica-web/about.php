			<!----start-content----->
			<div class="content">
				<div class="wrap">
				<div class="boxs">
					<?php if($about_number_of_columns >= 1){ ?>
					<?php if($about_number_of_columns == 3){ ?>
						<div class="grid_1_of_3 images_1_of_3">	
					<?php }elseif($about_number_of_columns == 2){ ?>
						<div class="grid_1_of_2 images_1_of_2">	
					<?php }elseif($about_number_of_columns == 1){ ?>
						<div class="grid_4_of_4 images_4_of_4">	
					<?php } ?>
						<h3><?=$about_header1;?></h3>
						<?=$about_content1;?>
					</div>
					<?php } ?>
					
					<?php if($about_number_of_columns >= 2){ ?>
					<?php if($about_number_of_columns == 3){ ?>
						<div class="grid_1_of_3 images_1_of_3">	
					<?php }elseif($about_number_of_columns == 2){ ?>
						<div class="grid_1_of_2 images_1_of_2">	
					<?php } ?>
						<h3><?=$about_header2;?></h3>
						<?=$about_content2;?>
					</div>
					<?php } ?>
					
					<?php if($about_number_of_columns >= 3){ ?>
					<div class="grid_1_of_3 images_1_of_3">
						<h3><?=$about_header3;?></h3>
						<?=$about_content3;?>
					</div>
					<?php } ?>
					<div class="clear"> </div>
								<?php if (in_array("doctor", $active_modules)) { ?>
								<div class="ourteam">
									<h3>Our Doctors</h3>
									<div class="section group">
										<?php
										$i=1;
										foreach($doctors as $doctor){
											?>
											<div class="grid_1_of_4 images_1_of_4">
												<img src="<?=base_url().$doctor['contact_image'];?>">
												<h3><?=$doctor['first_name'].' '.$doctor['middle_name'].' '.$doctor['last_name'];?></h3>
												<p><?=$doctor['description'];?></p>
											</div>	
										<?php } ?>
									</div>
								</div>
								<?php } ?>
			</div>
				<div class="clear"> </div>
				</div>
			<!----End-content----->
		</div>
		<!---End-wrap---->
		