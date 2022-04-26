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
//START SRVERROR FUNCTION
function srverror($err,$msg) {
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>ERROR: '.$err.'</strong></font>
</td>
</tr>
<tr>
<td class="under" valign="top">
'.$msg.'
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
//STOP SERVERROR FUNCTION

//START MSG FUNCTION
function msg($headline,$text) {
print '<table align="center" bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
<tr>
<td class="over2"><font size="2" face="Arial"><strong>'.$headline.'</strong></font>
</td>
</tr>
<tr>
<td class="under" valign="top">
'.$text.'
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
//STOP MSG FUNCTION

//START MYSQLDIE FUNCTION
function mysqldie($message) {
	//Get the MySQL error message
	$mysqlerror = mysql_error();
	//If the MySQL link is active then
	if (!empty($mlink)) {
		//close the connection
		mysql_close($mlink);
	}
	//die with a message and the MySQL error
	die($message.' - '.$mysqlerror);
};
//STOP MYSQLDIE FUNCTION

//START CHCHAR FUNCTION
function chchar($string) {
//Change some special chars with html chars from $string
	$string = str_replace("æ","&aelig;",$string);
	$string = str_replace("ø","&oslash;",$string);
	$string = str_replace("å","&aring;",$string);
	$string = str_replace("Æ","&AElig;",$string);
	$string = str_replace("Ø","&Oslash;",$string);
	$string = str_replace("Å","&Aring;",$string);
	$string = str_replace("\n","<br>",$string);
	return $string;
}
//STOP CHCHAR FUNCTION

//START SMILIES FUNCTION - adds smileys to the text
function smilies($text) {
	$imgdir = "./images/smilies/";
	//Put the smilies in a array
	$code = array(":)",":D",":O",":P",";)",":(",":|","(H)",":@");
	//if $text not is empty then
	if ($text) {
		//go trough the texts characthers one by one, if $code is like $b then
		foreach ($code as $b => $r) {
			//replace the character with a image
			$text = str_replace($r, "<img src=\"$imgdir$b.gif\" border=\"0\" alt=\"$b\">", $text);
		}
		return $text;
	}
}
//START PARSEURLS FUNCTION - A function that parse the input string (file) for urls and makes a valid html url of the url
function parseurls($string){
        $pattern_preg1 = '#(^|\s)(www|WWW)\.([^\s<>\.]+)\.([^\s\n<>]+)#sm';
        $replace_preg1 = '\\1<a href="http://\\2.\\3.\\4" target="_blank">\\2.\\3.\\4</a>';
        $pattern_preg2 = '#(^|[^\"=\]]{1})(http|HTTP|ftp)(s|S)?://([^\s<>\.]+)\.([^\s<>]+)#sm';
        $replace_preg2 = '\\1<a href="\\2\\3://\\4.\\5" target="_blank">\\2\\3://\\4.\\5</a>';
        $string = preg_replace($pattern_preg1, $replace_preg1, $string);
        $string = preg_replace($pattern_preg2, $replace_preg2, $string);
        return $string;
}
//STOP PARSEURLS FUNCTION
?>
