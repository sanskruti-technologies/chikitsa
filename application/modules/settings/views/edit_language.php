<script type="text/javascript">
$(window).load(function(){
	$("input").change(function(){
		var language=$( this ) .val();
		var index=$(this).attr('id');
		$.ajax({
			type: "POST",
			url: "<?=site_url('settings/save_language/');?>",
			data: {language:language,index:index},
			success: function (result) {
				console.log(result);
			}
		});
	});
});
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('language');?>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="bill_table">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('language')." ".$this->lang->line('key');?></th>
							<th><?php echo $this->lang->line('language')." ".$this->lang->line('value');?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($language_array as $language) { ?>
							<tr>
								<td><?php echo $language['l_index']; ?></td>
								<td><input type="text" id="<?=  $language['l_index']?>" value="<?=  $language['l_value']?> " maxlength="66" size="66" class="form-control my_class" /></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</div>
</div>