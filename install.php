<?php
/*
	This file is part of Chikitsa.

    Chikitsa is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Chikitsa is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Chikitsa.  If not, see <https://www.gnu.org/licenses/>.
*/
?>
<html>
    <head>
        <title>Chikitsa - Patient Management System</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">

		<!-- Custom fonts for this template -->
		<link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">
		<!-- Custom styles for this page -->
		<link href="./assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
		<link href="./assets/css/chikitsa.css" rel="stylesheet">

		<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
		<!-- JQUERY SCRIPTS -->
		<script src="./assets/js/jquery-1.11.3.min.js"></script>
		<script src="./assets/js/jquery.steps.min.js"></script>
		<script src="./assets/js/jquery.validate.min.js"></script>
		

    
	
<style>

/* ==========================================================================
   Tables
   ========================================================================== */

/**
 * Remove most spacing between table cells.
 */

table {
    border-collapse: collapse;
    border-spacing: 0;
}

/*
    Common 
*/

.wizard,
.tabcontrol
{
    display: block;
    width: 100%;
    overflow: hidden;
}

.wizard a,
.tabcontrol a
{
    outline: 0;
}

.wizard ul,
.tabcontrol ul
{
    list-style: none !important;
    padding: 0;
    margin: 0;
}

.wizard ul > li,
.tabcontrol ul > li
{
    display: block;
    padding: 0;
}

/* Accessibility */
.wizard > .steps .current-info,
.tabcontrol > .steps .current-info
{
    position: absolute;
    left: -999em;
}

.wizard > .content > .title,
.tabcontrol > .content > .title
{
    position: absolute;
    left: -999em;
}



/*
    Wizard
*/

.wizard > .steps
{
    position: relative;
    display: block;
    width: 100%;
}

.wizard.vertical > .steps
{
    display: inline;
    float: left;
    width: 30%;
}

.wizard > .steps .number
{
    font-size: 1.429em;
}

.wizard > .steps > ul > li
{
    width: 25%;
}

.wizard > .steps > ul > li,
.wizard > .actions > ul > li
{
    float: left;
}

.wizard.vertical > .steps > ul > li
{
    float: none;
    width: 100%;
}

.wizard > .steps a,
.wizard > .steps a:hover,
.wizard > .steps a:active
{
    display: block;
    width: auto;
    margin: 0 0.5em 0.5em;
    padding: 1em 1em;
    text-decoration: none;

    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.wizard > .steps .disabled a,
.wizard > .steps .disabled a:hover,
.wizard > .steps .disabled a:active
{
    background: #eee;
    color: #aaa;
    cursor: default;
}

.wizard > .steps .current a,
.wizard > .steps .current a:hover,
.wizard > .steps .current a:active
{
    background: #fcfcfc;
    color: #111;
    cursor: default;
}

.wizard > .steps .done a,
.wizard > .steps .done a:hover,
.wizard > .steps .done a:active
{
    background: #4CAF50;
    color: #fff;
}

.wizard > .steps .error a,
.wizard > .steps .error a:hover,
.wizard > .steps .error a:active
{
    background: #ff3111;
    color: #fff;
}

.wizard > .content
{
    background: #eee;
    display: block;
    margin: 0.5em;
    min-height: 35em;
    overflow: auto;
    position: relative;
    width: auto;

    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.wizard.vertical > .content
{
    display: inline;
    float: left;
    margin: 0 2.5% 0.5em 2.5%;
    width: 65%;
}

.wizard > .content > .body
{
    float: left;
    position: absolute;
    width: 95%;
    height: 95%;
    padding: 2.5%;
}

.wizard > .content > .body ul
{
    list-style: disc !important;
}

.wizard > .content > .body ul > li
{
    display: list-item;
}

.wizard > .content > .body > iframe
{
    border: 0 none;
    width: 100%;
    height: 100%;
}

.wizard > .content > .body input
{
    display: block;
    border: 1px solid #ccc;
}

.wizard > .content > .body input[type="checkbox"]
{
    display: inline-block;
}

.wizard > .content > .body input.error
{
    background: rgb(251, 227, 228);
    border: 1px solid #fbc2c4;
    color: #8a1f11;
}

.wizard > .content > .body label
{
    display: inline-block;
    margin-bottom: 0.5em;
}

.wizard > .content > .body label.error
{
    color: #8a1f11;
    display: inline-block;
    margin-left: 1.5em;
}

.wizard > .actions
{
    position: relative;
    display: block;
    text-align: right;
    width: 100%;
}

.wizard.vertical > .actions
{
    display: inline;
    float: right;
    margin: 0 2.5%;
    width: 95%;
}

.wizard > .actions > ul
{
    display: inline-block;
    text-align: right;
}

.wizard > .actions > ul > li
{
    margin: 0 0.5em;
}

.wizard.vertical > .actions > ul > li
{
    margin: 0 0 0 1em;
}

.wizard > .actions a,
.wizard > .actions a:hover,
.wizard > .actions a:active
{
    background: #2184be;
    color: #fff;
    display: block;
    padding: 0.5em 1em;
    text-decoration: none;

    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.wizard > .actions .disabled a,
.wizard > .actions .disabled a:hover,
.wizard > .actions .disabled a:active
{
    background: #eee;
    color: #aaa;
}

.wizard > .loading
{
}

.wizard > .loading .spinner
{
}



/*
    Tabcontrol
*/

.tabcontrol > .steps
{
    position: relative;
    display: block;
    width: 100%;
}

.tabcontrol > .steps > ul
{
    position: relative;
    margin: 6px 0 0 0;
    top: 1px;
    z-index: 1;
}

.tabcontrol > .steps > ul > li
{
    float: left;
    margin: 5px 2px 0 0;
    padding: 1px;

    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.tabcontrol > .steps > ul > li:hover
{
    background: #edecec;
    border: 1px solid #bbb;
    padding: 0;
}

.tabcontrol > .steps > ul > li.current
{
    background: #fff;
    border: 1px solid #bbb;
    border-bottom: 0 none;
    padding: 0 0 1px 0;
    margin-top: 0;
}

.tabcontrol > .steps > ul > li > a
{
    color: #5f5f5f;
    display: inline-block;
    border: 0 none;
    margin: 0;
    padding: 10px 30px;
    text-decoration: none;
}

.tabcontrol > .steps > ul > li > a:hover
{
    text-decoration: none;
}

.tabcontrol > .steps > ul > li.current > a
{
    padding: 15px 30px 10px 30px;
}

.tabcontrol > .content
{
    position: relative;
    display: inline-block;
    width: 100%;
    height: 35em;
    overflow: hidden;
    border-top: 1px solid #bbb;
    padding-top: 20px;
}

.tabcontrol > .content > .body
{
    float: left;
    position: absolute;
    width: 95%;
    height: 95%;
    padding: 2.5%;
}

.tabcontrol > .content > .body ul
{
    list-style: disc !important;
}

.tabcontrol > .content > .body ul > li
{
    display: list-item;
}
@import url(https://fonts.googleapis.com/css?family=Roboto:400,300,600,400italic);
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-font-smoothing: antialiased;
  -o-font-smoothing: antialiased;
  font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
}



.container {
  width: 100%;
  margin: 0 auto;
  position: relative;
}

#install {
  padding: 25px; 
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

#install h3 {
  display: block;
  font-size: 30px;
  font-weight: 300;
  margin-bottom: 10px;
}

#install h4 {
  margin: 5px 0 15px;
  display: block;
  font-size: 13px;
  font-weight: 400;
}

fieldset {
  border: medium none !important;
  margin: 0 0 10px;
  min-width: 100%;
  padding: 0;
  width: 100%;
}



#install input[type="text"]:hover,
#install input[type="email"]:hover,
#install input[type="tel"]:hover,
#install input[type="url"]:hover,
#install textarea:hover {
  -webkit-transition: border-color 0.3s ease-in-out;
  -moz-transition: border-color 0.3s ease-in-out;
  transition: border-color 0.3s ease-in-out;
  border: 1px solid #aaa;
}

#install textarea {
  height: 100px;
  max-width: 100%;
  resize: none;
}

#install button[type="submit"] {
  cursor: pointer;
  width: 100%;
  border: none;
  background: #4CAF50;
  color: #FFF;
  margin: 0 0 5px;
  padding: 10px;
  font-size: 15px;
}

#install button[type="submit"]:hover {
  background: #43A047;
  -webkit-transition: background 0.3s ease-in-out;
  -moz-transition: background 0.3s ease-in-out;
  transition: background-color 0.3s ease-in-out;
}

#install button[type="submit"]:active {
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
}

.copyright {
  text-align: center;
}

#install input:focus,
#install textarea:focus {
  outline: 0;
  border: 1px solid #aaa;
}

::-webkit-input-placeholder {
  color: #888;
}

:-moz-placeholder {
  color: #888;
}

::-moz-placeholder {
  color: #888;
}

:-ms-input-placeholder {
  color: #888;
}

.steps > ul > li > a,
.actions li a { 
    padding: 10px;
    text-decoration: none;
    margin: 1px;
    display: block;
    color: #777;
}
.steps > ul > li,
.actions li {
    list-style:none;
} 

.container {
  
    min-height: 100vh;
    padding-top: 3%;
}
</style>
<script>
$( window ).load(function() {
    $('#full_day').change(function() {
        $("#clinic_start_time").prop("disabled", $(this).is(':checked'));
        $("#clinic_end_time").prop("disabled", $(this).is(':checked'));
    });

    $("#clinic_start_time").prop("disabled", $('#full_day').is(':checked'));
    $("#clinic_end_time").prop("disabled", $('#full_day').is(':checked'));
});
</script>
</head>
<?php 
    $timezone_list = array("Africa/Abidjan" => "Africa/Abidjan",
    "Africa/Accra" => "Africa/Accra",
    "Africa/Addis_Ababa" => "Africa/Addis_Ababa",
    "Africa/Algiers" => "Africa/Algiers",
    "Africa/Asmara" => "Africa/Asmara",
    "Africa/Asmera" => "Africa/Asmera",
    "Africa/Bamako" => "Africa/Bamako",
    "Africa/Bangui" => "Africa/Bangui",
    "Africa/Banjul" => "Africa/Banjul",
    "Africa/Bissau" => "Africa/Bissau",
    "Africa/Blantyre" => "Africa/Blantyre",
    "Africa/Brazzaville" => "Africa/Brazzaville",
    "Africa/Bujumbura" => "Africa/Bujumbura",
    "Africa/Cairo" => "Africa/Cairo",
    "Africa/Casablanca" => "Africa/Casablanca",
    "Africa/Ceuta" => "Africa/Ceuta",
    "Africa/Conakry" => "Africa/Conakry",
    "Africa/Dakar" => "Africa/Dakar",
    "Africa/Dar_es_Salaam" => "Africa/Dar_es_Salaam",
    "Africa/Djibouti" => "Africa/Djibouti",
    "Africa/Douala" => "Africa/Douala",
    "Africa/El_Aaiun" => "Africa/El_Aaiun",
    "Africa/Freetown" => "Africa/Freetown",
    "Africa/Gaborone" => "Africa/Gaborone",
    "Africa/Harare" => "Africa/Harare",
    "Africa/Johannesburg" => "Africa/Johannesburg",
    "Africa/Juba" => "Africa/Juba",
    "Africa/Kampala" => "Africa/Kampala",
    "Africa/Khartoum" => "Africa/Khartoum",
    "Africa/Kigali" => "Africa/Kigali",
    "Africa/Kinshasa" => "Africa/Kinshasa",
    "Africa/Lagos" => "Africa/Lagos",
    "Africa/Libreville" => "Africa/Libreville",
    "Africa/Lome" => "Africa/Lome",
    "Africa/Luanda" => "Africa/Luanda",
    "Africa/Lubumbashi" => "Africa/Lubumbashi",
    "Africa/Lusaka" => "Africa/Lusaka",
    "Africa/Malabo" => "Africa/Malabo",
    "Africa/Maputo" => "Africa/Maputo",
    "Africa/Maseru" => "Africa/Maseru",
    "Africa/Mbabane" => "Africa/Mbabane",
    "Africa/Mogadishu" => "Africa/Mogadishu",
    "Africa/Monrovia" => "Africa/Monrovia",
    "Africa/Nairobi" => "Africa/Nairobi",
    "Africa/Ndjamena" => "Africa/Ndjamena",
    "Africa/Niamey" => "Africa/Niamey",
    "Africa/Nouakchott" => "Africa/Nouakchott",
    "Africa/Ouagadougou" => "Africa/Ouagadougou",
    "Africa/Porto-Novo" => "Africa/Porto-Novo",
    "Africa/Sao_Tome" => "Africa/Sao_Tome",
    "Africa/Timbuktu" => "Africa/Timbuktu",
    "Africa/Tripoli" => "Africa/Tripoli",
    "Africa/Tunis" => "Africa/Tunis",
    "Africa/Windhoek" => "Africa/Windhoek",
    "America/Adak" => "America/Adak",
    "America/Anchorage" => "America/Anchorage",
    "America/Anguilla" => "America/Anguilla",
    "America/Antigua" => "America/Antigua",
    "America/Araguaina" => "America/Araguaina",
    "America/Argentina/Buenos_Aires" => "America/Argentina/Buenos_Aires",
    "America/Argentina/Catamarca" => "America/Argentina/Catamarca",
    "America/Argentina/ComodRivadavia" => "America/Argentina/ComodRivadavia",
    "America/Argentina/Cordoba" => "America/Argentina/Cordoba",
    "America/Argentina/Jujuy" => "America/Argentina/Jujuy",
    "America/Argentina/La_Rioja" => "America/Argentina/La_Rioja",
    "America/Argentina/Mendoza" => "America/Argentina/Mendoza",
    "America/Argentina/Rio_Gallegos" => "America/Argentina/Rio_Gallegos",
    "America/Argentina/Salta" => "America/Argentina/Salta",
    "America/Argentina/San_Juan" => "America/Argentina/San_Juan",
    "America/Argentina/San_Luis" => "America/Argentina/San_Luis",
    "America/Argentina/Tucuman" => "America/Argentina/Tucuman",
    "America/Argentina/Ushuaia" => "America/Argentina/Ushuaia",
    "America/Aruba" => "America/Aruba",
    "America/Asuncion" => "America/Asuncion",
    "America/Atikokan" => "America/Atikokan",
    "America/Atka" => "America/Atka",
    "America/Bahia" => "America/Bahia",
    "America/Bahia_Banderas" => "America/Bahia_Banderas",
    "America/Barbados" => "America/Barbados",
    "America/Belem" => "America/Belem",
    "America/Belize" => "America/Belize",
    "America/Blanc-Sablon" => "America/Blanc-Sablon",
    "America/Boa_Vista" => "America/Boa_Vista",
    "America/Bogota" => "America/Bogota",
    "America/Boise" => "America/Boise",
    "America/Buenos_Aires" => "America/Buenos_Aires",
    "America/Cambridge_Bay" => "America/Cambridge_Bay",
    "America/Campo_Grande" => "America/Campo_Grande",
    "America/Cancun" => "America/Cancun",
    "America/Caracas" => "America/Caracas",
    "America/Catamarca" => "America/Catamarca",
    "America/Cayenne" => "America/Cayenne",
    "America/Cayman" => "America/Cayman",
    "America/Chicago" => "America/Chicago",
    "America/Chihuahua" => "America/Chihuahua",
    "America/Coral_Harbour" => "America/Coral_Harbour",
    "America/Cordoba" => "America/Cordoba",
    "America/Costa_Rica" => "America/Costa_Rica",
    "America/Creston" => "America/Creston",
    "America/Cuiaba" => "America/Cuiaba",
    "America/Curacao" => "America/Curacao",
    "America/Danmarkshavn" => "America/Danmarkshavn",
    "America/Dawson" => "America/Dawson",
    "America/Dawson_Creek" => "America/Dawson_Creek",
    "America/Denver" => "America/Denver",
    "America/Detroit" => "America/Detroit",
    "America/Dominica" => "America/Dominica",
    "America/Edmonton" => "America/Edmonton",
    "America/Eirunepe" => "America/Eirunepe",
    "America/El_Salvador" => "America/El_Salvador",
    "America/Ensenada" => "America/Ensenada",
    "America/Fort_Wayne" => "America/Fort_Wayne",
    "America/Fortaleza" => "America/Fortaleza",
    "America/Glace_Bay" => "America/Glace_Bay",
    "America/Godthab" => "America/Godthab",
    "America/Goose_Bay" => "America/Goose_Bay",
    "America/Grand_Turk" => "America/Grand_Turk",
    "America/Grenada" => "America/Grenada",
    "America/Guadeloupe" => "America/Guadeloupe",
    "America/Guatemala" => "America/Guatemala",
    "America/Guayaquil" => "America/Guayaquil",
    "America/Guyana" => "America/Guyana",
    "America/Halifax" => "America/Halifax",
    "America/Havana" => "America/Havana",
    "America/Hermosillo" => "America/Hermosillo",
    "America/Indiana/Indianapolis" => "America/Indiana/Indianapolis",
    "America/Indiana/Knox" => "America/Indiana/Knox",
    "America/Indiana/Marengo" => "America/Indiana/Marengo",
    "America/Indiana/Petersburg" => "America/Indiana/Petersburg",
    "America/Indiana/Tell_City" => "America/Indiana/Tell_City",
    "America/Indiana/Vevay" => "America/Indiana/Vevay",
    "America/Indiana/Vincennes" => "America/Indiana/Vincennes",

    "America/Indiana/Winamac" => "America/Indiana/Winamac",

    "America/Indianapolis" => "America/Indianapolis",

    "America/Inuvik" => "America/Inuvik",

    "America/Iqaluit" => "America/Iqaluit",

    "America/Jamaica" => "America/Jamaica",

    "America/Jujuy" => "America/Jujuy",
    "America/Juneau" => "America/Juneau",
    "America/Kentucky/Louisville" => "America/Kentucky/Louisville",
    "America/Kentucky/Monticello" => "America/Kentucky/Monticello",
    "America/Knox_IN" => "America/Knox_IN",

    "America/Kralendijk" => "America/Kralendijk",

    "America/La_Paz" => "America/La_Paz",

    "America/Lima" => "America/Lima",

    "America/Los_Angeles" => "America/Los_Angeles",

    "America/Louisville" => "America/Louisville",

    "America/Lower_Princes" => "America/Lower_Princes",

    "America/Maceio" => "America/Maceio",
    "America/Managua" => "America/Managua",

    "America/Manaus" => "America/Manaus",

    "America/Marigot" => "America/Marigot",

    "America/Martinique" => "America/Martinique",
    "America/Matamoros" => "America/Matamoros",
    "America/Mazatlan" => "America/Mazatlan",
    "America/Mendoza" => "America/Mendoza",

    "America/Menominee" => "America/Menominee",

    "America/Merida" => "America/Merida",

    "America/Metlakatla" => "America/Metlakatla",

    "America/Mexico_City" => "America/Mexico_City",

    "America/Miquelon" => "America/Miquelon",

    "America/Moncton" => "America/Moncton",
    "America/Monterrey" => "America/Monterrey",

    "America/Montevideo" => "America/Montevideo",

    "America/Montreal" => "America/Montreal",
    "America/Montserrat" => "America/Montserrat",
    "America/Nassau" => "America/Nassau",
    "America/New_York" => "America/New_York",

    "America/Nipigon" => "America/Nipigon",

    "America/Nome" => "America/Nome",

    "America/Noronha" => "America/Noronha",

    "America/North_Dakota/Beulah" => "America/North_Dakota/Beulah",

    "America/North_Dakota/Center" => "America/North_Dakota/Center",

    "America/North_Dakota/New_Salem" => "America/North_Dakota/New_Salem",

    "America/Ojinaga" => "America/Ojinaga",

    "America/Panama" => "America/Panama",

    "America/Pangnirtung" => "America/Pangnirtung",

    "America/Paramaribo" => "America/Paramaribo",
    "America/Phoenix" => "America/Phoenix",
    "America/Port-au-Prince" => "America/Port-au-Prince",
    "America/Port_of_Spain" => "America/Port_of_Spain",
    "America/Porto_Acre" => "America/Porto_Acre",
    "America/Porto_Velho" => "America/Porto_Velho",

    "America/Puerto_Rico" => "America/Puerto_Rico",

    "America/Rainy_River" => "America/Rainy_River",

    "America/Rankin_Inlet" => "America/Rankin_Inlet",

    "America/Recife" => "America/Recife",

    "America/Regina" => "America/Regina",

    "America/Resolute" => "America/Resolute",

    "America/Rio_Branco" => "America/Rio_Branco",

    "America/Rosario" => "America/Rosario",

    "America/Santa_Isabel" => "America/Santa_Isabel",
    "America/Santarem" => "America/Santarem",

    "America/Santiago" => "America/Santiago",
    "America/Santo_Domingo" => "America/Santo_Domingo",
    "America/Sao_Paulo" => "America/Sao_Paulo",

    "America/Scoresbysund" => "America/Scoresbysund",

    "America/Shiprock" => "America/Shiprock",

    "America/Sitka" => "America/Sitka",

    "America/St_Barthelemy" => "America/St_Barthelemy",

    "America/St_Johns" => "America/St_Johns",

    "America/St_Kitts" => "America/St_Kitts",

    "America/St_Lucia" => "America/St_Lucia",

    "America/St_Thomas" => "America/St_Thomas",

    "America/St_Vincent" => "America/St_Vincent",

    "America/Swift_Current" => "America/Swift_Current",
    "America/Tegucigalpa" => "America/Tegucigalpa",

    "America/Thule" => "America/Thule",

    "America/Thunder_Bay" => "America/Thunder_Bay",

    "America/Tijuana" => "America/Tijuana",

    "America/Toronto" => "America/Toronto",
    "America/Tortola" => "America/Tortola",

    "America/Vancouver" => "America/Vancouver",

    "America/Virgin" => "America/Virgin",

    "America/Whitehorse" => "America/Whitehorse",

    "America/Winnipeg" => "America/Winnipeg",

    "America/Yakutat" => "America/Yakutat",
    "America/Yellowknife" => "America/Yellowknife",

    "Antarctica/Casey" => "Antarctica/Casey",

    "Antarctica/Davis" => "Antarctica/Davis",
    "Antarctica/DumontDUrville" => "Antarctica/DumontDUrville",

    "Antarctica/Macquarie" => "Antarctica/Macquarie",

    "Antarctica/Mawson" => "Antarctica/Mawson",

    "Antarctica/McMurdo" => "Antarctica/McMurdo",

    "Antarctica/Palmer" => "Antarctica/Palmer",

    "Antarctica/Rothera" => "Antarctica/Rothera",

    "Antarctica/South_Pole" => "Antarctica/South_Pole",

    "Antarctica/Syowa" => "Antarctica/Syowa",

    "Antarctica/Troll" => "Antarctica/Troll",

    "Antarctica/Vostok" => "Antarctica/Vostok",
    "Arctic/Longyearbyen" => "Arctic/Longyearbyen",

    "Asia/Aden" => "Asia/Aden",

    "Asia/Almaty" => "Asia/Almaty",

    "Asia/Amman" => "Asia/Amman",
    "Asia/Anadyr" => "Asia/Anadyr",

    "Asia/Aqtau" => "Asia/Aqtau",

    "Asia/Aqtobe" => "Asia/Aqtobe",

    "Asia/Ashgabat" => "Asia/Ashgabat",

    "Asia/Ashkhabad" => "Asia/Ashkhabad",

    "Asia/Baghdad" => "Asia/Baghdad",

    "Asia/Bahrain" => "Asia/Bahrain",
    "Asia/Baku" => "Asia/Baku",

    "Asia/Bangkok" => "Asia/Bangkok",

    "Asia/Beirut" => "Asia/Beirut",

    "Asia/Bishkek" => "Asia/Bishkek",
    "Asia/Brunei" => "Asia/Brunei",

    "Asia/Calcutta" => "Asia/Calcutta",

    "Asia/Chita" => "Asia/Chita",

    "Asia/Choibalsan" => "Asia/Choibalsan",

    "Asia/Chongqing" => "Asia/Chongqing",

    "Asia/Chungking" => "Asia/Chungking",

    "Asia/Colombo" => "Asia/Colombo",
    "Asia/Dacca" => "Asia/Dacca",

    "Asia/Damascus" => "Asia/Damascus",

    "Asia/Dhaka" => "Asia/Dhaka",

    "Asia/Dili" => "Asia/Dili",

    "Asia/Dubai" => "Asia/Dubai",
    "Asia/Dushanbe" => "Asia/Dushanbe",

    "Asia/Gaza" => "Asia/Gaza",

    "Asia/Harbin" => "Asia/Harbin",

    "Asia/Hebron" => "Asia/Hebron",

    "Asia/Ho_Chi_Minh" => "Asia/Ho_Chi_Minh",

    "Asia/Hong_Kong" => "Asia/Hong_Kong",

    "Asia/Hovd" => "Asia/Hovd",
    "Asia/Irkutsk" => "Asia/Irkutsk",

    "Asia/Istanbul" => "Asia/Istanbul",

    "Asia/Jakarta" => "Asia/Jakarta",

    "Asia/Jayapura" => "Asia/Jayapura",

    "Asia/Jerusalem" => "Asia/Jerusalem",

    "Asia/Kamchatka" => "Asia/Kamchatka",
    "Asia/Karachi" => "Asia/Karachi",

    "Asia/Kashgar" => "Asia/Kashgar",

    "Asia/Kathmandu" => "Asia/Kathmandu",

    "Asia/Katmandu" => "Asia/Katmandu",
    "Asia/Khandyga" => "Asia/Khandyga",

    "Asia/Kolkata" => "Asia/Kolkata",

    "Asia/Krasnoyarsk" => "Asia/Krasnoyarsk",

    "Asia/Kuala_Lumpur" => "Asia/Kuala_Lumpur",

    "Asia/Kuching" => "Asia/Kuching",

    "Asia/Kuwait" => "Asia/Kuwait",

    "Asia/Macao" => "Asia/Macao",

    "Asia/Macau" => "Asia/Macau",
    "Asia/Magadan" => "Asia/Magadan",

    "Asia/Makassar" => "Asia/Makassar",

    "Asia/Manila" => "Asia/Manila",

    "Asia/Muscat" => "Asia/Muscat",

    "Asia/Nicosia" => "Asia/Nicosia",

    "Asia/Novokuznetsk" => "Asia/Novokuznetsk",

    "Asia/Novosibirsk" => "Asia/Novosibirsk",

    "Asia/Omsk" => "Asia/Omsk",

    "Asia/Oral" => "Asia/Oral",

    "Asia/Phnom_Penh" => "Asia/Phnom_Penh",

    "Asia/Pontianak" => "Asia/Pontianak",

    "Asia/Pyongyang" => "Asia/Pyongyang",
    "Asia/Qatar" => "Asia/Qatar",

    "Asia/Qyzylorda" => "Asia/Qyzylorda",

    "Asia/Rangoon" => "Asia/Rangoon",

    "Asia/Riyadh" => "Asia/Riyadh",

    "Asia/Saigon" => "Asia/Saigon",

    "Asia/Sakhalin" => "Asia/Sakhalin",

    "Asia/Samarkand" => "Asia/Samarkand",

    "Asia/Seoul" => "Asia/Seoul",
    "Asia/Shanghai" => "Asia/Shanghai",

    "Asia/Singapore" => "Asia/Singapore",

    "Asia/Srednekolymsk" => "Asia/Srednekolymsk",

    "Asia/Taipei" => "Asia/Taipei",

    "Asia/Tashkent" => "Asia/Tashkent",
    "Asia/Tbilisi" => "Asia/Tbilisi",

    "Asia/Tehran" => "Asia/Tehran",

    "Asia/Tel_Aviv" => "Asia/Tel_Aviv",

    "Asia/Thimbu" => "Asia/Thimbu",

    "Asia/Thimphu" => "Asia/Thimphu",

    "Asia/Tokyo" => "Asia/Tokyo",

    "Asia/Ujung_Pandang" => "Asia/Ujung_Pandang",
    "Asia/Ulaanbaatar" => "Asia/Ulaanbaatar",

    "Asia/Ulan_Bator" => "Asia/Ulan_Bator",

    "Asia/Urumqi" => "Asia/Urumqi",

    "Asia/Ust-Nera" => "Asia/Ust-Nera",

    "Asia/Vientiane" => "Asia/Vientiane",

    "Asia/Vladivostok" => "Asia/Vladivostok",
    "Asia/Yakutsk" => "Asia/Yakutsk",

    "Asia/Yekaterinburg" => "Asia/Yekaterinburg",

    "Asia/Yerevan" => "Asia/Yerevan",

    "Atlantic/Azores" => "Atlantic/Azores",

    "Atlantic/Bermuda" => "Atlantic/Bermuda",
    "Atlantic/Canary" => "Atlantic/Canary",

    "Atlantic/Cape_Verde" => "Atlantic/Cape_Verde",

    "Atlantic/Faeroe" => "Atlantic/Faeroe",

    "Atlantic/Faroe" => "Atlantic/Faroe",

    "Atlantic/Jan_Mayen" => "Atlantic/Jan_Mayen",
    "Atlantic/Madeira" => "Atlantic/Madeira",

    "Atlantic/Reykjavik" => "Atlantic/Reykjavik",

    "Atlantic/South_Georgia" => "Atlantic/South_Georgia",

    "Atlantic/St_Helena" => "Atlantic/St_Helena",

    "Atlantic/Stanley" => "Atlantic/Stanley",

    "Australia/ACT" => "Australia/ACT",

    "Australia/Adelaide" => "Australia/Adelaide",
    "Australia/Brisbane" => "Australia/Brisbane",

    "Australia/Broken_Hill" => "Australia/Broken_Hill",

    "Australia/Canberra" => "Australia/Canberra",

    "Australia/Currie" => "Australia/Currie",

    "Australia/Darwin" => "Australia/Darwin",

    "Australia/Eucla" => "Australia/Eucla",
    "Australia/Hobart" => "Australia/Hobart",

    "Australia/LHI" => "Australia/LHI",

    "Australia/Lindeman" => "Australia/Lindeman",

    "Australia/Lord_Howe" => "Australia/Lord_Howe",

    "Australia/Melbourne" => "Australia/Melbourne",

    "Australia/North" => "Australia/North",
    "Australia/NSW" => "Australia/NSW",

    "Australia/Perth" => "Australia/Perth",

    "Australia/Queensland" => "Australia/Queensland",

    "Australia/South" => "Australia/South",

    "Australia/Sydney" => "Australia/Sydney",

    "Australia/Tasmania" => "Australia/Tasmania",

    "Australia/Victoria" => "Australia/Victoria",
    "Australia/West" => "Australia/West",

    "Australia/Yancowinna" => "Australia/Yancowinna",

    "Europe/Amsterdam" => "Europe/Amsterdam",

    "Europe/Andorra" => "Europe/Andorra",

    "Europe/Athens" => "Europe/Athens",

    "Europe/Belfast" => "Europe/Belfast",

    "Europe/Belgrade" => "Europe/Belgrade",
    "Europe/Berlin" => "Europe/Berlin",

    "Europe/Bratislava" => "Europe/Bratislava",

    "Europe/Brussels" => "Europe/Brussels",

    "Europe/Bucharest" => "Europe/Bucharest",

    "Europe/Budapest" => "Europe/Budapest",
    "Europe/Busingen" => "Europe/Busingen",

    "Europe/Chisinau" => "Europe/Chisinau",

    "Europe/Copenhagen" => "Europe/Copenhagen",

    "Europe/Dublin" => "Europe/Dublin",

    "Europe/Gibraltar" => "Europe/Gibraltar",

    "Europe/Guernsey" => "Europe/Guernsey",

    "Europe/Helsinki" => "Europe/Helsinki",
    "Europe/Isle_of_Man" => "Europe/Isle_of_Man",

    "Europe/Istanbul" => "Europe/Istanbul",

    "Europe/Jersey" => "Europe/Jersey",

    "Europe/Kaliningrad" => "Europe/Kaliningrad",

    "Europe/Kiev" => "Europe/Kiev",

    "Europe/Lisbon" => "Europe/Lisbon",
    "Europe/Ljubljana" => "Europe/Ljubljana",
    "Europe/London" => "Europe/London",
    "Europe/Luxembourg" => "Europe/Luxembourg",
    "Europe/Madrid" => "Europe/Madrid",
    "Europe/Malta" => "Europe/Malta",
    "Europe/Mariehamn" => "Europe/Mariehamn",
    "Europe/Minsk" => "Europe/Minsk",
    "Europe/Monaco" => "Europe/Monaco",
    "Europe/Moscow" => "Europe/Moscow",
    "Europe/Nicosia" => "Europe/Nicosia",
    "Europe/Oslo" => "Europe/Oslo",
    "Europe/Paris" => "Europe/Paris",
    "Europe/Podgorica" => "Europe/Podgorica",
    "Europe/Prague" => "Europe/Prague	<</option>",
    "Europe/Riga" => "Europe/Riga",
    "Europe/Rome" => "Europe/Rome",
    "Europe/Samara" => "Europe/Samara",
    "Europe/San_Marino" => "Europe/San_Marino",
    "Europe/Sarajevo" => "Europe/Sarajevo",
    "Europe/Simferopol" => "Europe/Simferopol",
    "Europe/Skopje" => "Europe/Skopje",
    "Europe/Sofia" => "Europe/Sofia",
    "Europe/Stockholm" => "Europe/Stockholm",
    "Europe/Tallinn" => "Europe/Tallinn",
    "Europe/Tirane" => "Europe/Tirane",
    "Europe/Tiraspol" => "Europe/Tiraspol",
    "Europe/Uzhgorod" => "Europe/Uzhgorod",
    "Europe/Vaduz" => "Europe/Vaduz",
    "Europe/Vatican" => "Europe/Vatican",
    "Europe/Vienna" => "Europe/Vienna",
    "Europe/Vilnius" => "Europe/Vilnius",
    "Europe/Volgograd" => "Europe/Volgograd",
    "Europe/Warsaw" => "Europe/Warsaw",
    "Europe/Zagreb" => "Europe/Zagreb",
    "Europe/Zaporozhye" => "Europe/Zaporozhye",
    "Europe/Zurich" => "Europe/Zurich",
    "Indian/Antananarivo" => "Indian/Antananarivo",
    "Indian/Chagos" => "Indian/Chagos",
    "Indian/Christmas" => "Indian/Christmas",
    "Indian/Cocos" => "Indian/Cocos",
    "Indian/Comoro" => "Indian/Comoro",
    "Indian/Kerguelen" => "Indian/Kerguelen",
    "Indian/Mahe" => "Indian/Mahe",
    "Indian/Maldives" => "Indian/Maldives",
    "Indian/Mauritius" => "Indian/Mauritius",
    "Indian/Mayotte" => "Indian/Mayotte",
    "Indian/Reunion" => "Indian/Reunion",
    "Pacific/Apia" => "Pacific/Apia",
    "Pacific/Auckland" => "Pacific/Auckland",
    "Pacific/Bougainville" => "Pacific/Bougainville",
    "Pacific/Chatham" => "Pacific/Chatham",
    "Pacific/Chuuk" => "Pacific/Chuuk",
    "Pacific/Easter" => "Pacific/Easter",
    "Pacific/Efate" => "Pacific/Efate",
    "Pacific/Enderbury" => "Pacific/Enderbury",
    "Pacific/Fakaofo" => "Pacific/Fakaofo",
    "Pacific/Fiji" => "Pacific/Fiji",
    "Pacific/Funafuti" => "Pacific/Funafuti",
    "Pacific/Galapagos" => "Pacific/Galapagos",
    "Pacific/Gambier" => "Pacific/Gambier",
    "Pacific/Guadalcanal" => "Pacific/Guadalcanal",
    "Pacific/Guam" => "Pacific/Guam",
    "Pacific/Honolulu" => "Pacific/Honolulu",
    "Pacific/Johnston" => "Pacific/Johnston",
    "Pacific/Kiritimati" => "Pacific/Kiritimati",
    "Pacific/Kosrae" => "Pacific/Kosrae",
    "Pacific/Kwajalein" => "Pacific/Kwajalein",
    "Pacific/Majuro" => "Pacific/Majuro",
    "Pacific/Marquesas" => "Pacific/Marquesas",
    "Pacific/Midway" => "Pacific/Midway",
    "Pacific/Nauru" => "Pacific/Nauru",
    "Pacific/Niue" => "Pacific/Niue",
    "Pacific/Norfolk" => "Pacific/Norfolk",
    "Pacific/Noumea" => "Pacific/Noumea",
    "Pacific/Pago_Pago" => "Pacific/Pago_Pago",
    "Pacific/Palau" => "Pacific/Palau",
    "Pacific/Pitcairn" => "Pacific/Pitcairn",
    "Pacific/Pohnpei" => "Pacific/Pohnpei",
    "Pacific/Ponape" => "Pacific/Ponape",
    "Pacific/Port_Moresby" => "Pacific/Port_Moresby",
    "Pacific/Rarotonga" => "Pacific/Rarotonga",
    "Pacific/Saipan" => "Pacific/Saipan",
    "Pacific/Samoa" => "Pacific/Samoa",
    "Pacific/Tahiti	" => "Pacific/Tahiti",
    "Pacific/Tarawa" => "Pacific/Tarawa",
    "Pacific/Tongatapu" => "Pacific/Tongatapu",
    "Pacific/Truk" => "Pacific/Truk",
    "Pacific/Wake" => "Pacific/Wake",
    "Pacific/Wallis" => "Pacific/Wallis",
    "Pacific/Yap" => "Pacific/Yap",
    "Brazil/Acre" => "Brazil/Acre",
    "Brazil/DeNoronha" => "Brazil/DeNoronha",
    "Brazil/East" => "Brazil/East",
    "Brazil/West" => "Brazil/West",
    "anada/Atlantic" => "Canada/Atlantic",
    "Canada/Central" => "Canada/Central",
    "Canada/East-Saskatchewan" => "Canada/East-Saskatchewan",
    "Canada/Eastern" => "Canada/Eastern",
    "Canada/Mountain" => "Canada/Mountain",
    "Canada/Newfoundland" => "Canada/Newfoundland",
    "Canada/Pacific" => "Canada/Pacific",
    "Canada/Saskatchewan" => "Canada/Saskatchewan",
    "Canada/Yukon" => "Canada/Yukon",
    "CET Chile/Continental" => "CET Chile/Continental",
    "Chile/EasterIsland" => "Chile/EasterIsland",
    "CST6CDT" => "CST6CDT",
    "Cuba" => "Cuba",
    "EET" => "EET",
    "Egypt" => "Egypt",
    "Eire" => "Eire",
    "EST" => "EST",
    "EST5EDT" => "EST5EDT",
    "Etc/GMT" => "Etc/GMT",
    "Etc/GMT+0" => "Etc/GMT+0",
    "Etc/GMT+1" => "Etc/GMT+1",
    "Etc/GMT+10	" => "Etc/GMT+10",
    "Etc/GMT+11" => "Etc/GMT+11",
    "Etc/GMT+12	" => "Etc/GMT+12",
    "Etc/GMT+2" => "Etc/GMT+2",
    "Etc/GMT+3	" => "Etc/GMT+3",
    "Etc/GMT+4" => "Etc/GMT+4",
    "Etc/GMT+5" => "Etc/GMT+5",
    "Etc/GMT+6" => "Etc/GMT+6",

    "Etc/GMT+7" => "Etc/GMT+7",

    "Etc/GMT+8" => "Etc/GMT+8",

    "Etc/GMT+9" => "Etc/GMT+9",

    "Etc/GMT-0" => "Etc/GMT-0",

    "Etc/GMT-1" => "Etc/GMT-1",

    "Etc/GMT-10" => "Etc/GMT-10",

    "Etc/GMT-11" => "Etc/GMT-11",

    "Etc/GMT-12" => "Etc/GMT-12",

    "Etc/GMT-13" => "Etc/GMT-13",
    "Etc/GMT-14" => "Etc/GMT-14",

    "Etc/GMT-2" => "Etc/GMT-2",

    "Etc/GMT-3" => "Etc/GMT-3",

    "Etc/GMT-4" => "Etc/GMT-4",

    "Etc/GMT-5" => "Etc/GMT-5",

    "Etc/GMT-6" => "Etc/GMT-6",

    "Etc/GMT-7" => "Etc/GMT-7",

    "Etc/GMT-8" => "Etc/GMT-8",

    "Etc/GMT-9" => "Etc/GMT-9",

    "Etc/GMT0" => "Etc/GMT0",

    "Etc/Greenwich" => "Etc/Greenwich",

    "Etc/UCT" => "Etc/UCT",
    "Etc/Universal" => "Etc/Universal",

    "Etc/UTC" => "Etc/UTC",

    "Etc/Zulu" => "Etc/Zulu",

    "Factory" => "Factory",

    "GB" => "GB",

    "GB-Eire" => "GB-Eire",

    "GMT" => "GMT",

    "GMT+0" => "GMT+0",

    "GMT-0" => "GMT-0",

    "GMT0" => "GMT0",

    "Greenwich" => "Greenwich",

    "Hongkong" => "Hongkong",
    "HST" => "HST",

    "Iceland" => "Iceland",

    "Iran" => "Iran",

    "Israel" => "Israel",

    "Jamaica" => "Jamaica",

    "Japan" => "Japan",

    "Kwajalein" => "Kwajalein",

    "Libya" => "Libya",

    "MET" => "MET",

    "Mexico/BajaNorte" => "Mexico/BajaNorte",

    "Mexico/BajaSur" => "Mexico/BajaSur",

    "Mexico/General" => "Mexico/General",

    "MST" => "MST",

    "MST7MDT" => "MST7MDT",

    "Navajo" => "Navajo",

    "NZ" => "NZ",
    "NZ-CHAT" => "NZ-CHAT",
    "Poland" => "Poland",
    "Portugal" => "Portugal",
    "PRC" => "PRC",
    "PST8PDT" => "PST8PDT",
    "ROC" => "ROC",
    "ROK" => "ROK",
    "Singapore" => "Singapore",
    "Turkey" => "Turkey",
    "UCT" => "UCT",
    "Universal" => "Universal",
    "US/Alaska" => "US/Alaska",
    "US/Aleutian" => "US/Aleutian",
    "US/Arizona" => "US/Arizona",
    "US/Central" => "US/Central",
    "US/East-Indiana" => "US/East-Indiana",
    "US/Eastern" => "US/Eastern",
    "US/Hawaii" => "US/Hawaii",
    "US/Indiana-Starke" => "US/Indiana-Starke",
    "US/Michigan" => "US/Michigan",
    "US/Mountain" => "US/Mountain",
    "US/Pacific" => "US/Pacific",
    "US/Pacific-New" => "US/Pacific-New",
    "US/Samoa" => "US/Samoa",
    "UTC" => "UTC",
    "W-SU" => "W-SU",
    "WET" => "WET",
    "Zulu" => "Zulu"
);



	function display_form($message){
			if($message != ""){
				display_error($message);
			}
			?>
				<div class="row">
					
					<div class="col-lg-12">
								<input type="hidden" name="step" value="2" />
								<div>
									<span class="input-group-addon required">Host Name</span>
									<input type="text" class="form-control" name="server" id="server" placeholder="" required/>
									<span class="small">You should be able to get hostname from your web host, if <strong>localhost</strong> does not work.</span>
								</div>
                                <div>
									<span class="input-group-addon required">MySQL Username</span>
									<input type="text" class="form-control" name="mysql_username" id="mysql_username" placeholder="MySQL Username" required />
								</div>
								<div>
									<span class="input-group-addon">MySQL Password</span>
									<input type="password" class="form-control" name="mysql_password" id="mysql_password" placeholder="MySQL Password" />
								</div>
								<div>
									<span class="input-group-addon required">Database Name</span>
									<input type="text" class="form-control" name="dbname" id="dbname" placeholder="" required/>
								</div>
								<div class="checkbox">
									<label><input type='checkbox' name='createdb' id='createdb' value='createdb'> Create database</label>
								</div>
								<div>
									<span class="input-group-addon">Table Prefix</span>
									<input type="text" class="form-control" name="tableprefix" id="tableprefix" placeholder=""  />
								</div>
								
														
					</div>
				</div>
			<?php
		}
		?>
<body class="" style="background-color:#fff !important;">
<div class="container">
<div class="row">
		<div class="col-lg-12">
			<div class="text-center">
				<!--<h1 class="h4 text-gray-900 mb-4">Chikitsa : Install</h1>-->
				<img src="./uploads/images/logo.png" alt="Chikitsa" width="100px">
				<div class="ast-site-title-wrap">
						<h1 class="site-title" itemprop="name">
                        Chikitsa
                        </h1>
						<p class="site-description" itemprop="description">
                        Clinic/Hospital Management System
                        </p>
				</div>
			</div>
		</div>
	</div>
<form id="install" action="#">
    <div>
        <h3>Database</h3>
		<?php
		/************************************************************
		** Step 1 - Ask for MySQL Credentials
		*************************************************************/
		?>
        <section>
			<?php
				$message="";
				display_form($message);
			?>
        </section>
        <h3>System Administrator</h3>
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Create System Administrator User</strong>
                        </div>
                        <div class="panel-body">
                
                            <span class="input-group-addon required">Username</span>
                            <input type="text" class="form-control" name="admin_username" id="admin_username" placeholder="User Name" required />

                            <span class="input-group-addon required">Password</span>
                            <input type="password" class="form-control" name="admin_password" id="admin_password" placeholder="Password" required/>

                            <span class="input-group-addon required">Confirm Password</span>
                            <input type="password" class="form-control" name="admin_confirm_password" placeholder="Confirm Password" required />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <h3>Clinic Settings</h3>
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Set Clinic Settings</strong>
                        </div>
                        <div class="panel-body">
                
                            <span class="input-group-addon required">Clinic Name</span>
                            <input type="text" class="form-control" name="clinic_name" placeholder="Clinic Name" required />

                            <span class="input-group-addon">Clinic Address</span>
                            <textarea rows="4" name="clinic_address" class="form-control"></textarea>
                            <div style="width:50%;display:inline-block;">
                            <span class="input-group-addon ">Clinic Phone Number</span>
                            <input type="text" class="form-control" name="clinic_phone_number" placeholder="Clinic Phone Number"  />
                            </div>
                            <div style="width:49%;display:inline-block;">
                            <span class="input-group-addon ">Clinic Email Address</span>
                            <input type="text" class="form-control" name="clinic_email_address" placeholder="Clinic Email Address"  />
                            </div>
                            <div style="width:24%;display:inline-block;">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="full_day" id="full_day" value="1" > Clinic Runs Full Day
                                </label>
                            </div>
                            </div>
                            <div style="width:25%;display:inline-block;">
                            <span class="input-group-addon ">Clinic Start Time</span>
    						<input type="input" name="clinic_start_time" id="clinic_start_time" value="" class="form-control"/>
                            </div>
                            <div style="width:25%;display:inline-block;">
                            <span class="input-group-addon ">Clinic End Time</span>
    						<input type="input" name="clinic_end_time" id="clinic_end_time" value="" class="form-control"/>
                            </div>
                            <div style="width:24%;display:inline-block;">
                            <span class="input-group-addon ">Normal Appointment Time (in minutes)</span>
    						<input type="text" name="time_interval" value="60" class="form-control"/>
                            </div>
                            <div style="width:100%;display:inline-block;">
                            <span class="input-group-addon ">Working Days</span>
                            <div class="row">
                               
                                <div class="col-md-1">
                                    <label><input type="checkbox" name="working_days[]" checked="" value="7">S</label>
                                </div>
                                <div class="col-md-1">
                                    <label><input type="checkbox" name="working_days[]" checked="" value="1">M</label>
                                </div>
                                <div class="col-md-1">
                                    <label><input type="checkbox" name="working_days[]" checked="" value="2">T</label>
                                </div>
                                <div class="col-md-1">
                                    <label><input type="checkbox" name="working_days[]" checked="" value="3">W</label>
                                </div>
                                <div class="col-md-1">
                                    <label><input type="checkbox" name="working_days[]" checked="" value="4">T</label>
                                </div>
                                <div class="col-md-1">
                                    <label><input type="checkbox" name="working_days[]" checked="" value="5">F</label>
                                </div>
                                <div class="col-md-1">
                                    <label><input type="checkbox" name="working_days[]" checked="" value="6">S</label>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <h3>General Settings</h3>
        <section>
        <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Set General Settings</strong>
                        </div>
                        <div class="panel-body">
                
                            <span class="input-group-addon required">Select your Time Zone</span>
                            <select name="timezones" class="form-control" id="timezones">
                                <?php foreach($timezone_list as $value=>$label){ ?>
                                <option value="<?=$value;?>" ><?=$label;?></option>
                                <?php } ?>
                            </select>
                            
                            <span class="input-group-addon ">Currency Symbol</span>
    						<input type="input" name="currency_symbol" id="currency_symbol" value="" class="form-control"/>

                            <span class="input-group-addon ">Decimal Places</span>
    						<input type="input" name="currency_decimal_places" id="currency_decimal_places" value="" class="form-control"/>
                            
                            <span class="input-group-addon ">Decimal Symbol</span>
    						<input type="input" name="currency_decimal_symbol" id="currency_decimal_symbol" value="" class="form-control"/>

                            <span class="input-group-addon ">Thousand Separator</span>
    						<input type="input" name="currency_thousand_seaparator" id="currency_thousand_seaparator" value="" class="form-control"/>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <h3>Update Notifications</h3>
        <section>
        <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
   
                        <div class="panel-body">
                
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="autoupdates" id="autoupdates" value="1" > Check for updates automatically
                                </label>
                            </div>
                            <small>The System will notify youu when updates abd important security released. Anonymous information about your site is sent to <a href="https://chikitsa.net/">chikitsa.net</a></small>
                            <br/>        
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="email_subscribe" id="email_subscribe" value="1" > Receive Email Notifications for Updates and Offers
                                </label>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>
</div>
<script>
var form = $("#install");
$.validator.addMethod(
	"MySQLConnect", 
	function(value, element) {
		var response;
		
		var server = $("#server").val();
		var username = $("#mysql_username").val();
		var password = $("#mysql_password").val();
		
		$.ajax({
			type: "POST",
			async: false,
			url: "install/checkMySQLConnection.php",
			data: {server: server, username: username, password: password},
			dataType:"html",
			success: function(msg)
			{
				//If username exists, set response to true
				response = ( msg === 'true' ) ? true : false;
			}
		 });
		return response;
	},
	"Cannot Connect to MySQL. Please check MySQL Username and MySQL Password"
);
$.validator.addMethod(
	"databaseExists", 
	function(value, element) {
		var response;
		
		var server = $("#server").val();
		var username = $("#mysql_username").val();
		var password = $("#mysql_password").val();
		var dbname = $("#dbname").val();
		
		if($("#createdb").prop("checked") == true){
			$.ajax({
				type: "POST",
				async: false,
				url: "install/checkDatabaseExists.php",
				data: {server: server, username: username, password: password, dbname: dbname},
				dataType:"html",
				success: function(msg)
				{
					//If username exists, set response to true
					response = ( msg === 'notexists' ) ? true : false;
				}
			 });
			return response;
		}else{
			return true;
		}
		
	},
	"Database already exists. Cannot create Database"
);

$.validator.addMethod(
	"databaseNotExists", 
	function(value, element) {
		var response;
		
		var server = $("#server").val();
		var username = $("#mysql_username").val();
		var password = $("#mysql_password").val();
		var dbname = $("#dbname").val();
		
		if($("#createdb").prop("checked") == true){
			return true;
		}else{
			$.ajax({
				type: "POST",
				async: false,
				url: "install/checkDatabaseExists.php",
				data: {server: server, username: username, password: password, dbname: dbname},
				dataType:"html",
				success: function(msg)
				{
					//If username exists, set response to true
					response = ( msg === 'exists' ) ? true : false;
				}
			 });
			return response;
		}
		
		
		
		return true;
	},
	"Database does not exists. Cannot Install."
);

$.validator.addMethod(
	"tablesCreated", 
	function(value, element) {
		var response;
		
		var server = $("#server").val();
		var username = $("#mysql_username").val();
		var password = $("#mysql_password").val();
		var dbname = $("#dbname").val();
		var dbprefix = $("#tableprefix").val();
		
		if($("#createdb").prop("checked") == true){
			return true;
		}else{
			$.ajax({
				type: "POST",
				async: false,
				url: "install/checkTablesCreated.php",
				data: {server: server, username: username, password: password, dbname: dbname, dbprefix: dbprefix},
				dataType:"html",
				success: function(msg)
				{
					//If username exists, set response to true
					response = ( msg === 'notexists' ) ? true : false;
				}
			 });
			return response;
		}
		
		return false;
	},
	"Tables already installed.Try another Database or Table Prefix."
);
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        dbname:{
			databaseNotExists: true
		},
		createdb:{
			databaseExists: true
		},
		tableprefix:{
			tablesCreated: true
		},
		mysql_username: {
            required: true,
            MySQLConnect: true
        },
        password: {
            required: true,
            minlength : 5
        },
        confirm_password : {
            required: true,
            equalTo : "#password"
        },
        admin_username : {
            required: true,
            minlength: 5,
            maxlength: 25
        },
        admin_password : {
            required: true,
            minlength: 8,
            maxlength: 50
        },
        admin_confirm_password : {
            required: true,
            equalTo : "#admin_password"
        }
    }
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex){
        
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        var server = $("#server").val();
		var username = $("#mysql_username").val();
		var password = $("#mysql_password").val();
		var dbname = $("#dbname").val();
		var dbprefix = $("#tableprefix").val();
        var createdb = 0;

        var admin_username = $("#admin_username").val();
		var admin_password = $("#admin_password").val();
        
        if($("#createdb").prop("checked") == true){
            createdb = 1;
        }
        
        $.ajax({
            type: "POST",
            async: false,
            url: "install/installDatabase.php",
            data: {server: server, username: username, password: password, dbname: dbname, dbprefix: dbprefix, createdb: createdb},
            dataType:"html",
            success: function(msg)
            {
                $.ajax({
                    type: "POST",
                    async: false,
                    url: "install/createSysAdmin.php",
                    data: {server: server, username: username, password: password, dbname: dbname, dbprefix: dbprefix, admin_username: admin_username, admin_password : admin_password},
                    dataType:"html",
                    success: function(msg)
                    {
                        console.log(msg);
                    }
                });
            }
        });
        return true;
    }
});
</script>
</body>
</html>