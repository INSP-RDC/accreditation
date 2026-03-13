<?php
// ajax
if($_a=='update-periode'){
    $sql="update demande set date_debut='$date_debut',date_fin='$date_fin' where id=$id";
    $cn->exec($sql);
    header("location:view?id=$id");
    exit;
}
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