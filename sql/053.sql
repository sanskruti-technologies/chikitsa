ALTER TABLE %dbprefix%patient ADD wp_user_id INT(11) NULL AFTER dob;
UPDATE %dbprefix%version SET current_version='0.5.3';