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
$from = (string) $_POST["from"]; //get the from address
$message = (string) $_POST["message"]; //get the message
$subject = (string) $_POST["subject"]; //get the subject
//if $from and $messages and $subject not is empty then
if(empty($from) && empty($message) && empty($subject)){
//print out the "Send a mail box"
print '<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<font face="Arial" size="2">
<strong>Mail::Admin</strong><br>
<font size="1"><strong>Skriv meldingen du vil sende under!:)</strong></font>
</font>
</td>
</tr>
<tr class="under">
<td valign="top">
<form action="'.$_SERVER["PHP_SELF"].'?site='.$site.'&amp;style='.$style.'" method="post">
<strong>Din e-mail adresse:</strong><br>
<input type="text" name="from" size="50"><br>
<strong>Emne:</strong><br>
<input type="text" name="subject" size="50"><br>
<strong>Melding:</strong><br>
<textarea name="message" rows="6" cols="43"></textarea><br>
<br>
<input type="submit" value="Send"> || <input type="reset" value="Nullstill">
</form>
</td>
</tr>
</tbody>
</table>
<td>
</tr>
</tbody>
</table>
<br>';
}else{ //else send the mail
mail ($to, $subject, $message,"From: $from");
//print out the "message is sendt box
print '<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2">
<font face="Arial" size=2>
<strong>Meldingen er n&aring; sendt!:)</strong>
</font>
</td>
</tr>
<tr class="under">
<td valign="top">
<font face="Arial" size="1">
<strong>Til:</strong> Admin<br>
<strong>Din e-mail adresse:</strong> '.chchar($from).'<br>
<strong>Emne:</strong> '.chchar($subject).'<br>
<strong>Melding:</strong> '.chchar($message).'
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
