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
    if(!$eingeloggt || $_SESSION['id']>2){
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
              <h1> <?php if($eingeloggt){echo "Lieber ".$_SESSION['vorname']." b";}else{echo "B";} ?>eginne mit uns deine Reise in die <span class="text-warning"> Welt der Musik!</span></h1>
              <p class="lead my-4">

              <em>Die Musik drückt das aus, was nicht gesagt werden kann und worüber zu schweigen unmöglich ist.</em> <br>
              - Victor Hugo
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
      <!-- Instrumente -->
      <section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5">
        <div class="row d-flex justify-content-around">
                  <div class="d-flex justify-content-center h2 text-dark">Instrumente</div>
                  <!-- Linke Spalte-->
                  <div class="col-5">
                      <div class="text-center h3 text-dark">Geigen</div>
                      <?php
                        $servername = "localhost";
                        $user = "root";
                        $password = "";
                        $datenbank = "instrumente";
                      
                        $connection1 = new mysqli($servername, $user, $password, $datenbank);
                        $sql1 = "SELECT * FROM geigen";
                        if ($erg1 = $connection1->query($sql1)) {
                          if ($erg1->num_rows) {
                          // print_r($erg->num_rows);
                          $ds_gesamt = $erg1->num_rows;
                          $erg1->free();
                        }
                        if ($erg1 = $connection1->query($sql1)) {
                          while ($datensatz1 = $erg1->fetch_object()) {
                            $daten1[] = $datensatz1;
                          }
                        }
                      }
                      
                      ?>
                      <table class="table text-dark mr-5">
                        <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Geige</th>
                        <th scope="col">Ausgeliehen an</th>
                        <th scope="col">Ausgeliehen am</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($daten1 as $inhalt1) {
                    ?>
              
                          <tr>
                              <td>
                              
                              <form method="post" action="geigen.php">
                                  <div class="input-group mb-3">
                                    <input type="text" hidden name="toDeleteID" value=<?php echo $inhalt1->gg_id;?>>
                                    <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="❌" name="delete" id="delete">
                                  </div>
                                </form>
                              

                              </td>

                              <th scope="row"> <?php echo $inhalt1->gg_id; ?></th>
                              <td>
                                  <?php echo $inhalt1->gg_name; ?>
                              </td>
                              <td>
                              <?php $kunde1 = $inhalt1->kd_id; 
                                  if($erg1 = $connection1->query("SELECT `kd_vorname`, `kd_nachname` FROM `kunden` WHERE `kd_id` = $kunde1")){
                                    if($erg1->num_rows > 0){
                                      $kundendaten1 = $erg1->fetch_object();
                                      echo $kundendaten1->kd_vorname." ".$kundendaten1->kd_nachname;
                                    }
                                    else{
                                      echo "Auf Lager";
                                    }
                                  }else{
                                    echo "keine Connection zur Kundendatenbank";
                                  }
                                  
                                  ?>
                              </td> 
                              <td>
                                  <?php echo $inhalt1->gg_ausleihdatum; ?>
                              </td>               
                        </tr>
                    <?php
                    }
                   
                    ?>
                    </tbody>
                    </table>
                      <form method="post" action="geigen.php">
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Geigenname" aria-label="Geigenname" aria-describedby="basic-addon2" name="geigenname">
                          <div class="input-group-append">
                            <input type="submit" class="btn btn-warning"/>
                          </div>
                        </div>
                    </form>
                  </div>
                <!-- Rechte Spalte-->
                  <div class="col-5">
                      <div class="text-center h3 text-dark">Harfen</div>
                      <?php
                        $servername = "localhost";
                        $user = "root";
                        $password = "";
                        $datenbank = "instrumente";
                      
                        $connection = new mysqli($servername, $user, $password, $datenbank);

                        $sql = "SELECT * FROM harfen";
                        if ($erg = $connection->query($sql)) {
                          if ($erg->num_rows) {
                          // print_r($erg->num_rows);
                          $ds_gesamt = $erg->num_rows;
                          $erg->free();
                        }
                        if ($erg = $connection->query($sql)) {
                          while ($datensatz = $erg->fetch_object()) {
                            $daten[] = $datensatz;
                          }
                        }
                      }
                      
                      ?>
                      <table class="table text-dark mr-5">
                        <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Harfe</th>
                        <th scope="col">Ausgeliehen an</th>
                        <th scope="col">Ausgeliehen am</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($daten as $inhalt) {
                    ?>
              
                          <tr>
                              <td>
                              
                              <form method="post" action="harfen.php">
                                  <div class="input-group mb-3">
                                    <input type="text" hidden name="toDeleteID" value=<?php echo $inhalt->hf_id;?>>
                                    <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="❌" name="delete" id="delete">
                                  </div>
                                </form>
                              

                              </td>

                              <th scope="row"> <?php echo $inhalt->hf_id; ?></th>
                              <td>
                                  <?php echo $inhalt->hf_name; ?>
                              </td>
                              <td>
                              <?php $kunde = $inhalt->kd_id; 
                                  if($erg = $connection->query("SELECT `kd_vorname`, `kd_nachname` FROM `kunden` WHERE `kd_id` = $kunde")){
                                    if($erg->num_rows > 0){
                                      $kundendaten = $erg->fetch_object();
                                      echo $kundendaten->kd_vorname." ".$kundendaten->kd_nachname;
                                    }
                                    else{
                                      echo "Auf Lager";
                                    }
                                  }else{
                                    echo "keine Connection zur Kundendatenbank";
                                  }
                                  
                                  ?>
                              </td> 
                              <td>
                                  <?php echo $inhalt->hf_ausleihdatum; ?>
                              </td>               
                        </tr>
                    <?php
                    }
                    $connection->close();
                    ?>
                    </tbody>
                    </table>
                      <form method="post" action="harfen.php">
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Harfenname" aria-label="Harfenname" aria-describedby="basic-addon2" name="harfenname">
                          <div class="input-group-append">
                            <input type="submit" value="Hinzufügen" class="btn btn-warning"/>
                          </div>
                        </div>
                    </form>
                  </div>
        </div>
      </section>  
      <!-- Kunden -->
      <section class="text-light p-5 p-lg-0 pt-lg-5 text-center d-flex justify-content-center text-sm-start bgmaincolor5">
        <div class="col-11">
        <div class="d-flex justify-content-center h2 text-dark">Kunden</div> 

        <?php
                        $servername = "localhost";
                        $user = "root";
                        $password = "";
                        $datenbank = "instrumente";
                      
                        $connection2 = new mysqli($servername, $user, $password, $datenbank);

                        $sql2 = "SELECT * FROM kunden";

                        $erg2 = $connection2->query($sql2);
                          while ($datensatz2 = $erg2->fetch_object()) {
                            $daten2[] = $datensatz2;
                          }
                          
                      ?>
                      <table class="table text-dark mr-5">
                        <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Vorname</th>
                        <th scope="col">Nachname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Handynummer</th>
                        <th scope="col">Letzte Anmeldung</th>
                        <th scope="col">Registriert seit</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($inhalt)){
                    foreach ($daten2 as $inhalt) {
                     
                    ?>
              
                          <tr>
                              <td>
                              <form method="post" action="kunden.php">
                                  <div class="input-group mb-3">
                                    <input type="text" hidden name="toDeleteID" value=<?php echo $inhalt->kd_id;?>>
                                    <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="❌" name="delete" id="delete">
                                  </div>
                                </form>
                              </td>

                              <th scope="row"> <?php echo $inhalt->kd_id; ?></th>
                              <td>
                                  <?php echo $inhalt->kd_vorname; ?>
                              </td>
                              <td>
                                  <?php echo $inhalt->kd_nachname; ?>
                              </td>
                              <td>
                                  <?php echo $inhalt->kd_email; ?>
                              </td>
                              <td>
                                  <?php echo $inhalt->kd_handy; ?>
                              </td>
                              <td>
                              <?php

                              $q = $inhalt->kd_anmeldedatum;

                              // lookup all hints from array if $q is different from ""
                              //echo $q;
                              if($inhalt->kd_anmeldedatum == ""){
                                  echo "Noch nie gesehen.";
                              }
                              else{
                              $d = DateTime::createFromFormat('Y-m-d H:i:s', $q);
                              $date = new DateTime();
                              $differenz = $date->getTimestamp() - $d->getTimestamp();
                              $seen = floor($differenz/60);
                              $more = false;
                              if($seen > 60) {
                                  $more = true;
                                  $hours = floor($seen/60);
                                  $minutes = $seen-($hours*60);
                                  if(($seen > 24) && ($more == true)) {
                                      $days = floor(($seen/60)/24);
                                      $hours = floor($seen/60)-($days*24);
                                  }
                                  if($minutes == 1) {
                                  $minute = ' Minute ';  
                                  } else {
                                  $minute = ' Minuten ';
                                  }
                                  if($hours == 1) {
                                  $hour = ' Stunde ';  
                                  } else {
                                  $hour = ' Stunden ';
                                  }
                                  if($days == 1) {
                                  $day = ' Tag ';  
                                  } else {
                                  $day = ' Tage ';
                                  }
                                  if($days > 0) {  
                                  $seen = 'vor '. $days . $day . $hours . $hour . $minutes . $minute;
                                  } else {
                                  $seen = 'vor '. $hours . $hour . $minutes . $minute;
                                  }
                              } else {
                                  if($seen == 1) {
                                  $minute = ' minute ';  
                                  } else {
                                  $minute = ' minuten ';
                                  }    
                                  $seen = 'vor '.$seen . $minute;
                                  }
                                  echo $seen;
                              }
                              ?>
                              </td>
                              <td>
                                  <?php echo $inhalt->kd_registrierdatum; ?>
                              </td>            
                        </tr>
                    <?php
                    }
                  }
                    $connection2->close();
                    ?>
                    </tbody>
                    </table>
        </div>
      </section>
      

   </div>   
   <footer class="p-5 bg-dark text-white text-center position-relative">
      <div class="container">
        <p class="lead">Copyright &copy; 2021 Noah Heidrich, Moritz Hussing</p>

        <a href="#" class="position-absolute bottom-0 end-0 p-5">
          <i class="bi bi-arrow-up-circle h1"></i>
        </a>
      </div>
    </footer>        
  </body>
</html>
