<?php
$sign_fn=function($carry,$item){
    return $carry.'<option value="'.$item->id.'">'.$item->nom.'</option>';
};

$sign_rows=$cn->query("select * from signataire_accredit")->fetchAll();
?>
<div class="col" data-aos="fade-up" data-aos-delay="100">
    <div class="card card-info card-outline">
        <div class="card-header"><h5 class="card-title">EPIDEMIE</h5></div>
        <div class="card-body">
            <dl>
                <dt>Etat</dt><dd class="badge badge-info"><?= $demande->etat ?></dd>
            </dl>
            <?php 
            if($demande->etat=='Refusé'):?>
            <dl>
                <dt>Raison</dt><dd><?= $demande->raison_refus ?></dd>
            </dl>
            <?php endif ?>
            <?php if($demande->etat=='Accepté'):
                ?>
                <a target="_blank" href="parts/note.php?id=<?= $demande->id ?>" class="btn btn-info btn-block">Note d'accreditation</a>
                <?php
            endif?>
            
        </div>
    </div>
    <div class="card card-warning card-outline">
        <div class="card-header"><h5 class="card-title">EPIDEMIE</h5></div>
        <div class="card-body">
            <dl>
                <dt>Nom</dt><dd><?= $demande->epidemie_lib ?></dd>
            </dl>
            <dl>
                <dt>Resurgence</dt><dd><?= $demande->instance_lib ?></dd>
            </dl>
        </div>
    </div>
    <div class="card card-warning card-outline">
        <div class="card-header"><h5 class="card-title">PARTENAIRE</h5></div>
        <div class="card-body">
            <dl>
                <dt>Dénomination</dt>
                <dd><?= $demande->org_nom ?></dd>
            </dl>
            <dl>
                <dt>Type d'acteur</dt>
                <dd><?= $demande->org_type ?></dd>
            </dl>  
        </div>
    </div>
    <div class="card card-warning card-outline">
        <div class="card-header"><h5 class="card-title">REPRESENTANT</h5></div>
        <div class="card-body">   
            <dl>
                <dt>Nom</dt>
                <dd><?= $demande->user_nom ?></dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd><?= $demande->email ?></dd>
            </dl>
            <dl>
                <dt>Contact</dt>
                <dd><?= $demande->telephone ?></dd>
            </dl>
        </div>
    </div>
    <?php if(($_user->profile??'')=='Interne' && $demande->etat=='En cours'):?>
    <div class="card card-body card-outline card-info">
        <form action="engine/form/etat" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group">
                <label for="">Modifier l'état</label>
                <select name="etat" id="etat" class="form-control"><?= array_reduce(['En cours','Accepté','Refusé'],function($carry,$item){
                    return $carry.'<option>'.$item.'</option>';
                },'') ?></select>
            </div>
            <div id="obs-box" class="form-group d-none">
                <label for="">raison du refus</label>
                <textarea name="raison_refus" id="raison_refus" class="form-control" rows="4"></textarea>
            </div>
            <hr>
            <div id="sign-box" class="form-group d-none">
                <label for="">Signataire de l'accréditation</label>
                <select name="signataire_id" id="signataire_id" class="form-control"><?= array_reduce($sign_rows,$sign_fn,'') ?></select>
            </div>
            <div class="text-right"><button type="submit" class="btn btn-info">Valider</button></div>
        </form>
    </div>
    <script>
        const etat =document.getElementById('etat')
        const obs=document.getElementById('obs-box')
        const sign=document.getElementById('sign-box')
        etat.addEventListener('change',()=>{
            if(etat.value=='Accepté'){sign.classList.remove('d-none')}
            else{sign.classList.add('d-none')}
            if(etat.value=='Refusé'){obs.classList.remove('d-none');document.getElementById('raison').value=''}
            else{obs.classList.add('d-none')}
        })
    </script>
    <?php endif?>
</div>