<html>
  <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
</html>
<?php
require_once('checklogin.php');
?>
<table width="100%" border="0">
  <tr>
    <td bgcolor="#CCCCCC"><a href="calsn.php">计算序列号</a></td>
    <td bgcolor="#CCCCCC">更改密码</td>
   
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="logout.php">退出</a></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="0" >
<form id="form1" name="form1" method="post" action="updatepass.php">
  <tr>
    <td colspan="2" bgcolor="#0000FF"><div align="center">输入信息</div></td>
  </tr>
  <tr>
    <td><align="right">旧密码：</td>
     <td><input type="password" name="oldpass" id="oldpass" /></td>
    </td>
  </tr>
  <tr>
    <td><align="right">新密码：</td>
   
      
      <td><input type="password" name="newpass" id="newpass" /></td>
    </td>
  </tr>
  <tr>
    <td><align="right">新密码确认：</td>
    
      
      <td><input type="password" name="passcomfirm" id="passcomfirm" /></td>
    
  </tr>
  <tr>
    <td colspan="2"><align="center">
      
        <input type="submit" name="summit" id="summit" value="提交" />
        <input type="submit" name="reset" id="reset" value="重填" />
      
   </td>
  </tr>
  </form>
</table>


<p>&nbsp;</p>