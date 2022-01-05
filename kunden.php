<?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $datenbank = "instrumente";

    $connection = new mysqli($servername, $user, $password, $datenbank);

    if(isset($_POST['delete'])){
        $toDelete = $_POST['toDeleteID'];
        $sql = "DELETE FROM `kunden` WHERE `kd_id` = $toDelete";
        $connection->query($sql);
        $connection->close();
        header('Location: '."admin.php");
        die();
    }

?>