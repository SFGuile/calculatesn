<?php
session_start();
$im=imagecreate(30,20);
$font= 'ukai.ttf';
$bg=imagecolorallocate($im,255,255,255);
$textcolor=imagecolorallocate($im,0,0,0);
$mynumber=rand(9999,1000);
imagettftext($im,10,0,0,15,$textcolor,$font,$mynumber);
$_SESSION['check_auth']=$mynumber;
header("Content-type:image/png");
imagepng($im);
imagedestroy($im);
?>