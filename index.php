<?php 

require('controller/Frontend.php');
require('controller/Backend.php');
require('controller/CRUD/UserCRUD.php');
require('controller/CRUD/GroupCRUD.php');

try {
    if (isset($_GET['action'])) {
        $index = new Action($_GET['action']);
    } else {
        $frontend = new Frontend('mainPageView');
    }  
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}



class Action
{
    
    function __construct($action)
    {
        $this->go($action); 
    }


public function go($action) {
        switch ($action) {

            case 'mainPage':
                $frontend = new Frontend('mainPageView');
                break;

            case 'login':
                $backend = new Backend('loginView');
                break;
            case 'inscription':
                $backend = new Backend('inscriptionView');
                break;
            case 'backOffice':
                if (isset($_SESSION['id'])) {
                    $backend = new Backend('backOfficeView');
                } else {
                    throw new Exception('Absence de donnée de session.');
                }
                break;
            case 'newGroup':
                if (isset($_SESSION['id'])) {
                    $backend = new Backend('newGroupView');
                } else {
                    throw new Exception('Absence de donnée de session.');
                }
                break;
            case 'createGroup':
                if (isset($_SESSION['id'], $_POST['titleGroup'], $_POST['status'], $_POST['listFriend'])) {
                    if(strlen($_POST['titleGroup']) < 240 && strlen($_POST['titleGroup']) > 0) {
                        if(isset($_FILES['couvPicture'])) {
                            if ($_FILES['couvPicture'] > 4000000) {
                               $backend = new Backend('newGroupView', 'La taille du fichier dépasse 4Mo');
                                exit;
                            } else {
                                move_uploaded_file()
                            }   
                        }
                            $groupCRUD = new GroupCRUD();
                            $memberArray = [$_SESSION['id'] => 'admin'];
                            $memberArray[$_POST['listFriend']] = 'member';
                            $group = $groupCRUD->add($_POST['titleGroup'], $_POST['status'], $_FILES['couvPicture']['name'], $memberArray);
                            if($group === 'exist') {
                                $backend = new Backend('newGroupView', 'Ce nom de groupe existe déjà');
                            } elseif ($group) {
                                $frontend = new Frontend('groupView');
                            } else {
                                throw new Exception('Impossible d\'enregister le groupe');
                            }
                        }
                    }
                } else {
                   $backend = new Backend('newGroupView', 'Merci de reseigner tous les champs obligatoires.');
                }
                break;
            



            case 'addUser':
                if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {    
                    if (strlen($_POST['pseudo']) < 26 && strlen($_POST['pseudo']) > 7 ) {
                        if (strlen($_POST['mdp']) < 26 && strlen($_POST['mdp']) > 7 ) {
                            $userCRUD = new UserCRUD();
                            $user = $userCRUD->add(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['mdp']));
                            if ($user === 'exist') {
                                $backend = new Backend('inscriptionView', 'Le nom d\'utilisateur existe déjà, merci d\'en choisir un autre');
                            } elseif ($user) {
                                $_SESSION['pseudo'] = $user->getPseudo();
                                $_SESSION['id'] = $user->getId();
                                $frontend = new Frontend('mainPageView');
                            } else {
                                throw new Exception('Impossible d\'enregister l\'utilisateur');
                            }
                        } else {
                            $backend = new Backend('inscriptionView', 'Le mot de passe renseigné n\'est pas valide.');
                        }
                    } else {
                        $backend = new Backend('inscriptionView', 'Le nom d\'utilisateur renseigné n\'est pas valide.');
                    }
                } else {
                    $backend = new Backend('inscriptionView', 'Merci de renseigner tous les champs.');
                }
            break;
            case 'verifUser':
                if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {    
                    if (strlen($_POST['pseudo']) < 26 && strlen($_POST['pseudo']) > 0 ) {
                        if (strlen($_POST['mdp']) < 26 && strlen($_POST['mdp']) > 0 ) {
                            $userCRUD = new UserCRUD();
                            $user = $userCRUD->exist(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['mdp']));
                            if ($user) {
                                $_SESSION['pseudo'] = $user->getPseudo();
                                $_SESSION['id'] = $user->getId();
                                $frontend = new Frontend('mainPageView');
                            } else {
                                $backend = new Backend('loginView', 'Les identifiants fournis ne correspondent à aucun compte existant.');
                            }
                        } else {
                            $backend = new Backend('loginView', 'Le mot de passe renseigné n\'est pas valide.');
                        }
                    } else {
                        $backend = new Backend('loginView', 'Le nom d\'utilisateur renseigné n\'est pas valide.');
                    }
                } else {
                    $backend = new Backend('loginView', 'Merci de renseigner tous les champs.');
                }
            break;
            case 'logOut':
                $userCRUD = new UserCRUD();
                $userCRUD->logOut();
                $frontend = new Frontend('mainPageView');
            break;


            default:
                $frontend = new Frontend('mainPageView');
                break;

}

}
}










/*

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

*/

?>