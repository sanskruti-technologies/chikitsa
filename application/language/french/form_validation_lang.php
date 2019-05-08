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

$lang['form_validation_required']				= 'Le champ {field} est obligatoire.';
$lang['form_validation_isset']					= 'Le champ {field} doit avoir une valeur.';
$lang['form_validation_valid_email']			= 'Le champ {field} doit contenir une adresse e-mail valide.';
$lang['form_validation_valid_emails']			= 'Le champ {field} doit contenir toutes les adresses e-mail valides.';
$lang['form_validation_valid_url']				= 'Le champ {field} doit contenir une URL valide.';
$lang['form_validation_valid_ip']				= 'Le champ {field} doit contenir une adresse IP valide.';
$lang['form_validation_min_length']				= 'Le champ {field} doit contenir au moins {param} caractères.';
$lang['form_validation_max_length']				= 'Le champ {field} ne peut pas dépasser les caractères {param} de longueur.';
$lang['form_validation_exact_length']			= 'Le champ {field} doit avoir exactement {param} caractères.';
$lang['form_validation_alpha']					= 'Le champ {field} ne peut contenir que des caractères alphabétiques.';
$lang['form_validation_alpha_numeric']			= 'Le champ {field} ne peut contenir que des caractères alphanumériques.';
$lang['form_validation_alpha_numeric_spaces']	= 'Le champ {field} ne peut contenir que des caractères alphanumériques et des espaces.';
$lang['form_validation_alpha_dash']				= 'Le champ {field} peut uniquement contenir des caractères alphanumériques, des traits de soulignement et des tirets.';
$lang['form_validation_numeric']				= 'Le champ {field} ne doit contenir que des chiffres.';
$lang['form_validation_is_numeric']				= 'Le champ {field} ne doit contenir que des caractères numériques.';
$lang['form_validation_integer']				= 'Le champ {field} doit contenir un entier.';
$lang['form_validation_regex_match']			= 'Le champ {field} nest pas au format correct.';
$lang['form_validation_matches']				= 'Le champ {field} ne correspond pas au champ {param}.';
$lang['form_validation_differs']				= 'Le champ {field} doit différer du champ {param}.';
$lang['form_validation_is_unique'] 				= 'Le champ {field} doit contenir une valeur unique.';
$lang['form_validation_is_natural']				= 'Le champ {field} ne doit contenir que des chiffres.';
$lang['form_validation_is_natural_no_zero']		= 'Le champ {field} ne doit contenir que des chiffres et doit être supérieur à zéro.';
$lang['form_validation_decimal']				= 'Le champ {field} doit contenir un nombre décimal.';
$lang['form_validation_less_than']				= 'Le champ {field} doit contenir un nombre inférieur à {param}.';
$lang['form_validation_less_than_equal_to']		= 'Le champ {field} doit contenir un nombre inférieur ou égal à {param}.';
$lang['form_validation_greater_than']			= 'Le champ {field} doit contenir un nombre supérieur à {param}.';
$lang['form_validation_greater_than_equal_to']	= 'Le champ {field} doit contenir un nombre supérieur ou égal à {param}.';
$lang['form_validation_error_message_not_set']	= 'Impossible daccéder à un message derreur correspondant à votre nom de champ {champ}.';
$lang['form_validation_in_list']				= 'Le champ {field} doit être lun des suivants: {param}.';
