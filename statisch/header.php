<!DOCTYPE html>
<html lang="de">
  <head>
    <!-- Standard HTML Code -->

    <!-- Metadaten -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Wichtige Stylesheets u.A. Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css" rel="stylesheet" />
    <link rel="stylesheet" href="statisch/style.css"/>

    <!--Title der bspw im Tab angezeigt wird -->
    <title>Orpheus Musikverleih</title>

  </head>

  <!-- Hier beginnt der Body, dieser wird hier in der header.php geöffnet, aber dafür dann auch in der footer.php wieder geschlossen! -->
  <body class = "bgmaincolor5">


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bgmaincolor1">
      <div class="container">
        <!-- Das Logo, das auch als Link zur Startseite dient -->
        <a href="index.php" class="navbar-brand"><img src="img/OrpheusLogoKleinTransparentGoldeneSchrift.png" alt="Logo" style="width: 150px"></a>
        
        <!-- Navbar-Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                
                <!-- Woher unser Name kommt -->
                <li class="nav-item">
                    <a href="index.php#orpheus" class="nav-link text-warning">Orpheus</a>
                </li>

                <!-- FAQ -->
                <li class="nav-item">
                    <a href="index.php#faq" class="nav-link text-warning">FAQ</a>
                </li>

                <!-- Wer wir sind -->
                <li class="nav-item">
                    <a href="index.php#werwirsind" class="nav-link text-warning">Wer wir sind</a>
                </li>

                <!-- Wie man uns Kontaktieren kann -->
                <li class="nav-item">
                    <a href="index.php#kontakt" class="nav-link text-warning">Kontakt</a>
                </li>

                <!-- Wenn man eingeloggt ist, kann man hiermit auf die Buttons zur Ausleihe und zur Terminbuchung klicken. Ist man nicht eingeloggt, wird dies nicht angezeigt. -->
                <?php 
                    if($eingeloggt){
                        echo '
                            <li class="nav-item mx-2">
                                <a href="ausleihe.php" class="nav-link text-warning">Zur Ausleihe</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a href="terminbuchung.php" class="nav-link text-warning">Zur Terminbuchung</a>
                            </li>
                        ';
                        }
                ?>

                <!-- Admin Bereich -->
                <?php
                    //Prüfe ob Kunden ID unter 3 ist, da nur Moritz und ich als Admins die IDs 1 und 2 haben können!
                    if($eingeloggt==true && $_SESSION['id']<3){
                        echo '
                            <li class="nav-item">
                                <a href="admin.php" class="nav-link text-warning"><u>Admin Bereich</u></a>
                            </li>
                        ';
                    }
                ?>

                <!-- Anmelde-, Abmelde- und Registrationsbutton -->
                <?php 
                    if(!$eingeloggt){
                        echo 
                        '
                            <li class="nav-item mx-2">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#anmelden"> 
                                    Anmelden 
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#registrieren">
                                    Registrieren
                                </button>
                            </li>
                        ';
                    } else {
                    echo 
                    '   
                        <li class="nav-item mx-2">
                            <form action="server/kunden.php" method="post">
                                <input type="text" hidden name="logout"></input>
                                <button type="submit" class="btn btn-warning btn-sm">Abmelden</button>
                            </form>
                        </li>';
                    }
                ?>
            </ul>
        </div>
      </div>
    </nav>