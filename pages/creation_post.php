<?php

    session_start();

    
    //Vérification si l'utilisateur est connecté
    require('securityAction.php');

    $query = "SELECT *FROM administrateurs WHERE utilisateur_id = $id";
    $result = mysqli_query()




