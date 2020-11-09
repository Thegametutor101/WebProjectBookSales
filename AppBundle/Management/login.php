<?php
require_once('Model/ModelUsers.php');
$modelUsers = new ModelUsers();
$result = false;
if (isset($_POST['email']) && isset($_POST['password'])) {
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $result = $modelUsers->login($_POST['email'], $_POST['password']);
        if ($result) {
            echo json_encode(array("message" => "ok"));
        } else {
            echo json_encode(array("message" => "no"));
        }
    } else {
        echo json_encode(array("message" => "not email"));
    }
} else {
    echo json_encode(array("message" => "error"));
}