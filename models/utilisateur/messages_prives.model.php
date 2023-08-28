<?php


require_once("./models/pdo.model.php");


function envoiMPBdd($message, $destinataire,  $login)
{
    // $time = NOW();
    $req = "INSERT INTO private_message (message, destinataire, login, boiteEnvoi, boiteReception, date )
            VALUES(:message, :destinataire, :login, 1, 1, NOW())";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":message", $message, PDO::PARAM_STR);
    $stmt->bindValue(":destinataire", $destinataire, PDO::PARAM_STR);
    $stmt->bindValue(":login", $login, PDO::PARAM_STR);
    $stmt->execute();
    $creationOK = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $creationOK;
}

function infoMsg($id)
{
    $req = "SELECT * FROM private_message 
    WHERE id= :id
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $RecupOK = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $RecupOK;
}
function mpRecus($login)
{

    $req = "SELECT * FROM private_message 
    WHERE destinataire= :destinataire
    ORDER BY date DESC
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":destinataire", $login, PDO::PARAM_STR);
    $stmt->execute();
    $creationOK = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $creationOK;
}
function mpEnvoyes($login)
{

    $req = "SELECT * FROM private_message 
    WHERE login= :login
    ORDER BY date DESC
    ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":login", $login, PDO::PARAM_STR);
    $stmt->execute();
    $creationOK = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $creationOK;
}

function effacerMPBD($id)
{

    $req = "DELETE FROM private_message 
            WHERE id = :id
            ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $suppressionOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $suppressionOk;
}
function masquerDeReception($id)
{

    $req = "UPDATE private_message set boiteReception = 0
            WHERE id = :id
            ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $suppressionOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $suppressionOk;
}

function masquerDeEnvoi($id)
{

    $req = "UPDATE private_message set boiteEnvoi = 0
            WHERE id = :id
            ";
    $stmt = getBDD()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $suppressionOk = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $suppressionOk;
}
