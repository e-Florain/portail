<h3>Cyclos</h3>

<ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">person</i>Synchronisation Adhérents</div>
      <div class="collapsible-body">
      <button class="btn-floating btn-large waves-effect waves-light btn-pink" onclick="checkchanges('adhs');"><i class="material-icons">compare_arrows</i></button>
        <br>
        <div id="spinner"></div>  
          <form class="col s8" method="post" id="formadhpros" name="formadhpros" action="/cyclos/seechanges/adhs">
            <div class="row">
                <div class="input-field col s4">
                    <select id="filenameadhs" name="filenameadhs">
                    <?php
                    $i=0;
                    foreach($filesadhs as $file) {
                        if ($i>4) {
                            break;
                        }
                        echo '<option value="'.$file.'"';
                        if ($i==0) {
                            echo ' selected';
                        }
                        echo '>'.$file.'</option>';
                        $i++;
                    }
                    ?>
                    <label>Fichier</label>
                    </select>
                </div>
                <div class="input-field col s2">
                    <button class="btn-floating btn-large waves-effect waves-light btn-pink" type="submit" name="action">
                    <i class="material-icons right">preview</i>
                    </button>
                </div>
            </div>
            </form>
          </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">place</i>Synchronisation Adhérents pros</div>
      <div class="collapsible-body">
        <button class="btn-floating btn-large waves-effect waves-light btn-pink" onclick="checkchanges('adhpros');"><i class="material-icons">compare_arrows</i></button>
        <br>
        <div id="spinner"></div>  
          <form class="col s8" method="post" id="formadhpros" name="formadhpros" action="/cyclos/seechanges/adhpros">
            <div class="row">
                <div class="input-field col s4">
                    <select id="filenameadhpros" name="filenameadhpros">
                    <?php
                    $i=0;
                    foreach($filesadhpros as $file) {
                        if ($i>4) {
                            break;
                        }
                        echo '<option value="'.$file.'"';
                        if ($i==0) {
                            echo ' selected';
                        }
                        echo '>'.$file.'</option>';
                        $i++;
                    }
                    ?>
                    <label>Fichier</label>
                    </select>
                </div>
                <div class="input-field col s2">
                    <button class="btn-floating btn-large waves-effect waves-light btn-pink" type="submit" name="action">
                    <i class="material-icons right">preview</i>
                    </button>
                </div>
            </div>
            </form>
          </div>
    </li>
</ul>