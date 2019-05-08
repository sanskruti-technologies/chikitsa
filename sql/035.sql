ALTER TABLE  %dbprefix%data CHANGE  ck_value  ck_value VARCHAR( 500 );
ALTER TABLE %dbprefix%followup CHANGE id id INT(11) NOT NULL AUTO_INCREMENT;
UPDATE %dbprefix%version SET current_version='0.3.5';