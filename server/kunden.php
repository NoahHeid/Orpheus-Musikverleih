<?php
    session_start();
    include "functions.php";
    $connection = connectDatabase();

    //Einen Nutzer löschen
    if(isset($_POST['delete'])){
        $toDelete = $_POST['toDeleteID'];
        $sql = "DELETE FROM `kunden` WHERE `kd_id` = $toDelete";
        $connection->query($sql);
        $connection->close();
        header('Location: '."../admin.php");
        die();
    }

    //Einen Nutzer ausloggen
    if(isset($_POST['logout'])){
        session_destroy();
        echo '
            <script>
            function kehreZurückErfolg()
            {
            alert("Abmelden erfolgreich. Auf Wiedersehen!!");
            location.replace("../index.php");
            }
            </script>
            <body onload="kehreZurückErfolg()">
        ';
    }

    //Einen Nutzer einloggen
    if(isset($_POST['login']))
    {
        //Hole Values aus der Form
        $email = $_POST['user'];
        $pass = $_POST['pass'];
        if(isset($_POST['checkCookie'])){
            $checkCookie = true;
        }
        else{
            $checkCookie = false;
        }
        $hash = md5($pass);
        $kundenSQL = "SELECT * FROM kunden WHERE kd_email = '$email' AND kd_kennwort = '$hash'";
        $ergebnis = SQL($kundenSQL);

        //Wenn $ergebnis[0] einen Wert hat, dann war die Anmeldung erfolgreich. Ansonsten gab es keinen Nutzer mit den Anmeldedaten!
        if($ergebnis[0]!=NULL){
            //Setze die Session
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $ergebnis[0]->kd_id;
            $_SESSION['vorname'] =$ergebnis[0]->kd_vorname;
            $_SESSION['nachname'] = $ergebnis[0]->kd_nachname;
            $_SESSION['email'] = $ergebnis[0]->kd_email;
            $_SESSION['handy'] = $ergebnis[0]->kd_handy;
    
            //Setze den Cookie für einen Monat
            if($checkCookie){
                setcookie('email', $email);
                setcookie('password', $pass);
            }
            else{
                unset($_COOKIE['email']);
                unset($_COOKIE['password']);
                setcookie('email', "", time()-3600);
                setcookie('password', "", time()-3600);
            }
            //Update nun auch die letzte Anmeldung in der Datenbank!
            $kdID = $ergebnis[0]->kd_id;
            $sqlupdate = "update kunden set kd_anmeldedatum =CURRENT_TIMESTAMP where kd_id = $kdID";
            $connection->query($sqlupdate);
            $connection->close();

            //Gehe zurück zur Startseite.
            echo '
                <script>
                function kehreZurückErfolg()
                {
                    alert("Anmelden erfolgreich. Schön dich zu sehen '.$_COOKIE["email"].'!");
                    location.replace("../index.php");
                }
                </script>
                <body onload="kehreZurückErfolg()">
            ';
        }
        else{
            //Kehre zurück zur Startseite
            echo '
                <script>
                function kehreZurückOhneErfolg()
                {
                    alert("Benutzername und Passwort nicht fertig!");
                    location.replace("../index.php");
                }
                </script>
                <body onload="kehreZurückOhneErfolg()">
            ';
        }
    }

    //Einen Nutzer registrieren
    if(isset($_POST['registrieren'])){
        //Hole Values aus der Form
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $tel = $_POST['telefonnummer'];

        //Schau nach, ob es einen Nutzer gibt, der die gleiche Email bereits verwendet
        $prüfeDoppelteEmailSQL = "SELECT * FROM kunden WHERE kd_email = '$email'";
        $nutzer = SQL($prüfeDoppelteEmailSQL);
        if($nutzer[0]!=null){
            echo '
                <script>
                    function kehreZurückWeilEmailDoppelt()
                    {
                        alert("Email bereits vorhanden, bitte nutze eine andere Email!");
                        location.replace("../index.php");
                    }
                </script>
                <body onload="kehreZurückWeilEmailDoppelt()">
            ';
        }
        //Ansonsten, lege einen neuen Nutzer an und führe den Nutzer zurück auf die richtige Seite.
        else{
            $hash = md5($pass);
            $registriereNeuenNutzerSQL = "INSERT INTO kunden (kd_vorname, kd_nachname, kd_email, kd_handy, kd_kennwort) VALUES ('$vorname', '$nachname', '$email', '$tel', '$hash')";   
            $connection->query($registriereNeuenNutzerSQL);
            $connection->close();
            echo '
                <script>
                function kehreZurückErfolg()
                {
                    alert("Registration erfolgreich. Bitte logge dich nun ein '.$vorname.'!");
                    location.replace("../index.php");
                }
                </script>
                <body onload="kehreZurückErfolg()">
            ';
        }

    }

?>