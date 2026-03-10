<div class="row"><div class="col-md-6 m-auto"><div class="card card-body">
    <form action="engine/user/profil" method="post">
        <section id="pf">
            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" class="form-control" name="nom" value="<?= $_user->nom ?>">
            </div>
            <div class="form-group">
                <label for="">Prénom</label>
                <input type="text" class="form-control" name="prenom" value="<?= $_user->prenom ?>">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" value="<?= $_user->email ?>">
            </div>
            <div class="form-group">
                <label for="">Téléphone</label>
                <input type="text" class="form-control" name="telephone" value="<?= $_user->telephone ?>">
            </div>
            
        </section>
        <div class="text-right"><button type="submit" class="btn btn-primary">Soumettre</button></div>
    </form>
</div></div></div>
