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
        <h1> <?php echo "Liebe*r ".$_SESSION['vorname']?>, viel Spaß beim Erkunden unseres <span class="text-warning"> Instrumentenparadises!</span></h1>
        <p class="lead my-4">
            Bitte denk daran, dass die Instrumente nach einer Woche zurückgegeben werden müssen!
        </p>
      </div>
      <img class="img-fluid w-25 d-none d-sm-block" src="img/310984.svg"/>
    </div>
  </div>
</section>

<!-- Warning, wenn ein Instrument zurückgegeben werden muss -->
<?php include "statisch/ueberfaelligWarning.php"; ?>

<!-- Carousel -->
<section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor4">
<div id="carouselInstruments" class="carousel carousel-white slide" data-bs-ride="carousel">

  <div class="carousel-inner text-white">

    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselInstruments" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselInstruments" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselInstruments" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselInstruments" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>

    <div class="carousel-item active" data-bs-interval="4000">
      <div class="carousel-caption d-none d-md-block">
        <img src="img/instrumente/höfner_student_violine.png" class="d-block w-100" alt="...">
        <h5>HÖFNER Student Violine</h5>
        <p>Ausgezeichnete Schülergeige aus dem Hause der deutschen Geigenbauwerkstatt Karl Höfner</p>
      </div>
    </div>

    <div class="carousel-item" data-bs-interval="2500">
      <div class="carousel-caption d-none d-md-block">
        <img src="img/instrumente/pacato_evioline.png" class="d-block w-100" alt="...">
        <h5>PACATO E-Violine</h5>
        <p>Elektrische Violine mit schwarzem Teilkorpus und Stahlseiten</p>
      </div>
    </div>

    <div class="carousel-item" data-bs-interval="2500">
      <div class="carousel-caption d-none d-md-block">
        <img src="img/instrumente/paganini_allegro.png" class="d-block w-100" alt="...">
        <h5>PAGANINO Allegro Violine</h5>
        <p>Schöne Schülergeige von überzeugender Qualität mit Garnitur und Kinnhalter aus Ebenholz</p>
      </div>
    </div>    
    
    <div class="carousel-item" data-bs-interval="2500">
      <div class="carousel-caption d-none d-md-block">
        <img src="img/instrumente/paganino_classic.png" class="d-block w-100" alt="...">
        <h5>PAGANINO Classic Viola</h5>
        <p>Sehr gute Schülerbratsche von überzeugender Qualität aus handausgearbeitem Massivholz</p>
      </div>
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselInstruments" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#carouselInstruments" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

</div>
</section>

<!-- Geigenverleih -->
<section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5 border border-dark">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="la.jpg" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="chicago.jpg" alt="Chicago">
    </div>

    <div class="item">
      <img src="ny.jpg" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</section>

<!-- Harfenverleih -->
<section class="text-light p-5 mb-4 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5">
  <div class="container">
    <div class="row d-sm-flex align-items-center justify-content-around">
      <div class="col-5">
        <table class="table text-dark mr-5">
          <thead>
            <tr>
              <th scope="col">Harfe</th>
              <th scope="col">Ausleihen</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $harfenSQL = "SELECT * FROM harfen";
            $harfenDaten = SQL($harfenSQL);
            foreach ($harfenDaten as $harfe) {
            ?>
              <tr>
                <td>
                    <?php echo $harfe->hf_name; ?>
                </td>  
                <td>
                  <?php 
                    //Falls die Geige auf Lager ist (Also das Ausleihdatum NULL ist), mache es möglich Auszuleihen!
                    if($harfe->hf_ausleihdatum == NULL){
                      echo '
                      <form method="post" action="server/harfen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="hfID" value='.$harfe->hf_id.'>
                          <input type="text" hidden name="kdID" value='.$_SESSION['id'].'>
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Ausleihen" name="ausleihen" id="ausleihen">
                        </div>
                      </form>';
                    }else{
                      //Prüfe ob das Element vom Nutzer ausgeliehen ist, wenn ja, mach es möglich, das Element zurückzugeben!
                      if($harfe->kd_id == $_SESSION['id']){
                        echo '
                        <form method="post" action="server/harfen.php">
                          <div class="input-group mb-3">
                            <input type="text" hidden name="hfID" value='.$harfe->hf_id.'>';
                            $date = new DateTime();
                            if($date->getTimestamp() - strtotime($harfe->hf_ausleihdatum)>604800){
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
                        echo 'Bereits seit '.date("d.m.y", strtotime($geige->gg_ausleihdatum)).' ausgeliehen!';
                      }
                    }
                  ?>
                </td>
              </tr>
            <?php
            }
            
            ?>
          </tbody>
        </table>
      </div>
      <div class="col-2"></div>
      <!-- Harfenbild -->
      <div class="col-5">
        <img src="img/harfenAusleihe.png" class="img-fluid" alt="Responsive image">
      </div>
    </div>
  </div>
</section>

<?php
  include 'statisch/footer.php';
?>