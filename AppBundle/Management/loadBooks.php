<?php
require_once ("ProjectConstants.php");
$lines = array();
try
{
//    new PDO("mysql:host=206.167.140.56;dbname=420505ri_gr06;port=3306,charset=utf8","1763237","1763237");
    $constants = new ProjectConstants();
    $connexion = $constants->getConnexion();

    $request = "SELECT * FROM book";
    $result = $connexion->query($request);
    $lines = $result->fetchAll();

    echo json_encode(array( "OK", "lines" => $lines));
}
catch(PDOException $e) {
    echo json_encode(array("ERROR", "message" => "Échec de connexion à la base de données: " . $e->getMessage()));
}