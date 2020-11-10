<?php
require_once('ProjectConstants.php');
require_once('Entity/EntityUsers.php');

class ModelUsers
{
    private $connexion;

    public function __construct()
    {
        $constants = new ProjectConstants();
        $this->connexion = $constants->getConnexion();
    }

    function addUser(string $firstName, string $lastName, string $email, string $phone, string $password):bool
    {
        $entityUsers = new EntityUsers();
        try
        {
            if ($entityUsers->checkEmailUsed($email)) {
                return false;
            } else {
                $requete = "INSERT INTO user (firstName, lastName, email, phone, password) 
                        VALUES('$firstName', '$lastName', '$email', '$phone', '$password')";
                $this->connexion->exec($requete);
                $id = $entityUsers->getUserId($email);
                $file = dirname(__FILE__) . '/../../ressources/userPictures/defaultUserProfile.png';
                $newfile = dirname(__FILE__) . '/../../ressources/userPictures/' . $id . '.png';
                copy($file, $newfile);
                return true;
            }
        }
        catch(PDOException $e) {
            return false;
        }

    }
}