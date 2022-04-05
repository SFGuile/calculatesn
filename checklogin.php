<html>
  <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
</html>
<?php


session_start();

$havelogin=$_SESSION['havelogin'];

if($havelogin==false)
{
	echo "<script>alert('你非法地进入该页面');location.href='index.php';</script>";

}