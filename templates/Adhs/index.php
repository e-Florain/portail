<!-- File: templates/Adhs/index.php -->
<br>
<a class="btn-floating btn-large waves-effect waves-light btn-pink" href="/adhs/add"><i class="material-icons">add</i></a>
<a class="btn-floating btn-large waves-effect waves-light btn-blue" href="/adhs/importexport"><i class="material-icons">import_export</i></a>
<h3>Adhérents</h3>
<?php
if ($trash_view) {
?>
    <a href="/adhs/index">x Fermer la corbeille</a>
<?php
} else {
?>
    <a href="/adhs/index/false">Corbeille (<?php echo $nbitems_trashed; ?>)</a>
<?php
}
?>
<table class="striped responsive-table">
    <tr>
        <th><?= $this->Html->link("Id", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "adh_id"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Date d'adh", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "date_adh"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Année.s d'adh", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "adh_years"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Nom", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "lastname"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Prénom", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "firstname"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Ville", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "city"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Email", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "email"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Tel", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "phonenumber"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Asso", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "asso_id"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Paiement", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "payment_type"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Montant", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "amount"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Newsletter", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "newsletter"]
        ]); ?>
        </th>
        <th></th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($adhs as $adh): ?>
    <tr>
        <td>
            <?= $this->Html->link($adh->adh_id, ['action' => 'view', $adh->adh_id]) ?>
        </td>
        <td>
            <?php 
            if (isset($adh->date_adh)) {
                echo $adh->date_adh->format('Y-m-d');
            }
            ?>
        </td>
        <td>
            <?= $adh->adh_years ?>
        </td>
        <td>
            <?= $adh->lastname ?>
        </td>
        <td>
            <?= $adh->firstname ?>
        </td>
        <td>
            <?= $adh->city ?>
        </td>
        <td>
            <?= $adh->email ?>
        </td>
        <td>
            <?= $adh->phonenumber ?>
        </td>
        <td>
            <?php
            foreach ($assos as $asso) {
                if ($asso->id == $adh->asso_id) {
                    echo $asso->name;
                }
            } 
            ?>
        </td>
        <td>
            <?= $adh->payment_type ?>
        </td>
        <td>
            <?= $adh->amount ?>
        </td>
        <td>
            <?php 
                if ($adh->newsletter) {
                    echo '<i class="material-icons">done</i>';
                }
            ?>
        </td>
        <td class="icons">
            <a <?php echo 'href="/adhs/edit/'.$adh->id.'"'; ?> class="btn-floating btn-large waves-effect waves-light btn-green"><i class="material-icons">edit</i></a>
            <a <?php echo 'href="/adhs/delete/'.$adh->id.'"'; ?> class="btn-floating btn-large waves-effect waves-light btn-orange"><i class="material-icons">delete</i></a>
        </td>

    </tr>
    <?php endforeach; ?>
</table>