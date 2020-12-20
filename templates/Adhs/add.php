<br>
<h3>Ajouter un adhérent</h3>
  <div class="row">
    <?php echo $this->Form->create(); ?>
    <form class="col s12" methode="post" action="/adhs/add">
      <div class="row">
        <div class="input-field col s2">
          <input name="adh_id" id="adh_id" type="text" required class="validate">
          <label for="adh_id">Numéro d'adhérent</label>
        </div>
        <div class="input-field col s3">
          <input name="date_adh" type="text" id="date_adh" required class="datepicker">
          <label for="date_adh">Date d'adhésion</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <select multiple name="adh_years[]" required>
            <option value="" disabled>Choisir</option>
            <?php
            $tmp=true;
            if (date("W")>=44){
              echo '<option value="'.(date("Y")+1).'">'.(date("Y")+1).'</option>';
              $tmp=false;
            }
            echo '<option value="'.date("Y").'">'.date("Y").'</option>';
            echo '<option value="'.(date("Y")-1).'">'.(date("Y")-1).'</option>';
            if ($tmp) {
              echo '<option value="'.(date("Y")-2).'">'.(date("Y")-2).'</option>';
            }
            ?>
          </select>
          <label>Années d'adhésion</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="firstname" id="first_name" required type="text" class="validate">
          <label for="first_name">Prénom</label>
        </div>
        <div class="input-field col s6">
          <input name="lastname" id="last_name" required type="text" class="validate">
          <label for="last_name">Nom</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="email" id="email" required type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="city" id="city" required type="text" class="validate">
          <label for="city">Ville</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="phonenumber" id="phonenumber" type="text" class="validate">
          <label for="phonenumber">Téléphone</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <!--<input name="asso" id="asso" required type="text" class="validate">-->
          <select name="asso_id" >
            <option value="" disabled selected>Choisir</option>
              <?php foreach ($assos as $asso) {
              echo '<option value="'.$asso['id'].'" >'.$asso['name'].'</option>';
              }
              ?>
          </select>
          <label for="asso">Association</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
            <select name="payment_type" >
                <option value="" disabled selected>Choisir</option>
                <?php foreach ($list_payment_type as $payment_type) {
                  echo '<option value="'.$payment_type.'" >'.$payment_type.'</option>';
                }
                ?>
            </select>
            <label>Type de paiement</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="amount" id="amount" required type="text" class="validate">
          <label for="amount">Montant (entre 10 et 50)</label>
        </div>
      </div>
      <p>
        &nbsp;<label>
            <input name="newsletter" id="newsletter" type="checkbox" />
            <span>Ajout Liste</span>
        </label>
      </p>
    <button class="btn waves-effect waves-light" required type="submit" name="action">Ajouter
    <i class="material-icons right">send</i>
    </button>
    </form>
  </div>
        