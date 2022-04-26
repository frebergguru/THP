<?
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
//get some information and fix the output
$title = (string) mysql_real_escape_string($_POST["title"]);
$pagename = mysql_real_escape_string($_POST["pagename"]);
$to = (string) mysql_real_escape_string($_POST["to"]);
$maintenance = (int) $_POST["maintenance"];
$maintenanceip = $_POST["maintenanceip"];
$dguestbook = (int) $_POST["dguestbook"];
$dlinks = $_POST["dlinks"];
$siteurl = (string) mysql_real_escape_string($_POST["siteurl"]);
$backend_description = mysql_real_escape_string($_POST["backend_description"]);
$backend_language = (string) mysql_real_escape_string($_POST["backend_language"]);
$images = (string) mysql_real_escape_string($_POST["images"]);
$save = (int) $_GET["save"];
//if $save is 1 then
if ($save == "1") {
	//update the table config
	$query_string ="UPDATE `config` SET `title` = '$title',`pagename` = '$pagename',`to` = '$to',`maintenance` = '$maintenance',`maintenanceip` = '$maintenanceip',`dguestbook` = '$dguestbook',`dlinks` = '$dlinks',`siteurl` = '$siteurl',`backend_description` = '$backend_description',`backend_language` = '$backend_language',`images` = '$images';";
	mysql_query("$query_string") or mysqldie("Kan ikke skrive til $database.config");
	//print out a information box with the text "Innstillingene er n&aring; lagret!"
	info("Innstillingene er n&aring; lagret!");
}
//Query the MySQL database and get everything from the "config" table, die if a error occure
$result=mysql_query("SELECT * FROM config") or mysqldie("Kan ikke lese fra $database.config");
//get the result
$row = mysql_fetch_array($result);
//get some information and fix the output
$id = $row["id"];
$title = stripslashes($row["title"]);
$pagename = stripslashes($row["pagename"]);
$to = $row["to"];
$maintenance = $row["maintenance"];
$maintenanceip = $row["maintenanceip"];
$dguestbook = $row["dguestbook"];
$dlinks = $row["dlinks"];
$siteurl = stripslashes($row["siteurl"]);
$backend_description = stripslashes($row["backend_description"]);
$backend_language = stripslashes($row["backend_language"]);
$images = $row["images"];
//print out the "Edit CMS configuration" box
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>CMS konfigurering</strong></font>
</td>
</tr>
<tr>
<td class="under" valign="top">
<form name="setconfig" action="index.php?site='.$site.'&amp;save=1" method="post">
<strong>Titelen til siden:</strong><br>
<input type="text" name="title" value="'.$title.'" size="30" class="form"><br>
<br>
<strong>Navnet til siden:</strong><br>
<input type="text" name="pagename" value="'.$pagename.'" size="30" class="form"><br>
<br>
<strong>E-Mail adressen til administratoren:</strong><br>
<input type="text" name="to" value="'.$to.'" size="30" class="form"><br>
<br>
<strong>Vedlikehold:</strong><br>
<select name="maintenance">
<option value="0"'; if($maintenance=="1"){print 'selected';}; print '> Nei
<option value="1"'; if($maintenance=="1"){print 'selected';}; print '> Ja
</select><br>
<br>
<strong>Vedlikeholds ip:</strong><br>
<input type="text" name="maintenanceip" value="'."$maintenanceip".'" size="30"><br>
<br>
<strong>Koble ut skriving til gjesteboken:</strong><br>
<select name="dguestbook">
<option value="0"'; if($dguestbook=="1"){print 'selected';}; print '> Nei
<option value="1"'; if($dguestbook=="1"){print 'selected';}; print '> Ja
</select><br>
<br>
<strong>Koble ut legge til linker:</strong><br>
<select name="dlinks">
<option value="0"'; if($dlinks=="1"){print 'selected';}; print '> Nei
<option value="1"'; if($dlinks=="1"){print 'selected';}; print '> Ja
</select><br>
<br>
<strong>Adressen til siden (url):</strong><br>
<input type="text" name="siteurl" value="'.$siteurl.'" size="30"><br>
<br>
<strong>Backend beskrivelse (RSS):</strong><br>
<input type="text" name="backend_description" value="'.$backend_description.'" size="30"><br>
<br>
<strong>Backend spr&aring;k:</strong><br>
Eks: no-bokmaal<br>
<input type="text" name="backend_language" value="'.$backend_language.'" size="30"><br>
<br>
<strong>Hvor ligger bildene p&aring; web serveren ?</strong><br>
Eks: Hvis bildene ligger p&aring; <strong>http://example.com/bilder</strong> s&aring; skriver du <strong>/bilder</strong> i formen under:<br>
<input type="text" name="images" value="'.$images.'" size="30"><br>
<br>
<input type="Submit" name="submit" value="Rediger" class="form"> || <input type="reset" name="reset" value="Nullstill" class="form">
</form>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>';
?>
