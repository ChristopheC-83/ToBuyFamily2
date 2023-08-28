<?php

session_start();

// variable "URL" valide sur tout le site
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https"  : "http") . "://" . $_SERVER['HTTP_HOST'] .
    $_SERVER["PHP_SELF"]));


require_once("./controllers/administrateur/administrateur.controller.php");
require_once("./controllers/visiteur/visiteur.controller.php");
require_once("./controllers/utilisateur/utilisateur.controller.php");
require_once("./controllers/utilisateur/messages_prives.controller.php");
require_once("./controllers/utilisateur/listes.controller.php");
require_once("./controllers/functionController.controller.php");
require_once("./controllers/security.controller.php");
require_once("./controllers/images.controller.php");


try {
    if (empty($_GET['page'])) {
        $url[0] = "accueil";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($url[0]) {
        case "accueil":
            pageAccueil();
            break;
        case "login":
            pageLogin();
            break;
        case "validation_login":
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $login = secureHTML($_POST['login']);
                $password = secureHTML($_POST['password']);
                validation_login($login, $password);
            } else {
                ajouterMessageAlerte('Login ou mot de passe non renseigné.', 'rouge');
                header('location:' . URL . "login");
                exit;
            }
            break;
        case "creerCompte":
            creerCompte();
            break;
        case "validation_creerCompte":
            if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['mail'])) {
                $login = secureHTML($_POST['login']);
                $password = secureHTML($_POST['password']);
                $mail = secureHTML($_POST['mail']);
                validation_creerCompte($login, $password, $mail);
            } else {
                ajouterMessageAlerte("Les 3 champs sont obligatoires !", "rouge");
                header('location:' . URL . "creerCompte");
            }
            break;
        case "mdpOublie":
            mdpOublie();
            break;
        case "envoi_mdpOublie":
            if (!empty($_POST['loginMdpOublie']) && !empty($_POST['mailMdpOublie'])) {
                $login = secureHTML($_POST['loginMdpOublie']);
                $password = secureHTML($_POST['mailMdpOublie']);
                validation_mdpOublie($login, $password);
            } else {
                ajouterMessageAlerte('Login ou mail non renseigné.', 'rouge');
                header('location:' . URL . "mdpOublie");
                exit;
            }
            break;


        case "compte":
            if (
                !estConnecte() and
                isset($_COOKIE['login'], $_COOKIE['mdp'])
                and !empty($_COOKIE['login']) and !empty($_COOKIE['mdp'])
            ) {
                if (getPasswordUser($_COOKIE['login']) === ($_COOKIE['mdp'])) {
                    $_SESSION['profil'] = ["login" => $_COOKIE['login']];
                    $datas = getUserInformation($_SESSION['profil']['login']);
                    $_SESSION['profil']['role'] = $datas['role'];
                    header('location:' . URL . "compte/choixListe");
                };
            } elseif (!estConnecte()) {
                header('location:' . URL . "accueil");
                session_unset();
                ajouterMessageAlerte("Vous devez vous connecter ou vous inscrire.", "orange");
            } else {
                // genererCookieConnexion($login,$password);
                switch ($url[1]) {
                    case "profil":
                        profil();
                        break;
                    case "deconnexion":
                        setcookie('login', '', time() - 3600);
                        setcookie('mdp', '', time() - 3600);
                        deconnexion();
                        break;
                    case "listes":
                        listes();
                        break;
                    case "choixListe":
                        choixListe();
                        break;
                    case "listeChoisie":
                        $newList = secureHTML($url[2]);
                        $creator = secureHTML($url[3]);
                        $_SESSION['profil']['liste'] = $newList;
                        $_SESSION['profil']['creator'] = $creator;
                        header('location:' . URL . "compte/listes");
                        break;
                    case "creerListe":


                        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['name_list'])) {

                            $newList = secureHTML($_POST['name_list']);
                            $creator = secureHTML($_POST['creator']);
                            $_SESSION['profil']['liste'] = $newList;
                            $_SESSION['profil']['creator'] = $creator;

                            creerListe($creator, $newList);
                        } else {
                            ajouterMessageAlerte("La liste ne doit contenir que des lettres et des chiffres.", "rouge");
                            header('location:' . URL . "compte/choixListe");
                        }

                        break;

                    case "effacerListe":
                        $name_list = secureHTML($url[2]);
                        $creator = secureHTML($url[3]);
                        effacerListe($creator, $name_list);
                        header('location:' . URL . "compte/choixListe");
                        break;
                    case "ajouterElement":
                        if (empty($_POST['content'])) {
                            ajouterMessageAlerte("Merci de saisir un contenu.", "rouge");
                        } else {
                            $name_list = secureHTML($_POST['name_list']);
                            $creator = secureHTML($_POST['creator']);
                            $content = secureHTML($_POST['content']);
                            $contentFrom = secureHTML($_POST['contentFrom']);
                            ajouterElement($creator, $name_list, $content, $contentFrom);
                        }
                        header('location:' . URL . "compte/listes");
                        break;
                    case "validerElement":
                        $id = secureHTML($url[2]);
                        $did = intval(secureHTML($url[3]));
                        if ($did === 1) {
                            validerElement($id, 0);
                        } else {
                            validerElement($id, 1);
                        }
                        header('location:' . URL . "compte/listes");
                        break;
                    case "supprimerElementListe":
                        $id = secureHTML($url[2]);
                        supprimerElementListe($id);
                        header('location:' . URL . "compte/listes");
                        break;
                    case "modifierElementListe":

                        $newContent = secureHTML($_POST['content']);
                        $id = secureHTML($_POST['id']);
                        if (!empty($newContent)) {
                            modifierElementListe($newContent, $id);
                        }

                        header('location:' . URL . "compte/listes");
                        break;
                    case "supprimerElementsListeFaits":
                        $elementsFaits = secureHTML($url[2]);
                        supprimerElementsListeFaits($elementsFaits);
                        header('location:' . URL . "compte/listes");
                        break;
                    case "ajouterUtilisateurListe":
                        $user = secureHTML($_POST['user']);
                        $creator = secureHTML($_POST['creator']);
                        $name_list = secureHTML($_POST['name_list']);

                        if ($user === $_SESSION['profil']['login']) {
                            ajouterMessageAlerte("Tu comptes te partager ta liste à toi même ? lol", "orange");
                            header('location:' . URL . "compte/choixListe");
                        } elseif (userDroitsListesExist($creator, $user, $name_list)) {
                            ajouterMessageAlerte($user . " est déjà en partage de cette liste.", "orange");
                            header('location:' . URL . "compte/choixListe");
                        } else {
                            if (!verifLoginDispo($user)) {
                                $allUsers = getUsersName();
                                ajouterUtilisateurListe($user, $creator, $name_list);
                                header('location:' . URL . "compte/choixListe");
                            } else {

                                ajouterMessageAlerte($user . " n'existe pas.", "rouge");
                                header('location:' . URL . "compte/choixListe");
                            }
                        }
                        break;
                    case "effacerUtilisateur":
                        $id = secureHTML($url[2]);
                        effacerUtilisateur($id);
                        header('location:' . URL . "compte/choixListe");
                        break;
                    case "sortirDeListe":
                        $id_rights = secureHTML($url[2]);
                        sortirDeListe($id_rights);
                        header('location:' . URL . "compte/choixListe");
                        break;



















                    case "envoyerMessage":
                        envoyerMP();
                        break;
                    case "envoiMP":
                        $msg = secureHTML($_POST['msg']);
                        $destinataire = secureHTML($_POST['destinataire']);
                        validationEnvoiMP($msg, $destinataire, $_SESSION['profil']['login']);
                        break;

                    case "masquerDeBR":
                        $id = secureHTML($url[2]);
                        $infoMsg = infoMsg($id);
                        if ($infoMsg['boiteEnvoi'] === 0) {
                            effacerMP($id);
                        } else {
                            masquerDeBR($id);
                        };
                        break;
                    case "masquerDeBE":
                        $id = secureHTML($url[2]);
                        $infoMsg = infoMsg($id);
                        if ($infoMsg['boiteReception'] === 0) {
                            effacerMP($id);
                        } else {
                            masquerDeBE($id);
                        };
                        break;

                    case "validation_modifImage":
                        if ($_FILES['image']['size'] > 0) {
                            validation_modifImage($_FILES['image']);
                        } else {
                            ajouterMessageAlerte("Image non modifiée", "rouge");
                            header('location:' . URL . "profil");
                        }
                        break;
                    case "validation_modificationMail":
                        validation_modificationMail(secureHTML($_POST['mail']));
                        break;
                    case "validation_modificationMDP":
                        if (!empty($_POST['oldPassword']) && !empty($_POST['newPassword']) && !empty($_POST['verifNewPassword'])) {
                            $oldPassword = secureHTML($_POST['oldPassword']);
                            $newPassword = secureHTML($_POST['newPassword']);
                            $verifNewPassword = secureHTML($_POST['verifNewPassword']);
                            validation_modificationMDP($oldPassword, $newPassword, $verifNewPassword);
                        } else {
                            ajouterMessageAlerte("Il faut remplir les 3 champs", "rouge");
                            header('location:' . URL . "compte/profil");
                        }
                        break;
                    case "suppressionCompte":
                        validation_suppressionCompte();
                        break;
                    case "changerAvatar":
                        validation_ChangerAvatar($url[2]);
                        break;
                    default:
                        throw new Exception("La page demandée n'existe pas.");
                }
            }
            break;
        case "admin":
            if (!estConnecte()) {
                ajouterMessageAlerte("Vous devez vous connecter.", "rouge");
                session_unset();
                header('location:' . URL . "login");
            } elseif (!estAdministrateur()) {
                ajouterMessageAlerte("Zone réservée aux administrateurs.", "rouge");
                header('location:' . URL . "accueil");
            } else {
                switch ($url[1]) {
                    case "gestion_droits":
                        droits();
                        break;
                    case "validation_modificationValidation":
                        validation_modificationValidation($_POST['login']);
                        break;
                    case "validation_modificationRole":
                        validation_modificationRole($_POST['login'], $_POST['role']);
                        break;
                    case "pageAdminSuppressionCompte":
                        adminSuppressionCompte($_POST['login']);
                        break;

                    default:
                        throw new Exception("La page demandée n'existe pas.");
                }
            }

            break;
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    pageErreur($e->getMessage());
}
