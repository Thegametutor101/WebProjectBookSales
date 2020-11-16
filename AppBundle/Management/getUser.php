<?php
require_once("Entity/EntityUsers.php");
$entityUsers = new EntityUsers();
echo json_encode(array("user" => $entityUsers->getUserByID($_POST['id'])));