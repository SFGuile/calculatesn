<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->post('/users',function() use ($app)
{
    try {
        $app->contentType('application/json');
        $request = $app->request();
        $userinfo = json_decode($request->getBody());
        $queryusernae = $userinfo->username;
        if(!isset($queryusernae) || trim($queryusernae)==='')
        {
            $returnarr = array("returncode" => -4, "errortext" => "invalid character");
            echo json_encode($returnarr);
            return ;
        }
        $sql2 = "select * from cli_login where username=:myusername";
        $dbhost = "mysql.hostinger.com.hk";
        $dbuser = "u965619223_test";
        $dbpass = "abcd1234efpc";
        $dbname = "u965619223_test";
        $db2 = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt2 = $db2->prepare($sql2);
        $stmt2->bindParam("myusername",$queryusernae);
        $stmt2->execute();
        $result = $stmt2->fetchObject();
        $db2 = null;
        if ($result) {
            $returnarr = array("returncode" => -3, "errortext" => "");
            echo json_encode($returnarr);
        } else {

            try {
                $sql = "INSERT INTO cli_login(username,pass,cpusn,allow_use) VALUES (:username, :pass, :cpusn, -1)";

                $db = getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("username", $userinfo->username);
                $mystr = md5($userinfo->pass);
                $stmt->bindParam("pass", $mystr);
                $stmt->bindParam("cpusn", $userinfo->cpusn);
                $stmt->execute();
                $returnarr = array("returncode" => 0, "errortext" => "");
                echo json_encode($returnarr);
            }
            catch
            (PDOException $e) {
                $returnarr = array("returncode" => -2, "errortext" => $e->getMessage());
                json_encode($returnarr);
            }
        }
    }
    catch
        (PDOException $e) {
            $returnarr = array("returncode" => -2, "errortext" => $e->getMessage());
            json_encode($returnarr);
        }

});


$app->run();



function getConnection() {
    $dbhost="mysql.hostinger.com.hk";
    $dbuser="u965619223_test";
    $dbpass="abcd1234efpc";
    $dbname="u965619223_test";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}



?>