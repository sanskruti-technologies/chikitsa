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
<script type="text/javascript" charset="utf-8">	
	$(window).load(function(){
		$("#contact_form").submit(function(){
			event.preventDefault();
			var email_value =  $("#email").val();
			var name_value =  $("#name").val();
			var mobile_value =  $("#mobile").val();
			var message_value =  $("#message").val();
			$.post("<?php echo base_url(); ?>index.php/frontend/contact_email", {email: email_value,name : name_value, mobile : mobile_value, message : message_value } ,function(data, status){
				alert("Data: " + data + "\nStatus: " + status);
			});
		});
	});
</script>
			<!----start-content----->
			<div class="content">
				<div class="wrap">
					<!---start-contact---->
					<div class="contact">
						<div class="section group">
				<div class="col span_1_of_3">

      			<div class="company_address">
				     	<h3>Company Information :</h3>
						<p><?=$clinic['clinic_address'];?></p>
				   		<p>Phone : <?=$clinic['landline'];?></p>
				 	 	<p>Email: <span><?=$clinic['email'];?></span></p>
				   		<p>Follow on: <span><a href="http://<?=$frontend_settings['facebook'];?>">Facebook</a></span>, <span><a href="http://<?=$frontend_settings['twitter'];?>">Twitter</a></span></p>
				   </div>
				</div>
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>Contact Us</h3>
						<div id="contact_form_message"></div>
					    <form id="contact_form" method="post">
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input name="name" id="name" type="text" value=""></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input name="email" id="email" type="text" value=""></span>
						    </div>
						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input name="mobile" id="mobile" type="text" value=""></span>
						    </div>
						    <div>
						    	<span><label>MESSAGE</label></span>
						    	<span><textarea name="message" id="message"></textarea></span>
						    </div>
							<div>
						   		<span><input type="submit" value="Send"></span>
							</div>
					    </form>
				    </div>
  				</div>
			  </div>
					</div>
					<!---End-contact---->
				<div class="clear"> </div>
				</div>
			<!----End-content----->
		</div>
		<!---End-wrap---->
