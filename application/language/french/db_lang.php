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

$lang['db_invalid_connection_str'] = 'Impossible de déterminer les paramètres de la base de données en fonction de la chaîne de connexion que vous avez soumise.';
$lang['db_unable_to_connect'] = 'Impossible de se connecter à votre serveur de base de données à laide des paramètres fournis.';
$lang['db_unable_to_select'] = 'Impossible de sélectionner la base de données spécifiée:% s';
$lang['db_unable_to_create'] = 'Impossible de créer la base de données spécifiée:% s';
$lang['db_invalid_query'] = 'La requête que vous avez envoyée nest pas valide.';
$lang['db_must_set_table'] = 'Vous devez définir la table de base de données à utiliser avec votre requête.';
$lang['db_must_use_set'] = 'Vous devez utiliser la méthode "set" pour mettre à jour une entrée.';
$lang['db_must_use_index'] = 'Vous devez spécifier un index à rechercher pour les mises à jour par lots.';
$lang['db_batch_missing_index'] = 'Une ou plusieurs lignes soumises pour la mise à jour par lots manquent lindex spécifié.';
$lang['db_must_use_where'] = 'Les mises à jour ne sont pas autorisées à moins quelles contiennent une clause "where".';
$lang['db_del_must_use_where'] = 'Les suppressions ne sont pas autorisées sauf si elles contiennent une clause "where" ou "like".';
$lang['db_field_param_missing'] = 'Pour récupérer des champs nécessite le nom de la table en tant que paramètre.';
$lang['db_unsupported_function'] = 'Cette fonctionnalité nest pas disponible pour la base de données que vous utilisez.';
$lang['db_transaction_failure'] = 'Échec de la transaction: retour en arrière effectué.';
$lang['db_unable_to_drop'] = 'Impossible de supprimer la base de données spécifiée.';
$lang['db_unsupported_feature'] = 'Fonctionnalité non prise en charge de la plaque-forme de base de données.';
$lang['db_unsupported_compression'] = 'Le format de compression de fichier que vous avez choisi nest pas supporté par votre serveur.';
$lang['db_filepath_error'] = 'Impossible décrire des données dans le chemin de fichier que vous avez envoyé.';
$lang['db_invalid_cache_path'] = 'Le chemin daccès au cache que vous avez envoyé nest pas valide ou accessible en écriture.';
$lang['db_table_name_required'] = 'Un nom de table est requis pour cette opération.';
$lang['db_column_name_required'] = 'Un nom de colonne est requis pour cette opération.';
$lang['db_column_definition_required'] = 'Une définition de colonne est requise pour cette opération.';
$lang['db_unable_to_set_charset'] = 'Impossible de définir le jeu de caractères de la connexion client:% s';
$lang['db_error_heading'] = 'Une erreur est survenue dans la base de données';
