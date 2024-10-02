<?php
require 'config.php';

$stmt = $pdo->query("
    SELECT p.id, p.content, p.user_id, u.username, p.created_at,
        DATE_FORMAT(p.created_at, '%d %M %Y à %H:%i') AS formatted_date,
        (SELECT COUNT(*) FROM Reactions WHERE post_id = p.id AND type = 'like') AS likes,
        (SELECT COUNT(*) FROM Reactions WHERE post_id = p.id AND type = 'love') AS loves,
        (SELECT COUNT(*) FROM Reactions WHERE post_id = p.id AND type = 'haha') AS hahas
    FROM Posts p
    JOIN Users u ON p.user_id = u.id
    ORDER BY p.created_at DESC
");

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($posts);
?>
