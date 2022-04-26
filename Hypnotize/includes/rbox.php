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
//Query the MySQL database and get everything from the "Admin" table, die if a error occure
$result = mysql_query("SELECT * FROM Admin") or mysqldie("Kan ikke lese fra $database.Admin");
//while $results not is empty then
while($row = mysql_fetch_array($result)) {
//add the query result to a array
$array_modules[$row["module"]] = $row["enable"];
};
//query the MySQL database and get everything from the "boxes" table and order by sort_id asscending, die if a error occure
$result=mysql_query("SELECT * FROM boxes ORDER BY sort_id asc") or mysqldie("Kan ikke lese fra $database.boxes");
//while $result not is empty then
while ($row = mysql_fetch_array($result))
{
//get some information from the table and fix the output
$headline = stripslashes(chchar($row["headline"]));
$uheadline = stripslashes(smilies(chchar($row["uheadline"])));
$text = parseurls(stripslashes(smilies(chchar($row["text"]))));
$link = $row["link"];
$image = $row["image"];
$module = $row["module"];
$dbsite = $row["site"];
$position = $row["position"];
$allsites = $row["allsites"];
//if $module not is empty and $array_modules is like 1 and $allsites is like 0 and $dbsite is like $site then
if (!empty($module) && $array_modules[$module] == "1" && $allsites == "0" && $dbsite == $site) {
//set $filename to "Modules/$module/right.php"
$filename = 'Modules/'.$module.'/right.php';
//if the file $filename exists then
if (file_exists($filename)) {
//include the file
include $filename;
};
//elseif $module is empty and $array_modules is like 1 and $allsites is like 1 then
}elseif(!empty($module) && $array_modules[$module] == "1" && $allsites == "1"){
//set the file $filename to "Modules/$module/right.php"
$filename = 'Modules/'.$module.'/right.php';
//if the file $filename exists then
if (file_exists($filename)) {
//include the file
include $filename;
};
//else if $headline not is empty and $image not is empty and $allsites is like 0 and $dbsite is like $site and $position is like r then
}elseif (!empty($headline) && empty($image) && $allsites == "0" && $dbsite == $site && $position == "r") {
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
<strong>'.smilies($headline).'</strong>
</font>';if(!empty($uheadline)){print'<br>
<font size="1" face="Arial">
<strong>'.$uheadline.'</strong>
</font>';};
print'</td>
</tr>
<tr>
<td class="under" valign="top">
<font size="2">
'.$text.'
</font>
</td>
</tr>';
if(!empty($link)){print'<tr>
<td align="left" class="under2">
<font size="1">
<a href="'.$link.'" class="under2"><strong>'.$link.'</strong></a>
</font>
</td>
</tr>';};
print'</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>';
//else if $headline not is empty and $image not is empty and $allsites is like 0 and $dbsite is like $site and $position is like r then
} elseif (!empty($headline) && !empty($image) && $allsites == "0" && $dbsite == $site && $position == "r") {
//print out the box
print '<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<font face="Arial" size="2">
<strong>'.smilies($headline).'</strong>
</font>
</td>
</tr>
<tr class="under">
<td valign="top">
<div align="center">
<a href="includes/watermark.php?image='.$image.'" target="_blank"><img src="includes/thumb.php?filename='.$image.'" border="0" alt="'.$headline.'"></a>
</div>
</td>
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
?>
