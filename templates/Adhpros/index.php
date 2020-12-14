<!-- File: templates/Adhpros/index.php -->
<br>
<div id="modalImportAdhPro" class="modal">
    <div class="modal-content">
        <h4>Importer un csv</h4>
        <div class="row">
        <div class="input-field file-field col s6">
        <div class="btn">
            <span>Choisir</span>
            <input id="mailfiles" type="file">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate">
        </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
      <a href="/adhpros/import" class="btn waves-effect waves-light">Importer</a>
    </div>
</div>

<a class="btn-floating btn-large waves-effect waves-light light-green" href="/adhpros/add"><i class="material-icons">add</i></a>
<a class="btn-floating btn-large waves-effect waves-light light-green" href="/adhpros/importexport"><i class="material-icons">import_export</i></a>

<h3>Adhérents Pro</h3>
<table class="striped responsive-table">
    <tr>
        <th><?= $this->Html->link("Id", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "adh_id"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Date d'adh", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "date_adh"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Nom de l'orga", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "orga_name"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Contact", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "orga_contact"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Email", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "email"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Tel", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "phonenumber"]
        ]); ?>
        </th>
        <th>Adresse</th>
        <th>CP</th>
        <th><?= $this->Html->link("Ville", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "city"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Asso", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "asso_id"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Paiement", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "payment_type"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Montant", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "amount"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("NL", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "newsletter"]
        ]); ?>
        </th>
        <th>Facture</th>
        <th>Annuaire</th>
        <th></th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($adhpros as $adhpro): ?>
    <tr>
        <td>
            <?= $this->Html->link($adhpro->adh_id, ['action' => 'view', $adhpro->adh_id]) ?>
        </td>
        <td>
            <?php 
            if (isset($adhpro->date_adh)) {
                echo $adhpro->date_adh->format('Y-m-d');
            }
            ?>
        </td>
        <td>
            <?= $adhpro->orga_name ?>
        </td>
        <td>
            <?= $adhpro->orga_contact ?>
        </td>
        <td>
            <?= $adhpro->email ?>
        </td>
        <td>
            <?= $adhpro->phonenumber ?>
        </td>
        <td>
            <?= $adhpro->address ?>
        </td>
        <td>
            <?= $adhpro->postcode ?>
        </td>
        <td>
            <?= $adhpro->city ?>
        </td>
        <td>
            <?php
            foreach ($assos as $asso) {
                if ($asso->id == $adhpro->asso_id) {
                    echo $asso->name;
                }
            } 
            ?>
        </td>
        <td>
            <?= $adhpro->payment_type ?>
        </td>
        <td>
            <?= $adhpro->amount ?>
        </td>
        <td>
            <?php 
                if ($adhpro->newsletter) {
                    echo '<i class="material-icons">done</i>';
                }
            ?>
        </td>
        <td>
            <?php 
                if ($adhpro->invoice) {
                    echo '<i class="material-icons">done</i>';
                }
            ?>
        </td>
        <td>
            <?php 
                if ($adhpro->annuaire) {
                    echo '<i class="material-icons">done</i>';
                }
            ?>
        </td>
        <td class="icons">
            <a <?php echo 'href="/adhpros/edit/'.$adhpro->id.'"'; ?> class="btn-floating btn-large waves-effect waves-light light-green"><i class="material-icons">edit</i></a>
        </td>

    </tr>
    <?php endforeach; ?>
</table>