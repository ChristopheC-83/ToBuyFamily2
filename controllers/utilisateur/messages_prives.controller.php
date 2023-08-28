



<?php


require_once("./controllers/functionController.controller.php");
require_once("./models/visiteur/visiteur.model.php");
require_once("./models/utilisateur/utilisateur.model.php");
require_once("./models/utilisateur/messages_prives.model.php");






function envoyerMP()
{
    $datas = getUserInformation($_SESSION['profil']['login']);
    $mpRecus = mpRecus($_SESSION['profil']['login']);
    $mpEnvoyes = mpEnvoyes($_SESSION['profil']['login']);

    $data_page = [
        "page_description" => "les messages privés ",
        "page_title" => "Les MP",
        "view" => "views/pages/utilisateur/messagePrive.view.php",
        "template" => "views/commons/template.php",
        "utilisateur" => $datas,
        "mpRecus" => $mpRecus,
        "mpEnvoyes" => $mpEnvoyes,
    ];
    genererPage($data_page);
}


function validationEnvoiMP($msg, $destinataire, $expediteur)
{
    if (!empty($msg)) {
        $usersList = getUsersName();
        $destinataireExiste = false;
        // afficherTableau($usersList);
        foreach ($usersList as $userInlist) {
            // afficherTableau($userInlist);
            $userLogin = ($userInlist['login']);
            if ($destinataire === $userLogin) {
                $destinataireExiste = true;
                // envoi bdd
                if (envoiMPBdd($msg, $destinataire,  $expediteur)) {
                    ajouterMessageAlerte("Message envoyé", "vert");
                }
                header('location:' . URL . "compte/envoyerMessage");
                // echo ($destinataire . " existe !");
                // echo ("on envoie message : " . $msg);
                break;
            }
        }
        if (!$destinataireExiste) {
            ajouterMessageAlerte("Le destinataire " . $destinataire . " n'existe pas", "rouge");
            header('location:' . URL . "compte/envoyerMessage");
        }
    } else {
        ajouterMessageAlerte("Merci de remplir tous les champs.", "rouge");
        header('location:' . URL . "compte/envoyerMessage");
    }
}

function masquerDeBR($id)
{
    masquerDeReception($id);
    header('location:' . URL . "compte/envoyerMessage");
}
function masquerDeBE($id)
{
    masquerDeEnvoi($id);
    header('location:' . URL . "compte/envoyerMessage");
}

function effacerMP($id)
{
    effacerMPBD($id);
    header('location:' . URL . "compte/envoyerMessage");
}
