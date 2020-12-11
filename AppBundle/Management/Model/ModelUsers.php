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

    function addUser(string $firstName, string $lastName, string $email, string $phone, string $password, string $adress):bool
    {
        $entityUsers = new EntityUsers();
        try
        {
            if ($entityUsers->checkEmailUsed($email)) {
                return false;
            } else {
                $requete = "INSERT INTO user (firstName, lastName, email, phone, password, adress, ext) 
                        VALUES('$firstName', '$lastName', '$email', '$phone', '$password',' $adress', 'png')";
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

    function updateUserWithPassord($id, $firstName, $lastName, $email, $phone, $password, $adress):bool
    {
        try
        {
            $requete = "UPDATE user SET firstName='$firstName', lastName='$lastName', email='$email', phone='$phone', password='$password', adress='$adress' WHERE id='$id'";
            $this->connexion->exec($requete);

            return true;
        }
        catch(PDOException $e) {
            return false;
        }
    }

    function updateUser($id, $firstName, $lastName, $email, $phone, $adress):bool
    {
        try
        {
            $requete = "UPDATE user SET firstName='$firstName', lastName='$lastName', email='$email', phone='$phone', adress='$adress' WHERE id='$id'";
            $this->connexion->exec($requete);

            return true;
        }
        catch(PDOException $e) {
            return false;
        }
    }

    function updateExtension($id, $ext):bool
    {
        try
        {
            $requete = "UPDATE user SET ext='$ext' WHERE id='$id'";
            $this->connexion->exec($requete);

            return true;
        }
        catch(PDOException $e) {
            return false;
        }
    }

    function updateUserPhoto(): bool
    {
        try
        {

            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }
}