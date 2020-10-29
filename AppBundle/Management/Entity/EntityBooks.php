<?php


class EntityBooks
{
    function getBooks():array
    {
        $ligne = array();
        try
        {
            $connexion = new PDO("mysql:host=localhost;dbname=booksales;port=3308,charset=utf8","root","");
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = "SELECT * FROM book";
            $resultat = $connexion->query($requete);
            $ligne = $resultat->fetchAll();

            return $ligne;
        }
        catch(PDOException $e) {
            echo "Échec de connexion à la base de données: " . $e->getMessage();
            return $ligne;
        }
    }
}