<?php

$engagement=[
    "Réunions COUSP","Réunion de coordination provinciale","cluster santé"
];
?>
<section id="step-4" class="d-none">
    <div class="card card-success card-outline">
        <div class="card-header"><div class="card-title">Engagement et coordination</div></div>
        <div class="card-body">
            <?= checks($engagement,'engagement') ?>
            <input type="checkbox" class="autre" data-target="box4"> &nbsp; Autre
            <div class="form-group d-none" id="box4">
                <label for="">Préciser</label>
                <input type="text" name="engagement[]" class="form-control">
            </div>
            <hr>
            <label for="">Personne désignée pour le suivi des activités</label><br>
            <input type="checkbox" class="autre" data-target="n"> &nbsp; National <br>
            <div class="form-group d-none" id="n">
                <label for="">Point focal pour le suivi des activités au niveau National</label>
                <input type="text" name="pf_national" class="form-control">
            </div>
            <input type="checkbox" class="autre" data-target="p"> &nbsp; Provincial <br>
            <div class="form-group d-none" id="p">
                <label for="">Point focal pour le suivi des activités au niveau Provincial</label>
                <input type="text" name="pf_provincial" class="form-control">
            </div>
            <input type="checkbox" class="autre" data-target="l"> &nbsp; Local <br>
            <div class="form-group d-none" id="l">
                <label for="">Point focal pour le suivi des activités au niveau Local</label>
                <input type="text" name="pf_local" class="form-control">
            </div> 
            <br>
            <div class="form-group">
                <label for="">Observations / remarques</label>
                <textarea rows="10" name="obs" class="form-control"></textarea>
            </div>
        </div>
    </div>
</section>