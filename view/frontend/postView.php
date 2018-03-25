<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
while ($comment = $comments->fetch())
{
    ?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> </p>
    <a href="index.php?action=post&id=<?= $post['id'] ?>&commentId=<?= htmlspecialchars($comment['id']) ?>">Modifier le commentaire</a>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <?php
}

$comments->closeCursor();
?>
<?php $action = isset($commentPost)?'modifyComment':'addComment'; ?>
<form action="index.php?action=<?= $action ?>&amp;id=<?= $post['id'] ?>" method="post">
    <input type="hidden" name="id" value="<?= isset($commentPost)?$commentPost['id']:'' ?>">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?= isset($commentPost)?$commentPost['author']:'' ?>"/>
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?= isset($commentPost)?$commentPost['comment']:'' ?></textarea>
    </div>
    <div>
        <input type="submit"/>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
