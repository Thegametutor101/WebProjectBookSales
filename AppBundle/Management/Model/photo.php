
<?php

$fichier_photo = basename($_FILES["cover"]["name"]);

if (move_uploaded_file($_FILES["cover"]["tmp_name"], $fichier_photo)) 
{
    echo json_encode("Sauvegarde réussie" , JSON_UNESCAPED_UNICODE); 
}
else 
{
	echo json_encode("Problème lors de la sauvegarde" , JSON_UNESCAPED_UNICODE);
}      

        
