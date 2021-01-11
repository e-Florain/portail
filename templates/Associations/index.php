<!-- File: templates/Adhs/index.php -->
<br>
<a class="btn-floating btn-large waves-effect waves-light btn-pink" href="/associations/add"><i class="material-icons">add</i></a>
<a class="btn-floating btn-large waves-effect waves-light btn-blue" href="/associations/importexport"><i class="material-icons">import_export</i></a>
<h3>
    <div id='nbassos'>Associations
    <?php if ($trash_view) { 
            echo "effacés";
            echo "(".$nbitems_trashed.")";
        } else {
            echo "(".$nbitems.")";    
        }
    ?>
    </div>
</h3>
<?php
if ($trash_view) {
?>
    <a href="/associations/index">x Fermer la corbeille</a>
<?php
} else {
?>
    <a href="/associations/index/trash:true">Corbeille (<?php echo $nbitems_trashed; ?>)</a>
<?php
}
?>

<table class="striped responsive-table">
    <tr>
        <th><?= $this->Html->link("Id", [
            'controller' => 'associations',
            'action' => 'index',
            '?' => ['orderby' => "asso_id"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Nom", [
            'controller' => 'associations',
            'action' => 'index',
            '?' => ['orderby' => "name"]
        ]); ?>
        </th>
        <th><?= $this->Html->link("Activité", [
            'controller' => 'associations',
            'action' => 'index',
            '?' => ['orderby' => "activite"]
        ]); ?>
        </th>

        <th></th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($assos as $asso): ?>
    <tr>
        <td>
            <?php echo $asso->asso_id; ?>
        </td>
        <td>
            <?= $asso->name ?>
        </td>
        <td>
            <?= $asso->activite ?>
        </td>
        <td class="icons"> 
            <a <?php echo 'href="/associations/edit/'.$asso->id.'"'; ?> class="btn-floating btn-large waves-effect waves-light btn-green"><i class="material-icons">edit</i></a>
            <a <?php echo 'href="/associations/delete/'.$asso->id.'"'; ?> class="btn-floating btn-large waves-effect waves-light btn-orange"><i class="material-icons">delete</i></a>
            <?php if ($trash_view): ?>
            <a <?php echo 'href="/associations/restore/'.$asso->id.'"'; ?> class="btn-floating btn-large waves-effect waves-light btn-orange"><i class="material-icons">restore_from_trash</i></a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>