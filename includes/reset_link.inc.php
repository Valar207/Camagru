<?PHP

require "../header.php";
require "../functions.php";
if(isset($_POST['reset']) && !empty($_POST['mail']))
{
    require "../config/database_connect.php";
    $mail = $_POST['mail'];

    $sql = "SELECT emailUsers FROM users WHERE emailUsers= :mail OR nameUsers= :mail";
    $req = $bdd->prepare($sql);
    $req->execute(array('mail' => $mail));
    if($mail = $req->fetch()['emailUsers']) //check if a line contain the same email
    {
        $req->closeCursor();
        $sql = "SELECT cle FROM users WHERE emailUsers= :mail OR nameUsers = :mail";
        $req = $bdd->prepare($sql);
        $req->execute(array('mail' => $mail));
        $checkcle = $req->fetch()['cle'];
        sendLinkNewPwd($mail, $checkcle);
        header("Location: ../reset.php?mail=sent");
    }
    else
        header("Location: ../reset.php?mail=no_exists");
}
else
{
    header("Location: ../reset.php?error=emptyfield");
}

?>