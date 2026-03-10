<?php
$org_id=$cn->query("select organisation_id data from user where id={$_SESSION['user-id']}")->fetch()->data;
$rows=$cn->query("select * from user where organisation_id=$org_id and not id={$_SESSION['user-id']}")->fetchAll();
$title="Utilisateurs";
?>
<div class="row"><div class="col"><div class="card card-warning card-outline card-body p-0"><table class="table table-striped">
    <thead><tr>
        <th>Titre</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th width="1%"><button class="btn btn-sm btn-warning" data-target="#modal" data-toggle="modal"><span class="fa fa-plus"></span></button></th>
    </tr></thead>
    <tbody>
        <?php foreach($rows as $row):?>
        <tr>
            <td><?= $row->titre ?></td>
            <td><?= $row->nom ?></td>
            <td><?= $row->prenom ?></td>
            <td><?= $row->email ?></td>
            <td><?= $row->telephone ?></td>
            <td><button data-target="#modal" data-id="<?= $row->id ?>" data-toggle="modal" class="btn btn-default btn-sm">
                <span class="fa fa-eye"></span>
            </button></td>
        </tr>
        <?php endforeach?>
    </tbody>
</table></div></div></div>

<div class="modal fade" id="modal">
        <div class="modal-dialog">
          <form method="post" action="engine/user/add" class="modal-content">
            <input type="hidden" name="organisation_id" value="<?= $org_id ?>">
            <div class="modal-header">
              <h4 class="modal-title">Utilisateurs</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Titre</label>
                    <select name="titre" id="titre" class="form-control"><?= array_reduce(['M.','Mme','Dr.'],function($carry,$item){
                            return $carry."<option>$item</option>";
                        }) ?></select>
                </div>
                <div class="form-group">
                    <label for="">Nom</label>
                    <input type="text" class="form-control" name="nom">
                </div>
                <div class="form-group">
                    <label for="">Prénom</label>
                    <input type="text" class="form-control" name="prenom">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="">Téléphone</label>
                    <input type="text" class="form-control" name="telephone">
                </div>
                <div class="form-group">
                    <label for="">Etat</label>
                    <select name="etat" id="etat" class="form-control">
                        <?= array_reduce(['Actif','Inactif'],function($carry,$item){
                            return $carry."<option>$item</option>";
                        }) ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-outline-light">Ajouter</button>
            </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>