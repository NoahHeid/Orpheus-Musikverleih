<?php
    include "functions.php";
    $connection = connectDatabase();

    if(isset($_POST['delete'])){
        $toDelete = $_POST['toDeleteID'];
        $sql = "DELETE FROM `geigen` WHERE `gg_id` = $toDelete";
        $connection->query($sql);
        $connection->close();
        header('Location: '."../admin.php");
        die();
    }

    if(isset($_POST['geigenname'])){
        $geigenname = $_POST['geigenname'];
        $sql ="INSERT INTO `geigen` (`gg_id`, `gg_name`, `gg_ausleihdatum`, `kd_id`) VALUES (NULL, '$geigenname', NULL, '')";
        $connection->query($sql);
        $connection->close();
        header('Location: '."../admin.php");
        die();
    }
    if(isset($_POST['ausleihen'])){
        $auszuleihenID = $_POST['ggID'];
        $kdID = $_POST['kdID'];
        
        $sql = "UPDATE geigen SET gg_ausleihdatum=CURRENT_TIMESTAMP,kd_id=$kdID WHERE gg_id = $auszuleihenID";
        $connection->query($sql);
        $connection->close();
        //Gehe zurück zur Startseite.
        echo '
            <script>
            function kehreZurückErfolg()
            {
                alert("Viel Erfolg mit der neuen Geige. Bitte denk daran, dass die Instrumente nach einer Woche zurückgegeben werden müssen!");
                location.replace("../ausleihe.php");
            }
            </script>
            <body onload="kehreZurückErfolg()">
        ';
    }
    if(isset($_POST['zurückgeben'])){
        $zurückgebenID = $_POST['ggID'];
        $sql = "UPDATE geigen SET gg_ausleihdatum=NULL,kd_id=0 WHERE gg_id = $zurückgebenID";
        $connection->query($sql);
        $connection->close();
        //Gehe zurück zur Startseite.
        echo '
            <script>
            function kehreZurückErfolg()
            {
                alert("Vielen Dank für das Zurückgeben der Geige!");
                location.replace("../ausleihe.php");
            }
            </script>
            <body onload="kehreZurückErfolg()">
        ';
    }

?>