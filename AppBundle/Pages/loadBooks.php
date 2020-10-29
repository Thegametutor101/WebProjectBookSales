<?php
echo json_encode("test");
$lines = array();
try
{
    $connection = new PDO("mysql:host=206.167.140.56:8008;dbname=420505ri_gr06;port=SB0134-WINWEB,charset=utf8","1763237","1763237");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $request = "SELECT * FROM book";
    $result = $connection->query($request);
    $lines = $result->fetchAll();

    echo json_encode(array( "OK", "lines" => $lines));
}
catch(PDOException $e) {
    echo "Échec de connexion à la base de données: " . $e->getMessage();
    echo json_encode(array("ERROR"));
}