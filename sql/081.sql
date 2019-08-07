ALTER TABLE %dbprefix%language_data CHANGE l_value l_value VARCHAR(700) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
UPDATE %dbprefix%version SET current_version = '0.8.1'; 