<?php
require 'config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("DELETE FROM Posts WHERE id = ? AND user_id = ?");
    $stmt->execute([$post_id, $user_id]);
}
?>

