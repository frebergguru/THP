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
$search = (string) $_POST['search']; //find out what the users is searching after
//if $search not is empty then
if (!empty($search)) {
//query the table links where ?? is like $search
$result=mysql_query("SELECT * FROM links WHERE description LIKE '%".mysql_real_escape_string($search)."%' OR name LIKE '%".mysql_real_escape_string($search)."%' OR ip LIKE '%".mysql_real_escape_string($search)."%'OR link LIKE '%".mysql_real_escape_string($search)."%' ORDER BY id") or mysqldie ("Cant read data from $database.links");
$tr=mysql_num_rows($result);
print '<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<font face="Arial" size=2>
<strong>S&oslash;ke resultat</strong>
</font>
</td>
</tr>
<tr class="under">
<td valign="top">
Søke etter "'.stripslashes(chchar($search)).'" ga '."$tr".' resultater
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>';
//while $result not is empty then
while ($row = mysql_fetch_array($result))
{
//get some information from the table and fix the output
$name = stripslashes(chchar($row["name"]));
$ip = $row["ip"];
$date = $row["date"];
$description = stripslashes(parseurls(smilies(chchar($row["description"]))));
$link = $row["link"];
//print out the box
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<font size="1" face="Arial">
<strong>Fra:</strong> '.$name.' <strong>IP:</strong> '.$ip.' <strong>Dato:</strong> '.$date.'
</font></td>
</tr>
<tr>
<td class="under" valign="top">
<font size="2">
'.$description.'
</font>
</td>
</tr>
<tr>
<td align="left" class="under2">
<font size="1">
<a href="'.$link.'" class="under2"><strong>'.chchar($link).'</strong></a>
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
};
?>
