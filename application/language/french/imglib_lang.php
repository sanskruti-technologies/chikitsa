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

$lang['imglib_source_image_required'] = 'Vous devez spécifier une image source dans vos préférences.';
$lang['imglib_gd_required'] = 'La bibliothèque dimages GD est requise pour cette fonctionnalité.';
$lang['imglib_gd_required_for_props'] = 'Votre serveur doit prendre en charge la bibliothèque dimages GD afin de déterminer les propriétés de limage.';
$lang['imglib_unsupported_imagecreate'] = 'Votre serveur ne prend pas en charge la fonction GD requise pour traiter ce type dimage.';
$lang['imglib_gif_not_supported'] = 'Les images GIF ne sont souvent pas prises en charge en raison de restrictions de licence. Vous devrez peut-être utiliser des images JPG ou PNG à la place.';
$lang['imglib_jpg_not_supported'] = 'Les images JPG ne sont pas supportées.';
$lang['imglib_png_not_supported'] = 'Les images PNG ne sont pas supportées.';
$lang['imglib_jpg_or_png_required'] = 'Le protocole de redimensionnement de limage spécifié dans vos préférences fonctionne uniquement avec les types dimage JPEG ou PNG.';
$lang['imglib_copy_error'] = 'Une erreur sest produite lors de la tentative de remplacement du fichier. Sil vous plaît assurez-vous que votre répertoire de fichiers est accessible en écriture.';
$lang['imglib_rotate_unsupported'] = 'La rotation de limage ne semble pas être prise en charge par votre serveur.';
$lang['imglib_libpath_invalid'] = 'Le chemin daccès à votre bibliothèque dimages est incorrect. Veuillez définir le bon chemin dans vos préférences dimage.';
$lang['imglib_image_process_failed'] = 'Le traitement dimage a échoué. Veuillez vérifier que votre serveur prend en charge le protocole choisi et que le chemin de votre bibliothèque dimages est correct.';
$lang['imglib_rotation_angle_required'] = 'Un angle de rotation est nécessaire pour faire pivoter limage.';
$lang['imglib_invalid_path'] = 'Le chemin vers limage nest pas correct.';
$lang['imglib_copy_failed'] = 'La routine de copie dimage a échoué.';
$lang['imglib_missing_font'] = 'Impossible de trouver une police à utiliser.';
$lang['imglib_save_failed'] = 'Impossible de sauvegarder limage. Sil vous plaît assurez-vous que limage et le répertoire de fichiers sont accessibles en écriture.';
