<?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $datenbank = "instrumente";

    $connection = new mysqli($servername, $user, $password, $datenbank);

    if(isset($_POST['delete'])){
        $toDelete = $_POST['toDeleteID'];
        $sql = "DELETE FROM `harfen` WHERE `hf_id` = $toDelete";
        $connection->query($sql);
    }

    if(isset($_POST['harfenname'])){
        $harfenname = $_POST['harfenname'];
        $sql ="INSERT INTO `harfen` (`hf_id`, `hf_name`, `hf_ausleihdatum`, `kd_id`) VALUES (NULL, '$harfenname', NULL, '')";
        $connection->query($sql);
    }
    $connection->close();
    header('Location: '."admin.php");
    die();
?>