<?php

function    sendActivation($username, $mail, $cle)
{
    $destinataire = $mail;
    $sujet = "Activer votre compte" ;
    $entete = "From: camagrutestactivation@gmail.com \r\n" ;
    $entete .= "Content-type: text/html; charset=utf8";
    $message = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Message</title>
    </head>
    <body>
    
    Bienvenue sur VotreSite,<br><br>
        
                Pour activer votre compte, veuillez cliquer sur le lien ci-dessous <br>
        
                <a target="_blank" href="http://localhost:8082/camagru/activation.php?username='.urlencode($username).'&cle='.urlencode($cle).'">Activer compte</a><br>
                
                --------------- <br>
                Ceci est un mail automatique, Merci de ne pas y répondre.
        
    </body>
    </html>';
    mail($destinataire, $sujet, $message, $entete);
}

function    sendLinkNewPwd($mail, $checkcle)
{
    $destinataire = $mail;
    $sujet = "Changement de mot de passe" ;
    $entete = "From: camagrutestoublimdp@gmail.com \r\n" ;
    $entete .= "Content-type: text/html; charset=utf8";
    $message = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Message</title>
    </head>
    <body>
    
                Pour changer votre mot de passe, veuillez cliquer sur le lien ci-dessous <br>
        
                <a target="_blank" href="http://localhost:8082/camagru/includes/checktoken.inc.php?username='.urlencode($mail).'&cle='.urlencode($checkcle).'">Réinitialiser mot de passe</a><br>
                
                --------------- <br>
                Ceci est un mail automatique, Merci de ne pas y répondre.
        
    </body>
    </html>';
    mail($destinataire, $sujet, $message, $entete);
}

?>