<div class="col">
    <div class="card card-warning card-outline">
        <div class="card-header"><h5 class="card-title">EPIDEMIE</h5></div>
        <div class="card-body">
            <dl>
                <dt>Nom</dt><dd><?= $instance->epidemie_lib ?></dd>
            </dl>
            <dl>
                <dt>Resurgence</dt><dd><?= $instance->lib ?></dd>
            </dl>
        </div>
    </div>
    <div class="card card-warning card-outline">
        <div class="card-header"><h5 class="card-title">PARTENAIRE</h5></div>
        <div class="card-body">
            <dl>
                <dt>Dénomination</dt>
                <dd><?= $user->org_nom ?></dd>
            </dl>
            <dl>
                <dt>Type d'acteur</dt>
                <dd><?= $user->org_type ?></dd>
            </dl>  
        </div>
    </div>
    <div class="card card-warning card-outline">
        <div class="card-header"><h5 class="card-title">REPRESENTANT</h5></div>
        <div class="card-body">   
            <dl>
                <dt>Nom</dt>
                <dd><?= $user->nom ?></dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd><?= $user->email ?></dd>
            </dl>
            <dl>
                <dt>Contact</dt>
                <dd><?= $user->telephone ?></dd>
            </dl>
        </div>
    </div>
</div>