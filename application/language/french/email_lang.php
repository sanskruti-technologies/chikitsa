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
defined('BASEPATH') OR exit('Aucun accès direct aux scripts autorisé');

$lang['email_must_be_array'] = 'La méthode de validation par e-mail doit être passée à un tableau.';
$lang['email_invalid_address'] = 'Adresse e-mail incorrecte:% s';
$lang['email_attachment_missing'] = 'Impossible de trouver la pièce jointe suivante:% s';
$lang['email_attachment_unreadable'] = 'Impossible douvrir cette pièce jointe:% s';
$lang['email_no_from'] = 'Impossible denvoyer le courrier sans en-tête "De".';
$lang['email_no_recipients'] = 'Vous devez inclure les destinataires: À, Cc ou Cci';
$lang['email_send_failure_phpmail'] = 'Impossible denvoyer un e-mail en utilisant PHP mail (). Votre serveur peut ne pas être configuré pour envoyer du courrier en utilisant cette méthode.';
$lang['email_send_failure_sendmail'] = 'Impossible denvoyer un e-mail en utilisant PHP Sendmail. Votre serveur peut ne pas être configuré pour envoyer du courrier en utilisant cette méthode.';
$lang['email_send_failure_smtp'] = 'Impossible denvoyer un e-mail en utilisant PHP SMTP. Votre serveur peut ne pas être configuré pour envoyer du courrier en utilisant cette méthode.';
$lang['email_sent'] = 'Votre message a été envoyé avec succès en utilisant le protocole suivant:% s';
$lang['email_no_socket'] = 'Impossible douvrir une socket à Sendmail. Veuillez vérifier les paramètres.';
$lang['email_no_hostname'] = 'You did not specify a SMTP hostname.';
$lang['email_smtp_error'] = 'Lerreur SMTP suivante a été rencontrée:% s';
$lang['email_no_smtp_unpw'] = 'Erreur: Vous devez attribuer un nom dutilisateur et un mot de passe SMTP.';
$lang['email_failed_smtp_login'] = 'Échec de lenvoi de la commande AUTH LOGIN. Les erreurs';
$lang['email_smtp_auth_un'] = 'Impossible dauthentifier le nom dutilisateur. Les erreurs';
$lang['email_smtp_auth_pw'] = 'Impossible dauthentifier le mot de passe. Les erreurs';
$lang['email_smtp_data_failure'] = 'Impossible denvoyer des données:% s';
$lang['email_exit_status'] = 'Code détat de sortie:% s';
