<?php
require_once('Entity/EntityBooks.php');
$lines = array();
$sortOnly = "";
$noText = "";
$entityBooks = new EntityBooks();
if (!isset($_POST['searchValue'])) {
    $lines = $entityBooks->getBooks();
} elseif (isset($_POST['searchValue'])) {
    if (!empty($_POST['searchValue']) ) {
        $text = trim($_POST['searchValue']);
        $filter = $_POST['searchFilter'];
        $sort = $_POST['searchSort'];
        if ($lines === "") {
            $lines = $entityBooks->getBooksSearchSort($sort);
        } else {
            switch (strtolower($filter)) {
                case "titre": {
                    $lines = $entityBooks->getBooksSearchByTitle($text, $sort);
                    break;
                }
                case "categorie": {
                    $lines = $entityBooks->getBooksSearchByCategory($text, $sort);
                    break;
                }
                case "auteur": {
                    $lines = $entityBooks->getBooksSearchByAuthor($text, $sort);
                    break;
                }
                default: {
                    $lines = $entityBooks->getBooksSearchByText($text, $sort);
                    break;
                }
            }
        }
        $sortOnly = $sort;
        $noText = $text;
    } elseif (isset($_POST['searchSort']) && !empty($_POST['searchSort'])) {
        $lines = $entityBooks->getBooksSearchSort($_POST['searchSort']);
    }
}
if (empty($lines)) {
        $lines = $entityBooks->getBooksSearchSort($sortOnly);
        echo json_encode(array("notFound" => "nope", "lines" => $lines));
} else {
    if (isset($_POST['mobile'])) {
        echo json_encode($lines);
    } else {
        echo json_encode(array("lines" => $lines));
    }
}