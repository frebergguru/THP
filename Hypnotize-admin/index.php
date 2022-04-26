<?
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
//START FUNCTION CHECKS
//If the function "ini_set" is avaiable then
if(function_exists("ini_set"))
{
//set magic_quotes_runtime to false
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
if(!function_exists("stripslashes")){
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

//Find out what page that should be shown
$site = (string) $_GET['site'];
//Find out what page that should be edited (used by the edit module)
$id2 = (int) $_GET['id2'];
//Get the configuration from "includes/config.php"
include 'includes/config.php';
//Launche the functions for THP from "includes/functions.php"
include 'includes/functions.php';
//if $site is empty then set $site to "edit" and set $id2 to "0"
if (empty($site)) { $site="edit"; $id2="0";}
//Make a connection to MySQL, die if a error occures
$mlink = mysql_connect($hostname, $username, $password) or mysqldie("Kan ikke koble til $hostname");
mysql_selectdb($database, $mlink);
//Get the configuration from the MySQL database
include 'includes/getconfig.php';
//print out the page
print '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>'.$title.'</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="Hypnotize">
<meta name="copyright" content="Copyleft">
<meta name="keywords" content="LastNetwork, Hypnotize">
<meta name="description" content="The Hypnotize Project, Web Portal">
<meta name="generator" content="linux/vi">
<link rel="stylesheet" type="text/css" href="css/admin.css">
<link rel="stylesheet" type="text/css" href="css/admin-menu.css">
</head>
<body class="body">
<br>
<div class="adminmenu">
<table bgcolor="#000000" border="0" cellpadding="1" cellspacing="0">
<tr><td>
<table border="0" cellpadding="4" cellspacing="0">
<tr>
<td class="menu">
<font size="2">
<strong>ADMINISTRASJONS MENY</strong><br>
<br>
<a href="?site=Moduler" class="menu">Moduler</a><br>
<br>
<a href="?site=addcat" class="menu">Legg til en side</a><br>
<br>
<a href="?site=rmcat" class="menu">Fjern en side</a><br>
<br>
<a href="?site=setconfig" class="menu">Konfigurasjon</a>
</font>
</td>
</tr>
</table>
</td></tr>
</table>
</div>
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
'.$pagename.'<br>
<font face="Arial" size="1">';
//Run the *NIX command "uptime" and print out the result 
echo `uptime`;
print '</font>
</td>
</tr>
<tr>
<td class="menu" valign="top">
<div align="center">
<font face="Arial" size="2">
<strong>[</strong> <a href="./index.php" class="menu">Hjem</a> <strong>]</strong> '; include 'includes/menu.php'; print'
</font>
</div>
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
<td class="round" valign=top width="167">';
//include the left boxes
include 'includes/lbox.php';
print '</td>
<td width="12">&nbsp;&nbsp;</td>
<td valign="top" width="416">';
//include the center boxes
include 'includes/cbox.php';
print '</td>
<td width="15">&nbsp;&nbsp;</td>
<td class="round" valign="top" width="165">';
//include the right boxes
include 'includes/rbox.php';
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
Lisensiert under <a href="http://www.gnu.org/" target="_blank">GNU/GPL lisensen</a>.<br>
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
