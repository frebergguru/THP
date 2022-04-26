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
//Query the MySQL database and get everything from the "guestbook" table order by id limit 1, die if a error occure
$result=mysql_query("SELECT * FROM guestbook ORDER BY id DESC limit 1") or mysqldie("Kan ikke lese fra $database.guestbook");
//while $result not is empty then
while ($row = mysql_fetch_array($result))
{
//get some information from the table and fix the output
$name = stripslashes(chchar($row["name"]));
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
<td class="over2">
<font size="2" face="Arial">
<strong>Siste fra Gjesteboka</strong>
</font>
<br>
<font size="1" face="Arial">
<strong>Fra:</strong> <a href="mailto:'.$mail.'">'.$name.'</a> <strong>Dato:</strong> '.$date.' <strong>Kl:</strong> '.$time.'
</font></td>
</tr>
<tr>
<td class="under" valign="top">
<font size="2">
'.$message.'
</font>
</td>
</tr>
<tr>
<td align="left" class="under2">
<font size="1">
<a href="'.$homepage.'" class="under2" target="_blank"><strong>Hjemmeside</strong></a>
</font>
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
?>
