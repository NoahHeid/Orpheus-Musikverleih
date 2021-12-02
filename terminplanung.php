<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
            <li class="nav-item">
              <a href="#orpheus" class="nav-link text-warning">Wieso Orpheus?</a>
            </li>
            <li class="nav-item">
              <a href="#faq" class="nav-link text-warning">FAQ</a>
            </li>
            <li class="nav-item">
              <a href="#werwirsind" class="nav-link text-warning">Wer wir sind</a>
            </li>
            <li class="nav-item">
              <a href="#kontakt" class="nav-link text-warning">Kontakt</a>
            </li>
            <li class="nav-item">
              <button
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
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Terminplanung -->
    <section
      class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor1"
    >
      <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <h1>Buche hier deine nächste Stunde <span class="text-warning"> Musikunterricht!</span></h1>
          </div>
          <img
            class="img-fluid d-none d-sm-block"
            src="img/310984.svg"
            style="width: 20%;"
            alt="Musiker Silhoutte"
          />
        </div>
      </div>
    </section>

    <!-- Virtuelle Terminplanung  -->
    <section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor4">
      <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between">

        </div>
      </div>
    </section>



    <!-- Footer -->
    <footer class="p-5 bg-dark text-white text-center position-relative">
      <div class="container">
        <p class="lead">Copyright &copy; 2021 Noah Heidrich, Moritz Hussing</p>

        <a href="#" class="position-absolute bottom-0 end-0 p-5">
          <i class="bi bi-arrow-up-circle h1"></i>
        </a>
      </div>
    </footer>

    <!-- Modal Hier Anmelden -->
    <div
      class="modal fade"
      id="anmelden"
      tabindex="-1"
      aria-labelledby="enrollLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="enrollLabel">Anmelden</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="email" class="col-form-label">
                  Email
                </label>
                <input type="text" class="form-control" id="email" />
              </div>
              <div class="mb-3">
                <label for="password" class="col-form-label">Passwort:</label>
                <input type="text" class="form-control" id="password" />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Hier Registrieren -->
    <div
      class="modal fade"
      id="registrieren"
      tabindex="-1"
      aria-labelledby="enrollLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="enrollLabel">Registrieren</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="email" class="col-form-label">
                  Email
                </label>
                <input type="text" class="form-control" id="email" />
              </div>
              <div class="mb-3">
                <label for="password" class="col-form-label">Passwort:</label>
                <input type="text" class="form-control" id="password" />
              </div>
              <div class="mb-3">
                <label for="vorname" class="col-form-label">Vorname:</label>
                <input type="text" class="form-control" id="vorname" />
              </div>
              <div class="mb-3">
                <label for="telefonnummer" class="col-form-label">Telefonnummer:</label>
                <input type="text" class="form-control" id="telefonnummer" />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Mehr erfahren über Orpheus -->
    <div
      class="modal fade"
      id="orpheusMehr"
      tabindex="-1"
      aria-labelledby="orpheusMehr"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="orpheusMehr">Mehr über Orpheus</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <p class="lead">Wer war dieser begnadete Musiker?</p>
            <p>Orpheus war...</p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Schließen
            </button>
            
          </div>
        </div>
      </div>
    </div>


    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"
    ></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>

    <script>
      mapboxgl.accessToken =
        'pk.eyJ1IjoiYnRyYXZlcnN5IiwiYSI6ImNrbmh0dXF1NzBtbnMyb3MzcTBpaG10eXcifQ.h5ZyYCglnMdOLAGGiL1Auw'
      var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [8.336097717285156, 49.86569595336914],
        zoom: 14,
      })
    </script>
  
  </div>
  </body>
</html>