<html>
  <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
</html>
<?php
//ini_set("display_errors", On);  
//error_reporting(E_ALL);
?>
<html>

<head>

<title>用户登陆</title>

</head>

<body>

<form action="check_auth.php" method="post">
 用户名<input name="name" type="text"><br>
 密码<input name="password" type="password"><br>
<img src="imageauth.php" border="0" /><br>
验证码<input name="auth" type="text"><br>
   <input type="submit" value="确认">
   <input value="退出"  type="submit"><br>
</form>





</body>


</html>
