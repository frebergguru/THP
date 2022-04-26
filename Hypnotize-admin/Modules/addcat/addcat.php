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
$cat = (string) $_POST["cat"];
//if $cat not is empty then
if (!empty($cat)) {
	//Query the MySQL database and get everything from the "Admin" table, die if a error occure
	$result=mysql_query("SELECT * FROM Admin") or mysqldie("Kan ikke lese fra $database.Admin");
	//while $results not is empty then
	while ($row = mysql_fetch_array($result))
	{
		//get some information from the table
		$module = $row["module"];
		$module_menu_name = $row["module_menu_name"];
		//if $cat is like $module or $cat is like $module_menu_name then
		if ($cat == $module or $cat == $module_menu_name) {
			//print out a error message ("Det finnes allerede en side/modul med navnet $cat")
			error('Det finnes allerede en side/modul med navnet "'.chchar($cat).'"');
			//set $status to 1
			$status="1";
		};
	};
//Query the MySQL database and get everything from the "menu" table, die if a error occure
$result=mysql_query("SELECT * FROM menu") or mysqldie("Kan ikke lese fra $database.menu");
//while $result not is empty then
while ($row = mysql_fetch_array($result))
{
	//get some information
	$sitename = $row["sitename"];
	//if $cat is like $sitename then
	if ($cat == $sitename) {
		//print out a error message ("Det finnes allerede en side/modul med navnet $cat")
		error('Det finnes allerede en side/modul med navnet "'.chchar($cat).'"');
		//set $status to 1
		$status="1";
	};
};
//if $status not is like 1 then
if ($status != "1") {
	//insert the new site name to the table menu, die if a error occure
	mysql_query("INSERT INTO `menu` (`id` , `sitename`) VALUES ('', '$cat')") or mysqldie("Kan ikke skrive til $database.menu");
	//print out a info box with the text ("Siden $cat er naa lagt til!")
	info('Siden "'.chchar($cat).'" er n&aring; lagt til!');
};
};
//print out the add a page form
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>Legg til en side</strong></font>
</td>
</tr>
<tr>
<td class="under" valign="top">
<form name="Category" action="index.php?site='.$site.'" method="post">
<strong>Side navn:</strong><br>
<input type="text" name="cat" size="30"><br>
<br>
<input type="submit" value="Legg til"> || <input type="reset" value="Nullstill">
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
