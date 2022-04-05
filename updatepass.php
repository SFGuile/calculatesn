<html>
  <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
</html>
<?php

require_once('checklogin.php');

include 'connectserverdb.php';


$conn=Connecttomydb();

$myloginuser=$_SESSION["name"];
$oldpass=md5($_POST['oldpass']);
$newpass=md5($_POST['newpass']);
$newpassraw=$_POST['newpass'];
$passcomfirm=md5($_POST['passcomfirm']);
$userid=$_SESSION['userid'];


 if(empty($oldpass))
 {
 	echo "<script>alert('错误：旧密码不能为空，请重试');location.href='password.php';</script>";

 }

 if(empty($newpass))
 {
 	echo "<script>alert('错误：新密码不能为空，请重试');location.href='password.php';</script>";

 }

 if(empty($passcomfirm))
 {
 	echo "<script>alert('错误：确认密码不能为空，请重试');location.href='password.php';</script>";

 }

 if($newpass<>$passcomfirm)
 {
 
  	echo "<script>alert('错误：新密码与确认密码不一致，请重试');location.href='password.php';</script>";

 }
 
 
 if(strlen($newpassraw)<8 or strlen($newpassraw)>30)
 {
 
 	echo "<script>alert('错误：新密码必须在8到30个字符之间，请重试');location.href='password.php';</script>";
 
 }

 $Query="select * from userpass where mypassword='$oldpass' and userid='$userid' ";

  
  $AdminResult=mysqli_query($conn,$Query);
  //输出结果
  $Num=mysqli_fetch_array($AdminResult);
  $correct=false;

  if ($Num>0)
  {
  	$correct=true;
  }
  else
  {
  	echo "<script>alert('错误：旧密码不对，请重试');location.href='password.php';</script>";
  }

  if ($correct==true)
  {
  	$Query="update userpass set mypassword='$newpass' where userid='$userid' ";
  	$AdminResult=mysqli_query($conn,$Query);
  }
  if ($AdminResult)
  {
  	echo "<script>alert('恭喜，密码已经成功修改了');location.href='password.php';</script>";
  }
  else
  {
  	echo "<script>alert('更新失败，请联系系统管理员');location.href='password.php';</script>";
  }

  mysqli_close($conn);

