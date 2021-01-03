<h3>Cyclos</h3>
<form class="col s12" method="post" action="/cyclos/seechanges">
<div class="row">
    <div class="input-field col s4">
        <select id="filename" name="filename">
        <?php
        $i=0;
        foreach($files as $file) {
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
        <button class="btn-floating btn-large waves-effect waves-light btn-pink" type="submit" name="action">
        <i class="material-icons right">preview</i>
        </button>
    </div>
</div>
</form>
<a class="btn-floating btn-large waves-effect waves-light btn-pink" onclick="addcyclosspinner();" href="/cyclos/checkchanges"><i class="material-icons">compare_arrows</i></a>
<div id="spinner"></div>