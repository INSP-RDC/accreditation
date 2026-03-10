<?php
$domaine_intervention=[
    'Coordination',
    "Gestion et analyse des données intégrées",
    "Surveillance épidémiologique",
    "Surveillance animale",
    "Surveillance environnementale",
    "Prise en charge médicale et psychosociale",
    "Laboratoire",
    "Prise en charge nutritionnelle et soutien alimentaire",
    "PCI/WASH",
    "EDS",
    "Communication des risques et engagement communautaire (CREC)",
    "Vaccination",
    "Logistique / Transport / Chaîne d'approvisionneme",
    "Sécurité et protection",
    "Appui financier / mobilisation des ressources",
    "Formation / renforcement des capacités"
];
$zone_couverture=[
    "BULAPE","MWEKA","MUSHENGE","KAKENGE",
];
$site_intervention=[
    'Centres de santé',
    'Hôpitaux',
    'Communautés',
    "Points d'entrée",
];
$province=array_map(function($item){return $item->province;},json_decode($cn->query("select zones from instance where id=$id")->fetch()->zones));
?>
<section id="step-1">
    <div class="card card-success card-outline">
        <div class="card-header"><h4 class="card-title">
            Domaine(s) d'intervention dans la riposte
        </h4></div>
        <div class="card-body">
            <?= checks($domaine_intervention,'domaine_intervention') ?>
            <input type="checkbox" class="autre" id="ch1" data-target="box1"> &nbsp; Autre
            <div id="box1" class="form-group d-none">
                <label for="">Préciser</label>
                <input type="text" name="domaine_intervention[]" class="form-control">
            </div>
        </div>
    </div>
    <div class="card card-success card-outline">
        <div class="card-header"><div class="card-title">Zone de couverture</div></div>
        <div class="card-body p-0">
            <div class="row m-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Province</label>
                        <select onchange="load_zone()" name="province" id="province" class="form-control">
                            <?= array_reduce($province,function($carry,$item){$carry.="<option value='$item'>$item</option>";return $carry;}) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input onclick="document.querySelector('#box-risque').classList.toggle('d-none')" type="checkbox" name="autre-zone" id="autre-zone">
                        Inclure des zones à risque
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="">Zone de santé</label>
                        <select name="zone" id="zone" multiple class="select2 form-control"></select>
                    </div>
                    <div class="form-group d-none" id="box-risque">
                        <label for="">Zone à risque</label>
                        <select name="zone-risque" id="zone-risque" multiple class="select2 form-control"></select>
                    </div>
                    <div class="form-group text-right">
                        <button onclick="add_zone()" type="button" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </div>
            <table id="table-zone" class="table table-striped table-sm">
            <thead><tr>
                <th>Province</th>
                <th>Zone de couverture</th>
                <th>Zone à rique</th>
                <th width="1%"></th>
            </tr></thead>
            <tbody></tbody>
        </table></div>
    </div>
    <div class="card card-success card-outline" >
        <div class="card-header"><h4 class="card-title">
            Sites d'intervention prioritaires
        </h4></div>
        <div class="card-body">
            <?= checks($site_intervention,'site_intervention') ?>
            <input type="checkbox" class="autre" data-target="box2"> &nbsp; Autre
            <div class="form-group d-none" id="box2">
                <label for="">Préciser</label>
                <input type="text" name="site_intervention[]" class="form-control">
            </div>
        </div>
    </div>
</section>

<script>
    function load_table(){
        const zones=JSON.parse(document.getElementById('zones').value)
        if(zones.length==0){document.querySelector('#table-zone tbody').innerHTML=`<tr><td colspan="4" class="text-center">Pas de donnée</td></tr>`;return}
        else{document.querySelector('#table-zone tbody').innerHTML=''}
        
        zones.forEach((e,i)=>{
            document.querySelector('#table-zone tbody').innerHTML+=`
            <tr>
                <td>${e.province}</td>
                <td>${e.couverture.join()}</td>
                <td>${e.risque.join()}</td>
                <td><button type="button" onclick="remove_zone(${i})" class="btn btn-default btn-sm"><span class="fa fa-trash"></span></button></td>
            </tr>
            `
        })
    }
    function load_zone(index){
        const province=document.getElementById('province')
        const id=<?= $id ?>
        
        fetch(`engine/form/zone-sante?province=${province.value}&id=${id}`)
        .then(e=>e.json()).then(r=>{ 
            const zone=r.zones
            const autre_zone=r.autres
            document.getElementById('zone').innerHTML= 
            zone.reduce((carry,item)=>{
                return carry+`<option>${item}</option>`
            },'')
            document.getElementById('zone-risque').innerHTML= 
            autre_zone.reduce((carry,item)=>{
                return carry+`<option>${item}</option>`
            },'')
            $('.select2').select2()
        })
    }
    function add_zone(){
        let zone=document.getElementById('zone')
        let risque=document.getElementById('zone-risque')
        const province=document.getElementById('province')
        let zones=JSON.parse(document.getElementById('zones').value)

        
        zones.push({
            province:province.value,
            couverture:Array.from(zone.selectedOptions).map(option => option.value),
            risque:risque ? Array.from(risque.selectedOptions).map(option => option.value) : []
        })
        document.getElementById('zones').value=JSON.stringify(zones)
        
        load_table()
        
    }
    function remove_zone(index){
        let zones=JSON.parse(document.getElementById('zones').value)
        zones.splice(index,1)
        document.getElementById('zones').value=JSON.stringify(zones)
        load_table()
    }
    load_zone()
    load_table()
</script>