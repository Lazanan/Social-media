<?php

session_start();

if (!isset($_SESSION['username'])) {

    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="./img/logo.jpeg" alt="logo">
        </div>
        <a href="logout.php">Se déconnecter</a>
    </header>

    
    <div id="postForm">
        <div id="user">
            <img src="./img/person.svg" alt="person-icon">
            <p><?php echo $_SESSION['username'];?></p>
        </div>
        <div id="postsHeader">
            <img src="./img/journal.svg" alt="journal-icon">
            <h1>Publications</h1>
        </div>
        <textarea id="postContent" placeholder="Écrivez quelque chose..."></textarea>
        <button id="submitPost">Publier</button>
    </div>

    <div id="postsContainer">
        <div class="post">
            <strong>Publieur: Rakoto </strong>
            <div class="date-time">Publié le 30 Septembre 2024 à 14:35</div>
            <p>Ceci est un exemple de publication sur le forum.</p>
        </div>

        <div class="commentsContainer">
            <strong>Commentateur: Rabe</strong>
            <div class="date-time">Commenté le 30 Septembre 2024 à 14:45</div>
            <p>Ceci est un exemple de commentaire.</p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
