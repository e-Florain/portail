<h3>Cyclos - <?php echo $filename; ?></h3>
<table class="striped responsive-table">
    <tr>
        <th>Login</th>    
        <th>Type</th>    
        <th>Ancien</th>
        <th>Nouveau</th>
        <th>Sens</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->
    
    <?php foreach ($infos as $key=>$info): ?>
    <tr>
        <td>
            <?php echo $key; ?>
        </td>
        <?php 
        $i=0; 
        foreach ($info as $inf):
            if ($i != 0):
        ?>
            <tr>
        <?php endif ?>
        <td>
        <?php 
        if ($inf["type"] == "delete") {
            echo '<span class="red-text">';
        }
        if ($inf["type"] == "modify") {
            echo '<span class="orange-text">';
        }
        echo $inf["type"]; 
        echo '</span>';
        ?>
        </td>
        <td><?php echo $inf["oldvalue"] ?? ""; ?></td>
        <td><?php echo $inf["newvalue"] ?? ""; ?></td>
        <?php
        if ($inf["dbtochange"] == "cyclos") {
            echo '<td><span class="material-icons">arrow_forward</span></td>';
        } else {
            echo '<td><span class="material-icons">arrow_back</span></td>';
        }
        ?>
        </tr>
        <?php $i++;
        endforeach;
        ?>
    <?php endforeach; ?>
</table>
<br>
<div class="row">
    <div class="col s4 offset-s4"><a href="/cyclos/applychanges/<?php echo $type; ?>/<?php echo $filename; ?>" class="btn waves-effect waves-light" >Appliquer les modifications</a></div>
</div>
