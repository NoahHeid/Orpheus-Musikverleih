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
    <div class="bgmaincolor5">

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
              <h1> <?php echo "Lieber ".$_SESSION['vorname']?>, viel Spaß beim Erkunden unseres <span class="text-warning"> Instrumentenparadises!</span></h1>
              <p class="lead my-4">
                  Bitte denke daran, dass nach einer Woche die Instrumente zurückgegeben werden müssen!
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

      <!-- Geigenverleih -->
      <section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5 border border-dark">
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-around">
            <div class="h1 text-dark text-center">Geigenverleih</div>
                <div>
                    <?php
                        function connectDatabase(){
                            $servername = "localhost";
                            $user = "root";
                            $password = "";
                            $datenbank = "instrumente";
                            return new mysqli($servername, $user, $password, $datenbank);
                        }
                        $connection1 = connectDatabase();
                        $sql1 = "SELECT * FROM geigen";
                        if ($erg1 = $connection1->query($sql1)) {
                          while ($datensatz1 = $erg1->fetch_object()) {
                            $daten1[] = $datensatz1;
                          }
                        }
                      
                      ?>
                      <table class="table text-dark mr-5">
                        <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Geige</th>
                        <th scope="col">Ausleihen</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($daten1 as $inhalt) {
                    ?>
              
                          <tr>
                              <th scope="row"> <?php echo $inhalt->gg_id; ?></th>
                              <td>
                                  <?php echo $inhalt->gg_name; ?>
                              </td>  
                              <td><?php 
                              //Falls die Geige auf Lager ist (Also das Ausleihdatum NULL ist), mache es möglich Auszuleihen!
                              if($inhalt->gg_ausleihdatum == NULL){
                                echo '<form method="post" action="geigen.php">
                                <div class="input-group mb-3">
                                  <input type="text" hidden name="ggID" value='.$inhalt->gg_id.'>
                                  <input type="text" hidden name="kdID" value='.$_SESSION['id'].'>
                                  <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Ausleihen" name="ausleihen" id="ausleihen">
                                </div>
                              </form>';
                              }else{
                                //Prüfe ob das Element vom Nutzer ausgeliehen ist, wenn ja, mach es möglich, das Element zurückzugeben!
                                if($inhalt->kd_id == $_SESSION['id']){
                                  echo '<form method="post" action="geigen.php">
                                  <div class="input-group mb-3">
                                    <input type="text" hidden name="ggID" value='.$inhalt->gg_id.'>';
                                    $date = new DateTime();
                                    if($date->getTimestamp() - strtotime($inhalt->gg_ausleihdatum)>604800){
                                     echo '<input type="submit" class="btn-sm bg-transparent btn-outline-danger"  value="Zurückgeben (Überfällig!)" name="zurückgeben" id="zurückgeben">';
                                    }
                                    else{
                                      echo '<input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Zurückgeben" name="zurückgeben" id="zurückgeben">';
                                    }
                                    echo '
                                  </div>
                                </form>';
                                }
                                else{
                                  echo 'Leider bereits ausgeliehen! Seit: '.strtotime($inhalt->gg_ausleihdatum);
                                }
                              }
                              
                              ?></td>
                        </tr>
                    <?php
                    }
                   
                    ?>
                    </tbody>
                    </table>
                </div>
          </div>
        </div>
      </section>

      <!-- Harfenverleih -->
      <section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5 border border-dark">
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-around">
                <div>
                    <?php
                        $connection2 = connectDatabase();
                        $sql2 = "SELECT * FROM harfen";
                        if ($erg2 = $connection2->query($sql2)) {
                          while ($datensatz2 = $erg2->fetch_object()) {
                            $daten2[] = $datensatz2;
                          }
                        }
                      
                      ?>
                      <table class="table text-dark mr-5">
                        <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Harfe</th>
                        <th scope="col">Ausleihen</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($daten2 as $inhalt2) {
                    ?>
              
                          <tr>
                              <th scope="row"> <?php echo $inhalt2->hf_id; ?></th>
                              <td>
                                  <?php echo $inhalt2->hf_name; ?>
                              </td>  
                              <td><?php 
                              //Falls die Geige auf Lager ist (Also das Ausleihdatum NULL ist), mache es möglich Auszuleihen!
                              if($inhalt2->hf_ausleihdatum == NULL){
                                echo '<form method="post" action="harfen.php">
                                <div class="input-group mb-3">
                                  <input type="text" hidden name="hfID" value='.$inhalt2->hf_id.'>
                                  <input type="text" hidden name="kdID" value='.$_SESSION['id'].'>
                                  <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Ausleihen" name="ausleihen" id="ausleihen">
                                </div>
                              </form>';
                              }else{
                                //Prüfe ob das Element vom Nutzer ausgeliehen ist, wenn ja, mach es möglich, das Element zurückzugeben!
                                if($inhalt2->kd_id == $_SESSION['id']){
                                  echo '<form method="post" action="harfen.php">
                                  <div class="input-group mb-3">
                                    <input type="text" hidden name="hfID" value='.$inhalt2->hf_id.'>';
                                    $date = new DateTime();
                                    if($date->getTimestamp() - strtotime($inhalt2->hf_ausleihdatum)>604800){
                                     echo '<input type="submit" class="btn-sm bg-transparent btn-outline-danger"  value="Zurückgeben (Überfällig!)" name="zurückgeben" id="zurückgeben">';
                                    }
                                    else{
                                      echo '<input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Zurückgeben" name="zurückgeben" id="zurückgeben">';
                                    }
                                    echo '
                                  </div>
                                </form>';
                                }
                                else{
                                  echo 'Leider bereits ausgeliehen!';
                                }
                              }
                              
                              ?></td>
                        </tr>
                    <?php
                    }
                   
                    ?>
                    </tbody>
                    </table>
                </div>
                <div class="h1 text-dark text-center">Harfenverleih</div>
          </div>
        </div>
      </section>
      

    </body>
    </html>