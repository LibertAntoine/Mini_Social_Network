<?php 

require_once('controller/Frontend.php');
require_once('controller/Backend.php');
require_once('controller/CRUD/UserCRUD.php');
require_once('controller/CRUD/GroupCRUD.php');
require_once('controller/CRUD/PostCRUD.php');
require_once('controller/CRUD/CommentCRUD.php');
require_once('controller/CRUD/LinkFriendCRUD.php');
require_once('controller/CRUD/LinkGroupCRUD.php');

class Action
{
    
    function __construct($action)
    {
        $this->$action(); 
    }


                public function mainPage($message = NULL) {
                    $frontend = new Frontend('mainPageView');
                    $frontend->setMessage($message);
                }
                public function group($message = NULL) {
                    if (isset($_GET['id'])) {
                        $frontend = new Frontend('groupView', intval(htmlspecialchars($_GET['id'])));
                        $frontend->setMessage($message);

                    } else {
                        throw new Exception('Mauvaise référence au groupe lol.');
                    }
                }    

                public function login($message = NULL) {
                    if (!isset($_SESSION['id'])) {
                        $backend = new Backend('loginView');
                        $backend->setMessage($message);
                    } else {
                        header('Location: index.php?action=mainPage');
                    }
                }
                public function inscription($message = NULL) {
                    if (!isset($_SESSION['id'])) {
                        $backend = new Backend('inscriptionView');
                        $backend->setMessage($message);
                    } else {
                        header('Location: index.php?action=mainPage');
                    }
                }
                public function backOffice($message = NULL) {
                    if (isset($_SESSION['id'])) {
                        $backend = new Backend('backOfficeView');
                        $backend->setMessage($message);
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }
                public function myGroup($message = NULL) {
                    if (isset($_SESSION['id'])) {
                        $backend = new Backend('myGroupView');
                        $backend->setMessage($message);
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }
                public function myFriend($message = NULL) {
                    if (isset($_SESSION['id'])) {
                        $backend = new Backend('myFriendView');
                        $backend->setMessage($message);
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }
                public function newGroup($message = NULL) {
                    if (isset($_SESSION['id'])) {
                        $backend = new Backend('newGroupView');
                        $backend->setMessage($message);
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }
                public function addGroup() {
                    if (isset($_SESSION['id'], $_POST['titleGroup'], $_POST['status'], $_POST['listFriend'])) {
                        if(strlen($_POST['titleGroup']) <= 240 && strlen($_POST['titleGroup']) >= 4) {
                            $groupCRUD = new GroupCRUD();
                            if(!$groupCRUD->read($_POST['titleGroup'])) { 
                                if(isset($_FILES['couvPicture'])) {
                                    if ($_FILES['couvPicture']['size'] > 4000000) {
                                        $backend = new Backend('newGroupView', 'La taille du fichier dépasse 4Mo');
                                        exit;
                                    } 
                                }
                                $memberArray = [$_SESSION['id'] => 'admin'];
                                $memberArray[$_POST['listFriend']] = 'member';
                                $group = $groupCRUD->add($_POST['titleGroup'], $_POST['status'], $_FILES['couvPicture']['type'], $memberArray);
                                if (isset($_FILES['couvPicture'])) {
                                    move_uploaded_file($_FILES['couvPicture']['tmp_name'], 'public/pictures/couv/'. $group->getId(). '.' . substr($_FILES['couvPicture']['type'], 6));
                                }
                                if ($group) {
                                    header('Location: index.php?action=group&id=' . $group->getId());
                                } else {
                                    throw new Exception('Impossible d\'enregister le groupe');
                                } 
                            } else {
                                $this->newGroup('Le nom de groupe existe déjà, merci d\'en choisir un autre');
                            }
                        } else {
                            $this->newGroup('newGroupView', 'Merci de renseigner un titre entre 5 et 240 caractères');
                        }
                    } else {
                       $this->newGroup('newGroupView', 'Merci de renseigner tous les champs obligatoires.');
                    }
                }

                public function addPost() {
                    if (isset($_SESSION['id'], $_POST['title'], $_POST['content'], $_POST['groupId'])) {
                        if(strlen($_POST['title']) <= 240 && strlen($_POST['title']) >= 4) {
                            $postCRUD = new PostCRUD();
                            if(!$postCRUD->read($_POST['title'])) { 
                                $post = $postCRUD->add($_POST['title'], $_POST['content'], $_POST['groupId'], $_SESSION['id']);
                                if ($post) {
                                    header('Location: index.php?action=group&id=' . intval($_POST['groupId']));
                                } else {
                                    throw new Exception('Impossible d\'enregister le post');
                                } 
                            } else {
                                $this->group('Le nom de post existe déjà, merci d\'en choisir un autre');
                            }
                        } else {
                            $this->group('Merci de renseigner un titre entre 5 et 240 caractères');
                        }
                    } else {
                       $this->group('Merci de renseigner tous les champs obligatoires.');
                    }
                }

                public function addComment() {
                    if (isset($_SESSION['id'], $_POST['content'], $_POST['postId'], $_POST['groupId'])) {

                        if(strlen($_POST['content']) >= 1) {

                            $commentCRUD = new CommentCRUD();                          
                            $comment = $commentCRUD->add($_SESSION['id'], $_POST['postId'], $_POST['content']);
                            if ($comment) {
								echo $_POST['groupId'];
                                header('Location: index.php?action=group&id=' . intval($_POST['groupId']));
                            } else {
                                throw new Exception('Impossible d\'enregister le commentaire');
                            } 
                        } else {
                            $this->group('Le commentaire est vide');
                        }
                    } else {
                       $this->group('Merci de renseigner tous les champs obligatoires.');
                    }
                }

                public function deleteComment() {

                    if (isset($_GET['commentId'], $_GET['groupId'])) {

                    	$commentCRUD = new CommentCRUD();
                    	$comment = $commentCRUD->read(intval($_GET['commentId']));
                        if($comment) {
                            $postId = $comment->getArticleId();
                            $userId = $comment->getUserId();                    
                            $delete = $commentCRUD->delete($_GET['commentId'], $postId, $userId);
                            if ($comment) {
                                header('Location: index.php?action=group&id=' . intval($_GET['groupId']));
                            } else {
                                throw new Exception('Impossible d\'enregister le commentaire');
                            } 
                        } else {
                            $this->group('Le commentaire n\'existe pas');
                        }
                    } else {
                       throw new Exception('Aucun commentaire assigné');
                    }
                }

                public function addUser() {
                    if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {    
                        if (strlen($_POST['pseudo']) < 26 && strlen($_POST['pseudo']) > 7 ) {
                            if (strlen($_POST['mdp']) < 26 && strlen($_POST['mdp']) > 7 ) {
                                $userCRUD = new UserCRUD();
                                if (!$userCRUD->read(htmlspecialchars($_POST['pseudo']))) {
                                    $user = $userCRUD->add(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['mdp']));
                                    if ($user) {
                                    $_SESSION['pseudo'] = $user->getPseudo();
                                    $_SESSION['id'] = $user->getId();
                                    header('Location: index.php?action=mainPage');
                                    } else {
                                        throw new Exception('Impossible d\'enregister l\'utilisateur');
                                    }
                                } else {
                                   $this->inscription('Le nom d\'utilisateur existe déjà, merci d\'en choisir un autre');
                                }
                            } else {
                                $this->inscription('Le mot de passe renseigné n\'est pas valide.');
                            }
                        } else {
                            $this->inscription('Le nom d\'utilisateur renseigné n\'est pas valide.');
                        }
                    } else {
                        $this->inscription('Merci de renseigner tous les champs.');
                    }
                }

                public function deleteUser() {
                    if (isset($_SESSION['id'])) {    
                    	$userCRUD = new UserCRUD();
                    	$delete = $userCRUD->delete($_SESSION['id']);
                    	if ($delete === 'ok') {
                    		header('Location: index.php?action=MainPage');
                    	}	
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }

                public function addFriend() {
                    if (isset($_GET['id']) && isset($_SESSION['id'])) {    
                        if ($_GET['id'] != $_SESSION['id']) {
                                $userCRUD = new UserCRUD();
                                if (!$userCRUD->read(htmlspecialchars($_GET['id']))) {
                                	$linkFriendCRUD = new LinkFriendCRUD();
                                    $friend = $linkFriendCRUD->add(intval($_SESSION['id']), intval($_GET['id']));
                                    if ($friend) {
                                    header('Location: index.php?action=myFriend');
                                    } else {
                                        throw new Exception('Impossible d\'enregister l\'utilisateur');
                                    }
                                } else {
                                   $this->inscription('Le nom d\'utilisateur existe déjà, merci d\'en choisir un autre');
                                }
                        } else {
                            throw new Exception('Mauvaise donnée de session.');
                        }
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }

                public function deleteFriend() {
                    if (isset($_GET['id']) && isset($_SESSION['id'])) {    
                        if ($_GET['id'] != $_SESSION['id']) {
                                $linkFriendCRUD = new LinkFriendCRUD();
                                if ($linkFriendCRUD->readLink(intval($_SESSION['id']), intval($_GET['id']))) {
                                   	$friend = $linkFriendCRUD->delete(intval($_GET['id']));
                                    if ($friend) {
                                    header('Location: index.php?action=MyFriend');
                                    } else {
                                        throw new Exception('Impossible d\'enregister l\'utilisateur');
                                    }
                                } else {
                                   throw new Exception('L\'utilisateur n\'a pas de lien avec cet id');
                                }
                        } else {
                            throw new Exception('Mauvaise donnée de session.');
                        }
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }

                public function deleteLinkGroup() {
                    if (isset($_GET['id']) && isset($_SESSION['id'])) {    
                            $linkGroupCRUD = new LinkGroupCRUD();
                            if ($linkGroupCRUD->readLink(intval($_SESSION['id']), intval($_GET['id']))) {
                                $link = $linkGroupCRUD->delete(intval($_GET['id']));
                                if ($link) {
                                 	header('Location: index.php?action=MyGroup');
                                } else {
                                    throw new Exception('Impossible de supprimer l\'affiliation au groupe');
                                }
                            } else {
                               	throw new Exception('L\'utilisateur n\'a pas de lien avec ce groupe');
                            }
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }

                public function verifUser() {
                    if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {    
                        if (strlen($_POST['pseudo']) < 26 && strlen($_POST['pseudo']) > 0 ) {
                            if (strlen($_POST['mdp']) < 26 && strlen($_POST['mdp']) > 0 ) {
                                $userCRUD = new UserCRUD();
                                $user = $userCRUD->read(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['mdp']));
                                if ($user) {
                                	if ($user->getAcompte() === 'on') {
                                    	$_SESSION['pseudo'] = $user->getPseudo();
                                    	$_SESSION['id'] = $user->getId();
                                    	header('Location: index.php?action=mainPage');
                                	} else {
                                		$this->login('Le compte a été désactivé');
                                	}                               
                                } else {
                                    $this->login('Les identifiants fournis ne correspondent à aucun compte existant.');
                                }
                            } else {
                                $this->login('loginView', 'Le mot de passe renseigné n\'est pas valide.');
                            }
                        } else {
                            $this->login('loginView', 'Le nom d\'utilisateur renseigné n\'est pas valide.');
                        }
                    } else {
                        $this->login('loginView', 'Merci de renseigner tous les champs.');
                    }
                }
                public function logOut() {
                    $userCRUD = new UserCRUD();
                    $userCRUD->logOut();
                    header('Location: index.php?action=mainPage');
                }
}