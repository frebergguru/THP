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
$search=$_POST['search']; //find out what the user search after
//query the table dvd where ?? is like $search
$result=mysql_query("SELECT * FROM dvd WHERE actors LIKE '%".mysql_real_escape_string($search)."%' OR title LIKE '%".mysql_real_escape_string($search)."%' ORDER BY title ASC") or mysqldie ("Cant read data from $database.links"); 
$tr=mysql_num_rows($result); //find out how many results it is
//print out the box
print '<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<font face="Arial" size=2>
<strong>::S&oslash;ke resultat::</strong>
</font>
</td>
</tr>
<tr class="under">
<td valign="top">
Søke etter "'.chchar($search).'" ga '.$tr.' resultater!
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>';
//quert the database where ?? is like $search
$result=mysql_query("SELECT * FROM dvd WHERE actors LIKE '%".mysql_real_escape_string($search)."%' OR title LIKE '%".mysql_real_escape_string($search)."%' ORDER BY title ASC") or mysqldie("Kan ikke lese fra $database.dvd");
//while $result not is empty then
while ($row = mysql_fetch_array($result))
{
//get some information from the table and fix the output
$producers = stripslashes(chchar($row["producers"]));
$directors = stripslashes(chchar($row["directors"]));
$manufacturer = stripslashes(chchar($row["manufacturer"]));
$rating = $row["rating"];
$region = $row["region"];
$format = stripslashes($row["format"]);
$genre = stripslashes(chchar($row["genre"]));
$length = $row["length"];
$title = stripslashes(chchar($row["title"]));
$actors = stripslashes(chchar($row["actors"]));
$year = $row["year"];
$subtitles = stripslashes(chchar($row["subtitles"]));
$screen = stripslashes(chchar($row["screen"]));
$languages = stripslashes(chchar($row["languages"]));
$comment = stripslashes(parseurls(smilies(chchar($row["comment"]))));
//check if some of the strings is empty and change the output of the string to N/A if it is empty
if (empty($producers)){$producers="N/A";};
if (empty($directors)){$directors="N/A";};
if (empty($manufacturer)){$manufacturer="N/A";};
if (empty($rating)){$rating="N/A";};
if (empty($region)){$region="N/A";};
if (empty($format)){$format="N/A";};
if (empty($genre)){$genre="N/A";};
if (empty($length)){$length="N/A";};
if (empty($title)){$title="N/A";};
if (empty($actors)){$actors="N/A";};
if (empty($year)){$year="N/A";};
if (empty($subtitles)){$subtitles="N/A";};
if (empty($screen)){$screen="N/A";};
if (empty($languages)){$languages="N/A";};
if (empty($comment)){$comment="N/A";};
if (empty($region)){$region="N/A";}elseif($region=="0"){$region="0 - Region fri";}elseif($region=="1"){$region="1 - USA, Canada, Puerto Rico";}elseif($region=="2"){$region="2 - Europa, Midt &Oslash;sten, Japan";}elseif($region=="3"){$region="3- S&oslash;r&oslash;st Asia, Hong Kong, Taiwan";}elseif($region=="4"){$region="4 - Mellom - Amerika, Mexico, S&oslash;r Amerika, Australia, New Zealand";}elseif($region=="5"){$region="5 - Den russiske f&oslash;derasjonen, Afrika (unntatt Egypt og S&oslash;r Afrika) India, Pakistan";}elseif($region=="6"){$region="6 - Kina";}elseif($region=="7"){$region="7 - Reservert for senere bruk!";}elseif($region=="8"){$region="8 - Internasjonale territorier (Skip, Fly etc)";}elseif($region=="9"){$region="9 - Ekpansjon (ofte brukt som region fri)";};
//print out the box with the result
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>'.$title.'</strong></font></td>
</tr>
<tr>
<td class="under" valign="top">
<font size="2">
<strong>Regis&oslash;r(er):</strong> '.$producers.'<br>
<br>
<strong>Leder(e):</strong> '.$directors.'<br>
<br>
<strong>Utgiver:</strong> '.$manufacturer.'<br>
<br>
<strong>Alder / Kode:</strong> '.$rating.'<br>
<br>
<strong>Region:</strong> '.$region.'<br>
<br>
<strong>Format:</strong> '.$format.'<br>
<br>
<strong>Sjanger:</strong> '.$genre.'<br>
<br>
<strong>Lengde:</strong> '.$length.'<br>
<br>
<strong>Skuespillere:</strong> '.$actors.'<br>
<br>
<strong>&Aring;r:</strong> '.$year.'<br>
<br>
<strong>Undertekster:</strong> '.$subtitles.'<br>
<br>
<strong>Skjerm:</strong> '.$screen.'<br>
<br>
<strong>Språk:</strong> '.$languages.'<br>
<br>
<strong>Kommentar:</strong> '.$comment.'
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
