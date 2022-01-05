<?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $datenbank = "instrumente";

    $connection = new mysqli($servername, $user, $password, $datenbank);

    if(isset($_POST['eintragen'])){
        $kdID = $_POST['eintragenKundenID'];
        $stID = $_POST['eintragenStundenID'];
        $kd_stelle = $_POST['eintragenKundenStelle'];
        $sql = "UPDATE `musikschulstunden` SET `$kd_stelle` = $kdID WHERE `stunden_id`=$stID";
        echo $sql;
        $connection->query($sql);
        $connection->close();
        header('Location: '."terminbuchung.php");
        die();
    }
    if(isset($_POST['austragen'])){
        $kdID = $_POST['austragenKundenID'];
        $stID = $_POST['austragenStundenID'];
        $kd_stelle = $_POST['austragenKundenStelle'];
        $sql = "UPDATE `musikschulstunden` SET `$kd_stelle` = 0 WHERE `stunden_id`=$stID";
        echo $sql;
        $connection->query($sql);
        $connection->close();
        header('Location: '."terminbuchung.php");
        die();
    }

?>