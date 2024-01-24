<?php
session_start();

if (isset($_FILES['profile_picture'])) {
    $file = $_FILES['profile_picture'];
    $imageData = base64_encode(file_get_contents($file['tmp_name']));


    // Connect to the database and update the profile picture
    $servername = "localhost";
    $username = "root";
    $password = "BbREe5uP@oZNc@@Z";
    $dbname = "utilisateur";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $conn->prepare("UPDATE users SET profile_picture = :profile_picture WHERE username = :username");
        $query->bindParam(':profile_picture', $imageData);
        $query->bindParam(':username', $_SESSION["username"]);
        $query->execute();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
