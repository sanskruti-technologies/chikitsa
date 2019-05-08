ALTER TABLE  %dbprefix%contacts CHANGE  type  type VARCHAR( 50 ) NULL ;
ALTER TABLE  %dbprefix%contacts ADD title VARCHAR( 5 ) NULL AFTER  contact_id ;
UPDATE %dbprefix%version SET current_version='0.4.6';