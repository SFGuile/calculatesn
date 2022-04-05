<html>
  <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
</html>

<?php
//ini_set("display_errors", On);
//error_reporting(E_ALL);

function Connecttomydb()
{
$server='hk.testapp.win';
$username='mytestuser';
//$port = '3306';
$database='testdb';
$password='mypassword!@#$WSX';

//$conn=mysql_connect("{$server}:{$port}",$username,$password) or die("不能连接服务器 ");
$conn=mysqli_connect($server,$username, $password,$database); //or die("不能连接服务器 ");
if( !$conn ) // == null if creation of connection object failed
{ 
    // report the error to the user, then exit program
    die("不能连接服务器: ".mysqli_error($conn));
}
if( mysqli_connect_errno() )  // returns false if no error occurred
{ 
    // report the error to the user, then exit program
    die("服务器连接失败: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}


$db=mysqli_select_db($conn,$database) or die("不能连接数据库");
mysqli_query($conn,"set names utf8");
return $conn;
}


