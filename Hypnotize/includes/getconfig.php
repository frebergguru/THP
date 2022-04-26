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
//query the MySQL database
$result=mysql_query("SELECT * FROM config") or mysqldie("Kan ikke lese fra $database.config");
//get the result
$row = mysql_fetch_array($result);
//get the page title
$title = stripslashes($row["title"]);
//get the page name
$pagename = stripslashes($row["pagename"]);
//get the admin e-mail address
$to = $row["to"];
//get the maintenance status (0 or 1)
$maintenance = $row["maintenance"];
//get the maintenance ip address
$maintenanceip = $row["maintenanceip"];
//get the "Disable Guestbook" status (0 or 1)
$dguestbook = $row["dguestbook"];
//get the "Disable Links" status (0 or 1)
$dlinks = $row["dlinks"];
//get the site url
$siteurl = $row["siteurl"];
//get the backend description
$backend_description = stripslashes($row["backend_description"]);
//get the backend language
$backend_language = stripslashes($row["backend_language"]);
//get the images path
$images = $row["images"];
?>
