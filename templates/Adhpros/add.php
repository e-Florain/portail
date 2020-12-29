<br>
<h3>Ajouter un adhérent pro</h3>
  <div class="row">
    <?php echo $this->Form->create(); ?>
    <form class="col s12" methode="post" action="/adhpros/add">
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
          <input name="orga_name" id="orga_name" type="text" required class="validate">
          <label for="orga_name">Nom de l'organisation</label>
        </div>
        <div class="input-field col s6">
          <input name="orga_contact" id="orga_contact" type="text" required class="validate">
          <label for="orga_contact">Contact de l'organisation</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="email" id="email" type="email" required class="validate">
          <label for="email">Email</label>
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
          <input name="address" id="address" type="text" class="validate">
          <label for="address">Adresse</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="postcode" id="postcode" type="text" class="validate">
          <label for="postcode">Code Postal</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="city" id="city" type="text" class="validate">
          <label for="city">Ville</label>
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
          <input name="amount" id="amount" type="text" class="validate">
          <label for="amount">Montant</label>
        </div>
      </div>
      <p>
        &nbsp;<label>
            <input name="account_cyclos" id="account_cyclos" type="checkbox" />
            <span>Compte Cyclos</span>
        </label>
      </p>
      <p>
        &nbsp;<label>
            <input name="newsletter" id="newsletter" type="checkbox" />
            <span>Ajout Liste</span>
        </label>
      </p>
      <p>
        &nbsp;<label>
            <input name="invoice" id="invoice" type="checkbox" />
            <span>Facture envoyée</span>
        </label>
      </p>
      <p>
        &nbsp;<label>
            <input name="annuaire" id="annuaire" type="checkbox" />
            <span>Ajout Annuaire</span>
        </label>
      </p>
    <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
    <i class="material-icons right">send</i>
    </button>
    </form>
  </div>
        