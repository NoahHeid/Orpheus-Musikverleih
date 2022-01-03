<?php
    session_start();
    if(isset($_SESSION['loggedin'])){
      if($_SESSION['loggedin']==TRUE){
        $eingeloggt = true;
      }else{
        $eingeloggt = false;
      }
      
    }
    else{
      $eingeloggt = false;
    }
    if(!$eingeloggt){
      echo "header('Location: '.'index.php');";
    }
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500&display=swap" rel="stylesheet">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
    <link
      href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Orpheus Musikverleih</title>
  </head>
  <body>
    <div class="bgmaincolor4">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top bgmaincolor1">
        <div class="container">
          <a href="index.php" class="navbar-brand"><img src="img/OrpheusLogoKleinTransparentGoldeneSchrift.png" alt="Logo" style="width: 150px"></a>

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navmenu"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
            <?php 
                if($eingeloggt){
                  echo '<li class="nav-item mx-2"><a href="ausleihe.php" class="nav-link text-warning"><u>Zur Ausleihe</u></a></li>';
                }
                
              ?>
            <!-- Admin Bereich -->
            <?php
            //Prüfe ob Kunden ID unter 3 ist, da nur Moritz und ich als Admins die IDs 1 und 2 haben können!
            if($eingeloggt==true && $_SESSION['id']<3){
              echo '<li class="nav-item">
              <a href="admin.php" class="nav-link text-warning"><u>Admin Bereich</u></a>
            </li>';
            }
            ?>
              <li class="nav-item mx-2">
                <?php 
                  if(!$eingeloggt){
                    echo '<button
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#anmelden"
                    
                  > Anmelden
                  </button>
                  </li>
                  <li class="nav-item">
                    <button
                      class="btn btn-warning btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#registrieren"
                    >Registrieren
                  </button>
                  </li>';
                  }
                  else{
                    echo '<form action="logout.php">
                            <button type="submit" class="btn btn-warning btn-sm" >Abmelden</button>
                          </form>
                          </li>';
                  }
                ?>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Showcase -->
      <section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor1">
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-between">
            <div>
              <h1> <?php echo "Liebe*r ".$_SESSION['vorname']?>, viel Spaß beim Meistern deines <span class="text-warning"> Instruments!</span></h1>
              <p class="lead my-4">
                  *Hier bitte was schlaues schreiben @Moritz*
              </p>

            </div>
            <img
              class="img-fluid w-25 d-none d-sm-block"
              src="img/310984.svg"
              alt=""
            />
          </div>
        </div>
      </section>

      <!-- Online -->
      <section class="text-dark p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5" id="online">
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-between">
            <div class="text-align-center">Online</div>
            <?php
              function connectDatabase(){
                $servername = "localhost";
                $user = "root";
                $password = "";
                $datenbank = "instrumente";
                return new mysqli($servername, $user, $password, $datenbank);
              }
              $connection = connectDatabase();
              $sql = "SELECT * FROM musikschulstunden";
              if ($erg = $connection->query($sql)) {
                while ($datensatz = $erg->fetch_object()) {
                  $daten[] = $datensatz;
                }
              }
            ?>
            <table class="table text-dark mr-5">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Teilnehmer 1</th>
                  <th scope="col">Teilnehmer 2</th>
                  <th scope="col">Teilnehmer 3</th>
                  <th scope="col">Teilnehmer 4</th>
                  <th scope="col">Teilnehmer 5</th>
                  <th scope="col">Datum</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($daten as $inhalt) {
                ?>
                <tr>
                  <th scope="row"> 
                    <?php echo $inhalt->stunden_id; ?>
                  </th>
                  <td>
                    <?php echo $inhalt->kd_id1; ?>
                  </td>  
                  <td>
                    <?php echo $inhalt->kd_id2; ?>
                  </td>  
                  <td>
                    <?php echo $inhalt->kd_id3; ?>
                  </td>  
                  <td>
                    <?php echo $inhalt->kd_id4; ?>
                  </td>  
                  <td>
                    <?php echo $inhalt->kd_id5; ?>
                  </td>  
                  <td>
                    <?php echo date("H:i", strtotime($inhalt->stunden_zeitpunkt))." Uhr am ".date("d.m.y", strtotime($inhalt->stunden_zeitpunkt)); ?>
                  </td>  
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>

          </div>
        </div>
        </section>

        <!-- Hybrid -->
        <section class="text-dark p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor4" id="hybrid">
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-between">
          <div class="text-align-center">Hybrid</div>
          </div>
        </div>
        </section>

        <!-- Präsenz -->
        <section class="text-dark p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5" id="vorort">
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-between">
          <div class="text-align-center">Vor Ort</div>
          </div>
        </div>
        </section>
    </div>
  </body>
</html>