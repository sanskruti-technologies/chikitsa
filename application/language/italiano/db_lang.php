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

$lang['db_invalid_connection_str'] = 'Impossibile determinare le impostazioni del database in base alla stringa di connessione hai inviato.';
$lang['db_unable_to_connect'] = 'Impossibile connettersi al server di database utilizzando le impostazioni fornite.';
$lang['db_unable_to_select'] = 'Non è possibile selezionare il database specificato: %s';
$lang['db_unable_to_create'] = 'Impossibile creare il database specificato: %s';
$lang['db_invalid_query'] = 'La query hai inviato non è valido.';
$lang['db_must_set_table'] = 'È necessario impostare la tabella del database da utilizzare con la query.';
$lang['db_must_use_set'] = 'È necessario utilizzare il metodo del "set" per aggiornare una voce.';
$lang['db_must_use_index'] = 'È necessario specificare un indice per abbinare su per gli aggiornamenti in batch.';
$lang['db_batch_missing_index'] = 'Una o più righe presentati per l'aggiornamento dei lotti manca l'indice specificato.';
$lang['db_must_use_where'] = 'Gli aggiornamenti non sono ammessi a meno che non contengono una clausola "where".';
$lang['db_del_must_use_where'] = 'Elimina non sono ammessi a meno che non contengono una "dove" o "come" clausola.';
$lang['db_field_param_missing'] = 'Per recuperare i campi richiede il nome della tabella come parametro.';
$lang['db_unsupported_function'] = 'Questa funzione non è disponibile per il database che si sta utilizzando.';
$lang['db_transaction_failure'] = 'fallimento di transazione: rollback eseguita.';
$lang['db_unable_to_drop'] = 'Impossibile eliminare il database specificato.';
$lang['db_unsupported_feature'] = 'caratteristica non supportata della piattaforma database in uso.';
$lang['db_unsupported_compression'] = 'Il formato di compressione dei file che hai scelto non è supportato dal server.';
$lang['db_filepath_error'] = 'Impossibile scrivere i dati al percorso del file che avete inviato.';
$lang['db_invalid_cache_path'] = 'Il percorso della cache hai inviato non è valido o scrivibile.';
$lang['db_table_name_required'] = 'È necessario un nome tabella per tale operazione.';
$lang['db_column_name_required'] = 'È necessario un nome di colonna per tale operazione.';
$lang['db_column_definition_required'] = 'Una definizione di colonna è richiesto per tale operazione.';
$lang['db_unable_to_set_charset'] = 'Impossibile impostare set di client di caratteri collegamento: %s';
$lang['db_error_heading'] = 'Si è verificato un errore nel database';
