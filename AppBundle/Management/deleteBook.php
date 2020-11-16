<?php
require_once ("Model/ModelBooks.php");
$modelBooks = new ModelBooks();
$modelBooks->deleteBook($_POST["id"]);