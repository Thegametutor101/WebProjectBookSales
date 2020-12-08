<?php
require_once ("Model/ModelUsers.php");
$modelUsers = new ModelUsers();

$id=trim($_POST['id'],"\"");
$firstName=trim($_POST['firstName'],"\"");
$lastName=trim($_POST['lastName'],"\"");
$email=trim($_POST['email'],"\"");
$phone=trim($_POST['phone'],"\"");
$password=trim($_POST['password'],"\"");
$adress="3175 Boulevard Laviolette, Trois-Rivières, Quebec G8Z 1E9";

if(isset($_POST['adress'])){
    $adress=trim($_POST['adress'],"\"");
}


if (isset($_POST['password'])) {
    if ($modelUsers->updateUserWithPassord($id, $firstName, $lastName, $email, $phone, $password, $adress)) {
        if (isset($_POST['mobile'])) {
            echo json_encode("ok");
        } else {
            echo json_encode(array("message" => "ok"));
        }
    } else {
        if (isset($_POST['mobile'])) {
            echo json_encode("no");
        } else {
            echo json_encode(array("message" => "no"));
        }
    }
} else {
    if ($modelUsers->updateUser($id, $firstName, $lastName, $email, $phone, $adress)) {
        if (isset($_POST['mobile'])) {
            echo json_encode("ok");
        } else {
            echo json_encode(array("message" => "ok"));
        }
    } else {
        if (isset($_POST['mobile'])) {
            echo json_encode("no");
        } else {
            echo json_encode(array("message" => "no"));
        }
    }
}