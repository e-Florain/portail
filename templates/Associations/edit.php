<br>
  <div class="row">
    <?php echo $this->Form->create(); ?>
    <input name="id" id="id" <?php echo 'value="'.$asso->id.'"'; ?> type="hidden" class="validate">
      <div class="row">
        <div class="input-field col s2">
          <input name="asso_id" id="asso_id" <?php echo 'value="'.$asso->asso_id.'"'; ?> type="text" class="validate">
          <label for="asso_id">ID</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="name" id="name" <?php echo 'value="'.$asso->name.'"'; ?> type="text" class="validate">
          <label for="name">Nom</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="activite" id="activite" <?php echo 'value="'.$asso->activite.'"'; ?> type="text" class="validate">
          <label for="activite">Activite</label>
        </div>
      </div>
    <button class="btn waves-effect waves-light" type="submit" name="action">Modifier
    <i class="material-icons right">edit</i>
    </button>
    </form>
  </div>
        