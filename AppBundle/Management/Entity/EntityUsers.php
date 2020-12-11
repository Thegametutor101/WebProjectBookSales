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

    function getUserByID($id): array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM user WHERE id='$id'";
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
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

    function getUserWithBook():array{
        $lines = array();
        try {
            $request = "SELECT DISTINCT u.id,u.firstName,u.lastName,u.email,u.phone,u.password,u.adress FROM user u INNER JOIN book b ON b.owner=u.id WHERE b.available=1";
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }
}