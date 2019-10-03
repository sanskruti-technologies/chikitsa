<script type="text/javascript">
$(window).load(function(){
	$(".language").change(function(){
		var language=$( this ) .val();
		var index=$(this).attr('id');
		var l_name= $('#l_name').val();
		$.ajax({
			type: "POST",
			url: "<?=site_url('settings/save_language/');?>",
			data: {language:language,index:index,l_name:l_name},
			success: function (result) {
				console.log(result);
				
				$('#'+result).addClass("btn-success", 500).delay(1000).queue(function(next){
					$(this).removeClass("btn-success", 500);
					next();
				});
				
			}
		});
	});
	$("#language_table").dataTable();
	
});
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('language');?> <?php echo $this->lang->line('save_language_instructions');?> 
			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="language_table">
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
								<td><input type="text" id="<?=  $language['l_index']?>" value="<?=  $language['l_value']?> " maxlength="66" size="66" class="form-control my_class language" />
									<input type="hidden" id="l_name" value="<?=$l_name?> "  class="form-control my_class language" />
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</div>
</div>