<?php 

require_once('controller/Frontend.php');
require_once('controller/Backend.php');
require_once('controller/Includes.php');
require_once('controller/CRUD/UserCRUD.php');
require_once('controller/CRUD/GroupCRUD.php');
require_once('controller/CRUD/PostCRUD.php');
require_once('controller/CRUD/CommentCRUD.php');
require_once('controller/CRUD/LinkFriendCRUD.php');
require_once('controller/CRUD/LinkGroupCRUD.php');
require_once('controller/CRUD/LinkReportingCRUD.php');

class Action
{
    
    function __construct($action)
    {

        if ($action != 'addGroup' AND $action != 'newGroupMember') {
            $_SESSION['admin'] = NULL;
            $_SESSION['author'] = NULL;
            $_SESSION['commenter'] = NULL;
            $_SESSION['viewer'] = NULL;
            $_SESSION['description'] = NULL;
            $_SESSION['titleGroup'] = NULL;
            $_SESSION['public'] = NULL;
            if (isset($_SESSION['couvPicture'])) { 
                unlink($_SESSION['couvPicture']);
                $_SESSION['couvPicture'] = NULL;
            }
        }

        $this->$action(); 
    }


                public function mainPage($message = NULL) {
                    $frontend = new Frontend('mainPageView');
                    $frontend->setMessage($message);
                }
                public function group($message = NULL) {
                    if (isset($_GET['id'], $_SESSION['id'])) {
                        $linkGroupCRUD = new LinkGroupCRUD();
                        if ($linkGroupCRUD->readLink($_SESSION['id'], $_GET['id'])) {
                            $frontend = new Frontend('groupView', intval(htmlspecialchars($_GET['id'])));
                            $frontend->setMessage($message);
                        } else {
                            $frontend = new Frontend('mainPageView');
                            $frontend->setMessage($message);
                        }
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
                public function newGroupMember($message = NULL) {
                    if (isset($_POST['titleGroup'], $_POST['public'])) {
                        $_SESSION['titleGroup'] = $_POST['titleGroup'];
                        $_SESSION['public'] = $_POST['public'];
                    }
                    if (isset($_POST['description'])) {
                        $_SESSION['description'] = $_POST['description'];
                    }
                    if (isset($_FILES['couvPicture']) AND $_FILES['couvPicture']['size'] !== 0) {
                        if ($_FILES['couvPicture']['size'] > 4000000) {
                            $backend = new Backend('newGroupView', 'La taille du fichier dépasse 4Mo');
                            exit;
                        }
                        $_SESSION['couvPicture'] = substr($_FILES['couvPicture']['type'], 6);
                        move_uploaded_file($_FILES['couvPicture']['tmp_name'], 'public/pictures/couv/'. str_replace(' ', '_', htmlspecialchars($_POST['titleGroup'])) . '.' . substr($_FILES['couvPicture']['type'], 6));
                    }
                    if (isset($_SESSION['id'])) {
                        $backend = new Backend('newGroupMemberView');
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
                public function adminGroup($message = NULL) {
                    if (isset($_SESSION['id'], $_GET['id'])) {
                        $linkGroupCRUD = new LinkGroupCRUD();
                        if ($linkGroupCRUD->readLink($_SESSION['id'], $_GET['id']) === 1) {
                            $backend = new Backend('adminGroupView', intval($_GET['id']));
                            $backend->setMessage($message); 
                        } else {
                            $frontend = new Frontend('mainPageView');
                            $frontend->setMessage($message);
                        }                                                                           
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }

                public function addGroup() {
                    if (isset($_SESSION['id'], $_SESSION['titleGroup'], $_SESSION['public'])) {
                        if(strlen($_SESSION['titleGroup']) <= 240 && strlen($_SESSION['titleGroup']) >= 4) {
                            $groupCRUD = new GroupCRUD();
                            $memberArray = [];
                            if ($_SESSION['admin'] != NULL) {
                                $memberArray[1] = $_SESSION['admin'];
                            }
                            if ($_SESSION['author'] != NULL) {
                                $memberArray[2] = $_SESSION['author'];
                            }
                            if ($_SESSION['commenter'] != NULL) {
                                $memberArray[3] = $_SESSION['commenter'];
                            }
                            if ($_SESSION['viewer'] != NULL) {
                                $memberArray[4] = $_SESSION['viewer'];
                            }
                            if(!$groupCRUD->read($_SESSION['titleGroup'])) { 
                                $group = $groupCRUD->add(htmlspecialchars($_SESSION['titleGroup']), intval($_SESSION['public']), htmlspecialchars($_SESSION['description']), $_SESSION['couvPicture'], $_SESSION['id'], $memberArray);
                                if ($group) {
                                  $_SESSION['couvPicture'] = NULL;  
                                  header('Location: index.php?action=group&id=' . $group->getId());
                                } else {
                                    throw new Exception('Impossible d\'enregister le groupe');
                                } 
                            } else {
                                throw new Exception('Impossible d\'enregister le groupe2');
                            }
                        } else {
                            throw new Exception('Impossible d\'enregister le groupe3');
                        }
                    } else {
                       throw new Exception('Impossible d\'enregister le groupe4');
                    }
                }

                public function updateGroup() {
                    if (isset($_SESSION['id'], $_POST['titleGroup'], $_POST['description'], $_POST['groupId']) ) {
                        if(strlen($_POST['titleGroup']) <= 240 && strlen($_POST['titleGroup']) >= 4) {
                            $groupCRUD = new GroupCRUD();
                            $group = $groupCRUD->read($_SESSION['titleGroup']);
                            if(!$group OR $group->getId() === intval($_POST['groupId'])) { 
                                $group = $groupCRUD->update(intval($_POST['groupId']), htmlspecialchars($_POST['titleGroup']), htmlspecialchars($_POST['description']));
                                if ($group) {  
                                  header('Location: '. $_SESSION['page']);
                                } else {
                                    throw new Exception('Impossible d\'enregister le groupe');
                                } 
                            } else {
                                throw new Exception('Impossible d\'enregister le groupe2');
                            }
                        } else {
                            throw new Exception('Impossible d\'enregister le groupe3');
                        }
                    } else {
                       throw new Exception('Aucune information fournit');
                    }
                }

                public function changePublic() {
                    if (isset($_SESSION['id'], $_GET['id'])) {
                            $groupCRUD = new GroupCRUD();
                            $group = $groupCRUD->read(intval($_GET['id']));
                            if($group instanceof Group) { 
                                $newGroup = $groupCRUD->updatePublic($group);
                                if ($newGroup instanceof Group) {  
                                  header('Location: '. $_SESSION['page']);
                                } else {
                                    throw new Exception('Impossible d\'enregister le groupe');
                                } 
                            } else {
                                throw new Exception('Impossible d\'enregister le groupe2');
                            }
                    } else {
                       throw new Exception('Aucune information fournit');
                    }
                }

                public function deleteGroup() {
                    if (isset($_GET['groupId'])) {
                        $groupCRUD = new GroupCRUD();
                        if($groupCRUD->read(intval($_GET['groupId']))) {                  
                            $delete = $groupCRUD->delete(intval($_GET['groupId']));
                            if ($delete) {
                                header('Location: index.php?action=myGroup');
                            } else {
                                throw new Exception('Impossible de supprimer le groupe');
                            } 
                        } else {
                            $this->group('Le groupe n\'existe pas');
                        }
                    } else {
                       throw new Exception('Aucune groupe assignée');
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

                public function editPost() {
                    if (isset($_SESSION['id'], $_POST['content'], $_POST['title'], $_POST['postId'])) {
                        if(strlen($_POST['title']) <= 240 && strlen($_POST['title']) >= 4) {
                            $postCRUD = new PostCRUD();
                            $postId = $postCRUD->read(intval($_POST['postId']));
                            if($postId) {
                                if($postId->getUserId() == $_SESSION['id']) {
                                    $postTitle = $postCRUD->read($_POST['title']);
                                    if(!$postTitle OR $postTitle == $postId) { 
                                        $post = $postCRUD->update($_POST['title'], $_POST['content'], intval($_POST['postId']));
                                        if ($post) {
                                            echo 'ok';
                                        } else {
                                            echo 'Erreur : impossible de modifier l\'article pour le moment';
                                        } 
                                    } else {
                                        echo 'Le nouveau nom de post existe déjà, merci d\'en choisir un autre';
                                    }
                                } else {
                                    echo 'Action non autorisé';
                                }
                            } else {
                                echo 'Le post désigné n\'existe pas ou plus';
                            }
                        } else {
                            echo 'Le titre doit être compris entre 4 et 240 caractères.';
                        }
                    } else {
                       echo 'Merci de renseigner tous les champs obligatoires.';
                    }
                }

				public function deletePost() {
                    if (isset($_GET['postId'])) {
                    	$postCRUD = new PostCRUD();
                        if($postCRUD->read(intval($_GET['postId']))) {                  
                            $delete = $postCRUD->delete(intval($_GET['postId']));
                            if ($delete) {
                                header('Location: index.php?action=group&id=' . $delete);
                            } else {
                                throw new Exception('Impossible de supprimer la publication');
                            } 
                        } else {
                            $this->group('La publication n\'existe pas');
                        }
                    } else {
                       throw new Exception('Aucune publication assignée');
                    }
                }

                public function addComment() {
                    if (isset($_SESSION['id'], $_POST['content'], $_POST['postId'], $_POST['groupId'])) {
                        if(strlen($_POST['content']) >= 1) {
                            $commentCRUD = new CommentCRUD();                          
                            $comment = $commentCRUD->add($_SESSION['id'], $_POST['postId'], $_POST['groupId'], $_POST['content']);
                            if ($comment) {
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
                    if (isset($_GET['commentId'])) {
                    	$commentCRUD = new CommentCRUD();
                        $comment = $commentCRUD->read(intval($_GET['commentId']));
                        if($comment) {                   
                            $delete = $commentCRUD->delete(intval($_GET['commentId']));
                            if ($delete) {
                                echo $delete;
                                header('Location: index.php?action=group&id=' . $comment->getGroupId());
                            } else {
                                throw new Exception('Impossible d\'enregister le commentaire');
                            } 
                        } else {
                            throw new Exception('Le commentaire n\'existe pas commentaire');
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
                                if ($userCRUD->read(intval($_GET['id']))) {
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


                public function addLinkGroup() {
                    if (isset($_SESSION['id'], $_POST['friend'], $_POST['groupId'], $_POST['status'])) {
                        $linkGroupCRUD = new LinkGroupCRUD();
                        if ($linkGroupCRUD->readLink(intval($_SESSION['id']), intval($_POST['groupId'])) === 1) {
                            $linkGroupCRUD->add(intval($_POST['friend']), intval($_POST['groupId']), intval($_POST['status']));
                            header('Location: '. $_SESSION['page']);
                        } else {
                            throw new Exception('Accès non authorisé');
                        }                                                                           
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }

                public function updateStatus() {
                    if (isset($_SESSION['id'], $_POST['id'], $_POST['status'])) {
                        $linkGroupCRUD = new LinkGroupCRUD();
                        if ($linkGroupCRUD->readLink(intval($_SESSION['id']), intval($_POST['id'])) <= intval($_POST['status'])) {
                            $member = $linkGroupCRUD->read(intval($_SESSION['id']), intval($_POST['id']));
                            $linkGroupCRUD->update($member, intval($_POST['status']));
                            echo 'ok'; 
                        } else {
                            echo 'Opération non authorisée.';
                        }                                                   
                    } else {
                        echo 'Mauvaise données transmises.';
                    }
                }

                public function updateLinkGroup() {
                    if (isset($_SESSION['id'], $_GET['id'])) {
                        $linkGroupCRUD = new LinkGroupCRUD();
                        if ($linkGroupCRUD->readLink(intval($_SESSION['id']), intval($_GET['id'])) === 1) {
                            $members = $linkGroupCRUD->readMembers(intval($_GET['id']));
                            foreach ($members as $memberId => $member) {
                                $newMember = $_POST[$memberId];
                                if ($newMember != $member->getStatusInt()) {
                                    $linkGroupCRUD->update($member, $newMember);
                                }
                            } 
                            header('Location: index.php?action=group&id='. $_GET['id']);
                        } else {
                            throw new Exception('Accès non authorisé');
                        }                                                                           
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }


                public function deleteLinkGroup() {
                    if (isset( $_SESSION['id'], $_GET['id'], $_GET['userId'])) {    
                            $linkGroupCRUD = new LinkGroupCRUD();
                            if ($linkGroupCRUD->readLink(intval($_SESSION['id']), intval($_GET['id']))) {
                                $link = $linkGroupCRUD->delete(intval($_GET['userId']), intval($_GET['id']));
                                if ($link) {
                                 	header('Location: ' . $_SESSION['page']);
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

                public function addReport() {
                    if (isset($_GET['id'], $_SESSION['id'])) {    
                                $commentCRUD = new CommentCRUD();
                                $comment = $commentCRUD->read(intval($_GET['id']));
                                if ($comment) {
                                    $linkReportingCRUD = new LinkReportingCRUD();
                                    $report = $linkReportingCRUD->add(intval($_SESSION['id']), intval($_GET['id']));
                                    if ($report) {
                                    header('Location: index.php?action=group&id=' . $comment->getGroupId());
                                    } else {
                                        throw new Exception('Impossible d\'enregister le signalement');
                                    }
                                } else {
                                    Exception('Le commentaire n\'existe pas');
                                }
                    } else {
                        throw new Exception('Absence de donnée de session.');
                    }
                }

                public function deleteReport() {
                    if (isset($_GET['id'], $_SESSION['id'])) {    
                                $commentCRUD = new CommentCRUD();
                                $comment = $commentCRUD->read(intval($_GET['id']));
                                if ($comment) {
                                    $linkReportingCRUD = new LinkReportingCRUD();
                                    $delete = $linkReportingCRUD->delete(intval($_GET['id']));
                                    if ($delete) {
                                            header('Location: index.php?action=group&id=' . $comment->getGroupId());
                                    } else {
                                        throw new Exception('Impossible d\'enregister le signalement');
                                    }
                                } else {
                                    Exception('Le commentaire n\'existe pas');
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
                                	if ($user->getActif() == "1") {
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