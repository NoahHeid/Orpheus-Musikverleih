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
        $connection->close();
        header('Location: '."admin.php");
        die();
    }

    if(isset($_POST['geigenname'])){
        $geigenname = $_POST['geigenname'];
        $sql ="INSERT INTO `geigen` (`gg_id`, `gg_name`, `gg_ausleihdatum`, `kd_id`) VALUES (NULL, '$geigenname', NULL, '')";
        $connection->query($sql);
        $connection->close();
        header('Location: '."admin.php");
        die();
    }
    if(isset($_POST['ausleihen'])){
        $auszuleihenID = $_POST['ggID'];
        $kdID = $_POST['kdID'];
        $sql = "UPDATE geigen SET gg_ausleihdatum=CURRENT_TIMESTAMP,kd_id=$kdID WHERE gg_id = $auszuleihenID";
        //UPDATE `geigen` SET `gg_ausleihdatum`='CURRENT_TIMESTAMP',`kd_id`='1' WHERE `gg_id` = '4';
        $connection->query($sql);
        $connection->close();
        header('Location: '."ausleihe.php");
        die();
    }
    if(isset($_POST['zurückgeben'])){
        $zurückgebenID = $_POST['ggID'];
        $sql = "UPDATE geigen SET gg_ausleihdatum=NULL,kd_id=0 WHERE gg_id = $zurückgebenID";
        //UPDATE `geigen` SET `gg_ausleihdatum`='CURRENT_TIMESTAMP',`kd_id`='1' WHERE `gg_id` = '4';
        $connection->query($sql);
        $connection->close();
        header('Location: '."ausleihe.php");
        die();
    }

?>