<?php
$colors=[
    'En cours'=>'warning',
    'Accepté'=>'success',
    'Refusé'=>'danger',
];
?>
<div class="row"  data-aos="fade-up" data-aos-delay="200"><div class="col"><div class="card card-body card-success card-outline p-0"><table class="table table-striped">
    <thead><tr>
        <th>Epidemie</th>
        <th>Période</th>
        <th>Demandeur</th>
        <th>Ress. humaine</th>
        <th>Ress. matérielle (USD)</th>
        <th>Financement (USD)</th>
        <th>Etat</th>
        <th width="1%"></th>
    </tr></thead>
    <tbody>
        <?php 
        $clause=$_user->profile=='Externe'?"org_id='$_user->organisation_id'":"1";
        $sql="select * from v_demande where $clause";
        $r=$cn->query($sql)->fetchAll();
        foreach($r as $item):
        ?>
        <tr>
            <td>
                <?= $item->epidemie_lib ?> <br>
                <small><?= $item->instance_lib ?></small>
            </td>
            <td>
                <?= $item->date_debut_est ?> <br>
                <small><?= $item->date_fin_est ?></small>
            </td>
            <td>
                <?= $item->org_nom ?> <br>
                <small><?= $item->user_nom ?></small>
            </td>
            <td><?= count(json_decode($item->rh)) ?></td>
            <td><?= array_reduce(json_decode($item->rm),function ($carry, $item) {
                return $carry+$item->valeur;
            },0) ?></td>
            <td><?= $item->budget ?></td>
            <td><span class="badge badge-<?= $colors[$item->etat] ?>"><?=$item->etat?></span></td>
            <td><a href="view?id=<?= $item->id ?>" class="btn btn-sm btn-default"><span class="fa fa-eye"></span></a></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table></div></div></div>