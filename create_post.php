<?php
include 'config.php';

session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $image_url = ''; 
    $user_id = $_SESSION['user_id']; 

    $stmt = $pdo->prepare("INSERT INTO Posts (user_id, content, image_url) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $content, $image_url]);
}
?>

