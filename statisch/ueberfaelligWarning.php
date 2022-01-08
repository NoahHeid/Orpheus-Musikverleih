<!-- Überfällige Instrumente zurückgeben! -->
<section class = "text-center">
  <!-- Nutze hier PHP Code um zu schauen, ob ein Instrument zu lange ausgeliehen wurde -->
  <?php
    //Sieh nach, ob der Nutzer ein Instrument zu lange besitzt und es zurückgeben muss
    if($eingeloggt)
    {
        $überfälligeInstrumente = prüfeÜberfälligkeit($_SESSION['id']);      
        if(!empty($überfälligeInstrumente))
        {
            if(count($überfälligeInstrumente)>0){
            if(isset($überfälligeInstrumente[0]->hf_name))
            {
                $überfälligesBeispielInstrument = $überfälligeInstrumente[0]->hf_name;
                $fälligSeit = date("d.m.y", strtotime($überfälligeInstrumente[0]->hf_ausleihdatum)+604800);
            }
            else
            {
                $überfälligesBeispielInstrument= $überfälligeInstrumente[0]->gg_name;
                $fälligSeit = date("d.m.y", strtotime($überfälligeInstrumente[0]->gg_ausleihdatum)+604800);
            }
            echo "
                <div class='h2 text-danger'>
                    Bitte gib die überfälligen Instrumente zurück. Unter anderem ist ".$überfälligesBeispielInstrument." seit dem ".$fälligSeit." fällig!
                </div>
                <script>
                    alert('Du hast überfällige Instrumente:".$überfälligesBeispielInstrument."');
                </script>
            ";
            }
        }    

    } 
  ?>
</section>