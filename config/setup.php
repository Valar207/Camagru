<?PHP
require "database.php";
try
{
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$sql = "CREATE DATABASE IF NOT EXISTS camagru";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Camagru database successfully created.\n<br>";
$req->closeCursor();
try
{
    $DB_DSN = "mysql:host=localhost;dbname=camagru;charset=utf8";
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$sql = "CREATE TABLE users (
    idUsers int (11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nameUsers TINYTEXT NOT NULL, 
    emailUsers TINYTEXT NOT NULL,
    pwdUsers LONGTEXT NOT NULL,
    actif BIT NOT NULL DEFAULT 0,
    cle VARCHAR(52),
    img varchar(255) NOT NULL DEFAULT './profile_pics/default_profile.jpg',
    bio text,
    img_nbr int (11) NOT NULL DEFAULT 0,
    notif_com BIT NOT NULL DEFAULT 1,
    notif_like BIT NOT NULL DEFAULT 1
    );";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Users table successfully created.\n<br>";
$req->closeCursor();


$sql = "CREATE TABLE `pictures` (
    `id_img` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `id_user` int(11) NOT NULL,
    `img` varchar(255) NOT NULL,
    `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `like` int(11) NOT NULL DEFAULT '0',
    `comment` int(11) NOT NULL DEFAULT '0',
    FOREIGN KEY id_user(id_user)
    REFERENCES users(idUsers)
  );";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Pictures table successfully created.\n<br>";
$req->closeCursor();

$sql = "CREATE TABLE `comments` (
    `id_com` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `id_user` int(11) NOT NULL,
    `id_img` int(11) NOT NULL,
    `comment` text,
    `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `active` BIT NOT NULL DEFAULT 1,
    FOREIGN KEY id_user(id_user)
    REFERENCES users(idUsers),
    FOREIGN KEY id_img(id_img)
    REFERENCES pictures(id_img)
  );";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Comments table successfully created.\n<br>";
$req->closeCursor();

$sql = "CREATE TABLE `likes` (
    `id_like` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `id_user` int(11) NOT NULL,
    `id_img` int(11) NOT NULL,
    `active` BIT NOT NULL DEFAULT 1,
    FOREIGN KEY id_user(id_user)
    REFERENCES users(idUsers),
    FOREIGN KEY id_img(id_img)
    REFERENCES pictures(id_img)
  );";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Likes table successfully created.\n<br>";
$req->closeCursor();

$sql = "CREATE TABLE `stickers` (
    `id_sticker` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `sticker` varchar(255) NOT NULL
  );";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Stickers table successfully created.\n<br>";
$req->closeCursor();
$sql = "INSERT INTO `stickers` (sticker) 
        VALUES 
        ('stickers/batman.png'),
        ('stickers/cat.png'),
        ('stickers/glasses.png'),
        ('stickers/lego.png'),
        ('stickers/phone.png')";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Items successfully inserted in Stickers table.\n<br>";


$req->closeCursor();
$sql = "INSERT INTO `users` (`idUsers`, `nameUsers`, `emailUsers`, `pwdUsers`, `actif`, `cle`, `img`, `bio`, `img_nbr`, `notif_com`, `notif_like`) VALUES
(1, 'food', 'food@gmail.com', '$2y$10.Q9Pr.rpll6YQdY4YKupbaqq', b'1', '2c9e47efa9f1b5d75c5164768cc55da6', './profile_pics/1.png', NULL, 9, b'1', b'1'),
(2, 'voyage', 'voyage@gmail.com', '$2y$10.OLBcAWyWJop48dgC5T6TkGpi1.FCvOne', b'1', '7cd1d1319a47a92981a057bc638d18c5', './profile_pics/2.png', NULL, 9, b'1', b'1'),
(3, 'voiture', 'voiture@gmail.com', '$2y$10$2G0vPtrXs1LGhkW8/dVHB.IKX0ukWja9C32lf6FxH7CWRqTFZ.OaS', b'1', '46f16a10178c4e234972add13d060148', './profile_pics/3.png', NULL, 7, b'1', b'1');";
$req = $bdd->prepare($sql);
if ($req->execute())
    echo "Users successfully created in users table.\n<br>"; 

    

$sql = "INSERT INTO `pictures` (`id_img`, `id_user`, `img`, `date`, `like`, `comment`) VALUES
(1, 1, './post_img/food_1.png', '2020-02-02 13:30:57', 0, 0),
(3, 1, './post_img/food_3.png', '2020-02-02 13:34:29', 0, 0),
(7, 1, './post_img/food_7.png', '2020-02-02 13:38:23', 0, 0),
(8, 1, './post_img/food_8.png', '2020-02-02 13:38:29', 0, 0),
(10, 1, './post_img/food_10.png', '2020-02-02 13:41:07', 0, 0),
(11, 1, './post_img/food_11.png', '2020-02-02 13:41:13', 0, 0),
(12, 1, './post_img/food_12.png', '2020-02-02 13:41:20', 0, 0),
(13, 1, './post_img/food_13.png', '2020-02-02 13:42:02', 0, 0),
(14, 2, './post_img/voyage_14.png', '2020-02-02 13:44:27', 0, 0),
(15, 2, './post_img/voyage_15.png', '2020-02-02 13:44:32', 0, 0),
(16, 2, './post_img/voyage_16.png', '2020-02-02 13:44:37', 0, 0),
(17, 2, './post_img/voyage_17.png', '2020-02-02 13:44:41', 0, 0),
(18, 2, './post_img/voyage_18.png', '2020-02-02 13:44:46', 0, 0),
(19, 2, './post_img/voyage_19.png', '2020-02-02 13:44:53', 0, 0),
(20, 2, './post_img/voyage_20.png', '2020-02-02 13:44:57', 0, 0),
(21, 2, './post_img/voyage_21.png', '2020-02-02 13:45:04', 0, 0),
(22, 2, './post_img/voyage_22.png', '2020-02-02 13:45:08', 0, 0),
(23, 3, './post_img/voiture_23.png', '2020-02-02 13:48:43', 0, 0),
(24, 3, './post_img/voiture_24.png', '2020-02-02 13:48:48', 0, 0),
(25, 3, './post_img/voiture_25.png', '2020-02-02 13:48:52', 0, 0),
(26, 3, './post_img/voiture_26.png', '2020-02-02 13:48:56', 0, 0),
(27, 3, './post_img/voiture_27.png', '2020-02-02 13:49:02', 0, 0),
(28, 3, './post_img/voiture_28.png', '2020-02-02 13:49:06', 0, 0),
(29, 3, './post_img/voiture_29.png', '2020-02-02 13:49:11', 0, 0);";
$req = $bdd->prepare($sql);
if ($req->execute())
echo "pictures successfully inserted in Pictures table.\n<br>";
?>