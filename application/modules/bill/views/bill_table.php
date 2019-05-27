<?php
	$total = ($particular_total + $fees_total + $treatment_total +  $lab_test_total +$item_total + $session_total);
?>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="bill_table">
		<thead>
			<tr>
				<th><span style="color:black;"><?php echo $this->lang->line("particular");?></span></th>
				<th><?php echo $this->lang->line("quantity");?></th>
				<th><?php echo $this->lang->line("mrp");?></th>
				<th><?php echo $this->lang->line("amount");?></th>
				<?php if($tax_type == "item"){?>
				<th><?php echo $this->lang->line("tax");?></th>
				<?php } ?>
				<?php if($edit_bill){ ?>
				<th><?php echo $this->lang->line("action");?></th>
				<?php } ?>
			</tr>									
		</thead>
		<tbody>
			<?php 
				if ($bill_details != NULL) {       
					$i=1;
					$current_type='';
					foreach ($bill_details as $bill_detail) {                     
						if ($current_type=='') {
							$current_type=$bill_detail['type'];                            
						}elseif($current_type <> $bill_detail['type']){ 
							?>
								<?php if($current_type == "fees"){ ?>
									<tr>
									<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
									<th style="text-align:right;"><?=currency_format($fees_total);if($currency_postfix) echo $currency_postfix; ?></th>
									<?php if($edit_bill){ ?>
									<td>&nbsp;</td>
									<?php } ?>
									</tr>
								<?php }elseif($current_type == "item"){ ?>
									<tr>
									<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
									<th style="text-align:right;"><?=currency_format($item_total);if($currency_postfix) echo $currency_postfix; ?></th>
									<?php if($edit_bill){ ?>
									<td>&nbsp;</td>
									<?php } ?>
									</tr>
								<?php }elseif($current_type == "particular"){ ?>
									<tr>
									<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
									<th style="text-align:right;"><?=currency_format($particular_total);if($currency_postfix) echo $currency_postfix; ?></th>
									<?php if($tax_type == "item"){?>
									<th style="text-align:right;"><?=currency_format($particular_tax_total);if($currency_postfix) echo $currency_postfix ?></th>
									<?php } ?>
									<?php if($edit_bill){ ?>
									<td>&nbsp;</td>
									<?php } ?>
									</tr>
								<?php }elseif($current_type == "treatment"){ ?>
									<tr>
									<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
									<th style="text-align:right;"><?=currency_format($treatment_total);if($currency_postfix) echo $currency_postfix; ?></th>
									<?php if($tax_type == "item"){?>
									<th style="text-align:right;"><?=currency_format($treatment_tax_total);if($currency_postfix) echo $currency_postfix; ?></th>
									<?php } ?>
									<?php if($edit_bill){ ?>
									<td>&nbsp;</td>
									<?php } ?>
									</tr>	
								<?php }elseif($current_type == "lab_test"){ ?>
									<tr>
									<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
									<th style="text-align:right;"><?=currency_format($lab_test_total);if($currency_postfix) echo $currency_postfix; ?></th>
									<?php if($tax_type == "item"){?>
									<th style="text-align:right;"><?=currency_format($lab_test_tax_total);if($currency_postfix) echo $currency_postfix; ?></th>
									<?php } ?>
									<?php if($edit_bill){ ?>
									<td>&nbsp;</td>
									<?php } ?>
									</tr>	
								<?php }elseif($current_type == "session"){ ?>
									<tr>
									<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
									<th style="text-align:right;"><?=currency_format($session_total);if($currency_postfix) echo $currency_postfix; ?></th>
									<?php if($tax_type == "item"){?>
									<th style="text-align:right;"><?=currency_format($session_tax_total);if($currency_postfix) echo $currency_postfix; ?></th>
									<?php } ?>
									<?php if($edit_bill){ ?>
									<td>&nbsp;</td>
									<?php } ?>
									
									</tr>	
								<?php }elseif($current_type == "disount" || $current_type == "tax"){ ?>
									<!-- Do Nothing -->
								<?php } ?>
							<?php
							$current_type=$bill_detail['type'];
						}
					?>
					<?php if($current_type != "discount" && $current_type != "tax"){ ?>	
					<tr <?php if ($i % 2 == 0) { echo "class='alt'";} ?> >
						<td><?php echo $bill_detail['particular'] ?></td>						
						<td style="text-align:right;"><?php echo $bill_detail['quantity'] ?></td>
						<td style="text-align:right;"><?php echo currency_format($bill_detail['mrp']);if($currency_postfix) echo $currency_postfix; ?></td>
						<td style="text-align:right;"><?php echo currency_format($bill_detail['amount']);if($currency_postfix) echo $currency_postfix; ?></td>
						<?php if($tax_type == "item"){?>
						<td style="text-align:right;"><?php echo currency_format($bill_detail['tax_amount']);if($currency_postfix) echo $currency_postfix; ?></td>
						<?php } ?>
						<?php if($edit_bill){ ?>
						<td>
							<?php if($bill_detail['type'] != 'session'){ ?>
						
								<a class="btn btn-sm btn-danger square-btn-adjust confirmDelete"  href="<?php echo site_url("patient/delete_bill_detail_table/".$called_from."/". $bill_detail['bill_detail_id'] . "/" . $bill_id . "/" . $visit_id . "/" . $patient_id); ?>"><?php echo $this->lang->line("delete");?></a>
							<?php } ?>
						</td>
						<?php } ?>
					</tr>
					<?php } ?>
				<?php $i++; ?>
				<?php } ?>				
				<?php if($current_type == "fees"){ ?>
					<tr>
					<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
					<th style="text-align:right;"><?=currency_format($fees_total);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php if($edit_bill){ ?>
					<td>&nbsp;</td>	
					<?php } ?>
					</tr>
				<?php }elseif($current_type == "item"){ ?>
					<tr>
					<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
					<th style="text-align:right;"><?=currency_format($item_total);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php if($edit_bill){ ?>
					<td>&nbsp;</td>	
					<?php } ?>
					</tr>
				<?php }elseif($current_type == "particular"){ ?>
					<tr>
					<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
					<th style="text-align:right;"><?=currency_format($particular_total);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php if($tax_type == "item"){?>
					<th style="text-align:right;"><?=currency_format($particular_tax_total);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php } ?>
					<?php if($edit_bill){ ?>
					<td>&nbsp;</td>	
					<?php } ?>
					</tr>
				<?php }elseif($current_type == "session"){ ?>
					<tr>
					<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
					<th style="text-align:right;"><?=currency_format($session_total);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php if($tax_type == "item"){?>
					<th style="text-align:right;"><?=currency_format($session_tax_total);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php } ?>
					<?php if($edit_bill){ ?>
					<td>&nbsp;</td>	
					<?php } ?>
					</tr>
				<?php }elseif($current_type == "treatment"){ ?>
					<tr>
					<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
					<th style="text-align:right;"><?=currency_format($treatment_total);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php if($tax_type == "item"){?>
					<th style="text-align:right;"><?=currency_format($treatment_tax_total);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php } ?>
					<?php if($edit_bill){ ?>
					<td>&nbsp;</td>	
					<?php } ?>
					</tr>
				<?php }elseif($current_type == "lab_test"){ ?>
					<tr>
					<th style="text-align:left;" colspan="3"><?php echo $this->lang->line('sub_total');?> - <?php echo $this->lang->line($current_type);?></th>
					<th style="text-align:right;"><?=currency_format($lab_test_total);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php if($tax_type == "item"){?>
					<th style="text-align:right;"><?=currency_format($lab_test_tax_total);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php } ?>
					<?php if($edit_bill){ ?>
					<td>&nbsp;</td>	
					<?php } ?>
					</tr>
				<?php }elseif($current_type == "discount" || $current_type == "tax"){ ?>
					<!-- Do Nothing -->
				<?php } ?>
				<tr class='total'>
					<?php if($tax_type == "item"){?>
					<th style="text-align:left;" colspan="4" ><?php echo $this->lang->line("total");?></th>
					<th style="text-align:right;"><?=currency_format($total + $session_tax_total + $particular_tax_total + $treatment_tax_total);if($currency_postfix) echo $currency_postfix; ?>
					
					</th>
						
					<?php }else{ ?>
					<th style="text-align:left;" colspan="3" ><?php echo $this->lang->line("total");?></th>
					<th style="text-align:right;"><?=currency_format($total);if($currency_postfix) echo $currency_postfix; ?>
					<input type="hidden" name="total_amount" id="total_amount" value="<?=$total;?>" />
					</th>
					<?php } ?>
					<?php if($edit_bill){ ?>
					<td>&nbsp;</td>	
					<?php } ?>
					
				</tr>
				<?php if($tax_type == "bill"){
						$tax_total = 0;
				?>
				<?php foreach($bill_details as $bill_detail){ ?>
				<?php if($bill_detail['type']=='tax') { ?>
					<tr>
						<th style="text-align: left;" colspan="2"  ></th>
						<td><?=$bill_detail['particular'];?></td>
						<th style="text-align: right;"><?= currency_format($bill_detail['amount']);if($currency_postfix) echo $currency_postfix; ?></th>
						<?php $tax_total =  $tax_total + $bill_detail['amount']; ?>
						
						<?php if($edit_bill){ ?>
						<td>
						<a class="btn btn-sm btn-danger square-btn-adjust confirmDelete"  href="<?php echo site_url("patient/delete_bill_detail_table/" .$called_from ."/".$bill_detail['bill_detail_id'] . "/" . $bill_detail['bill_id'] . "/" . $visit_id. "/".$patient_id); ?>"><?php echo $this->lang->line("delete");?></a>
						</td>
						<?php } ?>
						
					</tr>
				<?php } ?>
				<?php } ?>
				<?php } ?>
				<tr>
					<?php if($tax_type == "item"){?>
					<th style="text-align: left;" colspan="4" ><?php echo $this->lang->line("discount");?></th>
					<?php }else{ ?>
					<th style="text-align: left;" colspan="3" ><?php echo $this->lang->line("discount");?></th>
					<?php } ?>
					<th style="text-align: right;"><?= currency_format($discount);if($currency_postfix) echo $currency_postfix; ?></th>
					
					<?php if($edit_bill){ ?>
					<td>
						 
						<?php
							if($bill_detail['type'] != 'session'){ ?>
							<a class="btn btn-sm btn-danger square-btn-adjust confirmDelete"  href="<?php echo site_url("patient/delete_bill_discount/" . $bill_id . "/" . $visit_id . "/" . $patient_id."/".$called_from); ?>"><?php echo $this->lang->line("delete");?></a>
						<?php } ?>
					</td>
					<?php } ?>
					
				</tr>
				
				<tr>
					<?php if($tax_type == "item"){?>
					<th style="text-align: left;" colspan="4" ><?php echo $this->lang->line("to_be_paid");?></th>
					<?php }else{ ?>
					<th style="text-align: left;" colspan="3" ><?php echo $this->lang->line("to_be_paid");?></th>
					<?php } ?>
					<?php if($tax_type == "bill"){?>
					<th style="text-align: right;"><?= currency_format($total + $tax_total - $discount);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php } ?>
					<?php if($edit_bill){ ?>
					<td>&nbsp;</td>
					<?php } ?>
				</tr>
				<tr>
					<?php if($tax_type == "item"){?>
					<th style="text-align: left;" colspan="4" ><?php echo $this->lang->line("amount_paid");?></th>
					<?php }else{ ?>
					<th style="text-align: left;" colspan="3" ><?php echo $this->lang->line("amount_paid");?></th>
					<?php } ?>
					
					<th style="text-align: right;"><?= currency_format($paid_amount);if($currency_postfix) echo $currency_postfix; ?></th>
					<?php if($edit_bill){ ?>
					<td>&nbsp;</td>
					<?php } ?>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>