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
            <?php echo $adhpro->adh_id; ?>
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
            <a <?php echo 'href="/adhpros/edit/'.$adhpro->id.'"'; ?> class="btn-floating btn-large waves-effect waves-light btn-green"><i class="material-icons">edit</i></a>
            <a <?php echo 'href="/adhpros/delete/'.$adhpro->id.'"'; ?> class="btn-floating btn-large waves-effect waves-light btn-orange"><i class="material-icons">delete</i></a>
        </td>

    </tr>
    <?php endforeach; ?>
</table>