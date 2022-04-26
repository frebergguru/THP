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
//Start a session
session_start();
//randomize a number
$rand = rand(1000000, 9999999);
//save the number in a session and encrypt it with md5
$_SESSION['image_random_value'] = md5($rand);
//create a image
$image = imagecreate(80, 30);
//make it transparang
$trans_color = imagecolorallocate($image, 255, 0, 0);
//set witch color to be transparang
imagecolortransparent($image, $trans_color);
//set the text color (red)
$textColor = imagecolorallocate ($image, 255, 0, 0);
//print out the numbers on the image
imagestring ($image, 5, 5, 8,  $rand, $textColor);
//send out some expire headers etc
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//print out the image header (image/png)
header('Content-type: image/png');
//make the image
imagepng($image);
//destroy the image 
imagedestroy($image); 
?>
