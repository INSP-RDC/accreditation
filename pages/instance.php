<?php
$sql="select * from v_instance";
$rows=$cn->query($sql)->fetchAll();
?>
<div class="row">
    <div class="col">
        <div class="card card-body card-warning card-outline">
            <table class="table">
                <thead>
                    <tr>
                        <th>Epidemie</th>
                        <th>Instance</th>
                        <th>Demande</th>
                        <th>Budget prevue</th>
                        <th>Création</th>
                        <th>Etat</th>
                        <th width="1%"><a href="instance-form" class="btn btn-primary"><span class="fa fa-plus"></span></a></th>
                    </tr>
                </thead>
                <tbody><?php foreach($rows as $r):?><tr>
                    <td><?= $r->epidemie_lib ?></td>
                    <td><?= $r->lib ?></td>
                    <td><?= $r->n_demande ?></td>
                    <td><?= $r->budget ?></td>
                    <td><?= $r->create_at ?></td>
                    <td><?= $r->etat ?></td>
                    <td>
                        <div class="btn-group"><a href="instance-form?id=<?= $r->id ?>" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a><a href="engine/instance/delete?id=<?= $r->id ?>" class="btn btn-sm btn-default"><span class="fa fa-trash"></span></a></div>
                    </td>
                </tr><?php endforeach?></tbody>
            </table>
        </div>
    </div>
</div>