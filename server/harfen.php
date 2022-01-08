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
        $connection->close();
        header('Location: '."../admin.php");
        die();
    }

    if(isset($_POST['harfenname'])){
        $harfenname = $_POST['harfenname'];
        $sql ="INSERT INTO `harfen` (`hf_id`, `hf_name`, `hf_ausleihdatum`, `kd_id`) VALUES (NULL, '$harfenname', NULL, '')";
        $connection->query($sql);
        $connection->close();
        header('Location: '."../admin.php");
        die();
    }

if(isset($_POST['ausleihen'])){
    $auszuleihenID = $_POST['hfID'];
    $kdID = $_POST['kdID'];
    $sql = "UPDATE harfen SET hf_ausleihdatum=CURRENT_TIMESTAMP,kd_id=$kdID WHERE hf_id = $auszuleihenID";
    $connection->query($sql);
    $connection->close();
    //Gehe zurück zur Startseite.
    echo '
        <script>
        function kehreZurückErfolg()
        {
            alert("Viel Erfolg mit der neuen Harfe. Bitte denk daran, dass die Instrumente nach einer Woche zurückgegeben werden müssen!");
            location.replace("../ausleihe.php");
        }
        </script>
        <body onload="kehreZurückErfolg()">
    ';
}
if(isset($_POST['zurückgeben'])){
    $zurückgebenID = $_POST['hfID'];
    $sql = "UPDATE harfen SET hf_ausleihdatum=NULL,kd_id=0 WHERE hf_id = $zurückgebenID";
    $connection->query($sql);
    $connection->close();
    //Gehe zurück zur Startseite.
    echo '
        <script>
        function kehreZurückErfolg()
        {
            alert("Vielen Dank für das Zurückgeben der Harfe!");
            location.replace("../ausleihe.php");
        }
        </script>
        <body onload="kehreZurückErfolg()">
    ';
}

?>