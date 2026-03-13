<section id="form" class=""  data-aos="fade-up" data-aos-delay="200">
    <div class="card card-success card-outline">
        <div class="card-header"><h4 class="card-title">Domaine(s) d'intervention dans la riposte</h4></div>
        <div class="card-body">
            <ul>
                <?= array_reduce(json_decode($demande->domaine_intervention),function($carry,$item){
                    return $carry."<li>$item</li>";
                },'') ?>
            </ul>
        </div>
    </div>
    <div class="card card-success card-outline">
        <div class="card-header"><h4 class="card-title"> Zones de couverture </h4></div>
        <div class="card-body">
            <b>Zones de couverture</b>
            <ul>
                <?= array_reduce(json_decode($demande->zones),function($carry,$item){
                    $zones=implode(',',array_merge($item->couverture,$item->risque));
                    return $carry."<li>{$item->province} ($zones)</li>";
                }) ?>
            </ul>
            <b>Sites d'intervention prioritaires</b>
            <ul>
                <?= array_reduce(json_decode($demande->site_intervention),function($carry,$item){
                    return $carry."<li>$item</li>";
                },'') ?>
            </ul>
        </div>
    </div>
    <div class="card card-success card-outline">
        <div class="card-header"><h4 class="card-title"> Ressources humaines </h4></div>
        <div class="card-body p-0"><table class="table table-striped">
            <thead><tr>
                <th>Nom</th>
                <th>Profil</th>
                <th>Pays</th>
            </tr></thead>
            <tbody>
                <?php foreach(json_decode($demande->rh) as $r): ?>
                <tr>
                    <td><?= $r->nom ?></td>
                    <td><?= $r->profil ?></td>
                    <td><?= $r->pays ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table></div>
    </div>
    <div class="card card-success card-outline">
        <div class="card-header"><h4 class="card-title"> Ressources matérielles </h4></div>
        <div class="card-body p-0"><table class="table table-striped">
            <thead><tr>
                <th>Nature</th>
                <th>Type</th>
                <th>Nombre</th>
                <th>valeur(USD)</th>
            </tr></thead>
            <tbody>
                <?php foreach(json_decode($demande->rm) as $r): ?>
                <tr>
                    <td><?= $r->nature ?></td>
                    <td><?= $r->type ?></td>
                    <td><?= $r->nombre ?></td>
                    <td><?= $r->valeur ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table></div>
    </div>
    <div class="card card-success card-outline">
        <div class="card-header"><h4 class="card-title"> Finances </h4></div>
        <div class="card-body">
            <dl>
                <dt>Budget alloué (USD)</dt>
                <dd><?= $demande->budget ?></dd>
            </dl>
            <b>Modalité de financement</b>
            <ul>
                <?= array_reduce(json_decode($demande->modalite),function($carry,$item){
                    return $carry."<li>$item</li>";
                },'') ?>
            </ul>
        </div>
    </div>
    <div class="card card-success card-outline">
        <div class="card-header"><h4 class="card-title"> Durée d'appui </h4></div>
        <div class="card-body">
            <form action="view?_a=update-periode&id=<?= $id ?>" method="post">
                <div class="row">
                    <div class="col-md">
                        <h4>Période sollicitée</h4>
                        <div class="form-group">
                            <label for="">Date de début</label>
                            <span class="form-control"><?= $demande->date_debut_est ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Date de fin</label>
                            <span class="form-control"><?= $demande->date_fin_est ?></span>
                        </div>
                    </div>
                    <div class="col-md">
                        <h4>Période accordée</h4>
                        <div class="form-group">
                            <label for="">Date de début</label>
                            <input type="date" name="date_debut" class="form-control" value="<?= $demande->date_debut ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Date de fin</label>
                            <input type="date" name="date_fin" class="form-control" value="<?= $demande->date_fin ?>">
                        </div>
                    </div>
                </div>
                <div class="text-right <?= $_user->profile=='Interne'?'':'d-none' ?>"><input type="submit" value="Modifier" class="btn btn-primary"></div>
            </form>
        </div>
    </div>
    <div class="card card-success card-outline">
        <div class="card-header"><h4 class="card-title">Engagement et coordination </h4></div>
        <div class="card-body">
            <ul>
            <?= array_reduce(json_decode($demande->engagement),function($carry,$item){
                    return $carry."<li>$item</li>";
            },'') ?>
            </ul>
            <dl>
                <dt>Point focal pour le suivi des activités au niveau Local</dt>
                <dd><?= $demande->pf_national??'-' ?></dd>
            </dl>
            <dl>
                <dt>Point focal pour le suivi des activités au niveau Provincial</dt>
                <dd><?= $demande->pf_provincial??'-' ?></dd>
            </dl>
            <dl>
                <dt>Point focal pour le suivi des activités au niveau National</dt>
                <dd><?= $demande->pf_local??'-' ?></dd>
            </dl>
            <dl>
                <dt>Observation</dt>
                <dd><?= $demande->obs ?></dd>
            </dl>
        </div>
    </div>
</section>