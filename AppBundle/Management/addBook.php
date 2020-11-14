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
$id = substr($title, 0, 3) .
    substr($authorWords[0], 0, 1) .
    substr($authorWords[count($authorWords) - 1], 0) .
    rand(0, 9) . rand(0, 9) . rand(0, 9);

echo json_encode(array("message" => $modelBook->addBook(
    $id, $title, $author, $category, $description, $available, $price,
    $_FILES['cover']['name'], $_FILES['cover']['tmp_name'], $owner)));
