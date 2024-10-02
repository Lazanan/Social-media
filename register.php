<?php
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_POST['username']) || empty($_POST['username'])) {
        echo "Le nom d'utilisateur est requis.";
        exit();
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {

        exit();
    }

    $hashed_password = md5($password); 

    $stmt = $pdo->prepare("INSERT INTO Users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $hashed_password])) {
        echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
        header("Location: index.php"); 
        exit();
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>
