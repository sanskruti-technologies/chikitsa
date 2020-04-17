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
<style>
  #myProgress {
    width: 100%;
    background-color: grey;
  }
  #myBar {
    width: 1%;
    height: 30px;
    background-color: green;
  }
</style>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('add')." ".$this->lang->line('language') . " : " .$language_name  ;?>
				</div>
				<div class="panel-body">
          <?php
            $dbprefix = $this->db->dbprefix;
            $server = $this->db->hostname;
            $username = $this->db->username;
            $password = $this->db->password;
            $database = $this->db->database;
            $language_sqls = array();
            $language_files = directory_map('./application/language/'.$language_name);
            foreach($language_files as $language_file){
              $lang = array();
              $destination = 'application/language/'.$language_name.'/'.$language_file;
              if($language_file!="index.html"){
                include($destination);
              }
              foreach($lang as $key => $l){
                $sql = "INSERT INTO ".$dbprefix."language_data (l_name,l_index,l_value) values('".addslashes($language_name)."','".addslashes($key)."','".addslashes($l)."');";
                if(mb_detect_encoding($sql, "UTF-8", "UTF-8, ISO-8859-9") != "UTF-8"){
							      $sql = utf8_encode($sql);
								}
                $language_sqls[$language_name][] = $sql;
              }
            }


          ?>

          <div id="myProgress">
						<input type="hidden" name="progress" id="progress" value="0"/>
						<div id="myBar"></div>
					</div>
					<span id="step">Please wait...</span>
          <textarea id="install_logs" class="form-control" rows=15 style="background:#eee;" readonly></textarea>
          <a style="display:none;" id="continue_button" class="btn btn-primary btn-sm square-btn-adjust" href="<?=site_url('settings/language/');?>"><?php echo $this->lang->line('continue'); ?></a>
        </div>
			</div>
			<!--End Advanced Tables -->
		</div>
	</div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
      var language = "<?=$language_name;?>";
      var language_sqls = <?php echo json_encode($language_sqls[$language_name]); ?>;

      $("#step").html("Loading Language File : "+ language );
      jQuery.each( language_sqls, function( i, sql) {
        $.ajax({url: "<?php echo base_url()."install_functions.php"; ?>",
                data: { action: 'install_sql' ,
                        sql : sql,server: '<?=$server;?>',
                        username: '<?=$username;?>',
                        password: '<?=$password;?>',
                        dbname:'<?=$database;?>',
                        dbprefix:'<?=$dbprefix;?>'
                      },
                success: function(result){
                  if(result != ''){
							             result =  $("#install_logs").val() + result + '\n';
							             $("#install_logs").val(result);
							             var textarea = $("#install_logs");
							             textarea.scrollTop(textarea[0].scrollHeight);
						       }

						       progress = parseInt($("#progress").val());
						       progress = progress + 1;
						       $("#progress").val(progress);

						       var total_queries = language_sqls.length;

						       $("#myBar").width(parseInt(progress/total_queries*100)+ '%');
						       if(progress == total_queries){
							        var index = parseInt($("#index").val());
							        index++;
							        $("#index").val(index);

								      $("#step").html("Complete");
								      $("#continue_button").show();
							    }
						    }


					});
      });
    });
</script>
