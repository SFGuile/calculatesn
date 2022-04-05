<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/checkauth/:user/:pass/:cpusn/:privil',function($user,$pass,$cpusn,$privil)use ($app){
 $app->contentType('application/json');
$sql = "select *  from cli_login left JOIN cli_privillege on cli_login.userid=cli_privillege.userid where cli_login.allow_use=0 and cli_login.username=:username and cli_login.pass=:mypass and cli_login.cpusn=:mycpusn and cli_privillege.privillege=:privil ";
try {
    $dbhost="mysql.hostinger.com.hk";
    $dbuser="u965619223_test";
    $dbpass="abcd1234efpc";
    $dbname="u965619223_test";
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare($sql);
    $stmt->bindParam("username",$user);
    $mystr=md5($pass);
    $stmt->bindParam("mypass", $mystr);
    $stmt->bindParam("mycpusn",$cpusn);
    $stmt->bindParam("privil", $privil);
    $stmt->execute();
    $result = $stmt->fetchObject();
	

    $db = null;
    if ($result)
    {
         $returnarr=array("returncode"=>0,"errortext"=>"");
	   
		echo  json_encode( $returnarr);
    }
    else
    {
        $returnarr = array("returncode" => -1, "errortext" => "password error");
		
        echo  json_encode( $returnarr, JSON_UNESCAPED_UNICODE);
    }

} catch(PDOException $e)
{
     $returnarr = array("returncode" => -2, "errortext" =>$e->getMessage());
	 json_encode($returnarr);
    
}
});
$app->run();




?>