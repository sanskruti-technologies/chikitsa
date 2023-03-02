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