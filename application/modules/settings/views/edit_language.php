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

<script type="text/javascript">

$(window).load(function(){

	$(".language").change(function(){

		var language=$( this ) .val();

		var index=$(this).attr('id');

		var l_name= $('#l_name').val();

		$.ajax({

			type: "POST",

			url: "<?=site_url('settings/save_language_data/');?>",

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

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('languages');?></h5>
		</div>
		<div class="card-body">
			<div class="text-align">
				<a class="btn btn-primary square-btn-adjust btn-sm" href="<?=site_url("settings/language/");?>"><?=$this->lang->line('back');?></a>
			</div>
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