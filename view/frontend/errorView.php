<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Erreur !</h1>
<p>Erreur :  <?=  $errorMessage; ?></p>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
