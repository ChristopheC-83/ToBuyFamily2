<?php


require_once("./models/pdo.model.php");

function getNameListeByCreator($login)
{
    $req = "SELECT DISTINCT * FROM listList 
    WHERE creator= :creator
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":creator", $login, PDO::PARAM_STR);
    $stmt->execute();
    $listes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $listes;
}

function creerListeBD($login, $name_list)
{
    $req = "INSERT INTO listList (creator, name_list)
    VALUES(:creator, :name_list)";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":creator", $login, PDO::PARAM_STR);
    $stmt->bindValue(":name_list", $name_list, PDO::PARAM_STR);
    $stmt->execute();
    $creationOK = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $creationOK;
}

function verif_name_list_dispo($name, $name_list)
{
    $name_list = allLists($name, $name_list);
    return empty($name_list);
}

function allLists($login, $name_list)
{
    $req = "SELECT * FROM listList  WHERE creator = :creator AND name_list =:name_list
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":creator", $login, PDO::PARAM_STR);
    $stmt->bindValue(":name_list", $name_list, PDO::PARAM_STR);
    $stmt->execute();
    $listes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $listes;
}


function effacerListeBD($creator, $name_list)
{
    $req = "DELETE FROM listList 
    WHERE creator = :creator AND name_list =:name_list
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":creator", $creator, PDO::PARAM_STR);
    $stmt->bindValue(":name_list", $name_list, PDO::PARAM_STR);
    $stmt->execute();
    $suppressionOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $suppressionOk;
}

function ajouterElementBD($creator, $name_list, $content, $contentFrom)
{

    $req = "INSERT INTO contentList (creator, name_list, content, contentFrom, did)
    VALUES(:creator, :name_list, :content, :contentFrom, 0)";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":creator", $creator, PDO::PARAM_STR);
    $stmt->bindValue(":name_list", $name_list, PDO::PARAM_STR);
    $stmt->bindValue(":content", $content, PDO::PARAM_STR);
    $stmt->bindValue(":contentFrom", $contentFrom, PDO::PARAM_STR);
    $stmt->execute();
    $insertionOK = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $insertionOK;
}

function readContentList($login, $name_list)
{
    $req = "SELECT * FROM contentList  WHERE creator = :creator AND name_list =:name_list
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":creator", $login, PDO::PARAM_STR);
    $stmt->bindValue(":name_list", $name_list, PDO::PARAM_STR);
    $stmt->execute();
    $listes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $listes;
}
function readContentListTiers($creator, $name_list, $contentFrom)
{
    $req = "SELECT * FROM contentList  WHERE creator = :creator AND name_list =:name_list AND contentFrom = :contentFrom
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":creator", $creator, PDO::PARAM_STR);
    $stmt->bindValue(":name_list", $name_list, PDO::PARAM_STR);
    $stmt->bindValue(":contentFrom", $contentFrom, PDO::PARAM_STR);
    $stmt->execute();
    $listes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $listes;
}

function validerElementBD($id, $did)
{

    $req = "UPDATE contentList set did = :did 
            WHERE id = :id
            ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->bindValue(":did", $did, PDO::PARAM_INT);
    $stmt->execute();
    $validationOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $validationOk;
}

function supprimerElementListeBD($id)
{

    $req = "DELETE FROM contentList 
    WHERE id = :id
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $suppressionOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $suppressionOk;
}

function modifierElementListeBD($content, $id){

$req = "UPDATE contentList set content = :content 
            WHERE id = :id
            ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->bindValue(":content", $content, PDO::PARAM_STR);
    $stmt->execute();
    $ModifOK = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $ModifOK;
}


function supprimerElementsListeFaitsBD($name_list){

    $req = "DELETE FROM contentList 
    WHERE name_list = :name_list AND did = 1
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":name_list", $name_list, PDO::PARAM_STR);
    $stmt->execute();
    $suppressionOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $suppressionOk;


}

function droitsListes($creator){

        $req = "SELECT * FROM rightsList  WHERE creator = :creator
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":creator", $creator, PDO::PARAM_STR);
    $stmt->execute();
    $droits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $droits;

}
function listesTiers($user){

        $req = "SELECT * FROM rightsList  WHERE user = :user
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":user", $user, PDO::PARAM_STR);
    $stmt->execute();
    $droits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $droits;

}
function userDroitsListesExist($creator,$user, $name_list ){

        $req = "SELECT * FROM rightsList  WHERE creator = :creator AND name_list =:name_list AND user= :user
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":creator", $creator, PDO::PARAM_STR);
    $stmt->bindValue(":user", $user, PDO::PARAM_STR);
    $stmt->bindValue(":name_list", $name_list, PDO::PARAM_STR);
    $stmt->execute();
    $droits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $droits;

}

function ajouterUtilisateurListeBD($user, $creator,$name_list){
    $req = "INSERT INTO rightsList (user, creator, name_list,rights)
    VALUES(:user, :creator, :name_list, 1)";
$stmt = getBDD()->prepare($req);
$stmt->bindValue(":user", $user, PDO::PARAM_STR);
$stmt->bindValue(":creator", $creator, PDO::PARAM_STR);
$stmt->bindValue(":name_list", $name_list, PDO::PARAM_STR);
$stmt->execute();
$creationOK = ($stmt->rowCount() > 0);
$stmt->closeCursor();
return $creationOK;

}

function effacerUtilisateurBD($id){

    $req = "DELETE FROM rightsList 
    WHERE id_rights = :id_rights
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":id_rights", $id, PDO::PARAM_INT);
    $stmt->execute();
    $suppressionOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $suppressionOk;
}
function sortirDeListeBD($id_rights){

    $req = "DELETE FROM rightsList 
    WHERE id_rights = :id_rights
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":id_rights", $id_rights, PDO::PARAM_INT);
    $stmt->execute();
    $suppressionOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $suppressionOk;
}