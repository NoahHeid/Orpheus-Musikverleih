<?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $datenbank = "instrumente";

    $connection = new mysqli($servername, $user, $password, $datenbank);

    if(isset($_POST['delete'])){
        $toDelete = $_POST['toDeleteID'];
        $sql = "DELETE FROM `geigen` WHERE `gg_id` = $toDelete";
        $connection->query($sql);
    }

    if(isset($_POST['geigenname'])){
        $geigenname = $_POST['geigenname'];
        $sql ="INSERT INTO `geigen` (`gg_id`, `gg_name`, `gg_ausleihdatum`, `kd_id`) VALUES (NULL, '$geigenname', NULL, '')";
        $connection->query($sql);
    }
    $connection->close();
    header('Location: '."admin.php");
    die();
?>