<?PHP

require "../header.php";
require "./mail_functions.inc.php";
if(isset($_POST['reset']) && !empty($_POST['mail']))
{
    require "../config/database_connect.php";
    $mail = htmlspecialchars($_POST['mail']);

    $req = $bdd->prepare("SELECT emailUsers FROM users WHERE emailUsers= :mail OR nameUsers= :mail");
    $req->execute(array('mail' => $mail));
    if($mail = $req->fetch()['emailUsers']) //check if a line contain the same email
    {
        $req->closeCursor();
        $req = $bdd->prepare("SELECT cle FROM users WHERE emailUsers= :mail OR nameUsers = :mail");
        $req->execute(array('mail' => $mail));
        $checkcle = $req->fetch()['cle'];
        sendLinkNewPwd($mail, $checkcle);
        header("Location: ../forgotten_pwd.php?mail=sent");
    }
    else
        header("Location: ../forgotten_pwd.php?mail=no_exists");
}
else
{
    header("Location: ../forgotten_pwd.php?error=emptyfield");
}

?>