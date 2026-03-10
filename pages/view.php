<?php
$s??='form';
$sql="select * from v_demande where id=$id";
$demande=$cn->query($sql)->fetch();
$title='visualiser la demande';
?>
<div class="row">
    <div class="col-md-8">
        
        <?php require_once "view.form.php";?>
    </div>
    <div class="col">
        <?php require_once 'view.sidebar.php' ?>
    </div>
</div>