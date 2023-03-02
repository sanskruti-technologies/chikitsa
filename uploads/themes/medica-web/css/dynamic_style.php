<?php header("Content-type: text/css"); 
$main_background = "#003d79";
$main_title_color = "#ffffff";
$second_background = "#a0d2fc";
$second_title_color = "#000040";
$third_background = "#000000";
$third_title_color = "#ffffff";
$main_text_color = "#ffffff";
$second_text_color = "#000000";
$third_text_color = "#e2e2e2";
$content_background = "#fbfafa";
$content_title_color = "#000000";
$content_text_color = "#535050";

?>
.text {
    color: #666060  !important;
}
table.book_appointment_calendar th{
	background-color: <?=$second_background?>;
	border: solid <?=$second_background?>;
}
table.book_appointment_calendar td {
    border: solid <?=$second_background?>;
}
table.book_appointment_calendar td:hover {
    background-color: <?=$second_background?>;
}
.images_1_of_3 p{
	color: <?=$main_text_color?>;
}
.main-header {
   background: <?=$main_background?>;
}
body{
	background: <?=$main_background?> ;
}

.book_appointment h4 {
	 color:<?=$main_title_color?>;
}
 .images_1_of_3  > h3{
	color: <?=$main_title_color?>;
}
.images_1_of_2  > h3{
	color: <?=$main_title_color?>;
}
 .span_1_of_3 h3 {
    color:<?=$main_title_color?>;
}
.ourteam > h3{
	color:<?=$main_title_color?>;
}
.services1 > h4{
	 color: <?=$main_title_color?>;
}
.services1  h3{
	 color: <?=$main_title_color?>;
}
.service-content > h3{
	color:<?=$main_title_color?> !important;
}
.service-content ul li p a {
    color:<?=$main_title_color?>;
}
.service-content ul li span {
	  color: <?=$main_title_color?>;
}
.services-sidebar > h3{
	color:<?=$main_title_color?>!important;
}
.services-sidebar ul li a {
	color:<?=$main_title_color?>;
}
.contact-form input[type="submit"]:hover {
    color: <?=$main_title_color?>;
}
.company_address p span {
    text-decoration: none;
    color: <?=$main_title_color?>;
    cursor: pointer;
}
.span_2_of_3 h3{
	color:<?=$main_title_color?>;
}


.images_1_of_2 p,.service-content ul li p,.company_address p{
	color:<?=$second_text_color?>;
}
.contact-form span,.book_appointment label{
	color:<?=$second_text_color?>;
}
.top-nav {
    background: <?=$second_background?>;
}
.make_appointment_button {
    background:<?=$second_background?>;
}

.slider-info a {
    background:<?=$second_background?>;
}
.logo a{
	 color:<?=$second_background?> !important;
}
.top-nav li a {
    color: <?=$second_title_color?>;
    background: <?=$second_background?>;
}
.burger-menu-button{
	background: <?=$second_background?> !important;
}
.burger-menu  a{
	background: <?=$second_background?> !important;
}
.slider-info p{
	 color: <?=$second_background?>;
}
.top-nav ul li {
    border-left: 1px ridge <?=$second_background?>;
}
.grid-button {
    color: <?=$second_background?>;
}
.images_1_of_3 span {
    color: <?=$second_background?>;
}
.images_1_of_4 h3 {
    color: <?=$second_background?>; !important;
}
.copy-tight p a:hover {
    color: <?=$second_background?>;
}
.top-header-right ul li a {
    color: <?=$second_background?>;
}
.top-header-left p {
    color: <?=$second_background?>;
}

.contact-form input[type="submit"]{
	color:<?=$second_background?>;
}
.contact-form input[type="submit"]:hover {
    color: <?=$second_title_color?>;
}


a,.images_1_of_4 p{
	color:<?=$third_text_color?>;
}

.footer {
   background: <?=$third_background?>;
}
.top-nav li.active > a, .top-nav li > a:hover {
    background: <?=$third_background?>;
}

.make_appointment_button:hover {
    background:<?=$third_background?>;
}

.slider-info a:hover {
    background: <?=$third_background?>;
    color: <?=$third_title_color?>;
}
.top-header-right ul li a:hover {
    color: <?=$third_background?>;
}
.burger-menu a:hover{
	background:<?=$third_background?> !important;
}

