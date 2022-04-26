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
include '../includes/config.php';
include '../includes/functions.php';
$link = mysql_connect("$hostname", "$username", "$password") or mysqldie("Cant connect to $hostname");
include '../includes/getconfig.php';
header("Content-Type: application/rss+xml");
print '<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE rss PUBLIC "-//Netscape Communications//DTD RSS 0.91//EN" "http://my.netscape.com/publish/formats/rss-0.91.dtd">

<rss version="0.91">

<channel>
<title>'.htmlspecialchars($pagename).'</title>
<link>'.htmlspecialchars($siteurl).'</link>
<description>'.htmlspecialchars($backend_description).' - DVD</description>
<language>'.htmlspecialchars($backend_language).'</language>';
$result=mysql_query("SELECT * FROM dvd ORDER BY ID DESC LIMIT 15") or mysqldie ("Cant read data from $database.dvd");
while ($row = mysql_fetch_array($result))
{
$title = $row["title"];
$year = $row["year"];
print '
<item>
<title>Tittel: '.htmlspecialchars($title).'</title>
<description>
Tittel: '.htmlspecialchars($title).'
</description>
<link>'.htmlspecialchars($siteurl).'/?site=DVD&amp;sub=view&amp;id='.htmlspecialchars($id).'</link>
</item>';
};
mysql_close($link);
print '</channel>
</rss>';
?>
