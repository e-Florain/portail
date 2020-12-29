<br>
  <div class="row">
    <?php echo $this->Form->create(); ?>
    <form class="col s12" methode="post" action="/adhpros/edit">
    <input name="id" id="id" <?php echo 'value="'.$adhpro->id.'"'; ?> type="hidden" class="validate">
      <div class="row">
        <div class="input-field col s2">
          <input name="adh_id" id="adh_id" type="text" <?php echo 'value="'.$adhpro->adh_id.'"'; ?> class="validate">
          <label for="adh_id">Numéro d'adhérent</label>
        </div>
        <div class="input-field col s3">
          <input name="date_adh" type="text" id="date_adh" 
          <?php if ($adhpro->date_adh != null) { echo 'value="'.$adhpro->date_adh->format('Y-m-d').'"'; } else {echo 'value=""'; }; 
          ?> class="datepicker">
          <label for="date_adh">Date d'adhésion</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="orga_name" id="orga_name" type="text" <?php echo 'value="'.$adhpro->orga_name.'"'; ?> class="validate">
          <label for="orga_name">Nom de l'organisation</label>
        </div>
        <div class="input-field col s6">
          <input name="orga_contact" id="orga_contact" type="text" <?php echo 'value="'.$adhpro->orga_contact.'"'; ?> class="validate">
          <label for="orga_contact">Contact de l'organisation</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="email" id="email" type="email" <?php echo 'value="'.$adhpro->email.'"'; ?> class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="phonenumber" id="phonenumber" type="text" <?php echo 'value="'.$adhpro->phonenumber.'"'; ?> class="validate">
          <label for="phonenumber">Téléphone</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="address" id="address" type="text" <?php echo 'value="'.$adhpro->address.'"'; ?> class="validate">
          <label for="address">Adresse</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="postcode" id="postcode" type="text" <?php echo 'value="'.$adhpro->postcode.'"'; ?> class="validate">
          <label for="postcode">Code Postal</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="city" id="city" type="text" <?php echo 'value="'.$adhpro->city.'"'; ?> class="validate">
          <label for="city">Ville</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
            <select name="payment_type" >
                <option value="" disabled >Choisir</option>
                <?php foreach ($list_payment_type as $payment_type) {
                  if ($adhpro->payment_type == $payment_type) {
                    echo '<option value="'.$payment_type.'" selected>'.$payment_type.'</option>';
                  } else {
                    echo '<option value="'.$payment_type.'" >'.$payment_type.'</option>';
                  }
                }
                ?>
            </select>
            <label>Type de paiement</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="amount" id="amount" type="text" <?php echo 'value="'.$adhpro->amount.'"'; ?> class="validate">
          <label for="amount">Montant</label>
        </div>
      </div>
      <p>
        &nbsp;<label>
            <input name="cyclos_account" id="cyclos_account" <?php if ($adhpro->cyclos_account) { echo "checked"; } ?> type="checkbox" />
            <span>Compte Cyclos</span>
        </label>
      </p>
      <p>
        &nbsp;<label>
            <input name="newsletter" id="newsletter" <?php if ($adhpro->newsletter) { echo "checked"; } ?> type="checkbox" />
            <span>Ajout Liste</span>
        </label>
      </p>
      <p>
        &nbsp;<label>
            <input name="invoice" id="invoice" <?php if ($adhpro->invoice) { echo "checked"; } ?> type="checkbox" />
            <span>Facture envoyée</span>
        </label>
      </p>
      <p>
        &nbsp;<label>
            <input name="annuaire" id="annuaire" <?php if ($adhpro->annuaire) { echo "checked"; } ?> type="checkbox" />
            <span>Ajout Annuaire</span>
        </label>
      </p>
    <button class="btn waves-effect waves-light" type="submit" name="action">Modifier
    <i class="material-icons right">send</i>
    </button>
    </form>
  </div>
        