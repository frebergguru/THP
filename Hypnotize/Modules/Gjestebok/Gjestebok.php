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
//get some information
$name = $_POST['name'];
$message = $_POST['message'];
$mail = $_POST['mail'];
$homepage = $_POST['homepage'];
$number = $_POST['number'];

//get the date
$date=(date ("Y-m-d"));
//get the time
$time=(date ("H:i:s"));
//get the users ip address
$ip=$_SERVER["REMOTE_ADDR"];

//if $name and $message is empty and $dguestbook not is like 1 and md5($number) is like $session["image_reandom_value"] then
if (!empty($name) && !empty($message) && $dguestbook !="1" && md5($number) == $_SESSION['image_random_value']){
//add the message to the database
$result=mysql_query("INSERT INTO guestbook VALUES ('','".mysql_real_escape_string($name)."','$ip','$date','$time','".mysql_real_escape_string($mail)."','".mysql_real_escape_string($homepage)."','".mysql_real_escape_string($message)."')") or mysqldie("Kan ikke skrive til $database.guestbook");
//print out the box
print '<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<font face="Arial" size=2>
<strong>Takk for at du la inn en melding i gjesteboken!:)</strong>
</font>
</td>
</tr>
<tr class="under">
<td valign="top">
<font face="Arial" size="1">
<strong>Navn:</strong> '.stripslashes(chchar($name)).'<br>
<strong>Mail:</strong> '.stripslashes(chchar($mail)).'<br>
<strong>Hjemmeside:</strong> '.stripslashes(chchar($homepage)).'<br>
<strong>Bedskjed:</strong> '.stripslashes(parseurls(smilies(chchar($message)))).'<br>
<br>
<a href="'.$_SERVER["PHP_SELF"].'?site='.$site.'&amp;style='.$style.'">Trykk her for &aring; g&aring; tilbake til Gjesteboken!</a>
</font>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>
</td>
<td width="15">&nbsp;&nbsp;</td>
<td valign="top" width="165">
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
</tbody>
</table>
</body>
</html>
';
return 0; //die
} else { 
//if $dguestbook not is like 1 then
if ($dguestbook != "1") {
//print out the add a message box
print '<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font face="Arial" size="2"><strong>Legg til en melding</strong></font></td>
</tr>
<tr class="under">
<td valign="top">
<form name="Gjestebok" action="index.php?site='.$site.'&amp;style='.$style.'" method="post">
<font size="2">';
//if $name and $message not is empty and md5($number) not is like $_SESSION['image_random_value'] then
if (!empty($name) && !empty($message) && md5($number) != $_SESSION['image_random_value']){
//print out "UGYLDIG VERIFIKASJONS KODE!"
print '<font size="2">UGYLDIG VERIFIKASJONS KODE!</font><br>';
//Reset the session "image_random_value" value
$_SESSION['image_random_value'] = '';
};
//print out the add a message form
print '<strong>Verifikasjons kode:</strong><br>
<img src="./includes/image.php" border="0" alt=""><br>
<strong>Skriv inn nummerene over her:</strong><br>
<input type="text" name="number" size="30"><br>
<strong>Navn:</strong><br>
<input type="text" name="name" size="30"><br>
<strong>Mail:</strong><br>
<input type="text" name="mail" size="30"><br>
<strong>Hjemmeside:</strong><br>
<input type="text" value="http://" name="homepage" size="30"><br>
<strong>Melding:</strong><br>
<textarea name="message" rows="6" cols="43"></textarea><br>
<br>
<input type="Submit" value="Legg til"> || <input type="reset" value="Nullstill">
</font>
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
};
//Query the MySQL database and get everything from the "guestbook" table order by id descending, die if a error occure
$result=mysql_query("SELECT * FROM guestbook ORDER BY id DESC") or mysqldie("Kan ikke lese fra $database.guestbook");
//while $result not is empty then
while ($row = mysql_fetch_array($result))
{
//get some information from the table and fix the output
$name = stripslashes(chchar($row["name"]));
$ip = $row["ip"];
$date = $row["date"];
$time = $row["time"];
$mail = $row["mail"];
$homepage = stripslashes(chchar($row["homepage"]));
$message = stripslashes(parseurls(smilies(chchar($row["message"]))));
//print out the box
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>Fra:</strong> <a href="mailto:'.$mail.'" class="over2">'.$name.'</a> <strong>Dato:</strong> '.$date.' <strong>Kl:</strong> '.$time.'</font>
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
};
?>
