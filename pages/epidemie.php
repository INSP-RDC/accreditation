<?php
$title="Epidemies";
$rows=$cn->query("select * from v_epidemie")->fetchAll();
?>
<div class="row"><div class="col"><div class="card card-warning card-outline card-body p-0"><table class="table table-striped">
    <thead><tr>
        <th>Nom</th>
        <th>Nombre instances</th>
        <th>Nombre demandes</th>
        <th>Buget total</th>
        <th width="1%"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal">Ajouter</button></th>
    </tr></thead>
    <tbody><?php foreach($rows as $r): ?>
        <tr>
            <td><?= $r->lib ?></td>
            <td><?= $r->n_instance ?></td>
            <td><?= $r->n_demande ?></td>
            <td><?= $r->budget ?></td>
            <td><a href="engine/epidemie/del?id=<?= $r->id ?>" class="btn btn-block btn-sm btn-primary">
                <span class="fa fa-trash"></span>
            </a></td>
        
        </tr>
    <?php endforeach?></tbody>
</table></div></div></div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="engine/epidemie/add" class="modal-content">
            <input type="hidden" name="id">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Détails</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Epidemie</label>
                    <input type="text" name="lib" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </form>
    </div>
</div>