DELETE t1 FROM %dbprefix%data t1 INNER JOIN %dbprefix%data t2 WHERE t1.ck_data_id < t2.ck_data_id AND t1.ck_key = t2.ck_key;
ALTER TABLE %dbprefix%data ADD UNIQUE(ck_key);
UPDATE %dbprefix%version SET current_version='0.9.1';