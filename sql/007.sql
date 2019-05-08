ALTER TABLE %dbprefix%clinic ADD next_followup_days int(11) DEFAULT '15';
ALTER TABLE %dbprefix%invoice ADD currency_postfix CHAR(10) DEFAULT '/-';
UPDATE %dbprefix%version SET current_version='0.0.7';