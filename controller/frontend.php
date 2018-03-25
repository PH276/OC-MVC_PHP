<?php
use \Ph\Blog\Model\PostManager;
use \Ph\Blog\Model\CommentManager;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager -> getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager -> getPost($_GET['id']);
    $comments = $commentManager -> getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function comment()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager -> getPost($_GET['id']);
    $comments = $commentManager -> getComments($_GET['id']);
    $commentPost = $commentManager -> getComment($_GET['commentId']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{

    $commentManager = new CommentManager();
    $affectedLines = $commentManager -> postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function modifyComment($postId, $id, $author, $comment)
{

    $commentManager = new CommentManager();
    $affectedLines = $commentManager -> modifyComment($id, $author, $comment);

    if ($affectedLines === false) {
        // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
