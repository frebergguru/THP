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

//START PRINT OUT LOCAL PAGES
//Query the MySQL database and get everything from the "menu" table and order by sort_id, die if a error occure
$result = mysql_query("SELECT * FROM menu ORDER BY sort_id") or mysqldie("Kan ikke lese fra $database.menu");
//while $results not is empty then
while ($row = mysql_fetch_array($result))
{
//get some information from the table and fix the output
$id = $row["id"];
$sitename = chchar($row["sitename"]);
$link2 = $row["link"];
$lbreak = $row["break"];
//if $link2 is empty and $lbreak is 0 then
if(empty($link2) && $lbreak =="0") {
//print out the menu "items"
print '<strong>[</strong> <a href="'.$_SERVER["PHP_SELF"].'?site='.$id.'&amp;style='.$style.'" class="menu">'.$sitename.'</a> <strong>]</strong> ';
//else if $link2 is empty and $lbreak is 1 then
}elseif(empty($link2) && $lbreak =="1"){
//print out the menu item and add a break at the end
print '<strong>[</strong> <a href="'.$_SERVER["PHP_SELF"].'?site='.$id.'&amp;style='.$style.'" class="menu">'.$sitename.'</a> <strong>]</strong><br>';
//else if $link2 not is empty and $lbreak is 0 then
}elseif(!empty($link2) && $lbreak =="0"){
//print out the menu "items"
print '<strong>[</strong> <a href="'.$link2.'" target="_blank" class="menu">'.$sitename.'</a> <strong>]</strong> ';
//else if $link2 not is empty and $lbreak is 1 then 
}elseif(!empty($link2) && $lbreak =="1"){
//print out the menu item and add a break on the end
print '<strong>[</strong> <a href="'.$link2.'" target="_blank" class="menu">'.$sitename.'</a> <strong>]</strong><br>';
};
};
//STOP PRINT OUT LOCAL PAGES

//START PRINT OUT THE MODULES
//Query the MySQL database and get everything from the "Admin" table, die if a error occure
$result=mysql_query("SELECT * FROM Admin") or mysqldie("Kan ikke lese fra $database.Admin");
//while $results not is empty then
while($row = mysql_fetch_array($result)) {
//get some information from the table
$module = $row["module"];
$admin_menu_name = $row["module_menu_name"];
//if $row[enable] is like 1 && $row[standalone] not is like 1 then print out the menu item
if ($row["enable"]=="1" && $row["standalone"]!="1") {print '<strong>[</strong> <a href="'.$_SERVER["PHP_SELF"].'?site='.$module.'&amp;style='.$style.'" class="menu">'.$admin_menu_name.'</a> <strong>]</strong> ';};
};
//STOP PRINT OUT THE MODULES
?>
