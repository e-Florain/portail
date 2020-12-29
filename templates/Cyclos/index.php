<h3>Cyclos</h3>
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
        <td><?php echo $inf["type"]; ?></td>
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