<?php 

require_once('controller/Frontend.php');
require_once('controller/Backend.php');
require_once('controller/CRUD/UserCRUD.php');
require_once('controller/CRUD/GroupCRUD.php');
require_once('controller/CRUD/PostCRUD.php');
require_once('controller/CRUD/CommentCRUD.php');

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
                                    $frontend = new Frontend('groupView', $group->getId());
                                } else {
                                    throw new Exception('Impossible d\'enregister le groupe');
                                } 
                            } else {
                                $backend = new Backend('newGroupView', 'Le nom de groupe existe déjà, merci d\'en choisir un autre');
                            }
                        } else {
                            $backend = new Backend('newGroupView', 'Merci de renseigner un titre entre 5 et 240 caractères');
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
                                if ($userCRUD->read(htmlspecialchars($_POST['pseudo']))) {
                                    $user = $userCRUD->add(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['mdp']));
                                    if ($user) {
                                    $_SESSION['pseudo'] = $user->getPseudo();
                                    $_SESSION['id'] = $user->getId();
                                    $frontend = new Frontend('mainPageView');
                                    } else {
                                        throw new Exception('Impossible d\'enregister l\'utilisateur');
                                    }
                                } else {
                                   $backend = new Backend('inscriptionView', 'Le nom d\'utilisateur existe déjà, merci d\'en choisir un autre');
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
                                $user = $userCRUD->read(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['mdp']));
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


?>