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

$lang['form_validation_required']		= '{field} ફિલ્ડ જરૂરી છે.';
$lang['form_validation_isset']			= '{field} ફિલ્ડ વેલ્યૂ હોવી જ જોઈએ .';
$lang['form_validation_valid_email']		= '{field} ફીલ્ડમાં એક માન્ય ઇમેઇલ સરનામું હોવું આવશ્યક છે.';
$lang['form_validation_valid_emails']		= '{field} ફીલ્ડમાં બધા માન્ય ઇમેઇલ સરનામાંઓ હોવા આવશ્યક છે.';
$lang['form_validation_valid_url']		= '{field} ફીલ્ડમાં એક માન્ય URL હોવું આવશ્યક છે.';
$lang['form_validation_valid_ip']		= '{field} ફીલ્ડમાં એક માન્ય IP હોવું આવશ્યક છે.';
$lang['form_validation_min_length']		= '{field} ફીલ્ડમાં ઓછામાં ઓછા {param} અક્ષર લંબાઈમાં હોવો આવશ્યક છે.';
$lang['form_validation_max_length']		= '{field} ફીલ્ડમાં લંબાઈ {param} અક્ષરોથી વધી શકતો નથી.';
$lang['form_validation_exact_length']		= '{field} ફીલ્ડમાં બરાબર {param} લંબાઈના અક્ષરો હોવા જોઈએ.';
$lang['form_validation_alpha']			= '{field} ફીલ્ડમાં ફક્ત મૂળાક્ષર અક્ષરો જ હોઈ શકે છે.';
$lang['form_validation_alpha_numeric']		= '{field} ફીલ્ડમાં ફક્ત આંકડાકીય અક્ષરો હોઈ શકે છે';
$lang['form_validation_alpha_numeric_spaces']	= '{field} ફીલ્ડમાં ફક્ત આંકડાકીય અક્ષરો અને જગ્યા હોઈ શકે છે';
$lang['form_validation_alpha_dash']		= '{field} ફીલ્ડમાં ફક્ત આંકડાકીય અક્ષરો, અંડરસ્કોર્સ અને ડૅશ હોઈ શકે છે';
$lang['form_validation_numeric']		= '{field} ફીલ્ડમાં ફક્ત સંખ્યાઓ જ હોવી જોઈએ.';
$lang['form_validation_is_numeric']		= '{field} ફીલ્ડમાં માત્ર આંકડાકીય અક્ષરો જ હોવા જોઈએ.';
$lang['form_validation_integer']		= '{field} ફીલ્ડમાં પૂર્ણાંક હોવો આવશ્યક છે';
$lang['form_validation_regex_match']		= '{field} ફીલ્ડ યોગ્ય ફોર્મેટમાં નથી.';
$lang['form_validation_matches']		= '{field} ફીલ્ડ {param} ફીલ્ડથી મેળ ખાતો નથી';
$lang['form_validation_differs']		= '{field} ફીલ્ડ {param} ફીલ્ડથી અલગ હોવું જોઈએ';
$lang['form_validation_is_unique'] 		= '{field} ફીલ્ડમાં એક અનન્ય મૂલ્ય હોવું આવશ્યક છે.';
$lang['form_validation_is_natural']		= '{field} ફીલ્ડમાં માત્ર અંકો જ હોવા જોઈએ.';
$lang['form_validation_is_natural_no_zero']	= '{field} ફીલ્ડમાં માત્ર અંકો હોવો જોઈએ અને શૂન્ય કરતા વધારે હોવા જોઈએ.';
$lang['form_validation_decimal']		= '{field} ફીલ્ડમાં દશાંશ નંબર હોવો આવશ્યક છે.';
$lang['form_validation_less_than']		= '{field} ફીલ્ડમાં {param} કરતાં ઓછી સંખ્યા ધરાવતું હોવું જોઈએ.';
$lang['form_validation_less_than_equal_to']	= '{field} ફીલ્ડમાં {param} કરતાં ઓછા અથવા બરાબર સંખ્યા હોવી જોઈએ.';
$lang['form_validation_greater_than']		= '{field} ફીલ્ડમાં {param} કરતાં મોટી સંખ્યા હોવી જોઈએ.';
$lang['form_validation_greater_than_equal_to']	= '{field} ફીલ્ડમાં {param} થી મોટી અથવા તેનાથી વધુ સંખ્યા હોવી જોઈએ.';
$lang['form_validation_error_message_not_set']	= 'તમારા ફીલ્ડના નામથી સંબંધિત ભૂલ સંદેશાને ઍક્સેસ કરવામાં અસમર્થ{field}.';
$lang['form_validation_in_list']		= '{field} ફીલ્ડના એક હોવો જોઈએ: {param}';
