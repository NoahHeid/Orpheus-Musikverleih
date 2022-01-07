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
    //Prüfe ob die Person Adminrechte hat, wenn nein, leite sie sofort zurück!
    if(!$eingeloggt || $_SESSION['id']>2){
      header('Location: '.'index.php');
    }
    include 'server/functions.php';
    include 'statisch/header.php';
?>

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
      <img class="img-fluid w-25 d-none d-sm-block" src="img/310984.svg" alt=""/>
    </div>
  </div>
</section>

<!-- Button Reihe -->
<script>
  function toggleSichtbarkeit(id) {
    var x = document.getElementById(id);
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
    if(document.getElementById("geigenSpalte").style.display===none && document.getElementById("harfenSpalte").style.display===none){
      document.getElementById("instrumenteID") = "none";
      console.log("Ausgeblendet!");
    }
    else{
      document.getElementById("instrumenteID") = "block";
    }
  }
</script>

<div class="row my-4">
  <div class = "d-sm-flex align-items-center justify-content-center">  
    <div class="col text-center">
      <a class="btn btn-lg btn-custom" onclick="toggleSichtbarkeit('geigenSpalte')">Blende Geigen aus</a>
    </div>
    <div class="col text-center">
      <a class="btn btn-lg btn-custom" onclick="toggleSichtbarkeit('kundenSpalte')">Blende Kunden aus</a>
    </div>
    <div class="col text-center">
      <a class="btn btn-lg btn-custom" onclick="toggleSichtbarkeit('harfenSpalte')">Blende Harfen aus</a>
    </div>
    <div class="col text-center">
      <a class="btn btn-lg btn-custom" onclick="toggleSichtbarkeit('musikstundenSpalte')">Blende Musikstunden aus</a>
    </div>
    
  </div>
</div>


<!-- Instrumente -->
<section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5" id="instrumentenSpalte">
  <div class="row d-flex justify-content-around">
    <div class="d-flex justify-content-center h2 text-dark" id="instrumenteID">Instrumente</div>
    <!-- Linke Spalte Geigen -->
    <div class="col-5" id="geigenSpalte">
        <div class="text-center h3 text-dark">Geigen</div>
        <?php      
          $sqlGeigen = "SELECT * FROM geigen";
          $geigenDaten = SQL($sqlGeigen);
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
              foreach ($geigenDaten as $geige) {
            ?>
            <tr>
              <td>
                <!--Hier der Button, um eine Geige zu löschen -->
                <form method="post" action="server/geigen.php">
                  <div class="input-group mb-3">
                    <input type="text" hidden name="toDeleteID" value=<?php echo $geige->gg_id;?>>
                    <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="❌" name="delete" id="delete">
                  </div>
                </form>
              </td>
              
              <!-- Geigen ID anzeigen -->
              <th scope="row"> <?php echo $geige->gg_id; ?></th>
              
              <!-- Geigen Name anzeigen-->
              <td>
                <?php echo $geige->gg_name; ?>
              </td>
              <!-- Geigen Kunde ausfindig machen und eventuell Namen ausgeben, ansonsten "Auf Lager" -->
              <td>
                <?php 
                  $geigenKundeID = $geige->kd_id; 
                  $geigenKundenSQL = "SELECT `kd_vorname`, `kd_nachname` FROM `kunden` WHERE `kd_id` = $geigenKundeID";
                  $geigenKunde = SQL($geigenKundenSQL);
                  if($geigenKunde == NULL){
                    echo "Auf Lager";
                  }
                  else{
                    echo $geigenKunde[0]->kd_vorname." ".$geigenKunde[0]->kd_nachname;
                  }
                ?>
              </td> 

              <!-- Geigen Ausleihdatum anzeigen-->
              <td>
                    <?php echo $geige->gg_ausleihdatum; ?>
              </td>               
            </tr>
            <?php
              }  
            ?>
          </tbody>
      </table>
      <form method="post" action="server/geigen.php">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Geigenname" aria-label="Geigenname" aria-describedby="basic-addon2" name="geigenname">
          <div class="input-group-append">
            <input type="submit" class="btn btn-warning"/>
          </div>
        </div>
      </form>
    </div>
  
  <!-- Rechte Spalte Harfen-->
    <div class="col-5" id="harfenSpalte">
      <div class="text-center h3 text-dark">Harfen</div>
      <?php      
        $sqlHarfen = "SELECT * FROM harfen";
        $harfenDaten = SQL($sqlHarfen);
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
            foreach ($harfenDaten as $harfe) {
          ?>
          <tr>
            <td>
              <!--Hier der Button, um eine Harfe zu löschen -->
              <form method="post" action="server/harfen.php">
                <div class="input-group mb-3">
                  <input type="text" hidden name="toDeleteID" value=<?php echo $harfe->hf_id;?>>
                  <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="❌" name="delete" id="delete">
                </div>
              </form>
            </td>
            
            <!-- Harfen ID anzeigen -->
            <th scope="row"> <?php echo $harfe->hf_id; ?></th>
            
            <!-- Harfen Name anzeigen-->
            <td>
              <?php echo $harfe->hf_name; ?>
            </td>
            <!-- Harfen Kunde ausfindig machen und eventuell Namen ausgeben, ansonsten "Auf Lager" -->
            <td>
              <?php 
                $harfenKundeID = $harfe->kd_id; 
                $harfenKundenSQL = "SELECT `kd_vorname`, `kd_nachname` FROM `kunden` WHERE `kd_id` = $harfenKundeID";
                $harfenKunde = SQL($harfenKundenSQL);
                if($harfenKunde == NULL){
                  echo "Auf Lager";
                }
                else{
                  echo $harfenKunde[0]->kd_vorname." ".$harfenKunde[0]->kd_nachname;
                }
              ?>
            </td> 

            <!-- Harfen Ausleihdatum anzeigen-->
            <td>
                  <?php echo $harfe->hf_ausleihdatum; ?>
            </td>               
          </tr>
          <?php
            }  
          ?>
        </tbody>
      </table>

      <!-- Neue Harfe hinzufügen -->
      <form method="post" action="server/harfen.php">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Harfenname" aria-label="Harfenname" aria-describedby="basic-addon2" name="harfenname">
          <div class="input-group-append">
            <input type="submit" class="btn btn-warning"/>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>  

<!-- Musikstunden -->
<section class="text-light p-5 p-lg-0 pt-lg-5 text-center d-flex justify-content-center text-sm-start bgmaincolor5">
  <div class="col-11" id="musikstundenSpalte">
    <div class="d-flex justify-content-center h2 text-dark">Musikstunden</div> 
    <?php
      $musikschulDaten = SQL("SELECT * FROM musikschulstunden");
    ?>
    <table class="table text-dark mr-5">
      <thead>
        <tr>
          <th scope="col">Löschen</th>
          <th scope="col">Datum</th>
          <th scope="col">Lehrkraft</th>
          <th scope="col">Teilnehmer 1</th>
          <th scope="col">Teilnehmer 2</th>
          <th scope="col">Teilnehmer 3</th>
          <th scope="col">Teilnehmer 4</th>
          <th scope="col">Teilnehmer 5</th>
        </tr>
      </thead>
      <tbody>
        <?php
          //Zeige die nächsten Stunden als erstes an!
          usort($musikschulDaten, "vergleicheTimestamp");
          foreach ($musikschulDaten as $musikStunde) 
          {
            if($musikStunde->stunden_ort=="online")
            {
        ?>
                <tr>
                  <!--Hier der Button, um eine Stunde zu löschen -->
                  <td>
                    <form method="post" action="server/serverTerminbuchen.php">
                      <div class="input-group mb-3">
                        <input type="text" hidden name="toDeleteID" value=<?php echo $musikStunde->stunden_id;?>>
                        <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="❌" name="stundeLöschen" id="stundeLöschen">
                      </div>
                    </form>
                  </td>

                  <!-- Datum der Stunde -->
                  <th scope ="row">
                    <?php echo date("H:i", strtotime($musikStunde->stunden_zeitpunkt))." Uhr am ".date("d.m.y", strtotime($musikStunde->stunden_zeitpunkt)); ?>
                  </th>
                  
                  <!-- Lehrkraft -->
                  <td> 
                    <?php 
                      $lehrer = $musikStunde->kd_idLehrkraft; 
                      $lehrkraftdaten = SQL("SELECT * FROM kunden where $lehrer= `kd_id`");
                      if($lehrkraftdaten[0]!=null){
                        echo $lehrkraftdaten[0]->kd_vorname." ".$lehrkraftdaten[0]->kd_nachname;
                      }
                      else{
                        echo "-";
                      }                      
                    ?>
                  </td>

                  <!-- Teilnehmer 1 -->
                  <td>
                    <?php 
                      $schueler1daten = SQL("SELECT * FROM kunden where $musikStunde->kd_id1= `kd_id`");
                      if($schueler1daten[0]!=null){
                        echo $schueler1daten[0]->kd_vorname." ".$schueler1daten[0]->kd_nachname;
                      }
                      else{
                        echo "-";
                      }
                    ?>
                  </td> 
                  
                  <!-- Teilnehmer 2 -->
                  <td>
                    <?php 
                        $schueler2daten = SQL("SELECT * FROM kunden where $musikStunde->kd_id2= `kd_id`");
                        if($schueler2daten[0]!=null){
                          echo $schueler2daten[0]->kd_vorname." ".$schueler2daten[0]->kd_nachname;
                        }
                        else{
                          echo "-";
                        }
                      ?>  
                  </td>  

                  <!-- Teilnehmer 3 -->
                  <td>
                  <?php 
                        $schueler3daten = SQL("SELECT * FROM kunden where $musikStunde->kd_id3= `kd_id`");
                        if($schueler3daten[0]!=null){
                          echo $schueler3daten[0]->kd_vorname." ".$schueler3daten[0]->kd_nachname;
                        }
                        else{
                          echo "-";
                        }
                      ?>  
                  </td> 
                  
                  <!-- Teilnehmer 4 -->
                  <td>
                  <?php 
                        $schueler4daten = SQL("SELECT * FROM kunden where $musikStunde->kd_id4= `kd_id`");
                        if($schueler4daten[0]!=null){
                          echo $schueler4daten[0]->kd_vorname." ".$schueler4daten[0]->kd_nachname;
                        }
                        else{
                          echo "-";
                        }
                      ?>  
                  </td>  

                  <!-- Teilnehmer 5 -->
                  <td>
                  <?php 
                        $schueler5daten = SQL("SELECT * FROM kunden where $musikStunde->kd_id5= `kd_id`");
                        if($schueler5daten[0]!=null){
                          echo $schueler5daten[0]->kd_vorname." ".$schueler5daten[0]->kd_nachname;
                        }
                        else{
                          echo "-";
                        }
                      ?>  
                  </td>  
                </tr>
          <?php
            }
          }
          ?>
      </tbody>
    </table>
    <a class="btn btn-sm btn-warning" onclick="toggleSichtbarkeit('neueStundeEinstellen')">Füge neue Musikstunden hinzu</a>
  </div>
</section>

<!-- Neue Musikstunde! (Kann über den Button ausgeblendet werden) -->
<section class="p-5 p-lg-0 pt-lg-5 text-center d-flex text-sm-start bgmaincolor5 text-dark justify-content-center">
  <div class="col-11" id="neueStundeEinstellen">
    <form method="post" action="server/terminbuchen.php">
      <div class="row">
        <div class="h5 text-center">Neue Musikstunde</div>
      </div>
      <div class="row justify-content-between">
        <div class="col-3">
        <label for="datum">Datum (Jahr-Monat-Tag Stunde:Minute:Sekunde)</label>
          <input type="text" class="form-control" placeholder="Jahr-Monat-Tag Stunde:Minute:Sekunde" id="datum" name="datum" required>
        </div>
        <div class="col-3">
          <label for="ort">Ort</label>
          <select id="ort" name="ort" class="form-control" required>
            <option selected disabled>Wähle...</option>
            <option>Online</option>
            <option>Hybrid</option>
            <option>Vor Ort</option>
          </select>
        </div>
        <div class="col-3">
          <label for="lehrer">Lehrer</label>
          <select id="lehrer" name="lehrer" class="form-control" required>
            <option selected hidden disabled>Wähle...</option>
            <option>Moritz Hussing</option>
            <option>Noah Heidrich</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-1">
          <input type="submit" value="Hinzufügen" name="neueStundeHinzufügen"class="btn btn-warning mt-4"/>
        </div>
      </div>
    </form>
  </div>
</section>

<!-- Kunden -->
<section class="text-light p-5 p-lg-0 pt-lg-5 text-center d-flex justify-content-center text-sm-start bgmaincolor5">
  <div class="col-11" id="kundenSpalte">
    <div class="d-flex justify-content-center h2 text-dark">Kunden</div> 
    <?php
      $sqlKunden = "SELECT * FROM kunden";
      $kundenDaten = SQL($sqlKunden);
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
          foreach ($kundenDaten as $kunde) 
          {
        ?>
            <tr>
              <!-- Kunde löschen -->
              <td>
                <form method="post" action="server/kunden.php">
                    <div class="input-group mb-3">
                      <input type="text" hidden name="toDeleteID" value=<?php echo $kunde->kd_id;?>>
                      <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="❌" name="delete" id="delete">
                    </div>
                  </form>
                </td>

                <!-- Kunden ID -->
                <th scope="row"> 
                  <?php echo $kunde->kd_id; ?>
                </th>

                <!-- Kunden Vorname -->
                <td>
                    <?php echo $kunde->kd_vorname; ?>
                </td>

                <!-- Kunden Nachname -->
                <td>
                    <?php echo $kunde->kd_nachname; ?>
                </td>

                <!-- Kunden Email -->
                <td>
                    <?php echo $kunde->kd_email; ?>
                </td>

                <!-- Kunden Handynummer -->
                <td>
                    <?php echo $kunde->kd_handy; ?>
                </td>

                <!-- Letzte Anmeldung des Kunden -->
                <td>
                  <?php
                  $q = $kunde->kd_anmeldedatum;
                  $letzteAnmeldung = letzteAnmeldung($q);
                  echo $letzteAnmeldung;
                ?>
                </td>

                <!-- Registrationszeitpunkt -->
                <td>
                    <?php echo date("d.m.y", strtotime($kunde->kd_registrierdatum))." um ".date("H:i", strtotime($kunde->kd_registrierdatum))." Uhr"; ?>
                </td>            
            </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</section>
       
<?php
  include "statisch/footer.php";
?>