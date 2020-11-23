<?php
require_once('Entity/EntityUsers.php');
$entityUsers = new EntityUsers();
$result = false;
if (isset($_POST['email']) && isset($_POST['password'])) {
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $result = $entityUsers->login($_POST['email'], $_POST['password']);
        if ($result) {
            $loggedUser = $entityUsers->setNameCookie($_POST['email']);
            if (isset($_POST['mobile']))
            {
                echo json_encode($loggedUser);
            } else {
                echo json_encode(array("message" => "ok", "loggedUser" => $loggedUser));
            }
        } else {
            echo json_encode(array("message" => "no"));
        }
    } else {
        if (isset($_POST['mobile']))
        {
            echo json_encode("0");
        } else{
            echo json_encode(array("message" => "not email"));
        }
    }
} else {
    echo json_encode(array("message" => "error"));
}