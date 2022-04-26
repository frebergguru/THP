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
//get some information and fix the output
$action = $_GET["action"];
$module = $_GET["module"];
$id = $_GET["id"];
$edited == $_GET["edited"];
$editheadline = mysql_escape_string($_POST["headline"]);
$edituheadline = mysql_escape_string($_POST["uheadline"]);
$editlink = mysql_escape_string($_POST["link"]);
$edittext = mysql_escape_string($_POST["text"]);
//if $action is "RAdded" then
if ($action=="RAdded") {
	//add the text to the selected page
	$query_string = "INSERT INTO `boxes` ( `id` , `site` , `catid` , `position` , `headline` , `uheadline` , `link` , `text` ) VALUES ('', '$id2', '$id2', 'r', '$editheadline', '$edituheadline', '$editlink', '$edittext')";
	mysql_query("$query_string") or mysqldie("Kan ikke skrive til $database.boxes");
//else if $action is like "RAddedI" then
} elseif ($action=="RAddedI") {
	//if $editheadline is empty then
	if(empty($editheadline)) {
		//print out a error box with the text "Du m&aring; skrive inn et navn til bilde!"
		error('Du m&aring; skrive inn et navn til bilde!');
	//else check if the image type is valid
	} elseif (($_FILES["image"]["type"] == "image/gif") or ($_FILES["image"]["type"] == "image/jpeg") or ($_FILES["image"]["type"] == "image/png"))
    {	//if a error has occured then
        if ($_FILES["image"]["error"] > 0)
        {	//print out a error message
            error('Det skjedde en feil: '.$_FILES["image"]["error"]);
        } else {//else set $imagefile to $_SERVER["DOCUMENT_ROOT"]/$images/$_FILES["image"]["name"]
		//if the image do exist then
            if (file_exists($images/$_FILES["image"]["name"]))
            {	//print out a error box with the text "... finnes allerede."
                error($_FILES["image"]["name"].' finnes allerede.');
            } else {//else move the uploaded image to the correct folder on the server
            $moveto = $_SERVER["DOCUMENT_ROOT"].$images.'/'.$_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"],$moveto);
		//and print out a info box with the text "Bilde ble lagret i ...."
            info('Bilde ble lagret i: '.$images.'/'. $_FILES["image"]["name"]);
		//set $editimage to $_FILES["image"]["name"]
            $editimage = $_FILES["image"]["name"];
		//insert the path to the image to the database
            $query_string = "INSERT INTO `boxes` ( `id` , `site` , `catid` , `position` , `headline` , `image` ) VALUES ('', '$id2', '$id2', 'r', '$editheadline', '$editimage')";
            mysql_query("$query_string") or mysqldie("Kan ikke skrive til $database.boxes");
            }
        }
    } else {//else print out a error box with the text "Ugyldig bilde format: ..."
        error('Ugyldig bilde format: '.$_FILES["image"]["type"]);
    }//else if $action == "RAddI" then 
} elseif ($action=="RAddI") {
//print out the "Add a image" box
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>Legg til en tekst</strong></font>
</td>
</tr>
<tr>
<td class="under" valign="top">
<form name="RBox" action="index.php?site='.$site.'&amp;id2='.$id2.'&amp;action=RAddedI" method="post" enctype="multipart/form-data">
<strong>Navn:</strong><br>
<input type="text" name="headline" value="" size="30"><br>
<strong>Velg bilde:</strong><br>
<input type="file" name="image"><br>
<br>
<input type="Submit" value="Legg til"> || <input type="reset" value="Nullstill">
</form>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>';//else if $action is "RAdd" then
} elseif ($action=="RAdd") {//print out the "Add a text" box
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>Legg til en tekst</strong></font>
</td>
</tr>
<tr>
<td class="under" valign="top">
<form name="RBox" action="index.php?site='.$site.'&amp;id2='.$id2.'&amp;action=RAdded" method="post">
<strong>Overskrift:</strong><br>
<input type="text" name="headline" value="" size="30"><br>
<strong>Under overskrift:</strong><br>
<input type="text" name="uheadline" value="" size="30"><br>
<strong>Link:</strong><br>
<input type="text" name="link" value="" size="30"><br>
<strong>Tekst:</strong><br>
<textarea name="text" rows="6" cols="43"></textarea><br>
<br>
<input type="Submit" value="Legg til"> || <input type="reset" value="Nullstill">
</form>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>';//else if $action is "REditedI" then
} elseif ($action=="REditedI") {
	//update the database with new image information
	$query_string = "UPDATE boxes SET headline='$editheadline' WHERE ID like '$id'";
	mysql_query("$query_string") or mysqldie("Kan ikke skrive til $database.boxes");
//else if $ation is "REdited" then
} elseif ($action=="REdited") {
	//update the database with new text information
	$query_string = "UPDATE boxes SET headline='$editheadline', uheadline='$edituheadline', link='$editlink', text='$edittext' WHERE ID like '$id'";
	mysql_query("$query_string") or mysqldie("Kan ikke skrive til $database.boxes");
//else if $action is "CEditI" then
} elseif ($action=="REditI") {
	//Query the MySQL database and get everything from the "boxes" table where id is $id, die if a error occure
	$result=mysql_query("SELECT * FROM boxes WHERE id='$id'") or mysqldie("Kan ikke lese fra $database.boxes");
	$row = mysql_fetch_array($result);//get the result
	//get some information from the table and fix the output
	$id = $row["id"];
	$headline = stripslashes($row["headline"]);
	$image = $row["image"];
//print out the "Edit a image" box
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>Rediger en melding</strong></font></td>
</tr>
<tr>
<td class="under" valign="top">
<form name="RAdder" action="index.php?site='.$site.'&amp;id2='.$id2.'&amp;action=REditedI&amp;id='.$id.'" method="post">
<strong>Navn:</strong><br>
<input type="text" name="headline" value="'.$headline.'" size="30"><br>
<br>
<img src="./includes/thumb.php?filename='.$image.'" alt="'.$headline.'" border="0"><br>
<br>
<input type="Submit" value="Rediger"> || <input type="reset" value="Nullstill">
</form>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>';//else if $action is "REdit" then
} elseif ($action=="REdit") {
	//Query the MySQL database and get everything from the "boxes" table where id is $id, die if a error occure
	$result=mysql_query("SELECT * FROM boxes WHERE id='$id' ORDER BY id ASC") or mysqldie("Kan ikke lese fra $database.boxes");
	$row = mysql_fetch_array($result);//get the result
	//get some information from the table and fix the output
	$id = $row["id"];
	$headline = stripslashes($row["headline"]);
	$uheadline = stripslashes($row["uheadline"]);
	$link = $row["link"];
	$text = stripslashes($row["text"]);
//print out the "Edit a text" box
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>Rediger en melding</strong></font></td>
</tr>
<tr>
<td class="under" valign="top">
<form name="CAdder" action="index.php?site='.$site.'&amp;id2='.$id2.'&amp;action=REdited&amp;id='.$id.'" method="post">
<strong>Overskrift:</strong><br>
<input type="text" name="headline" value="'.$headline.'" size="30"><br>
<strong>Under overskrift:</strong><br>
<input type="text" name="uheadline" value="'.$uheadline.'" size="30"><br>
<strong>Link:</strong><br>
<input type="text" name="link" value="'.$link.'" size="30"><br>
<strong>Tekst:</strong><br>
<textarea name="text" rows="6" cols="43">'.$text.'</textarea><br>
<br>
<input type="Submit" value="Rediger"> || <input type="reset" value="Nullstill">
</form>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>';//else if $action is "RDeleteI" then
} elseif ($action=="RDeleteI"){
	//Delete the image path from the database
	$result=mysql_query("SELECT * FROM boxes WHERE id='$id'") or mysqldie("Kan ikke lese fra $database.boxes");
	$row = mysql_fetch_array($result);
	$image = $row["image"];
	//set $dimage to $_SERVER["DOCUMENT_ROOT"]/$images/$image
	$dimage = $_SERVER["DOCUMENT_ROOT"].$images.'/'.$image;
	unlink($dimage);//delete the image from the server
	//delete the image from the page
	$query_string = 'DELETE FROM `boxes` WHERE `id`= '.$id.' LIMIT 1';
	mysql_query("$query_string") or mysqldie("Kan ikke slette fra $database.boxes");
//else if $action is "RDelete" then
} elseif ($action=="RDelete"){
	//Delete the text from the page
	$query_string = 'DELETE FROM `boxes` WHERE `id` = '."$id".' LIMIT 1';
	mysql_query("$query_string") or mysqldie("Kan ikke slette fra $database.boxes");
};
//else if $action not is "RAdd" or "RAddI" then
if ($action !="RAdd" && $action !="RAddI"){
//print out the "Add a text or image" box
print '<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<div align="center">
<strong><a href="?site='.$site.'&amp;id2='.$id2.'&amp;action=RAdd">Legg til en tekst</a></strong>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table><br>
<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<div align="center">
<strong><a href="?site='.$site.'&amp;id2='.$id2.'&amp;action=RAddI">Legg til et bilde</a></strong>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table><br>';
};//Query the database table boxes where catid is $id2 and position is r order by id ascending
$result=mysql_query("SELECT * FROM boxes WHERE catid='$id2' AND position='r' ORDER BY id asc") or mysqldie("Kan ikke lese fra $database.boxes");
//while $result not is empty then
while ($row = mysql_fetch_array($result))
{	//get some information and fix the output
	$id = $row["id"];
	$headline = stripslashes(chchar($row["headline"]));
	$uheadline = stripslashes(smilies(chchar($row["uheadline"])));
	$image = $row["image"];
	$link = $row["link"];
	$text = parseurls(stripslashes(smilies(chchar($row["text"]))));
//print out the boxes
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="under"><strong><a href="?site='.$site.'&amp;id2='.$id2.'&amp;action=';if (!empty($image)) {print 'REditI';}else{print 'REdit';};print '&amp;id='.$id.'">Rediger</a> || <a href="?site='.$site.'&amp;id2='.$id2.'&amp;action=';if(!empty($image)){print 'RDeleteI';}else{print 'RDelete';};print '&amp;id='.$id.'">Slett</a></strong></td>
</tr>
<tr>
<td class="over2">
<font size="2" face="Arial">
<strong>'.smilies($headline).'</strong><br>'.$uheadline.'</font>
</td>
</tr>
<tr>
<td class="under" valign="top">
<font size="2">';
if (!empty($image)) {print '<img src="./includes/thumb.php?filename='.$image.'" alt="'.$headline.'" border="0">';};
if (!empty($text)) {print $text;};
print '</font>
</td>
</tr>
<tr>
<td align="left" class="under2">
<font size="1">
<a href="'.$link.'" class="under2" target="_blank"><strong>'.chchar($link).'</strong></a>
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
?>
