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
            return $isSame;
        }
    }

    function setNameCookie($email): array
    {
        $lines = array();
        try 
        {
            $request = "SELECT id FROM user WHERE email ='{$email}'";
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines[0];
        }
        catch(PDOException $e) {
            return $lines;
        }
    }

    function checkEmailUsed($email): bool
    {
        try
        {
            $request = "SELECT id FROM user WHERE email ='{$email}'";
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();
            if (isset($lines[0][0])) {
                return true;
            }
            return false;
        }
        catch(PDOException $e) {
            return true;
        }
    }

    function getUserId($email)
    {
        try
        {
            $request = "SELECT id FROM user WHERE email ='{$email}'";
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();
            return $lines[0][0];
        }
        catch(PDOException $e) {
            return 0;
        }
    }

}