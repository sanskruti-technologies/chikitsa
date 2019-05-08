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

$lang['db_invalid_connection_str'] = 'يتعذر تحديد إعدادات قاعدة البيانات استنادا إلى سلسلة الاتصال التي أرسلتها.';
$lang['db_unable_to_connect'] = 'تعذر الاتصال بخادم قاعدة البيانات باستخدام الإعدادات المتوفرة.';
$lang['db_unable_to_select'] = 'تعذر تحديد قاعدة البيانات المحددة:٪ s';
$lang['db_unable_to_create'] = 'تعذر إنشاء قاعدة البيانات المحددة:٪ s';
$lang['db_invalid_query'] = 'طلب البحث الذي أرسلته غير صالح.';
$lang['db_must_set_table'] = 'يجب تعيين جدول قاعدة البيانات ليتم استخدامه مع الاستعلام الخاص بك.';
$lang['db_must_use_set'] = 'يجب استخدام الأسلوب "سيت" لتحديث إدخال.';
$lang['db_must_use_index'] = 'يجب تحديد فهرس لمطابقته لتحديثات الدفعات.';
$lang['db_batch_missing_index'] = 'يفتقد صف واحد أو أكثر يتم إرساله لتحديث الدفعة الفهرس المحدد.';
$lang['db_must_use_where'] = 'لا يسمح بالتحديثات إلا إذا كانت تحتوي على شرط "حيث".';
$lang['db_del_must_use_where'] = 'لا يسمح بالحذف ما لم تحتوي على شرط "حيث" أو "أعجبني".';
$lang['db_field_param_missing'] = 'يتطلب جلب الحقول اسم الجدول كمعلمة.';
$lang['db_unsupported_function'] = 'هذه الميزة غير متوفرة لقاعدة البيانات التي تستخدمها.';
$lang['db_transaction_failure'] = 'فشل المعاملة: تمت عملية التراجع.';
$lang['db_unable_to_drop'] = 'تعذر إسقاط قاعدة البيانات المحددة.';
$lang['db_unsupported_feature'] = 'ميزة غير مدعومة من منصة قاعدة البيانات التي تستخدمها.';
$lang['db_unsupported_compression'] = 'تنسيق ضغط الملف الذي اخترته غير مدعوم من قبل الخادم.';
$lang['db_filepath_error'] = 'يتعذر كتابة البيانات إلى مسار الملف الذي أرسلته.';
$lang['db_invalid_cache_path'] = 'مسار ذاكرة التخزين المؤقت الذي أرسلته غير صالح أو قابل للكتابة.';
$lang['db_table_name_required'] = 'اسم جدول مطلوب لهذه العملية.';
$lang['db_column_name_required'] = 'مطلوب اسم عمود لهذه العملية.';
$lang['db_column_definition_required'] = 'مطلوب تعريف عمود لهذه العملية.';
$lang['db_unable_to_set_charset'] = 'تعذر تعيين مجموعة أحرف اتصال العميل:٪ s';
$lang['db_error_heading'] = 'حدث خطأ في قاعدة البيانات';
