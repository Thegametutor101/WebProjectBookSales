<?php
require_once('ProjectConstants.php');

class EntityBooks
{
    private $connexion;

    public function __construct()
    {
        $constants = new ProjectConstants();
        $this->connexion = $constants->getConnexion();
    }

    function getBooks():array
    {
        $ligne = array();
        try
        {
            $requete = "SELECT * FROM book";
            $resultat = $this->connexion->query($requete);
            $ligne = $resultat->fetchAll();

            return $ligne;
        }
        catch(PDOException $e) {
            echo "Échec de connexion à la base de données: " . $e->getMessage();
            return $ligne;
        }
    }
}