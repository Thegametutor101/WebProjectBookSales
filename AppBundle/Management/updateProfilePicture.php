<?php
require_once('Model/ModelUsers.php');
$model = new ModelUsers();
$path = $_FILES['profile']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$model->updateExtension($_POST['id'], $ext);
$profileDirectory = dirname(__FILE__) . '/../ressources/userPictures/' . $_POST['id'] . '.' . $ext;
if (!move_uploaded_file($_FILES['profile']['tmp_name'], $profileDirectory)) {
   return json_encode(array("message" => "file error"));
} else {
    return json_encode(array("message" => "ok"));
}