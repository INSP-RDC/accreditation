<?php
// Engine

$modalite=[
    'Directe',
    'Via partenaires locaux',
    'Via autorités sanitaires'
];
?>
<section id="step-3" class="d-none">
    <div class="card card-success card-outline">
        <div class="card-header"><div class="card-title">Finances</div></div>
        <div class="card-body">
            <div class="form-group">
                <label for="">Budet alloué (USD)</label>
                <input type="text" name="budget" value="0" class="form-control">
            </div>
            <label for="">Modalité de financement</label> <br>
            <?= checks($modalite,'modalite') ?>
            <input type="checkbox" class="autre" data-target="box3"> &nbsp; Autre
            <div class="form-group d-none" id="box3">
                <label for="">Préciser</label>
                <input type="text" name="modalite[]" class="form-control">
            </div>
        </div>
    </div>
    <div class="card card-success card-outline">
        <div class="card-header"><div class="card-title">Durée d'appui</div></div>
        <div class="card-body">
            <div class="form-group">
                <label for="">Date de début</label>
                <input type="date" name="date_debut_est" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Date de fin prévue</label>
                <input type="date" name="date_fin_est" id="" class="form-control">
            </div>
        </div>
    </div>
</section>