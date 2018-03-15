<?php
$pdo = new PDO("mysql:host=localhost;dbname=blog;charset=utf8", 'root', '');
$req = $pdo->query('SELECT id, titre, DATE_FORMAT(date_creation, "%d/%m/%Y") as date, DATE_FORMAT(date_creation, "%Hh%imin%ss") as heure, contenu FROM billets ORDER BY id desc LIMIT 5');
$billets = $req->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Blog billets</title>
</head>
<body>
    <h1>Blog</h1>
    <h2>Derniers billets de blog :</h2>
    <?php foreach ($billets as $billet) : ?>
        <?php extract($billet); ?>
        <div class="news">
            <h3><?= $titre. ' le '. $date. ' à '. $heure ?></h3>
            <p>
                <?= $contenu ?><br>
            <a href="commentaires.php?id=<?= $id ?>">Commentaires</a>
            </p>
        </div>

    <?php endforeach; ?>
</body>
</html>
