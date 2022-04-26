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
$result=mysql_query("SELECT * FROM Admin") or mysqldie("Kan ikke lese fra $database.Admin");
//while $results not is empty then
while($row = mysql_fetch_array($result)) {
//add the query result to a array
$array_modules[$row["module"]] = $row["enable"];
};

//START FUNCTION SUPTIME
function suptime() {
$dirty = file("/proc/uptime");          // grab the line
$ticks = trim(strtok($dirty[0], " "));  // sanitize it (pull out the ticks)
$mins  = $ticks / 60;                   // total mins
$hours = $mins  / 60;                   // total hours
$days  = floor($hours / 24);            // total days
$hours = floor($hours - ($days * 24));  // hours left
$mins  = floor($mins  - ($days * 60 * 24) - ($hours * 60)); // mins left
$uptime .= "$days dager, ";              // construct the string
$uptime .= "$hours timer, ";
$uptime .= "$mins minutter";
return $uptime;                         // return the string
};
//STOP FUNCTION SUPTIME
?>
<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<div align="center">
<font face="Arial" size="2">
<strong>Innformasjon</strong>
</font>
</div>
</td>
</tr>
<tr class="under">
<td valign="top">
<font face="Arial" size="1">
<strong>Oppetid:</strong><br>
<? print suptime(); ?><br>
<?
//if $array_modules["DVD"] is like 1 (enabled) then
if ($array_modules["DVD"] == "1") {
print '<br>
<strong>Antall DVD\'er:</strong><br>';
//Query the MySQL database and get everything from the "dvd" table, die if a error occure
$result=mysql_query("SELECT * FROM dvd") or mysqldie ("Kan ikke lese fra $database.dvd");
//print out how many results we got
print mysql_num_rows($result);
print '<br>';
};
//if $array_modules["Linker"] is like 1 (enabled) then
if ($array_modules["Linker"] == "1") {
print '<br>
<strong>Antall Linker:</strong><br>';
//Query the MySQL database and get everything from the "links" table, die if a error occure
$result=mysql_query("SELECT * FROM links") or mysqldie ("Kan ikke lese fra $database.links");
//print out how many results we got
print mysql_num_rows($result);
print '<br>';};
if ($array_modules["Gjestebok"] == "1") {
print '<br>
<strong>Antall meldinger i Gjesteboken:</strong><br>';
//Query the MySQL database and get everything from the "guestbook" table, die if a error occure
$result=mysql_query("SELECT * FROM guestbook") or mysqldie ("Kan ikke lese fra $database.guestbook");
//print out how many results we got
print mysql_num_rows($result);
print '<br>';};
?>
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
