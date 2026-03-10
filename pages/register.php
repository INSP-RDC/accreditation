
<?php

$title="Inscription du point focal";
?>
<div class="row"><div class="col-md-6 m-auto"><div class="card card-body">
    <form action="engine/user/register" method="post">
        <h4 class="text-center text-bold">Inscription</h4>
        <section id="pf">
            <div class="form-group">
                <label for="">Titre</label>
                <select name="titre" class="form-control">
                    <option value="M.">M.</option>
                    <option value="Mme">Mme</option>
                    <option value="Mlle">Mlle</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" name="nom" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Prénom</label>
                <input type="text" name="prenom" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="password" class="form-control" name="pwd">
            </div>
            <div class="form-group">
                <label for="">Confirmation</label>
                <input type="password" class="form-control" name="confirm">
            </div>
            <div class="form-group">
                <label for="">Téléphone</label>
                <input type="text" class="form-control" name="telephone">
            </div>
            <div class="form-group">
                <label for="">Organisation</label>
                <select name="organisation_id" id="organisation_id" class="form-control">
                    <option value="-1" disabled selected>Sélectionner</option>
                    <?= array_reduce($cn->query('select * from organisation')->fetchAll(), function($carry, $item){return $carry . "<option value='$item->id'>$item->nom</option>";}, ''); ?>
                    <option value="0">Préciser</option>
                </select>
            </div>
        </section>
        <section id="org" class="d-none">
            <div class="form-group">
                <label for="">Type d'acteur</label>
                <select name="type_acteur" id="type_acteur" class="form-control">
                    <option>ONG Internationale</option>
                    <option>ONG Nationale</option>
                    <option>Gourvernement</option>
                    <option>Secteur Privé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Siège</label>
                <input type="text" name="siege" class="form-control">
            </div>
        </section>
        <div class="text-right"><button type="submit" class="btn btn-primary">Soumettre</button></div>
        <a href="login">Se connecter</a>
    </form>
</div></div></div>
<script>
    let organisation_id=document.getElementById('organisation_id')
    organisation_id.addEventListener('change',()=>{
        if(organisation_id.value==0){document.getElementById('org').classList.remove('d-none')}
        else{document.getElementById('org').classList.add('d-none')}
    })
</script>