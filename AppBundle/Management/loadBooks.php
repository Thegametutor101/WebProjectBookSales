<?php
require_once('Entity/EntityBooks.php');
$lines = array();
$entityBooks = new EntityBooks();

if (!isset($_POST['searchValue'])) {
    $lines = $entityBooks->getBooks();
} elseif (isset($_POST['searchValue'])) {
    if (!empty($_POST['searchValue']) ) {
        $text = trim($_POST['searchValue']);
        $filter = trim($_POST['searchFilter']);
        $sort = trim($_POST['searchSort']);
//        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
//            $nameErr = "Only letters and white space allowed";
//        }

    }
}
echo json_encode(array("lines" => $lines));