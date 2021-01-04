<!-- File: templates/Adhs/index.php -->
<br>
<a class="btn-floating btn-large waves-effect waves-light btn-pink" href="/adhs/add"><i class="material-icons">add</i></a>
<a class="btn-floating btn-large waves-effect waves-light btn-blue" href="/adhs/importexport"><i class="material-icons">import_export</i></a>
<h3>
    <div id='nbadhs'>Adhérents 
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
    <a href="/adhs/index">x Fermer la corbeille</a>
<?php
} else {
?>
    <a href="/adhs/index/trash:true">Corbeille (<?php echo $nbitems_trashed; ?>)</a>
<?php
}
?>
<form class="col s12">
    <div class="row">
        <div class="input-field col s6">
            <i class="material-icons prefix">search</i>
            <input type="text" id="filter_Adhs_text"></textarea>
            <label for="icon_prefix2"></label>
        </div>
        <?php
        $tmp = true;
        if (date("W")>=44){
            echo '<div class="input-field col s1">';
            echo '<label>';
            echo '<input class="checkAdhsYears" id="'.(date("Y")+1).'" name="'.(date("Y")+1).'" type="checkbox" />';
            echo '<span>'.(date("Y")+1).'</span>';
            echo '</label>';
            echo '</div>';
            //echo '<option value="'.(date("Y")+1).'">'.(date("Y")+1).'</option>';
            $tmp=false;
        }
        echo '<div class="input-field col s1">';
        echo '<label>';
        echo '<input class="checkAdhsYears" id="'.(date("Y")).'" name="'.(date("Y")).'" type="checkbox" />';
        echo '<span>'.(date("Y")).'</span>';
        echo '</label>';
        echo '</div>';

        echo '<div class="input-field col s1">';
        echo '<label>';
        echo '<input class="checkAdhsYears" id="'.(date("Y")-1).'" name="'.(date("Y")-1).'" type="checkbox" />';
        echo '<span>'.(date("Y")-1).'</span>';
        echo '</label>';
        echo '</div>';

        if ($tmp) {
            echo '<div class="input-field col s1">';
            echo '<label>';
            echo '<input class="checkAdhsYears" id="'.(date("Y")-2).'" name="'.(date("Y")-2).'" type="checkbox" />';
            echo '<span>'.(date("Y")-2).'</span>';
            echo '</label>';
            echo '</div>';
            //echo '<option value="'.(date("Y")-2).'">'.(date("Y")-2).'</option>';
        }
        ?>
    </div>
</form>
<div id="results">
<table class="striped responsive-table">
    <tr>
        <th>
            <label>
            <input type="checkbox" id="selectAll"/>
            <span></span>
            </label>
        </th>
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
            <label>
            <input type="checkbox" id="<?php echo $adh->id; ?>" name="<?php echo $adh->id; ?>"/>
            <span></span>
            </label>
        </td>
        <td>
            <?= $adh->adh_id ?>
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
            <?php if ($trash_view): ?>
            <a <?php echo 'href="/adhs/restore/'.$adh->id.'"'; ?> class="btn-floating btn-large waves-effect waves-light btn-orange"><i class="material-icons">restore_from_trash</i></a>
            <?php endif; ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>
</div>
<div class="row">
    <div class="input-field col s3">
        <select multiple name="adh_years[]" id="adh_years" required>
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
    <div class="input-field col s3">
        <button class="btn btn-primary" onclick="applyAdh('adhs');">Appliquer</button>
    </div>
</div>