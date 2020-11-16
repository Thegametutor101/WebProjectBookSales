<?php

$profileDirectory = dirname(__FILE__) . '/../ressources/userPictures/' . $_POST['id'] . '.png';
if (!move_uploaded_file($_FILES['profile']['tmp_name'], $profileDirectory)) {
   return json_encode(array("message" => "file error"));
} else {
    return json_encode(array("message" => "ok"));
}