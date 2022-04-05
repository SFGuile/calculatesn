<?php
require_once('checklogin.php');

include 'connectserverdb.php';


$conn=Connecttomydb();


$caltext=$_POST['codcal1'];
$caltype=$_POST['retailtype'];
$userid=$_SESSION['userid'];
$Query="select * from userlogin where userid='$userid'";
$AdminResult=mysqli_query($conn,$Query) or die(mysqli_error());
$num=mysqli_num_rows($AdminResult);
if ($num>0)
{
	$row=mysqli_fetch_array($AdminResult);
	$mycaltime=$row['caltime'];
	if ($mycaltime<=0)
	{
		echo "你的这个月的计算配额已经用完，请通知系统管理员或等下个月";
	}
	else
	{
		if ($caltype==1)
		{
			$thesnresult=calmysntyp1($caltext);
		}
		else 
		{
			$thesnresult=calmysntyp2($caltext);
		}
		echo $caltext."结果是：";
		echo $thesnresult;
		echo "<br>";
		echo "你本月还剩的配额有：";
		$leftquota=$mycaltime-1;
		echo $leftquota;
		echo "<br>";
		
		$Query2="update userlogin set caltime='$leftquota' where userid='$userid'";
		$AdminResult2=mysqli_query($conn,$Query2) or die(mysqli_error());
		
		$iipp=$_SERVER["REMOTE_ADDR"];
		
		$Query2="insert into snlog( userid,logip,sn,snresult,caldate) values ('$userid','$iipp','$caltext','$thesnresult',date_add(now(), interval 13 hour))";
		$AdminResult2=mysqli_query($conn,$Query2) or die(mysqli_error());

		
	}
	
}

mysqli_close($conn);

function calmysntyp1($varlsnum)
{
	$varlie=3;
	$varlid=7;
	$varlin=33;
	$myresulstring="";
	$varlsstr=(string)$varlsnum;

	while ($varlsstr<>"")
	{
		$varlultemp=(integer)substr($varlsstr,0,2);
		if ($varlultemp>=$varlin)
		{
			$myleftstrtemp=substr($varlsstr,0,1);
			$varlultemp=(integer)$myleftstrtemp;
			$varlsstrtemp = substr($varlsstr,1);
			$varlsstr=$varlsstrtemp;	

		
		}
		else
		{
	 	 $varlsstrtemp = substr($varlsstr,2);
			$varlsstr=$varlsstrtemp;
	
		}
		$varluly = 1;
		for($i=0;$i<3;$i++)
		{
			$varluly = $varluly * $varlultemp;
		}
	
		
		 $varluly =  $varluly % 33;
		 $varlulystr=(string)$varluly;
		 $myresulstrtemp=$myresulstring.$varlulystr;
		 $myresulstring=$myresulstrtemp;
	}
     return $myresulstring;
}

function calmysntyp2($varlsnum)
{
	$varlssnn1=(string)$varlsnum."abcd1234";
	
	$varlie=3;
	$varlid=7;
	$varlin=33;
	$varlsstr=$varlssnn1;
	$varlultemp=0;
	$varlssnn2="";
	$myresulstring="";
	while ($varlsstr<>"")
	{
		if( preg_match('/^[a-zA-Z]+$/',substr($varlsstr,1,2) ))
		{
			$varlultemp=0;
		}
		else
		{	
		$varlultemp=(integer)substr($varlsstr,0,2);
		
		}	
			
		if ($varlultemp>=$varlin)
		{
			$myleftstrtemp=substr($varlsstr,0,1);
			$varlultemp=(integer)$myleftstrtemp;
			
			$varlsstrtemp = substr($varlsstr,1);
			$varlsstr=$varlsstrtemp;
		
		}
		else
		{
			$varlsstrtemp = substr($varlsstr,2);
			$varlsstr=$varlsstrtemp;
			
		}
		$varluly = 1;
		for($i=0;$i<3;$i++)
		{
			$varluly = $varluly * $varlultemp;
		}
				 $varluly =  $varluly % 33;
		
		 $varlulystr=(string)$varluly;
		 $myresulstrtemp=$myresulstring.$varlulystr;
		 $myresulstring=$myresulstrtemp;
		 $varlssnn2=$myresulstring;
	}
	   
	$varlsstr = $varlssnn2;
	$varlie=3;
	$varlid=7;
	$varlin=33;
	
	$varlssnn3="";
	
	
	while ($varlsstr<>"")
	{
		$varlultemp=(integer)substr($varlsstr,0,2);
		
		if ($varlultemp>=$varlin)
		{
			$myleftstrtemp=substr($varlsstr,0,1);
			$varlultemp=(integer)$myleftstrtemp;
			$varlsstrtemp = substr($varlsstr,1);
			$varlsstr=$varlsstrtemp;
		}
		else
		{
			$varlsstrtemp = substr($varlsstr,2);
			$varlsstr=$varlsstrtemp;
		}
		$varlulx0 = 1;
		$varlulx1 = 1;
		for($i=0;$i<4;$i++)
		{
		$varlulx0 = $varlulx0 * $varlultemp;
		}
	   
		$varlulx0 =  $varlulx0 % 33;
	
		
		for($i=0;$i<3;$i++)
		{
		$varlulx1 = $varlulx1 * $varlultemp;
		}
		
		$varlulx1 =  $varlulx1 % 33;
		
		$varlulx=( $varlulx0 * $varlulx1) % 33;
		
		$varlssnn3=$varlssnn3.(string)$varlulx;
		
	}
	return $varlssnn3;

	
 }

	
	