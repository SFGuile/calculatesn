<?php



require_once('checklogin.php');


?>
<html>
<table width="100%" border="0">
  <tr>
    <td bgcolor="#CCCCCC">计算序列号</a></td>
    <td bgcolor="#CCCCCC"><a href="password.php">更改密码</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="logout.php">退出</a></td>
  </tr>
</table>

<head>

<title>计算注册码</title>

</head>

<body>

<script>
function cf()
{
return confirm('你已经检查你填写要计算的注册码了吗？系统将扣除你本月一次计算配额');
}

function cleartext()
 {
	var txt1=document.getElementById("codecal1");
	txt1.value="";
	 
 }



</script>


<form action="calresult.php" method="post">
注册码<input  name="codcal1" type="text" id="codecal1"><br>
<input type="radio" value="2" name="retailtype" checked>零售软件
<input type="radio" value="1" name="retailtype">旧的零售软件<br>

<input type="submit" value="确定"   onclick="return cf();">
<input type="button" value="清空"     ONCLICK="cleartext();"><br>
</form>





</body>

</html>