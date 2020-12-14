<br>
  <div class="row">
    <?php echo $this->Form->create(); ?>
    <form class="col s12" methode="post" action="/associations/add">
    <input name="id" id="id" type="hidden" class="validate">
      <div class="row">
        <div class="input-field col s2">
          <input name="id" id="id" type="text" class="validate">
          <label for="id">ID</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="name" id="name" type="text" class="validate">
          <label for="name">Nom</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="activite" id="activite" type="text" class="validate">
          <label for="activite">Activite</label>
        </div>
      </div>
    <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
    <i class="material-icons right">add</i>
    </button>
    </form>
  </div>
        