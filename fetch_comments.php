<?php
require 'config.php';

session_start(); 

$postId = $_GET['post_id']; 
$userId = $_SESSION['user_id']; 
$stmt = $pdo->prepare("
    SELECT c.id, c.content, c.user_id, u.username, c.created_at,
        DATE_FORMAT(c.created_at, '%d %M %Y à %H:%i') AS formatted_date,
        (SELECT COUNT(*) FROM Comment_Reactions WHERE comment_id = c.id AND reaction_type = 'like') AS likes,
        (SELECT COUNT(*) FROM Comment_Reactions WHERE comment_id = c.id AND reaction_type = 'love') AS loves,
        (SELECT COUNT(*) FROM Comment_Reactions WHERE comment_id = c.id AND reaction_type = 'haha') AS hahas,
        CASE WHEN c.user_id = ? THEN 1 ELSE 0 END AS canDelete -- Vérifie si l'utilisateur connecté est l'auteur du commentaire
    FROM Comments c
    JOIN Users u ON c.user_id = u.id
    WHERE c.post_id = ?
    ORDER BY c.created_at DESC
");
$stmt->execute([$userId, $postId]);

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($comments);
?>
