<?php
require_once('Model/ModelBooks.php');

$modelBook = new ModelBooks();

$title = trim($_POST["title"],"\"");
$author = trim($_POST["author"],"\"");
$category = trim($_POST["category"],"\"");
$description = trim($_POST["description"],"\"");
$available = trim($_POST["available"],"\"");
$price = trim($_POST["price"],"\"");
$owner = trim($_POST["owner"],"\"");

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