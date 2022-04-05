<html>
  <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
</html>
<?php
require_once('checklogin.php');


unset($_SESSION['havelogin']);
unset($_SESSION['name']);
unset($_SESSION['check_auth']);
unset($_SESSION["theselect"]);
unset($_SESSION["thevalue"]);
unset($_SESSION["mynumcount"]);
unset($_SESSION["myclino"]);
session_destroy();

echo "你已经安全登出，祝你生活愉快！";

?>


