<div class="content">
	<div class="clear"> </div>
	<div class="book_appointment">
		<div class="wrap">
			<div class="grid_4_of_4 contact-form">
				<div class="boxs">
					<div class="section group">
						<h4><?=$this->lang->line('appointment_payment_success');?></h4>
						<div class="grid_1_of_4 images_1_of_4">
							<label><?=$this->lang->line('item_number');?>: </label>
							<input type="text" name="item_number" id="item_number" value="<?=$item_number;?>" readonly />
						</div>
						<div class="grid_1_of_4 images_1_of_4">
							<label><?=$this->lang->line('txn_id');?>: </label>
							<input type="text" name="txn_id" id="txn_id" value="<?=$txn_id;?>" readonly />
						</div>
						<div class="grid_1_of_4 images_1_of_4">
							<label><?=$this->lang->line('amount_paid');?>: </label>
							<input type="text" name="payment_amt" id="payment_amt" value="<?php echo $payment_amt.' '.$currency_code; ?>" readonly />
						</div>
						<div class="grid_1_of_4 images_1_of_4">
							<label><?=$this->lang->line('payment_status');?>: </label>
							<input type="text" name="status" id="status" value="<?php echo $status; ?>" readonly />
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<a href="<?=site_url('frontend/my_account');?>" class="make_appointment_button"><?=$this->lang->line('continue');?></a>
				<div class="clear"></div>
			</div>
			
		</div>
	</div>
</div>