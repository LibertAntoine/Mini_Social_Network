<?php 

    use \controller\Frontend;
    use \controller\Backend;
    use \controller\Includes;
    use \controller\CRUD\GroupCRUD;
    use \controller\CRUD\PostCRUD;
    use \controller\CRUD\CommentCRUD;
    use \controller\CRUD\UserCRUD;
    use \controller\CRUD\LinkGroupCRUD;
    use \controller\CRUD\LinkFriendCRUD;
    use \controller\CRUD\LinkReportingCRUD;

class Action {
 
    function __construct($action) {

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
                $_SESSION['extPicture'] = NULL;
            }
        }
        $this->$action(); 
    }

    public function mainPage() {
        $frontend = new Frontend('mainPageView');
    }

    public function group() {
        if (isset($_GET['id'])) {
            $groupCRUD = new GroupCRUD();
            $group = $groupCRUD->read(intval($_GET['id']));
            if($group) {
                $linkGroupCRUD = new LinkGroupCRUD();
                if ($group->getPublic() == 1 OR $linkGroupCRUD->readLink($_SESSION['id'], intval($_GET['id']))) {
                    $frontend = new Frontend('groupView', intval($_GET['id']));
                } else {
                    throw new Exception('L\'accès à cette page ne vous est pas authorisé.');
                }
            } else {
                throw new Exception('Le groupe désigné n\'existe pas.');
            }
        } else {
            throw new Exception('Erreur : merci de fournir un identifiant de groupe.');
        }
    }    

    public function login() {
        if (!isset($_SESSION['id'])) {
            $backend = new Backend('loginView');
        } else {
            header('Location: index.php?action=mainPage');
        }
    }

    public function inscription() {
        if (!isset($_SESSION['id'])) {
            $backend = new Backend('inscriptionView');
        } else {
            header('Location: index.php?action=mainPage');
        }
    }

    public function backOffice() {
        if (isset($_SESSION['id'])) {
            $backend = new Backend('backOfficeView');
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function myGroup() {
        if (isset($_SESSION['id'])) {
            $backend = new Backend('myGroupView'); 
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function myFriend() {
        if (isset($_SESSION['id'])) {
            $backend = new Backend('myFriendView');
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function adminGroup() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['id'])) {
                $groupCRUD = new GroupCRUD();
                if ($groupCRUD->read(intval($_GET['id']))) {
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($linkGroupCRUD->readLink($_SESSION['id'], intval($_GET['id'])) === 1) {
                        $backend = new Backend('adminGroupView', intval($_GET['id']));
                    } else {
                        throw new Exception('Accès à cette page non-authorisé.');
                    }  
                } else {
                    throw new Exception('Le groupe désigné n\'existe pas.');
                }  
            } else {
                throw new Exception('Absence de donnée de groupe.');
            }                                                                     
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function newGroup() {
        if (isset($_SESSION['id'])) {
            $backend = new Backend('newGroupView');
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function newGroupMember() {
        if (isset($_SESSION['id'])) {
            if (isset($_POST['titleGroup'], $_POST['public'])) {
                if (strlen($_POST['titleGroup']) >= 4 AND strlen($_POST['titleGroup']) <= 240) {
                    $_SESSION['titleGroup'] = $_POST['titleGroup'];
                    $_SESSION['public'] = $_POST['public'];
                } else {
                    throw new Exception('Le titre du groupe doit être compris entre 4 et 240 caractères.');
                }
            }
            if (isset($_POST['description'])) {
                if (strlen($_POST['titleGroup'] <= 2000)) {
                   $_SESSION['description'] = $_POST['description'];
                } else {
                    throw new Exception('La description ne doit pas excéder 2000 caractères.');
                }
            }
            $_SESSION['extPicture'] = NULL;
            if (isset($_FILES['couvPicture']) AND $_FILES['couvPicture']['size'] !== 0) {
                if ($_FILES['couvPicture']['size'] < 4000000) {
                    $_SESSION['extPicture'] = substr($_FILES['couvPicture']['type'], 6);
                    $_SESSION['couvPicture'] = 'public/pictures/couv/'. str_replace(' ', '_', htmlspecialchars($_POST['titleGroup'])) . '.' . substr($_FILES['couvPicture']['type'], 6);
                    move_uploaded_file($_FILES['couvPicture']['tmp_name'], $_SESSION['couvPicture']);
                } else {
                    throw new Exception('Le fichier de l\'image de couverture ne doit pas excerder 4 Mo.');
                }
            }
            if (isset($_SESSION['titleGroup'], $_SESSION['public'])) {
                $backend = new Backend('newGroupMemberView');
            } else {
                throw new Exception('Absence d\'information de titre et/ou de statut de groupe.');
            }
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function addGroup() {
        if (isset($_SESSION['id'], $_SESSION['titleGroup'], $_SESSION['public'])) {
            $groupCRUD = new GroupCRUD();
            if(!$groupCRUD->read($_SESSION['titleGroup'])) { 
                    $group = $groupCRUD->add(htmlspecialchars($_SESSION['titleGroup']), intval($_SESSION['public']), htmlspecialchars($_SESSION['description']), $_SESSION['extPicture'], $_SESSION['id']);
                    if ($group) {
                        $_SESSION['couvPicture'] = NULL;
                        header('Location: index.php?action=group&id=' . $group->getId());
                    } else {
                        throw new Exception('Impossible d\'enregister le groupe');
                    } 
            } else {
                throw new Exception('Ce titre de groupe existe déjà, merci d\'en renseigner un autre');
            }
        } else {
           throw new Exception('Absence de donnée de session.');
        }
    }

    public function updateGroup() {
        if (isset($_SESSION['id'])) {
            if (isset($_POST['titleGroup'], $_POST['description'], $_POST['groupId'])) {
                $groupCRUD = new GroupCRUD();
                if ($groupCRUD->read(intval($_POST['groupId']))) {
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($linkGroupCRUD->readLink($_SESSION['id'], intval($_POST['groupId'])) === 1) {
                        if(!$groupCRUD->read($_POST['titleGroup'])) { 
                            if(strlen($_POST['titleGroup']) >= 4 && strlen($_POST['titleGroup']) <= 240) {
                                if(strlen($_POST['description']) <= 2000) {
                                    $groupCRUD = new GroupCRUD();
                                    $group = $groupCRUD->read(htmlspecialchars($_SESSION['titleGroup']));
                                    if(!$group OR $group->getId() === intval($_POST['groupId'])) { 
                                        $group = $groupCRUD->update(intval($_POST['groupId']), htmlspecialchars($_POST['titleGroup']), htmlspecialchars($_POST['description']));
                                        header('Location: '. $_SESSION['page']); 
                                    } else {
                                        throw new Exception('Le titre existe déjà pour un autre groupe.');
                                    }       
                                } else {
                                    throw new Exception('La description du groupe ne doit pas excéder 2000 caractères.');
                                }     
                            } else {
                                throw new Exception('Le titre du groupe doit être compris entre 4 et 240 caractères.');
                            }
                        } else {
                                throw new Exception('Ce titre de groupe existe déjà, merci d\'en renseigner un autre');
                        }
                    } else {
                        throw new Exception('Opération non-authorisé : niveau d\'accès insuffisant.');
                    }
                } else {
                    throw new Exception('Le groupe désigné n\'existe pas.');
                }
            } else {
                throw new Exception('Absence des données liées au formulaire.');
            }
        } else {
           throw new Exception('Absence de donnée de session.');
        }
    }

    public function changePublic() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['id'])) {
                $groupCRUD = new GroupCRUD();
                $group = $groupCRUD->read(intval($_GET['id']));
                if($group) { 
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($linkGroupCRUD->readLink($_SESSION['id'], intval($_GET['id'])) === 1) {
                        $newGroup = $groupCRUD->updatePublic($group);
                        header('Location: '. $_SESSION['page']);
                    } else {
                        throw new Exception('Opération non-authorisé : niveau d\'accès insuffisant.');
                    }
                } else {
                    throw new Exception('Le groupe désigné n\'existe pas.');
                }
            } else {
                throw new Exception('Absence de donnée de groupe.');
            }
        } else {
           throw new Exception('Absence de données de session.');
        }
    }

    public function deleteGroup() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['groupId'])) {
                $groupCRUD = new GroupCRUD();
                if($groupCRUD->read(intval($_GET['groupId']))) { 
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($linkGroupCRUD->readLink($_SESSION['id'], intval($_GET['groupId'])) === 1) {                 
                        $delete = $groupCRUD->delete(intval($_GET['groupId']));
                        header('Location: index.php?action=myGroup');
                    } else {
                        throw new Exception('Opération non-authorisé : niveau d\'accès insuffisant.');
                    } 
                } else {
                    throw new Exception('Le groupe désigné n\'existe pas.');
                }
            } else {
               throw new Exception('Absence de donnée de groupe.');
            }
        } else {
           throw new Exception('Absence de données de session.');
        }
    }

    public function addPost() {
        if (isset($_SESSION['id'])) {
            if (isset($_POST['titlePost'], $_POST['contentPost'], $_POST['groupId'])) {
                $groupCRUD = new GroupCRUD();
                if($groupCRUD->read(intval($_POST['groupId']))) { 
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($linkGroupCRUD->readLink($_SESSION['id'], intval($_POST['groupId'])) <= 2) {                 
                        if(strlen($_POST['titlePost']) >= 4 && strlen($_POST['titlePost']) <= 240) {
                            if(strlen($_POST['contentPost']) <= 20000 && strlen($_POST['contentPost']) >= 1) {
                                $postCRUD = new PostCRUD();
                                $post = $postCRUD->add($_POST['titlePost'], $_POST['contentPost'], $_POST['groupId'], $_SESSION['id']);
                                header('Location: index.php?action=group&id=' . intval($_POST['groupId']));
                            } else {
                                throw new Exception('La contenu du post doit être compris entre 1 et 20 000 caractères.');
                            }     
                        } else {
                            throw new Exception('Le titre du post doit être compris entre 4 et 240 caractères.');
                        }
                    } else {
                        throw new Exception('Opération non-authorisé : niveau d\'accès insuffisant.');
                    } 
                } else {
                    throw new Exception('Le groupe désigné n\'existe pas.');
                }
            } else {
                throw new Exception('Absence des données liées au formulaire.');
            }
        } else {
           throw new Exception('Absence de données de session.');
        }
    }             

    public function editPost() {
        if (isset($_SESSION['id'])) {
            if (isset($_POST['content'], $_POST['title'], $_POST['postId'])) {
                $postCRUD = new PostCRUD();
                $postId = $postCRUD->read(intval($_POST['postId']));
                if($postId) {
                    if(strlen($_POST['title']) <= 240 && strlen($_POST['title']) >= 4) {
                        if(strlen($_POST['content']) <= 20000 && strlen($_POST['content']) >= 1) {
                            if($postId->getUserId() == $_SESSION['id']) {
                                $postTitle = $postCRUD->read(htmlspecialchars($_POST['title']));
                                if(!$postTitle || $postTitle == $postId) {
                                    $postCRUD->update(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['content']), intval($_POST['postId']));
                                    echo 'ok';
                                } else {
                                    echo 'Le nouveau nom de post existe déjà, merci d\'en choisir un autre';
                                }
                            } else {
                                echo 'Action non autorisé';
                            }
                        } else {
                            echo 'Le titre du post doit être compris entre 4 et 240 caractères.';
                        }
                    } else {
                        echo 'Le titre doit être compris entre 4 et 240 caractères.';
                    }
                } else {
                    echo 'Le post que vous cherchez à modifier n\'existe plus, merci d\'actualiser la page.';
                }
            } else {
               echo 'Merci de renseigner un titre et un contenu pour le post.';
            }
        } else {
           echo 'Absence de données de session.';
        }
    }

	public function deletePost() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['postId'])) {
            	$postCRUD = new PostCRUD();
                $post = $postCRUD->read(intval($_GET['postId']));
                if($post) {
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($post->getUserId() == $_SESSION['id'] OR $linkGroupCRUD->readLink($_SESSION['id'], $post->getGroupId()) == 1) {
                        $postCRUD->delete($post->getId());
                        header('Location: index.php?action=group&id=' . $post->getGroupId());
                    } else {
                        throw new Exception('Opération non-authorisé : niveau d\'accès insuffisant.');
                    }
                } else {
                    throw new Exception('La post désignée n\'existe pas');
                }
            } else {
               throw new Exception('Aucune publication assignée');
            }
        } else {
           throw new Exception('Absence de données de session.');
        }
    }

    public function addComment() {
        if (isset($_SESSION['id'])) { 
            if (isset($_POST['content'], $_POST['postId'])) {
                $postCRUD = new PostCRUD();
                $post = $postCRUD->read(intval($_POST['postId']));
                if($post) {
                    if (strlen($_POST['content']) >= 1 && strlen($_POST['content']) <= 500) {
                        $groupCRUD = new GroupCRUD();
                        $linkGroupCRUD = new LinkGroupCRUD();
                        $group = $groupCRUD->read($post->getGroupId());
                        if($group->getPublic() == 1 AND $linkGroupCRUD->readLink($_SESSION['id'], $post->getGroupId()) <= 5) {
                            $commentCRUD = new CommentCRUD();                
                            $commentCRUD->add($_SESSION['id'], intval($_POST['postId']), $post->getGroupId(), htmlspecialchars($_POST['content']));
                                header('Location: index.php?action=group&id=' . $post->getGroupId());

                        } elseif ($group->getPublic() == 0 AND $linkGroupCRUD->readLink($_SESSION['id'], $post->getGroupId()) <= 3) {
                            $commentCRUD = new CommentCRUD();                          
                            $commentCRUD->add($_SESSION['id'], intval($_POST['postId']), $post->getGroupId(), htmlspecialchars($_POST['content']));
                                header('Location: index.php?action=group&id=' . $post->getGroupId());
                        } else {
                            throw new Exception('Opération non-authorisé : niveau d\'accès insuffisant.');
                        }
                    } else {
                        throw new Exception('Le commentaire doit être compris entre 1 et 500 caractères.');
                    }
                } else {
                    throw new Exception('La post n\'existe plus');
                }
            } else {
                throw new Exception('Absence des données liées au formulaire.');
            }
        } else {
            throw new Exception('Absence de données de session.');
        }
    }

    public function deleteComment() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['commentId'])) {
            	$commentCRUD = new CommentCRUD();
                $comment = $commentCRUD->read(intval($_GET['commentId']));
                if($comment) {
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if($comment->getUserId() == $_SESSION['id'] OR $linkGroupCRUD->readLink($_SESSION['id'], $comment->getGroupId()) == 1)  {
                        $commentCRUD->delete(intval($_GET['commentId']));
                        header('Location: '. $_SESSION['page']);
                    } else {
                        throw new Exception('Opération non-authorisé : niveau d\'accès insuffisant.');
                    }
                } else {
                    throw new Exception('Le commentaire n\'existe pas.');
                }
            } else {
               throw new Exception('Aucun commentaire désigné.');
            }
        } else {
           throw new Exception('Absence de données de session.');
        }
    }

    public function addUser() {
        if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {    
            if (strlen($_POST['pseudo']) <= 24 && strlen($_POST['pseudo']) >= 8 ) {
                if (strlen($_POST['mdp']) <= 24 && strlen($_POST['mdp']) >= 8 ) {
                    $userCRUD = new UserCRUD();
                    if (!$userCRUD->read(htmlspecialchars($_POST['pseudo']))) {
                        $user = $userCRUD->add(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['mdp']));
                        $_SESSION['pseudo'] = $user->getPseudo();
                        $_SESSION['id'] = $user->getId();
                        header('Location: index.php?action=mainPage');
                    } else {
                       throw new Exception('Le nom d\'utilisateur existe déjà, merci d\'en choisir un autre');
                    }
                } else {
                    throw new Exception('Le mot de passe renseigné n\'est pas valide.');
                }
            } else {
                throw new Exception('Le nom d\'utilisateur renseigné n\'est pas valide.');
            }
        } else {
            throw new Exception('Absence des données liées au formulaire.');
        }
    }

    public function editPseudo() {
        if (isset($_SESSION['id'])) {
            if (!empty($_POST['newPseudo'])) {
                if(strlen($_POST['newPseudo']) <= 24 && strlen($_POST['newPseudo']) >= 8) {
                    $userCRUD = new UserCRUD();
                    $newUser = $userCRUD->updatePseudo(htmlspecialchars($_POST['newPseudo']));
                    $_SESSION['pseudo'] = htmlspecialchars($_POST['newPseudo']);
                    header('Location: index.php?action=backOffice');
                } else {
                    throw new Exception("L'identifiant doit avoir entre 8 et 25 caractères."); 
                }
            } else {
                throw new Exception("Aucun nouvel identifiant fournit.");
            }
        } else {
            throw new Exception('Absence de session utilisateur.');
        }
    }


    public function editMdp() {
        if (isset($_SESSION['id'])) {
            if (!empty($_POST['oldMdp']) AND !empty($_POST['newMdp'])) {
                if(strlen($_POST['newMdp']) <= 24 && strlen($_POST['newMdp']) >= 8) {
                    $userCRUD = new UserCRUD();
                    $user = $userCRUD->read(htmlspecialchars($_SESSION['pseudo']), htmlspecialchars($_POST['oldMdp']));
                    if ($user != NULL) {
                        $newUser = $userCRUD->updateMdp(htmlspecialchars($_POST['newMdp']));
                        header('Location: index.php?action=backOffice');
                    } else {
                        throw new Exception('Le mot de passe renseigné ne correspond pas à cet utilisateur.');
                    }
                } else {
                    throw new Exception("Le mot de passe doit avoir entre 8 et 25 caractères.");
                }
            } else {
                throw new Exception("Aucun nouveau mot de passe fournit.");
            }
        } else {
            throw new Exception('Absence de session utilisateur.');
        }
    }    

    public function deleteUser() {
        if (isset($_SESSION['id'])) {    
        	$userCRUD = new UserCRUD();
        	$userCRUD->delete($_SESSION['id']);
        	header('Location: index.php?action=MainPage');
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function addFriend() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['id'])) {    
                if ($_GET['id'] != $_SESSION['id']) {
                    $userCRUD = new UserCRUD();
                    if ($userCRUD->read(intval($_GET['id']))) {
                    	$linkFriendCRUD = new LinkFriendCRUD();
                        $linkFriendCRUD->add(intval($_SESSION['id']), intval($_GET['id']));
                        header('Location: index.php?action=myFriend');
                    } else {
                        throw new Exception('L\'ami renseigné ne correspond à aucun profil.');
                    }
                } else {
                    throw new Exception('Mauvaise donnée de session.');
                }
            } else {
                throw new Exception('Ancun ami désigné.');
            }
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function deleteFriend() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['id'])) {    
                if ($_GET['id'] != $_SESSION['id']) {
                    $linkFriendCRUD = new LinkFriendCRUD();
                    if ($linkFriendCRUD->readLink(intval($_SESSION['id']), intval($_GET['id']))) {
                       	$friend = $linkFriendCRUD->delete(intval($_GET['id']));
                        header('Location: index.php?action=MyFriend');
                    } else {
                       throw new Exception('L\'utilisateur n\'a pas de lien avec cet id');
                    }
                } else {
                    throw new Exception('Mauvaise donnée de session.');
                }
            } else {
                throw new Exception('Aucun identifiant renseigné.');
            }
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }


    public function addLinkGroup() {
        if (isset($_SESSION['id'])) {
            if (isset($_POST['friend'], $_POST['groupId'], $_POST['status'])) {
                if (intval($_POST['status']) <= 5 AND intval($_POST['status']) > 0) {
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($linkGroupCRUD->readLink(intval($_SESSION['id']), intval($_POST['groupId'])) === 1) {
                        $linkGroupCRUD->add(intval($_POST['friend']), intval($_POST['groupId']), intval($_POST['status']));
                        header('Location: '. $_SESSION['page']);
                    } else {
                        throw new Exception('Opération non-authorisé : niveau d\'accès insuffisant.');
                    } 
                } else {
                    throw new Exception('Statut renseigné invalide.');
                }                                                                         
            } else {
                throw new Exception('Absence des données liées au formulaire.');
            }
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function suscribe() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['groupId'])) {
                $groupCRUD = new GroupCRUD();
                $group = $groupCRUD->read(intval($_GET['groupId']));
                if($group) {
                    if ($group->getPublic() == 1) {
                        $linkGroupCRUD = new LinkGroupCRUD();
                        if (!$linkGroupCRUD->readLink(intval($_SESSION['id']), intval($_GET['groupId']))) {
                            $linkGroupCRUD->add(intval($_SESSION['id']), intval($_GET['groupId']), 5);
                            header('Location: '. $_SESSION['page']);
                        } else {
                            throw new Exception('Profil déjà lié à ce groupe.');
                        }                                                          
                    } else {
                        throw new Exception('Opération non authorisé : ce groupe n\'est pas publique');
                    } 
                } else {
                    throw new Exception('Le groupe désigné n\'existe pas.');
                }                
            } else {
                throw new Exception('Aucun groupe renseigné.');
            }
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function updateStatus() {
        if (isset($_SESSION['id'])) {
            if (isset($_POST['id'], $_POST['status'])) {
                $groupCRUD = new GroupCRUD();
                $group = $groupCRUD->read(intval($_POST['id']));
                if ($group) {
                    if (intval($_POST['status']) > 0) {
                        $linkGroupCRUD = new LinkGroupCRUD();
                        if ($linkGroupCRUD->readLink(intval($_SESSION['id']), $group->getId()) <= intval($_POST['status'])) {
                            $member = $linkGroupCRUD->read(intval($_SESSION['id']), intval($_POST['id']));
                            $linkGroupCRUD->update($member, intval($_POST['status']));
                            echo 'ok'; 
                        } else {
                            echo 'Opération non-authorisé : niveau d\'accès insuffisant.';
                        } 
                    } else {
                        echo 'Statut renseigné invalide.';
                    }
                } else {
                    echo 'Le groupe désigné n\'existe plus.';
                }                                
            } else {
                echo 'Mauvaise données transmises.';
            }
        } else {
            echo 'Absence de donnée de session.';
        }
    }

    public function updateLinkGroup() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['id'])) {
                $groupCRUD = new GroupCRUD();
                $group = $groupCRUD->read(intval($_GET['id']));
                if ($group) {
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($linkGroupCRUD->readLink(intval($_SESSION['id']), $group->getId()) === 1) {
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
                    throw new Exception('Le groupe renseigné n\'existe pas.');
                }       
            } else {
                throw new Exception('Aucun groupe renseigné.');
            }
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }


    public function deleteLinkGroup() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['id'], $_GET['userId'])) { 
                $groupCRUD = new GroupCRUD();
                $group = $groupCRUD->read(intval($_GET['id']));
                if ($group) {
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($linkGroupCRUD->readLink(intval($_SESSION['id']), $group->getId())) {
                        $linkGroupCRUD->delete(intval($_GET['userId']), $group->getId());
                        if($group->getNbMember() == 0) {
                            $delete = $groupCRUD->delete($group->getId());
                            header('Location: index.php?action=myGroup');
                        } else if($_SESSION['id'] != intval($_GET['userId'])) {
                            header('Location:' . $_SESSION['page']);
                        } else {
                            header('Location:index.php?action=myGroup');
                        }
                    } else {
                       	throw new Exception('L\'utilisateur n\'a pas de lien avec ce groupe');
                    }
                } else {
                    throw new Exception('Le groupe renseigné n\'existe pas.');
                }
            } else {
                throw new Exception('Données renseignés invalides.');
            }
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function unsuscribe() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['groupId'])) {
                $groupCRUD = new GroupCRUD();
                $group = $groupCRUD->read(intval($_GET['groupId']));
                if($group) {
                    if ($group->getPublic() == 1) {
                        $linkGroupCRUD = new LinkGroupCRUD();
                        if ($linkGroupCRUD->readLink(intval($_SESSION['id']), intval($_GET['groupId'])) == 5) {
                            $linkGroupCRUD->delete(intval($_SESSION['id']), intval($_GET['groupId']));
                            header('Location: '. $_SESSION['page']);
                        } else {
                            throw new Exception('Le profil n\'est pas lié à ce groupe en tant que membre');
                        }                                                          
                    } else {
                        throw new Exception('Opération non authorisé : ce groupe n\'est pas publique');
                    }
                } else {
                    throw new Exception('Le groupe renseigné n\'existe pas.');
                }                 
            } else {
                throw new Exception('Aucun groupe renseigné.');
            }
        } else {
                throw new Exception('Absence de donnée de session.');
        }
    }


    public function addReport() {
        if (isset($_SESSION['id'])) {
            if (isset($_GET['id'])) {    
                $commentCRUD = new CommentCRUD();
                $comment = $commentCRUD->read(intval($_GET['id']));
                if ($comment) {
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($linkGroupCRUD->readLink($_SESSION['id'], $comment->getGroupId())) {
                        $linkReportingCRUD = new LinkReportingCRUD();
                        if (!$linkReportingCRUD->readLink($_SESSION['id'], $comment->getId())) {
                            $report = $linkReportingCRUD->add(intval($_SESSION['id']), intval($_GET['id']));
                            header('Location: '. $_SESSION['page']);
                        } else {
                            throw new Exception('Vous avez déjà signalé ce commentaire.');
                        }
                    } else {
                        throw new Exception('Opération non authorisé : le compte n\'est pas lié au groupe');
                    }    
                } else {
                    throw new Exception('Le commentaire n\'existe pas');
                }
            } else {
                throw new Exception('Aucun commentaire renseigné.');
            }
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function deleteReport() {
        if (isset($_SESSION['id'])) {  
            if (isset($_GET['id'])) {  
                $commentCRUD = new CommentCRUD();
                $comment = $commentCRUD->read(intval($_GET['id']));
                if ($comment) {
                    $linkReportingCRUD = new LinkReportingCRUD();
                    if ($linkReportingCRUD->readLink($_SESSION['id'], $comment->getId())) {
                        $linkReportingCRUD->delete($_SESSION['id'], $comment->getId());
                        header('Location: '. $_SESSION['page']);
                    } else {
                        throw new Exception('Le commentaire n\'est actuellement pas signalé');
                    }
                } else {
                    throw new Exception('Le commentaire n\'existe pas');
                }
            } else {
                throw new Exception('Absence de donnée de session.');
            }
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function deleteAllReport() {
        if (isset($_SESSION['id'])) {  
            if (isset($_GET['id'])) {  
                $commentCRUD = new CommentCRUD();
                $comment = $commentCRUD->read(intval($_GET['id']));
                if ($comment) {
                    $linkGroupCRUD = new LinkGroupCRUD();
                    if ($linkGroupCRUD->readLink($_SESSION['id'], $comment->getGroupId()) == 1) {
                        $linkReportingCRUD = new LinkReportingCRUD();
                        $linkReportingCRUD->deleteAll($comment->getId());
                        header('Location: '. $_SESSION['page']);
                    } else {
                        throw new Exception('Opération non authorisé : le compte n\'est pas lié au groupe');
                    }
                } else {
                    throw new Exception('Le commentaire n\'existe pas');
                }
            } else {
                throw new Exception('Absence de donnée de session.');
            }
        } else {
            throw new Exception('Absence de donnée de session.');
        }
    }

    public function verifUser() {
        if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {    
            if (strlen($_POST['pseudo']) <= 24 && strlen($_POST['pseudo']) > 8 ) {
                if (strlen($_POST['mdp']) <= 24 && strlen($_POST['mdp']) > 8 ) {
                    $userCRUD = new UserCRUD();
                    $user = $userCRUD->read(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['mdp']));
                    if ($user) {
                    	if ($user->getActif() == "1") {
                        	$_SESSION['pseudo'] = $user->getPseudo();
                        	$_SESSION['id'] = $user->getId();
                        	header('Location: index.php?action=mainPage');
                    	} else {
                    		throw new Exception('Le compte a été désactivé');
                    	}                               
                    } else {
                        throw new Exception('Les identifiants fournis ne correspondent à aucun compte existant.');
                    }
                } else {
                    throw new Exception('Le mot de passe doit être compris entre 8 et 24 caractères.');
                }
            } else {
                throw new Exception('Le nom d\'utilisateur doit être compris entre 8 et 24 caractères.');
            }
        } else {
            throw new Exception('Absence des données liées au formulaire.');
        }
    }

    public function logOut() {
        $userCRUD = new UserCRUD();
        $userCRUD->logOut();
        header('Location: index.php?action=mainPage');
    }
}