<?php
require_once ("Model/ModelUsers.php");
$modelUsers = new ModelUsers();
if (isset($_POST['password'])) {
    if ($modelUsers->updateUserWithPassord($_POST['id'], $_POST['email'], $_POST['phone'], $_POST['password'])) {
        echo json_encode(array("message" => "ok"));
    } else {
        echo json_encode(array("message" => "no"));
    }
} else {
    if ($modelUsers->updateUser($_POST['id'], $_POST['email'], $_POST['phone'])) {
        echo json_encode(array("message" => "ok"));
    } else {
        echo json_encode(array("message" => "no"));
    }
}