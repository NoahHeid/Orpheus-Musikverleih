 <!-- Impressum -->
 <section id="impressum" class="p-5 bgmaincolor1">
      <div class="container">
        <h2 class="text-left text-white">Impressum</h2>
        <p class="text-left text-white">Angaben gemäß § 5 TMG</p>
        <p class="text-left text-white">Noah Heidrich <br>
          Mozartstraße 41<br> 
          55283 Nierstein <br>
        </p>
        <p class="text-left text-white"> <strong>Vertreten durch: </strong><br>
          Noah Heidrich<br>
          Moritz Hussing<br>
        </p>
        <p class="text-left text-white"><strong>Kontakt:</strong> <br>
          Telefon: 06133-5757802 <br>
          E-Mail: <a href='mailto:musikservice@orpheus.de'>musikservice@orpheus.de</a></br>
        </p>
        <p class="text-left text-white"><strong>Haftungsausschluss: </strong><br><br><strong>Urheberrecht</strong><br><br>
          Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers.
          Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet.
          Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.
        </p>
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

          <form action="server/kunden.php" method="POST" >
            <div class="mb-3">
              <input type="text" hidden name="login">
              <label for="user" class="col-form-label">Email</label>
              <input type="text" class="form-control" id="user" name="user" value="<?php 
              if(isset($_COOKIE['user'])){
                echo $_COOKIE['user'];
              }
              ?>" required/>
            </div>
            <div class="mb-3">
              <label for="pass" class="col-form-label">Passwort:</label>
              <input type="password" class="form-control" id="pass" required name="pass" value="<?php 
              if(isset($_COOKIE['password'])){
                echo $_COOKIE['password'];
              }
              ?>" />
            </div>
            <div class="form-check mt-2">
              <input class="form-check-input" type="checkbox" value="checkCookie" name="checkCookie" id="checkCookie">
              <label class="form-check-label" for="checkCookie">Daten speichern (verwendet Cookies)</label>
            </div>
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <input type="submit" value="Login" class="btn btn-warning" />

          </form>
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

              <form action="server/kunden.php" method="POST">
                <input type="text" hidden id="registrieren" name="registrieren"/>
                <div class="mb-3">
                  <label for="vorname" class="col-form-label">Vorname:</label>
                  <input type="text" class="form-control" id="vorname" name="vorname" required/>
                </div>
                <div class="mb-3">
                  <label for="nachname" class="col-form-label">Nachname:</label>
                  <input type="text" class="form-control" id="nachname" name="nachname" required/>
                </div>
                <div class="mb-3">
                  <label for="email" class="col-form-label"> Email </label>
                  <input type="email" class="form-control" id="email" name="email" required/>
                </div>
                <div class="mb-3">
                  <label for="pass" class="col-form-label">Passwort:</label>
                  <input type="password" class="form-control" id="pass" name="pass" required/>
                </div>
                <div class="mb-3">
                  <label for="telefonnummer" class="col-form-label">Telefonnummer:</label>
                  <input type="tel" class="form-control" id="telefonnummer" name="telefonnummer" required/>
                </div>
                <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
                >
                Close
                </button>
                <input type="submit" value="Registrieren" class="btn btn-warning" />
              </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
