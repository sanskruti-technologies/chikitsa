ALTER TABLE %dbprefix%contacts CHANGE contact_image contact_image VARCHAR(255) NOT NULL DEFAULT ''; 
UPDATE %dbprefix%version SET current_version='0.8.2';