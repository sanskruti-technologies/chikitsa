INSERT INTO %dbprefix%language_data (l_name, l_index, l_value, file_name) VALUES
('english', 'enable_patient_account', 'Enable Patient Account', 'main_lang.php'),
('english', 'patient_account_msg', '(You will be able to take more payment than invoice amount. The additional payment will be maintained in Patient Account.  This amount can be used to adjust the bill next time)', 'main_lang.php'),
('arabic', 'enable_patient_account', 'قم بتمكين حساب المريض', 'main_lang.php'),
('arabic', 'patient_account_msg', '(ستكون قادرًا على تسديد دفعة أكثر من مبلغ الفاتورة. سيتم الاحتفاظ بالدفع الإضافي في حساب المريض. هذا المبلغ يمكن
تستخدم لضبط الفاتورة في المرة القادمة)', 'main_lang.php'),
('french','enable_patient_account','Activer le compte patient','main_lang.php'),
('french','patient_account_msg','(Vous pourrez prendre plus de paiement que le montant de la facture. Le paiement supplémentaire sera conservé dans le compte patient. Ce montant peut être utilisé pour ajuster la facture la prochaine fois)','main_lang.php'),
('gujarati', 'enable_patient_account', 'પેશન્ટ એકાઉન્ટ સક્ષમ કરો', 'main_lang.php')
('gujarati', 'patient_account_msg', '(તમે ભરતિયું રકમ કરતાં વધુ ચુકવણી લઈ શકશો. પેશન્ટ એકાઉન્ટમાં વધારાની ચુકવણી જાળવવામાં આવશે. આ રકમનો ઉપયોગ આગલી વખતે બિલને સમાયોજિત કરવા માટે કરી શકાય છે)', 'main_lang.php'),
('italiano', 'enable_patient_account', 'Abilita account paziente', 'main_lang.php'),
('italiano', 'patient_account_msg', '(Sarai in grado di richiedere un pagamento maggiore dell\'importo della fattura. Il pagamento aggiuntivo verrà mantenuto nell\'Account paziente. Questo importo può essere utilizzato per regolare il conto la prossima volta)', 'main_lang.php'),
('spanish', 'enable_patient_account', 'Habilitar cuenta de paciente', 'main_lang.php'),
('spanish', 'patient_account_msg', '(Podrá aceptar más pagos que el monto de la factura. El pago adicional se mantendrá en la cuenta del paciente. Esta cantidad se puede utilizar para ajustar la factura la próxima vez.)', 'main_lang.php');

UPDATE %dbprefix%clinic SET tag_line = 'Clinic Management Software' WHERE clinic.clinic_id = 1; 

UPDATE  %dbprefix%version SET current_version='1.0.4';
