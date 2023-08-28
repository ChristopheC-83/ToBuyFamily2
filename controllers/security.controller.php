<?php

function secureHTML($chaine)
{
    return htmlentities($chaine);
}

function estConnecte()
{
    return (!empty($_SESSION['profil']));
}
function estUtilisateur()
{
    return (!empty($_SESSION['profil']['role'] === "utilisateur"));
}
function estAdministrateur()
{
    return (!empty($_SESSION['profil']['role'] === "administrateur"));
}


function genererCookieConnexion($login){
    $password = getPasswordUser($login);
    //le cookie expire dans timeExp secondes
    // $timeExp = 30;
    $timeExp = 60*60*24*7;
    setcookie('login', $login, time()+$timeExp, '/');
    setcookie('mdp', $password, time()+$timeExp, '/');
}

// function checkCookieConnexion(){
//     return $_COOKIE[COOKIE_NAME] === $_SESSION['profil'][COOKIE_NAME];
// }

function generateRandomPassword($length = 20) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*_-=+;:,.?";
    $password = substr(str_shuffle($chars), 0, $length);
    return $password;
}