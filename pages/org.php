<?php 
$data=$cn->query("select * from v_user where id={$_SESSION['user-id']}")->fetch();

?>
<div class="row"><div class="col-md-6 m-auto"><div class="card card-body">
    <form action="engine/user/update-org">
        <section id="org" >
            <div class="form-group">
                <label for="">Organisation</label>
                <span name="partenaire_id" id="partenaire_id" class="form-control">
                    <?= $data->org_nom ?>
                </span>
            </div>
            <div class="form-group">
                <label for="">Type d'acteur</label>
                <span name="" id="" class="form-control">
                    <?= $data->org_type ?>
                </span>
            </div>
            <div class="form-group">
                <label for="">Siège</label>
                <input type="text" value="<?= $data->org_siege ?>" class="form-control" name="siege">
            </div>
        </section>
        <div class="text-right"><button type="submit" class="btn btn-primary">Soumettre</button></div>
    </form>
</div></div></div>
