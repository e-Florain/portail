<br>
<h3>Ajouter un adhérent pro</h3>
  <div class="row">
    <?php echo $this->Form->create(); ?>
      <div class="row">
        <div class="input-field col s2">
          <input name="adh_id" id="adh_id" type="text" value="<?php echo isset($data['adh_id'])?$data['adh_id']:''; ?>" required class="validate">
          <label for="adh_id">Numéro d'adhérent</label>
        </div>
        <div class="input-field col s3">
          <input name="date_adh" type="text" id="date_adh" value="<?php echo isset($data['date_adh'])?substr($data['date_adh'],0,10):''; ?>" required class="datepicker">
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
          <input name="orga_name" id="orga_name" type="text" value="<?php echo isset($data['orga_name'])?$data['orga_name']:''; ?>" required class="validate">
          <label for="orga_name">Nom de l'organisation</label>
        </div>
        <div class="input-field col s6">
          <input name="orga_contact" id="orga_contact" type="text" value="<?php echo isset($data['orga_contact'])?$data['orga_contact']:''; ?>" required class="validate">
          <label for="orga_contact">Contact de l'organisation</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="email" id="email" type="email" value="<?php echo isset($data['email'])?$data['email']:''; ?>" required class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="phonenumber" id="phonenumber" type="text" value="<?php echo isset($data['phonenumber'])?$data['phonenumber']:''; ?>" class="validate">
          <label for="phonenumber">Téléphone</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="phonenumber2" id="phonenumber2" type="text" value="<?php echo isset($data['phonenumber2'])?$data['phonenumber2']:''; ?>" class="validate">
          <label for="phonenumber2">Téléphone 2</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="address" id="address" type="text" value="<?php echo isset($data['address'])?$data['address']:''; ?>" class="validate">
          <label for="address">Adresse</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="postcode" id="postcode" type="text" value="<?php echo isset($data['postcode'])?$data['postcode']:''; ?>" class="validate">
          <label for="postcode">Code Postal</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="city" id="city" type="text" value="<?php echo isset($data['city'])?$data['city']:''; ?>" class="validate">
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
          <input name="amount" id="amount" type="text" value="<?php echo isset($data['amount'])?$data['amount']:''; ?>" class="validate">
          <label for="amount">Montant</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="donation" id="donation" type="text" value="<?php echo isset($data['donation'])?$data['donation']:''; ?>" class="validate">
          <label for="donation">Don</label>
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
      <p>
        &nbsp;<label>
            <input name="is_asso" id="is_asso" type="checkbox" />
            <span>Est-ce une association ?</span>
        </label>
      </p>
    <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
    <i class="material-icons right">send</i>
    </button>
    </form>
  </div>
        