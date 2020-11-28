<?php
require_once("Entity/EntityUsers.php");
$entityUsers = new EntityUsers();
if (isset($_POST['mobile'])) {
    echo json_encode($entityUsers->getUserByID($_POST['id'])[0]);
} else {
    echo json_encode(array("user" => $entityUsers->getUserByID($_POST['id'])));
}