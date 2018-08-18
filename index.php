<?php 

require('controller/Frontend.php');
require('controller/Backend.php');
require('controller/UserCRUD.php');
require('controller/ArticleCRUD.php');
require('controller/CommentCRUD.php');



try {
    if (isset($_GET['action'])) {
        $index = new Action($_GET['action']);
    } else {
        $frontend = new Frontend();
        $frontend->articlesListView();
    }  
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}


class Action {  

    function __construct($action = 'NULL')
    {
        $this->go($action);     
    }

    public function go($action) {
        switch ($action) {

            case 'articlesList':
                $frontend = new Frontend();
                $frontend->articlesListView();
                break;
            case 'allArticles':
                $frontend = new Frontend();
                $frontend->allArticlesView();
                break;
            case 'biography':
                $frontend = new Frontend();
                $frontend->biographieView();
                break;
            case 'genesys':
                $frontend = new Frontend();
                $frontend->genesysVIew();
                break;
            case 'article':
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $frontend = new Frontend();
                    $frontend->articleView();
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
                break;

            case 'acompte':
                $backend = new Backend();
                $backend->backOfficeView();
                break;
            case 'login':
                $backend = new Backend();
                $backend->loginView();
                break;
            case 'inscription':
                $backend = new Backend();
                $backend->inscriptionView();
                break;
            case 'createArticle':
                $backend = new Backend();
                $backend->createArticleView();
                break;
            case 'editArticle':
                $backend = new Backend();
                $backend->editArticleView($_GET['id']);
                break;

            case 'addArticle':
                if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        $articleCRUD = new ArticleCRUD();
                        $articleCRUD->addArticle($_SESSION['id'], $_POST['title'], $_POST['content']);
                    }
                }
                break;
            case 'updateArticle':
                if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        $articleCRUD = new ArticleCRUD();
                        $articleCRUD->updateArticle($_POST['id'], $_SESSION['id'], $_POST['title'], $_POST['content'], $_POST['nbComment']);
                    }
                }
                break;
            case 'deleteArticle':
                $articleCRUD = new ArticleCRUD();
                $articleCRUD->deleteArticle($_GET['id']);
                break;

            case 'addUser':
                if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {    
                    if (strlen($_POST['pseudo']) < 26 && strlen($_POST['pseudo']) > 0 ) {
                        if (strlen($_POST['mdp']) < 26 && strlen($_POST['mdp']) > 0 ) {
                            $userCRUD = new UserCRUD();
                            $userCRUD->addUser($_POST['pseudo'], $_POST['mdp']);
                        }
                    }
                }
                break;
            case 'editPseudo':
                $userCRUD = new UserCRUD();
                $userCRUD->editPseudo($_POST['newPseudo']);
                break;
            case 'editMdp':
                $userCRUD = new UserCRUD();
                $userCRUD->editMdp($_POST['oldMdp'],$_POST['newMdp']);
                break;
            case 'verifUser':
                $userCRUD = new UserCRUD();
                $userCRUD->verifUser();
                break;
            case 'logOut':
                $userCRUD = new UserCRUD();
                $userCRUD->logOut();
                break;

            case 'addComment':
                if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                    if (!empty($_POST['id']) && !empty($_POST['comment'])) {
                        $commentCRUD = new CommentCRUD();
                        $commentCRUD->addComment($_SESSION['id'], $_POST['id'], $_POST['comment']);
                    } else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                } else {
                    throw new Exception('Vous devez vous connecter pour ajouter un commentaire');
                }
                break;
            case 'deleteComment':
                $commentCRUD = new CommentCRUD();
                $commentCRUD->deleteComment($_GET['id'], $_GET['article']);
                break;
            case 'deleteAdminComment':
                $commentCRUD = new CommentCRUD();
                $commentCRUD->deleteAdminComment($_GET['id'], $_GET['article']);
                break;

            case 'reporting':
                $commentCRUD = new CommentCRUD();
                $commentCRUD->reporting($_GET['id'], $_GET['article']);
                break;
            case 'removeReport':
                $commentCRUD = new CommentCRUD();
                $commentCRUD->removeReport($_GET['id']);
                break;

            default:
                $frontend = new Frontend();
                $frontend->articlesListView();
                break;
        }
    }
}