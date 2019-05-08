
DELETE FROM %dbprefix%navigation_menu WHERE menu_name = 'invoice_setting';
ALTER TABLE %dbprefix%payment ADD clinic_id INT(11) NULL AFTER cheque_no;
	
INSERT INTO %dbprefix%navigation_menu (menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module, sync_status, is_deleted) VALUES ('bank_payment', 'account', '200', 'account/bank_payment', NULL, 'Bank Payment', NULL, NULL, NULL);
INSERT INTO %dbprefix%menu_access (menu_name, category_name, allow) VALUES ('bank_payment', 'Administrator', '1');
INSERT INTO %dbprefix%navigation_menu (menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module, sync_status, is_deleted) VALUES ('bank_receipt', 'account', '300', 'account/bank_receipt', NULL, 'Bank Receipt', NULL, NULL, NULL);
INSERT INTO %dbprefix%menu_access (menu_name, category_name, allow) VALUES ('bank_receipt', 'Administrator', '1');
INSERT INTO %dbprefix%navigation_menu (menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module, sync_status, is_deleted) VALUES ('cash_payment', 'account', '400', 'account/cash_payment', NULL, 'Cash Payment', NULL, NULL, NULL);
INSERT INTO %dbprefix%menu_access (menu_name, category_name, allow) VALUES ('cash_payment', 'Administrator', '1');
INSERT INTO %dbprefix%navigation_menu (menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module, sync_status, is_deleted) VALUES ('cash_receipt', 'account', '500', 'account/cash_receipt', NULL, 'Cash Receipt', NULL, NULL, NULL);
INSERT INTO %dbprefix%menu_access (menu_name, category_name, allow) VALUES ('cash_receipt', 'Administrator', '1');
INSERT INTO %dbprefix%navigation_menu (menu_name, parent_name, menu_order, menu_url, menu_icon, menu_text, required_module, sync_status, is_deleted) VALUES ('journal_voucher', 'account', '600', 'account/journal_voucher', NULL, 'Journal Voucher', NULL, NULL, NULL);
INSERT INTO %dbprefix%menu_access (menu_name, category_name, allow) VALUES ('journal_voucher', 'Administrator', '1');

INSERT INTO %dbprefix%data (ck_key, ck_value) VALUES ( 'support_url', '<h4>Chikitsa would not have been possible without the amazing works listed below</h4><h5><b>Framework</b></h5><a href="http://codeigniter.com">CodeIgniter 3.0.0</a><h5><b></b></h5><a href="https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc">Modular Extensions - HMVC<h5><b></b></h5></a><h5><b>Theme</b></h5><a href="http://www.bootstrapzero.com/bootstrap-template/binary">Binary Admin (Bootstrap v3.1.1)</a><h5><b></b></h5><a href="https://fortawesome.github.io/Font-Awesome/">Font Awsome </a><h5><b></b></h5><a href="https://plugins.jquery.com/chosen/">Chosen</a><br><a href="http://lokeshdhakar.com/projects/lightbox2/">Lightbox </a><br><a href="http://xdsoft.net/jqplugins/datetimepicker/">DateTime Picker </a><br><a href="http://intridea.github.io/sketch.js/">Sketch</a><br><a href="https://www.tinymce.com/">TinyMCE</a><br>');
DELETE FROM %dbprefix%navigation_menu WHERE menu_name = 'invoice setting';
UPDATE %dbprefix%version SET current_version='0.5.5';