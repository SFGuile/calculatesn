<?php

//ini_set("display_errors", On);  
//error_reporting(E_ALL);

date_default_timezone_set('America/Los_Angeles');

include 'connectserverdb.php';

if (!isset($_SESSION))
{
	session_start();
}

$conn=Connecttomydb();

$auth=$_POST['auth'];
$name=$_POST['name'];
$pass=md5($_POST['password']);
$name=ltrim(rtrim($name));
$pass=ltrim(rtrim($pass));
$_SESSION['havelogin'] = false;
$_SESSION['name'] = $name;


if(empty($name))
{
	echo "<script>alert('姓名不能为空，请重试');location.href='index.php';</script>";

}

if(empty($pass))
{
	echo "<script>alert('密码不能为空，请重试');location.href='index.php';</script>";

}
$Query="select * from userpass where username='$name' and mypassword='$pass'";
//echo $Query;
$AdminResult=mysqli_query($conn,$Query) or die(mysqli_error());
$Num=mysqli_num_rows($AdminResult);
$correct=false;

if ($Num>0)
{
	$correct=true;
}
$correct2=false;
if(empty($auth))
{
	 
	echo "<script>alert('验证码不能为空，请重�?');location.href='index.php';</script>";
	 
}

if($auth==$_SESSION['check_auth'])
{

	$correct2=true;
}
else
{
	$correct2=false;
	"<script>alert('验证码错误，请重�?');location.href='index.php';</script>";
}


if ($correct==true and $correct2==true)
{
	
		
		

	$_SESSION['havelogin'] = true;
	$Query="select userid from userpass where username='$name'";
	$AdminResult=mysqli_query($conn,$Query) or die(mysqli_error());
	   $num=mysqli_num_rows($AdminResult);
		  if ($num>0)
		  {
				  $row=mysqli_fetch_array($AdminResult);
				  $_SESSION['userid']=$row['userid'];
				  $theuserid=$row['userid'];
				  $Query2="select logdate from userlogin where userid='$theuserid'";
				  $AdminResult2=mysqli_query($conn,$Query2) or die(mysqli_error());
				  $num2=mysqli_num_rows($AdminResult2);
				  $row2=mysqli_fetch_array($AdminResult2);
  
  
		  $today=date('Y-m-d H:i:s', strtotime('+13 hours',  time()));
		  $thisyear=getyear($today);
		  $thismonth=getmonth($today);
  
		  $lastloginmonth=getmonth(date($row2['logdate']));
		  $lastloginyear=getyear(date($row2['logdate']));
  
	
	   if (($thisyear<>$lastloginyear) or ($thismonth<>$lastloginmonth) )
	       {
	       	$Query3="update  userlogin set caltime=3,logdate=date_add(now(), interval 13 hour)  where userid='$theuserid'";
	       	$AdminResult3=mysqli_query($conn,$Query3) or die(mysqli_error());
	       }
	      else 
	      {
	      	$Query3="update  userlogin set logdate=date_add(now(), interval 13 hour) where userid='$theuserid'";
	      	$AdminResult3=mysqli_query($conn,$Query3) or die(mysqli_error());
	       }	
	
	}
	echo "<script>location.href='calsn.php';</script>";

}
else
{

	echo "<script>alert('密码错误，请重试');location.href='index.php';</script>";

}


mysqli_close($conn);

function getmonth($date)
{
	$strtime = $date;
	$strtimes = explode(" ",$strtime);
	$timearray = explode("-",$strtimes[0]);
	$year = $timearray[0];
	$month = $timearray[1];
	$day = $timearray[2];
	return $month;
}

//取得时间的日
//echo "日：".getday(date('Y-m-d H:i:s'));
function getyear($date)
{
	$strtime = $date;
	$strtimes = explode(" ",$strtime);
	$timearray = explode("-",$strtimes[0]);
	$year = $timearray[0];
	$month = $timearray[1];
	$day = $timearray[2];
	return $year;
}
