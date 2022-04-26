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
//Get some information
$action = $_GET["action"];
$module = $_GET["module"];
$id = $_GET["id"];
$edited == $_GET["edited"];
$editname = $_POST["name"];
$editip = $_POST["ip"];
$editdate = $_POST["date"];
$edittime = $_POST["time"];
$editdesc = $_POST["description"];
$editmail = $_POST["mail"];
$editmessage = $_POST["message"];
$edithomepage = $_POST["homepage"];
//get the users ip address
$ip = $_SERVER["REMOTE_ADDR"];
//get the date
$date=date("Y-m-d");
//get the time
$time=date("H:i:s");
//if $action is "Added" then
if ($action=="Added") {
//insert the messages to the guestbook
	$query_string = "INSERT INTO `guestbook` ( `id` , `name` , `ip` , `date` ,`time` , `mail` , `homepage` , `message` ) VALUES ('', '$editname', '$editip', '$editdate', '$edittime', '$editmail', '$edithomepage' , '$editmessage')";
	mysql_query("$query_string") or mysqldie("Kan ikke skrive til $database.guestbook");
//else if $action is "Add" then
} elseif ($action=="Add") {
//print out the Add a message to the guestbook box
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>Add a message</strong></font>
</td>
</tr>
<tr>
<td class="under" valign="top">
<form name="Guestbook" action="index.php?site='.$site.'&amp;action=Added" method="post">
<strong>IP:</strong><br>
<input type="text" name="ip" value="'.$ip.'" size="30"><br>
<strong>Dato:</strong><br>
<input type="text" name="date" value="'.$date.'" size="30"><br>
<strong>Klokken:</strong><br>
<input type="text" name="time" value="'.$time.'" size="30"><br>
<strong>Navn:</strong><br>
<input type="text" name="name" value="" size="30"><br>
<strong>Mail:</strong><br>
<input type="text" name="mail" value="" size="30"><br>
<strong>Hjemmeside:</strong><br>
<input type="text" name="homepage" value="" size="30"><br>
<strong>Melding:</strong><br>
<textarea name="message" rows="6" cols="43"></textarea><br>
<br>
<input type="Submit" value="Legg til"> || <input type="reset" value="Nullstill">
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
//else if $action is "Edited" then
} elseif ($action=="Edited") {
	//update the database with new guestbook information
	$query_string = "UPDATE guestbook SET name='$editname', ip='$editip', date='$editdate', time='$edittime', mail='$editmail', homepage='$edithomepage', message='$editmessage'  WHERE ID like '$id'";
	mysql_query("$query_string") or mysqldie("Kan ikke skrive til $database.guestbook");
//else if $action is "Edit" then
} elseif ($action=="Edit") {
	//Query the MySQL database and get everything from the "guestbook" table where id is $id order by id ascending, die if a error occure
	$result=mysql_query("SELECT * FROM guestbook WHERE id='$id' ORDER BY id ASC") or mysqldie("Kan ikke lese fra $database.guestbook");
	//get the result
	$row = mysql_fetch_array($result);
	//get some innformation and fix the output
	$id = $row["id"];
	$name = stripslashes($row["name"]);
	$ip = $row["ip"];
	$date = $row["date"];
	$time = $row["time"];
	$mail = $row["mail"];
	$homepage = stripslashes($row["homepage"]);
	$message = stripslashes($row["message"]);
//print out the "Edit a message" box
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>Rediger en melding</strong></font></td>
</tr>
<tr>
<td class="under" valign="top">
<form name="Guestbook" action="index.php?site='.$site.'&amp;action=Edited&amp;id='.$id.'" method="post">
<strong>IP:</strong><br>
<input type="text" name="ip" value="'.$ip.'" size="30"><br>
<strong>Dato:</strong><br>
<input type="text" name="date" value="'.$date.'" size="30"><br>
<strong>Klokken:</strong><br>
<input type="text" name="time" value="'.$time.'" size="30"><br>
<strong>Navn:</strong><br>
<input type="text" name="name" value="'.$name.'" size="30"><br>
<strong>Mail:</strong><br>
<input type="text" name="mail" value="'.$mail.'" size="30"><br>
<strong>Hjemmeside:</strong><br>
<input type="text" name="homepage" value="'.$homepage.'" size="30"><br>
<strong>Melding:</strong><br>
<textarea name="message" rows="6" cols="43">'.$message.'</textarea><br>
<br>
<input type="Submit" value="Rediger"> || <input type="reset" value="Nullstill">
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
//else if $action is "Delete" then
} elseif ($action=="Delete"){
	//Delete the message from the guestbook table where id is $id limit 1
	$query_string = 'DELETE FROM `guestbook` WHERE `id` = '."$id".' LIMIT 1';
	mysql_query("$query_string") or mysqldie("Kan ikke slette fra $database.guestbook");
};
//if $action not is Add then
if ($action !="Add"){
//print out the "Add a new message" box
print '<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<div align="center">
<strong><a href="?site='.$site.'&amp;action=Add">Legg til en melding</a></strong>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table><br>';
};
//Query the MySQL database and get everything from the "guestbook" table order by id descending, die if a error occure
$result=mysql_query("SELECT * FROM guestbook ORDER BY id desc") or mysqldie("Kan ikke lese fra $database.guestbook");
//while $result not is empty then
while ($row = mysql_fetch_array($result))
{
	//get some innformation and fix the output
	$id = $row["id"];
	$name = stripslashes(chchar($row["name"]));
	$ip = $row["ip"];
	$date = $row["date"];
	$time = $row["time"];
	$mail = $row["mail"];
	$homepage = stripslashes($row["homepage"]);
	$message = stripslashes(parseurls(smilies(chchar($row["message"]))));
//print out the messages
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="under"><strong><a href="?site='.$site.'&amp;action=Edit&amp;id='.$id.'">Rediger</a> || <a href="?site='.$site.'&amp;action=Delete&amp;id='.$id.'">Slett</a></strong></td>
</tr>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>Fra:</strong> <a href="mailto:'.$mail.'" class="over2">'.$name.'</a> <strong>IP:</strong> '.$ip.' <strong>Dato:</strong> '.$date.' <strong>Kl:</strong> '.$time.'</font>
</td>
</tr>
<tr>
<td class="under" valign="top">
<font size="2">
'.$message.'
</font>
</td>
</tr>
<tr>
<td align="left" class="under2"><font size="1"><a href="'.$homepage.'" class="under2" target="_blank"><strong>Hjemmeside</strong></a></font></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>';
};
?>
