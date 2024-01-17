<?php 
    require('setting_user.php');
    
    $querySelect = $conn->prepare("SELECT id FROM users WHERE id = :id");
    $querySelect->bindParam(':id', $_SESSION["id"]);
    $querySelect->execute();
    $row = $querySelect->fetch(PDO::FETCH_ASSOC);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        echo "Form submitted.";
        $new_firstname = $_POST['firstname'];
        $new_lastname = $_POST['lastname'];
        $new_username = $_POST['username'];
        $new_email = $_POST['email'];
    
        $queryUpdate = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, username = :username, email = :email WHERE id = :id");
        $queryUpdate->bindParam(':firstname', $new_firstname);
        $queryUpdate->bindParam(':lastname', $new_lastname);
        $queryUpdate->bindParam(':username', $new_username);
        $queryUpdate->bindParam(':email', $new_email);
        $queryUpdate->bindParam(':id', $row['id']);
    
        try{
            $queryUpdate->execute();
            echo "Update success";
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
