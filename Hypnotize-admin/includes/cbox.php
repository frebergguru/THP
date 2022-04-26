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
$result=mysql_query("SELECT * FROM Admin") or mysqldie("Cant read data from $database.Admin");
//while $results not is empty then
while ($row = mysql_fetch_array($result))
{
	//get the information
	$module_site = $row["module_site"];
	$dbsite = $row["site"];
	//if $module_site not is empty and $dbsite is like $site then
	if (!empty($module_site) && $dbsite == $site) {
		//$filename is like "Modules/$module_site/center.php"
		$filename = 'Modules/'.$module_site.'/center.php';
		//if the file $filename does exist then
		if (file_exists($filename)) {
			//include $filename
			include $filename;
		};
	};
};
?>
