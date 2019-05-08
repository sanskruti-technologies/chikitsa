ALTER TABLE %dbprefix%followup ADD PRIMARY KEY (id) ;
UPDATE %dbprefix%version SET current_version='0.2.6';
