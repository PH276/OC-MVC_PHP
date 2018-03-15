<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];
    $pdo = new PDO("mysql:host=localhost;dbname=blog;charset=utf8", 'root', '');
    $req = $pdo->prepare('SELECT titre, DATE_FORMAT(date_creation, "%d/%m/%Y") as date, DATE_FORMAT(date_creation, "%Hh%imin%ss") as heure, contenu FROM billets WHERE id = ?');
    $req->execute(array($id));
    // $req->execute(array($_GET['id']));
    $billet = $req->fetch();

    $req = $pdo->prepare('SELECT auteur, DATE_FORMAT(date_commentaire, "%d/%m/%Y") as date, DATE_FORMAT(date_commentaire, "%Hh%imin%ss") as heure, commentaire FROM commentaires WHERE id_billet = ?');
    $req->execute(array($id));
    // $req->execute(array($_GET['id']));
    $commentaires = $req->fetchAll();
}else {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Commentaires - blog</title>
</head>
<body>
    <h1>Blog</h1>
    <a href="index.php">Retour à la liste des billets</a>
    <section>

        <?php extract($billet); ?>
        <div class="news">
            <h3><?= $titre. ' le '. $date. ' à '. $heure ?></h3>
            <p><?= $contenu ?></p>
        </div>
    </section>
    <section>
        <h2>Commentaires</h2>
        <?php foreach ($commentaires as $commentaire) : ?>
            <?php extract($commentaire); ?>
                <p><b><?= $auteur. ' </b>le '. $date. ' à '. $heure ?></p>
                <p><?= $commentaire ?></p>
            </div>

        <?php endforeach; ?>
    </section>
</body>
</html>
