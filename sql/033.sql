UPDATE %dbprefix%navigation_menu SET menu_order = '200' WHERE menu_name ='patients';
UPDATE %dbprefix%navigation_menu SET menu_order = '100' WHERE menu_name ='appointments';
ALTER TABLE %dbprefix%users ADD contact_id INT( 11 ) NULL;
ALTER TABLE  %dbprefix%visit ADD patient_notes TEXT NULL;
CREATE OR REPLACE VIEW %dbprefix%view_visit AS SELECT visit.visit_id,visit.visit_date,visit.visit_time,visit.type,visit.notes,visit.patient_notes,visit.userid,users.name,visit.patient_id,bill.bill_id,bill.total_amount,bill.due_amount FROM %dbprefix%visit as visit INNER JOIN %dbprefix%users as users ON users.userid = visit.userid INNER JOIN %dbprefix%bill as bill ON bill.visit_id = visit.visit_id ORDER BY patient_id,visit_date,visit_time;
UPDATE %dbprefix%version SET current_version='0.3.3';