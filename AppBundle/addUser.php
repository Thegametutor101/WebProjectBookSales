<?php
require_once('Model/ModelUsers.php');
require_once('Entity/EntityUsers.php');
$modelUsers = new ModelUsers();
$entityUsers = new EntityUsers();
$result = false;


$firstName=trim($_POST['firstName'],"\"");
$lastName=trim($_POST['lastName'],"\"");
$email=trim($_POST['email'],"\"");
$phone=trim($_POST['phone'],"\"");
$password=trim($_POST['password'],"\"");
$adress;

if(!isset($_POST['adress'])){
    $adress="3175 Boulevard Laviolette, Trois-Rivières, Quebec G8Z 1E9";
}
else{
    $adress=trim($_POST['adress'],"\"");
}


if (isset($firstName) && isset($lastName)&&isset($email)&&isset($phone) && isset($password)) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = $modelUsers->addUser($firstName,$lastName,$email,$phone,$password,$adress);
        if ($result) {
            $loggedUser = $entityUsers->setNameCookie($email);
            if (isset($_POST['mobile']))
            {
                echo json_encode($loggedUser);
            } else {
                echo json_encode(array("message" => "ok", "loggedUser" => $loggedUser));
            }
           
        } else {
            echo json_encode(array("message" => "no"));
        }
    } 
    
    else 
    {
        if (isset($_POST['mobile']))
        {
            echo json_encode("0");
        } else{
            echo json_encode(array("message" => "not email"));
        }
    }
} else {
    echo json_encode(array("message" => "error"));
}