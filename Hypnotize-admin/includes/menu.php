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
//Query the MySQL database and get everything from the "menu" table, die if a error occure
$result=mysql_query("SELECT * FROM menu") or mysqldie("Kan ikke lese fra $database.menu");
//while $results not is empty then
while ($row = mysql_fetch_array($result))
{
//get some information from the table and fix the output
$menuid = $row["id"];
$sitename = chchar($row["sitename"]);
//print out the menu "items"
print '<strong>[</strong> <a href="?site=edit&amp;id2='."$menuid".'" class="menu">'."$sitename".'</a> <strong>]</strong> ';
};
//Query the MySQL database and get everything from the "Admin" table, die if a error occure
$result=mysql_query("SELECT * FROM Admin") or mysqldie("Kan ikke lese fra $database.Admin");
//while $results not is empty then
while($row = mysql_fetch_array($result)) {
//make a array
$array_modules[$row["module"]] = $row["enable"];
};

//Query the MySQL database and get everything from the "Admin" table, die if a error occure
$result=mysql_query("SELECT * FROM Admin") or mysqldie("Kan ikke lese fra $database.Admin");
//while $results not is empty then
while ($row = mysql_fetch_array($result))
{
//get some information from the table
$module_site = $row["module_site"];
//if $module_site not is empty and $array_modules[$module_site] is like 1 then
if (!empty($module_site) && $array_modules[$module_site] == "1") {
//print out the menu item
print '<strong>[</strong> <a href="?site='."$module_site".'" class="menu">'."$module_site".'</a> <strong>]</strong> ';
};
};
?>
