<?php


require_once("./controllers/functionController.controller.php");
require_once("./models/visiteur/visiteur.model.php");
require_once("./models/utilisateur/utilisateur.model.php");
require_once("./models/utilisateur/listes.model.php");




function listes()
{
    if (isset($_SESSION['profil']['liste'])) {
        $listes = getNameListeByCreator($_SESSION['profil']['login']);
        $listesTiers = listesTiers($_SESSION['profil']['login']);
        $contentListPerso = readContentList($_SESSION['profil']['login'], $_SESSION['profil']['liste']);
        $readContentListTiers = readContentListTiers($_SESSION['profil']['creator'], $_SESSION['profil']['liste'], $_SESSION['profil']['login']);

        $data_page = [
            "page_description" => "les listes de l'utilisateur",
            "page_title" => "Vos listes et accés",
            "view" => "views/pages/utilisateur/listes.view.php",
            "template" => "views/commons/template.php",
            "listes" => $listes,
            "contentListPerso" => $contentListPerso,
            "listesTiers" => $listesTiers,
            "readContentListTiers" => $readContentListTiers,
        ];
        genererPage($data_page);
    } else {
        header('location:' . URL . "compte/choixListe");
    }
}

function choixListe()
{

    $login = $_SESSION['profil']['login'];
    $listes = getNameListeByCreator($login);
    $listesTiers = listesTiers($_SESSION['profil']['login']);
    $droitsListe = droitsListes($_SESSION['profil']['login']);

    $data_page = [
        "page_description" => "les listes de l'utilisateur",
        "page_title" => "Vos listes et accés",
        "view" => "views/pages/utilisateur/choixListe.view.php",
        "template" => "views/commons/template.php",
        "login" => $login,
        "listes" => $listes,
        "droitsListe" => $droitsListe,
        "listesTiers" => $listesTiers,
    ];
    genererPage($data_page);
}

function creerListe($login, $name_from_form)
{
    $name_list = "liste_" . $login . "_" . $name_from_form;
    if (verif_name_list_dispo($login, $name_list)) {
        creerListeBD($login, $name_list);
        $_SESSION['profil']['liste'] = $name_list;
        header('location:' . URL . "compte/choixListe");
    } else {
        ajouterMessageAlerte("Nom de liste déjà utilisé.<br> Merci d'en choisi un autre.", "orange");
        header('location:' . URL . "compte/choixListe");
    }
}

function effacerListe($creator, $name_list)
{

    if (effacerListeBD($creator, $name_list)) {
        unset($_SESSION['profil']['liste']);
        unset($_SESSION['profil']['creator']);
        header('location:' . URL . "compte/choixListe");
    } else {

        ajouterMessageAlerte("La liste n'a pas pu être effacée.", "rouge");
        header('location:' . URL . "compte/listes");
    }
}

function ajouterElement($creator, $name_list, $content, $contentFrom)
{
    if (ajouterElementBD($creator, $name_list, $content, $contentFrom)) {
        header('location:' . URL . "compte/Listes");
    } else {
        ajouterMessageAlerte("L'ajour a échoué.", "rouge");
        header('location:' . URL . "compte/listes");
    }
}

function validerElement($id, $did)
{
    if (validerElementBD($id, $did)) {

        header('location:' . URL . "compte/listes");
    } else {
        ajouterMessageAlerte("Modification échouée.", "rouge");
        header('location:' . URL . "compte/listes");
    }
}
function supprimerElementListe($id)
{
    if (supprimerElementListeBD($id)) {
        header('location:' . URL . "compte/listes");
    } else {
        ajouterMessageAlerte("Suppression non effectuée.", "rouge");
        header('location:' . URL . "compte/listes");
    }
}
function 
supprimerElementsListeFaits($liste)
{
    if (supprimerElementsListeFaitsBD($liste)) {
        header('location:' . URL . "compte/listes");
    } else {
        ajouterMessageAlerte("Suppression non effectuée.", "rouge");
        header('location:' . URL . "compte/listes");
    }
}

function modifierElementListe($content, $id){
    if (modifierElementListeBD($content, $id)) {
        header('location:' . URL . "compte/listes");
    } else {
        ajouterMessageAlerte("Modification non effectuée.", "rouge");
        header('location:' . URL . "compte/listes");
    }

}


function ajouterUtilisateurListe($user, $creator,$name_list){

    if (ajouterUtilisateurListeBD($user, $creator,$name_list)) {
        header('location:' . URL . "compte/choixListe");
    } else {
        ajouterMessageAlerte("Ajout utilisateur non effectué.", "rouge");
        header('location:' . URL . "compte/choixListe");
    }
}
function effacerUtilisateur($id){
    if (effacerUtilisateurBD($id)) {
        header('location:' . URL . "compte/choixListe");
    } else {
        ajouterMessageAlerte("Lien toujours actif.", "rouge");
        header('location:' . URL . "compte/choixListe");
    }
}
function sortirDeListe($id_rights){
    if (sortirDeListeBD($id_rights)) {
        header('location:' . URL . "compte/choixListe");
    } else {
        ajouterMessageAlerte("Rupture non consommée !", "rouge");
        header('location:' . URL . "compte/choixListe");
    }
}