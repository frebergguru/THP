<?php
error_reporting (E_ALL ^ E_NOTICE);
date_default_timezone_set('Europe/Oslo');
/*
    The Hypnotize Project is a Content Management System (CMS) that allows you to easily make your own web site
    Copyright (C) 2004 Morten Freberg

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/
//START "GENERATE TIME COUNTER"
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$start_time = $mtime;
//STOP "GENERATE TIME COUNTER"

//START FUNCTION CHECKS
//If the function "ini_set" is avaiable then
if(function_exists("ini_set"))
{ //set magic_quotes_runtime to false
ini_set("magic_quotes_runtime", "False");
//set short_open_tag to true (On)
ini_set("short_open_tag", "On");
//set register_globals to false
ini_set("register_globals", "False");
}else{ //else if the function not does exist then
//Die and write out "Kan ikke bruke ini_set() funksjonen!"
die("Kan ikke bruke ini_set() funksjonen!");
};
//If the function "stripslashes" not is avaiable then
if(!function_exists("stripslashes"))
{
//Die and write out "Kan ikke bruke stripslashes funksjonen!"
die("Kan ikke bruke stripslashes() funksjonen!");
};
//if the function "mysql_real_escape_string" not is avaiable then
if(!function_exists("mysql_real_escape_string"))
{
//Die and write out "Kan ikke bruke mysql_real_escape_string() funksjonen!"
die("Kan ikke bruke mysql_real_escape_string() funksjonen!");
};
//STOP FUNCTION CHECKS

//Get the string $error from $_GET["error"], only numbers is allowed
$error = (int) $_GET["error"];

//Get the configuration from "includes/config.php"
include 'includes/config.php';
//Launche the functions for THP from "includes/functions.php"
include 'includes/functions.php';

//If $error not is like 503 then
if ($error != "503") {
//Make a connection to MySQL, die if a error occures
$mlink = mysql_connect($hostname, $username, $password) or mysqldie("Kan ikke koble til $hostname");
mysql_selectdb($database, $mlink);
//Get the configuration from the MySQL database
include 'includes/getconfig.php';
};

//Find the users IP address and save it in $origip
$origip = $_SERVER["REMOTE_ADDR"];
//Get the color style and save it in $style
$style = $_GET['style'];
//Find out what page that should be shown
$site = $_GET['site'];

//If $site is like "Gjestebok" then start a server session
if($site=="Gjestebok"){session_start();};
//If $site is like "Linker" then start a server session
if($site=="Linker"){session_start();};

//Make a string named $filename with this content: "css/$style.css" where $style is the style name
$filename = 'css/'.$style.'.css';
//if the file $filename exists then do nothing else set the style to default
if (file_exists($filename)) {} else { $style="default"; }
//if $site is empty then set $site to 0 (Mainpage)
if (empty($site)) { $site="0"; }

print '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>';if($error != "503"){print $title;}else{print "ERROR";}; print '</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="Hypnotize">
<meta name="copyright" content="Copyleft">
<meta name="keywords" content="LastNetwork, Hypnotize">
<meta name="description" content="The Hypnotize Project, Web Portal">
<meta name="generator" content="linux/vi">
<link rel="alternate" type="application/rss+xml" title="'.$backend_description.'" href="./RSS/backend2.php">
<link rel="alternate" type="application/rss+xml" title="'.$backend_description.' - DVD" href="./RSS/dvd2.php">
<link rel="stylesheet" type="text/css" href="css/'.$style.'.css">
</head>
<body>
<table align="center" border="0" width="70%">
<tbody>
<tr bgcolor="#000000">
<td valign="top">
<table align="center" border="0" cellpadding="4" cellspacing="0" width="100%">
<tbody>
<tr>
<td class="round" width="913">
<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over">
<a href="'.$_SERVER["PHP_SELF"].'?style='.$style.'" class="over">';
//if $error not is like "503 then print out the pagename else print out "ERROR"
if($error != "503"){print $pagename;}else{print "ERROR";};print'</a><br>
<font face="Arial" size="1">';
//Run the *NIX command "uptime" and print out the result 
echo `uptime`;
print '</font>
</td>
</tr>
<tr>
<td class="menu" valign="top">
<font face="Arial" size="2">
<strong>[</strong> <a href="'.$_SERVER["PHP_SELF"].'?style='.$style.'" class="menu">Hjem</a> <strong>]</strong> ';if($error != "503"){ if ($maintenance=="1" && $origip == $maintenanceip) { include 'includes/menu.php';}elseif($maintenance=="0") { include 'includes/menu.php';};}; print'
</font>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td class="round" valign="top" width="913">
<table border="0" cellpadding="2" cellspacing="0" width="100%">
<tbody>
<tr>
<td class="round" valign=top width="167">
';if($error != "503") {
if ($maintenance=="1" && $origip == $maintenanceip) { include 'includes/lbox.php';}elseif($maintenance=="0") { include 'includes/lbox.php';};
};
print '</td>
<td width="12">&nbsp;&nbsp;</td>
<td valign="top" width="416">';
//if $error is like 404 then
if ($error == "404") {
//print out a error message
srverror("404", "Filen eller dokumentet <strong>".$_SERVER['REQUEST_URI']."</strong><br>finnes ikke, vennligst pr&oslash;v et annet sted");
//if $error is like 401 then
}elseif($error == "401") {
//print out a error message
srverror("401", "Du har ikke tilgang til denne siden!");
//if $error is like 500 then
}elseif($error == "500") {
//print out a error message
srverror("500", "Det har skjedd en intern server feil, vennligst pr&oslash;v igjen senere!");
//if $error is like 503 then
}elseif($error == "503"){
//print out a error message
srverror("503", "Serveren er fortiden overbelastet, vennligst pr&oslash;v igjen senere!");
}else{ //else check if the page is under maintenance and print out the maintenance message if it is else print out the center boxes
if ($maintenance=="1" && $origip == $maintenanceip) { include 'includes/cbox.php';}elseif($maintenance=="0") { include 'includes/cbox.php';}elseif($maintenance=="1" && $origip != $maintenanceip) {msg("Vedlikehold","Siden er fortiden under vedlikehold, vennligst pr&oslash;v igjen senere!");};
};
print '</td>
<td width="15">&nbsp;&nbsp;</td>
<td class="round" valign="top" width="165">';if($error != "503") { //if $error not is like 503 then
if ($maintenance=="1" && $origip == $maintenanceip) { // if the page is under maintenance and $origip is like $maintenanceip then
//if $site not is like "DVD" then
if ($site != "DVD") {
	include "includes/RSS.php"; //include "inclues/RSS.php"
};
include "includes/rbox.php"; //include "includes/rbox.php"
} elseif($maintenance=="0") { //else if the page not is under maintenance then
if ($site != "DVD") { //if $site not is like "DVD" then
        include "includes/RSS.php"; //include "includes/RSS.php"
};
include "includes/rbox.php"; //include "includes/rbox.php"
};
};
print '</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div align="center">
<table bgcolor="#000000" border="0" cellpadding="1" cellspacing="0" width="70%">
<tr><td>
<table border="0" cellpadding="4" cellspacing="0" width="100%">
<tr>
<td class="round">
<div align="center">
<font size="2">
<a href="http://www.linux.org" target="_blank"><img src="./images/linux.jpg" border="0" alt="Linux"></a> <a href="http://www.php.net" target="_blank"><img src="./images/php.jpg" border="0" alt="PHP"></a> <a href="http://www.mysql.com" target="_blank"><img src="./images/mysql.jpg" border="0" alt="MySQL"></a> <a href="http://www.apache.org" target="_blank"><img src="./images/apache.jpg" border="0" alt="Apache Web Server"></a> <a href="http://www.lastnetwork.net" target="_blank"><img src="./images/Hypnotize.jpg" border="0" alt="The Hypnotize Project"></a><br>
<br>
<strong>CopyLeft &copy; LastNetwork.Net og Glenn Eriksen.<br>
Lisensiert under <a href="http://www.gnu.org/" class="gpl" target="_blank">GNU/GPL lisensen</a>.<br>';
//START "STOP TIME GENERATOR"
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$end_time = $mtime;
$total_time = ($end_time - $start_time);
$total_time = round($total_time, 2);
//STOP "STOP TIME GENERATOR"
print 'Sidegenerering: '.$total_time.' sekunder!</strong>
</font>
</div>
</td>
</tr>
</table>
</td></tr>
</table>
</div>
</body>
</html>';
//if the MySQL link is up then
if (!empty($mlink)) {
//close the connection
mysql_close($mlink);
};
?>
