<?php
require_once ('Entity/EntityUsers.php');
$entityUsers = new EntityUsers();
$lines = $entityUsers->getUserWithBook();
echo json_encode($lines[0]);