<?php
require_once('ProjectConstants.php');

class ModelUsers
{
    private $connexion;

    public function __construct()
    {
        $constants = new ProjectConstants();
        $this->connexion = $constants->getConnexion();
    }

    function login(string $email, string $password): bool
    {
        $isSame = false;
        try {
            $request = "SELECT email, password FROM user";
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();
            foreach ($lines as $line) {
                if (($line['email'] === $email) && ($line['password'] === $password)) {
                    $isSame = true;
                }
            }
            return $isSame;
        }
        catch(PDOException $e) {
            echo "echec de connexion à la base de donnees: " . $e->getMessage();
            return $isSame;
        }
    }
}