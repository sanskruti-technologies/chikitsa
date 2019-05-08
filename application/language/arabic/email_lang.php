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

$lang['email_must_be_array'] = 'يجب أن يتم تمرير طريقة التحقق من صحة البريد الإلكتروني مصفوفة.';
$lang['email_invalid_address'] = 'عنوان البريد الإلكتروني غير صالح:٪ s';
$lang['email_attachment_missing'] = 'تعذر تحديد موقع مرفق البريد الإلكتروني التالي:٪ s';
$lang['email_attachment_unreadable'] = 'تعذر فتح هذا المرفق:٪ s';
$lang['email_no_from'] = 'لا يمكن إرسال البريد بدون رأس "من".';
$lang['email_no_recipients'] = 'يجب تضمين المستلمين: إلى أو نسخة إلى أو نسخة مخفية الوجهة';
$lang['email_send_failure_phpmail'] = 'تعذر إرسال البريد الإلكتروني باستخدام بريد فب (). قد لا تتم تهيئة الخادم لإرسال البريد باستخدام هذه الطريقة.';
$lang['email_send_failure_sendmail'] = 'تعذر إرسال البريد الإلكتروني باستخدام فب سيندمايل. قد لا تتم تهيئة الخادم لإرسال البريد باستخدام هذه الطريقة.';
$lang['email_send_failure_smtp'] = 'تعذر إرسال البريد الإلكتروني باستخدام فب سمتب. قد لا تتم تهيئة الخادم لإرسال البريد باستخدام هذه الطريقة.';
$lang['email_sent'] = 'تم إرسال رسالتك بنجاح باستخدام البروتوكول التالي:٪ s';
$lang['email_no_socket'] = 'تعذر فتح مأخذ توصيل إلى سيندمايل. يرجى التحقق من الإعدادات.';
$lang['email_no_hostname'] = 'لم تحدد اسم مضيف سمتب.';
$lang['email_smtp_error'] = 'حدث خطأ سمتب التالي:٪ s';
$lang['email_no_smtp_unpw'] = 'خطأ: يجب تعيين اسم مستخدم وكلمة مرور سمتب.';
$lang['email_failed_smtp_login'] = 'أخفق إرسال أمر أوث لوجين. خطأ:٪ s';
$lang['email_smtp_auth_un'] = 'أخفق مصادقة اسم المستخدم.  خطأ:٪ s';
$lang['email_smtp_auth_pw'] = 'أخفق مصادقة كلمة المرور.  خطأ:٪ s';
$lang['email_smtp_data_failure'] = 'تعذر إرسال البيانات:٪ s';
$lang['email_exit_status'] = 'رمز حالة الخروج:٪ s';
