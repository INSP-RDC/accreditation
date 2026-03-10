<?php
$rows_epidemie=$cn->query("select * from epidemie")->fetchAll();
if($id)
    $data=$cn->query("select * from v_instance where id=$id")->fetch();
?>
<div class="row"><div class="col"><form action="engine/instance/submit">
    <input type="hidden" id="id" name="id" value="<?= $id ?>">
    <input type="hidden" id="zones" name="zones" value="<?= $data->zones??'[]' ?>">
    <div class="card card-warning card-body card-outline">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Resurgence</label>
                    <input type="text" name="lib" class="form-control" value="<?= $data->lib??'' ?>">
                </div>
                <div class="form-group">
                    <label for="">Epidemie</label>
                    <select name="epidemie_id" id="epidemie_id" class="form-control"><?= array_reduce($rows_epidemie,function($carry,$item){
                        global $data;
                        $selected=($data->epidemie_id??'')==$item->id?'selected':'';
                        return$carry.'<option value="'.$item->id.'" '.$selected.'>'.$item->lib.'</option>';
                    },'') ?></select>
                </div>
                <div class="form-group">
                    <label for="">Details</label>
                    <textarea name="obs" id="obs" class="form-control"><?= $data->obs??'' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Etat</label>
                    <select name="etat" id="etat" class="form-control"><?= array_reduce(['En cours','Terminé'],function($carry,$item){
                        global $data;
                        $selected=($data->etat??'')==$item?'selected':'';
                        return $carry.'<option value="'.$item.'" '.$selected.'>'.$item.'</option>';
                    }) ?></select>
                </div>
                <div class="text-right"><button type="submit" class="btn btn-primary">Soumettre</button></div>
            </div>
            <div class="col">
                
                <div class="text-right mb-3"><button data-toggle="modal" data-target="#modal" type="button" class="btn btn-sm btn-secondary">Ajouter la zone</button></div>
                <table class="table table-sm" id="table-zone">
                    <thead><tr><th>Province</th><th>Zone</th><th width="1%"></th></tr></thead>
                    <tbody>
                    <?php $i=0; if($data->zones): ?>
                        <?php foreach(json_decode($data->zones) as $item): ?>
                            <tr>
                                <td><?= $item->province ?></td>
                                <td><?= implode(',',$item->zones) ?></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="remove_zone('<?= $i ?>')">Supprimer</button></td>
                            </tr>
                        <?php $i++;endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="text-center">Aucune zone ajoutée</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form></div></div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="engine/epidemie/add" class="modal-content">
            <input type="hidden" name="id">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Détails</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Province</label>
                    <select name="province" id="province" onchange="load_zone(this.value)" class="form-control form-control-sm"><?= array_reduce($_province,function($carry,$item){
                        return $carry.'<option>'.$item.'</option>';
                    },'<option disabled selected>Selectionnez la province</option>') ?></select>
                </div>
                <div class="form-group">
                    <label for="">Zone de santé</label>
                    <select multiple="multiple" id="zone" class="select2 form-control form-control-sm"></select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="submit_zone()">Ajouter</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </form>
    </div>
</div>
<script>
    function load_zone(province){
        
        fetch(`engine/instance/zone-sante?province=${province}`)
        .then(e=>e.json()).then(r=>{
            document.querySelector('#zone').innerHTML=r.reduce((carry,item)=>{
                return carry+`<option>${item}</option>`
            })
        })
        $('#zone').val(null).trigger('change');
        
    }
    function submit_zone(){
        let rz=JSON.parse(document.getElementById('zones').value)
        if(rz.length==0){document.querySelector('#table-zone tbody').innerHTML='';}
        const r={
            province:document.getElementById('province').value,
            zones:Array.from(document.getElementById('zone').selectedOptions).map(e=>e.value)
        }
        
        rz.push(r);
        document.getElementById('zones').value=JSON.stringify(rz)
        document.querySelector('#table-zone tbody').innerHTML+=`
            <tr>
                <td>${r.province}</td>
                <td>${r.zones.join(', ')}</td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="delete_zone(${rz.length-1})">Supprimer</button></td>
            </tr>`
        $('#zone').val(null).trigger('change');
        document.querySelector('#province').selectedIndex=0
    }
    function remove_zone(index){
        let rz=JSON.parse(document.getElementById('zones').value)
        rz.splice(index,1)
        document.getElementById('zones').value=JSON.stringify(rz)
        document.querySelector('#table-zone tbody').innerHTML=rz.reduce((carry,item,i)=>{
            return carry+`
            <tr>
                <td>${item.province}</td>
                <td>${item.zones.join(', ')}</td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="delete_zone(${i})">Supprimer</button></td>
            </tr>`
        },'')   
    }
</script>