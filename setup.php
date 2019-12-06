<?php

try {
    $DSN = "mysql:host=localhost;dbname=camagru";
    $USR = "root";
    $PWD = "root";
    $DBH = new PDO($DSN, $USR, $PWD);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $DBH;
} catch (PDOException $e) {
    echo "Connection failed: ".$e->getMessage();
}
