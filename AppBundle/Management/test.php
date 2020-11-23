<?php
try {
//        $this->connexion = new PDO("mysql:host=localhost;dbname=booksales;port=3308,charset=utf8","root","");
        $connexion = new PDO("mysql:host=localhost;dbname=420505ri_gr06;port=3306","1763237","1763237");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e;
    }