<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = 'Il metodo di validazione e-mail deve essere passata una matrice.';
$lang['email_invalid_address'] = 'Indirizzo email non valido: %s';
$lang['email_attachment_missing'] = 'Impossibile individuare il seguente allegato e-mail: %s';
$lang['email_attachment_unreadable'] = 'Impossibile aprire questo allegato: %s';
$lang['email_no_from'] = 'Non è possibile inviare la posta senza "From".';
$lang['email_no_recipients'] = 'È necessario includere i destinatari: A, Cc, o Ccn ';
$lang['email_send_failure_phpmail'] = 'Impossibile inviare e-mail utilizzando PHP mail (). Il server potrebbe non essere configurato per inviare la posta con questo metodo.';
$lang['email_send_failure_sendmail'] = 'Impossibile inviare e-mail utilizzando PHP Sendmail. Il server potrebbe non essere configurato per inviare la posta con questo metodo.';
$lang['email_send_failure_smtp'] = 'Impossibile inviare e-mail utilizzando PHP SMTP. Il server potrebbe non essere configurato per inviare la posta con questo metodo.';
$lang['email_sent'] = 'Il messaggio è stato inviato con successo utilizzando il seguente protocollo: %s';
$lang['email_no_socket'] = 'Impossibile aprire un socket a Sendmail. Si prega di verificare le impostazioni.';
$lang['email_no_hostname'] = 'Non è stato specificato il nome host SMTP.';
$lang['email_smtp_error'] = 'Si è verificato il seguente errore SMTP: %s';
$lang['email_no_smtp_unpw'] = 'Errore: È necessario assegnare un nome utente e una password SMTP.';
$lang['email_failed_smtp_login'] = 'Impossibile inviare il comando di autorizzazione accesso. Errore: %s';
$lang['email_smtp_auth_un'] = 'Impossibile autenticare il nome utente. Errore: %s';
$lang['email_smtp_auth_pw'] = 'Impossibile autenticare la password. Errore: %s';
$lang['email_smtp_data_failure'] = 'Impossibile inviare i dati: %s';
$lang['email_exit_status'] = 'codice di stato di uscita: %s';
