<?php


require_once('ProjectConstants.php');

class EntityUsers
{
    private $connexion;

    public function __construct()
    {
        $constants = new ProjectConstants();
        $this->connexion = $constants->getConnexion();
    }

    function setNameCookie($email)
    {
        try 
        {
            $requete = "SELECT firstName, lastName FROM user WHERE email ='{$email}'"; 
            $result = $this->connexion->query($requete);
            $lines = $result->fetchAll();

            foreach ($lines as $line){
                setcookie(
                    "firstName",
                    $line["firstName"],
                    time() + (10 * 365 * 24 * 60 * 60)
                  );
                  setcookie(
                    "lastName",
                    $line["lastName"],
                    time() + (10 * 365 * 24 * 60 * 60)
                  );
            }


            exit;
        } 

        catch(PDOException $e) {

        }
    }

}