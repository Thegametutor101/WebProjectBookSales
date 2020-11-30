<?php
require_once('Model/ModelBooks.php');

$modelBook = new ModelBooks();

$title = $_POST["title"];
$author = $_POST["author"];
$category = $_POST["category"];
$description = $_POST["description"];
$available = $_POST["available"];
$price = $_POST["price"];
$owner = $_POST["owner"];

$authorWords = explode(' ', ucwords($author));
$id = $_POST['id'];


if (!isset($_FILES['cover'])) {
    if (isset($_POST['mobile']))
    {
        echo json_encode($modelBook->updateBook(
        $id, $title, $author, $category, $description, $available, $price, $owner));
    }
    else{
        echo json_encode(array("message" => $modelBook->updateBook(
        $id, $title, $author, $category, $description, $available, $price, $owner)));
    }
    
} else {
    if (isset($_POST['mobile']))
    {
        echo json_encode($modelBook->updateBookWithCover(
        $id, $title, $author, $category, $description, $available, $price, $_FILES['cover']['tmp_name'], $owner));
    }
    else{
        echo json_encode(array("message" => $modelBook->updateBookWithCover(
        $id, $title, $author, $category, $description, $available, $price, $_FILES['cover']['tmp_name'], $owner)));
    }
}