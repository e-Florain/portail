Adhérents pros;<?php echo $trash_view.";".$nbitems; ?>;
<table class="striped responsive-table">
    <tr>
        <th>
            <label>
            <input type="checkbox" id="selectAll"/>
            <span></span>
            </label>
        </th>
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
        <th><?= $this->Html->link("Année.s d'adh", [
            'controller' => 'adhs',
            'action' => 'index',
            '?' => ['orderby' => "adh_years"]
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
        <th><?= $this->Html->link("Cyclos", [
            'controller' => 'adhpros',
            'action' => 'index',
            '?' => ['orderby' => "cyclos_account"]
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
            <label>
            <input type="checkbox" id="<?php echo $adhpro->id; ?>" name="<?php echo $adhpro->id; ?>"/>
            <span></span>
            </label>
        </td>
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
            <?= $adhpro->adh_years ?>
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
            <?= $adhpro->payment_type ?>
        </td>
        <td>
            <?= $adhpro->amount ?>
        </td>
        <td>
            <?php 
                if ($adhpro->cyclos_account) {
                    echo '<i class="material-icons">done</i>';
                }
            ?>
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
<?php
echo '<ul class="pagination">';
echo $this->Paginator->first("<<",array('rel'=>'prev','tag'=>'li'));
if($this->Paginator->hasPrev()){
echo $this->Paginator->prev("<",array('tag'=>'li'));
}
echo $this->Paginator->numbers(array('first' => 2,'last' => 3,'modulus'=> '4','separator' => '','tag'=>'li'));
if($this->Paginator->hasNext()){
    echo $this->Paginator->next(">",array('tag'=>'li'));
}
echo $this->Paginator->last(">>",array('rel'=>'next','tag'=>'li'));
echo '</ul>';
?>