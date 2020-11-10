<?php
require_once('Model/ModelUsers.php');
require_once('Entity/EntityUsers.php');
$modelUsers = new ModelUsers();
$entityUsers = new EntityUsers();
$result = false;
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password'])) {
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $result = $modelUsers->addUser($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['phone'], $_POST['password']);
        if ($result) {
            $loggedUser = $entityUsers->setNameCookie($_POST['email']);
            echo json_encode(array("message" => "ok", "loggedUser" => $loggedUser));
        } else {
            echo json_encode(array("message" => "no"));
        }
    } else {
        echo json_encode(array("message" => "not email"));
    }
} else {
    echo json_encode(array("message" => "error"));
}