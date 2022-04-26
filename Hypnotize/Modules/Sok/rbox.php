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
$search = $_POST['search']; //find out what the user is searching after
//if $search not is empty then
if (!empty($search)) {
//query the table boxes where ?? is like $search
$result=mysql_query("SELECT * FROM boxes WHERE headline LIKE '%".mysql_real_escape_string($search)."%' OR uheadline LIKE '%".mysql_real_escape_string($search)."%' OR link LIKE '%".mysql_real_escape_string($search)."%' OR text LIKE '%".mysql_real_escape_string($search)."%' OR uheadline LIKE '%".mysql_real_escape_string($search)."%' ORDER BY id") or mysqldie("Cant read data from $database.boxes");
//while $result not is empty then
while ($row = mysql_fetch_array($result))
{
//get some information from the table and fix the output
$site2 = $row["site"];
$headline = stripslashes(chchar($row["headline"]));
$uheadline = stripslashes(chchar($row["uheadline"]));
$text = stripslashes(parseurls(smilies(chchar($row["text"]))));
$link = $row["link"];
$position = $row["position"];
//while $site2 not is like "Sok" and $position is like r then
if ($site2 != "Sok" && $position == "r") {
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
<strong>Side: '.$site2.'<br>
Overskrift: '.$headline.'</strong>
</font><br>
<font size="1" face="Arial">
'.$uheadline.'
</font>
</strong>
</td>
</tr>
<tr>
<td class="under" valign="top">
<font size="2">
'.$text.'
</font>
</td>
</tr>
<tr>
<td align="left" class="under2"><font size="1"><a href="'.$link.'" class="under2">'.chchar($link).'</a></font></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>';
}
};
};
?>
