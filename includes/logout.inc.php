<?php
if (isset($_POST['logout']) || isset($_GET['logout']))
{
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php?profile=logout");
    exit();
}
?>