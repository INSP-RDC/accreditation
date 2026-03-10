<?php
$vague=$cn->query('select * from v_instance v join epidemie e on e.id=v.epidemie_id')->fetchAll();
$couleur=['En cours'=>'warning','Terminé'=>'danger'];

?>
<div class="row" data-aos="fade-up" data-aos-delay="200"><div class="col"><div class="card card-body card-success card-outline p-0"><table class="table table-striped">
    <thead><tr>
        <th>Epidemie</th>
        <th>Vague</th>
        <th>Date</th>
        <th>Zones cibles</th>
        <th>Etat</th>
        <th width="1%"></th>
    </tr></thead>
    <tbody>
        <?php foreach($vague as $item): ?>
        <tr>
            <td><?= $item->epidemie_lib ?></td>
            <td><?= $item->lib ?></td>
            <td><?= $item->create_at ?></td>
            <td><?= '' ?></td>
            <td><span class="badge badge-<?= $couleur[$item->etat] ?>"><?= $item->etat ?></span></td>
            <td><?= 
            $item->etat=='En cours'?
            '<a href="form?id='.$item->id.'" class="btn btn-sm btn-default"><span class="fa fa-plus"></span></a>':
            '' 
            ?></td>
        </tr>
        <?php endforeach?>
    </tbody>
</table></div></div></div>