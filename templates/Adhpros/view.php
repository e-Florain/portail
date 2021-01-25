<br>
<h3>Adhérent <?php echo $adhpro->id; ?></h3>
<?php
foreach($list_keys as $key=>$namekey) {
    echo '<div class="row">';
    echo "<div class='col s1'>".$namekey." : </div><div class='col s3'>".$adhpro->{$key}."</div>";
    echo '</div>';
}
?>