<section id="step-2" class="d-none">
    <div class="card card-success card-outline">
        <div class="card-header"><div class="card-title">Ressources Humaine</div></div>
        <div class="card-body p-0"><table id="table-rh" class="table table-sm table-striped">
            <thead><tr>
                <th>Nom</th>
                <th>Profil</th>
                <th>Pays</th>
                <th width="1%"></th>
            </tr></thead>
            <tbody></tbody>
        </table></div>
    </div>
    <div class="card card-success card-outline">
        <div class="card-header"><div class="card-title">Ressources matérielle</div></div>
        <div class="card-body p-0"><table id="table-rm" class="table table-sm table-striped">
            <thead><tr>
                <th>Nature</th>
                <th>Type</th>
                <th>Nombre</th>
                <th>valeur(USD)</th>
                <th width="1%"></th>
            </tr></thead>
            <tbody></tbody>
        </table></div>
    </div>
</section>
<script>
    let rh=JSON.parse(document.getElementById('rh').value)
    let rm=JSON.parse(document.getElementById('rm').value)
    function load_rh(){
        let table=document.querySelector('#table-rh tbody')
        table.innerHTML=''
        rh.forEach((e,i)=>{
            table.innerHTML+=`
            <tr>
                <td>${e['nom']}</td>
                <td>${e['profil']}</td>
                <td>${e['pays']}</td>
                <td>
                    <button onclick="rm_rh(${i})" class="btn btn-sm btn-outline-danger">
                        <span class="fa fa-trash"></span>
                    </button>
                </td>
            </tr>
            `
        })
        if(table.innerHTML==''){table.innerHTML=`<tr><td colspan="4" style="text-align:center">Pas de données</td></tr>`}
        table.innerHTML+=`
        <tr>
            <td><input id="rh_nom" type="text" class="form-control form-control-sm"></td>
            <td><input id="rh_profil" type="text" class="form-control form-control-sm"></td>
            <td><select name="" id="rh_pays" class="form-control form-control-sm">
                <?php foreach($_pays as $k=>$v): ?>
                <option value="<?= $v ?>"><?= $v ?></option>
                <?php endforeach ?>
            </select></td>
            <td><button type="button" onclick="add_rh()" class="btn btn-sm btn-outline-success"><span class="fa fa-plus"></span></button></td>
        </tr>
        `
    }
    function load_rm(){
        let table=document.querySelector('#table-rm tbody')
        table.innerHTML=''
        rm.forEach((e,i)=>{
            table.innerHTML+=`
            <tr>
                <td>${e['nature']}</td>
                <td>${e['type']}</td>
                <td>${e['nombre']}</td>
                <td>${e['valeur']}</td>
                <td>
                    <button onclick="rm_rm(${i})" class="btn btn-sm btn-outline-danger">
                        <span class="fa fa-trash"></span>
                    </button>
                </td>
            </tr>
            `
        })
        if(table.innerHTML==''){table.innerHTML=`<tr><td colspan="4" style="text-align:center">Pas de données</td></tr>`}
        table.innerHTML+=`
        <tr>
            <td><select name="" id="rm_nature" class="form-control form-control-sm">
                <option>Vehicule</option>
                <option>Moto</option>
                <option>EPI</option>
                <option>Intant médicament</option>
                <option>Intant vaccin</option>
            </select></td>
            <td><input id="rm_type" type="text" class="form-control form-control-sm"></td>
            <td><input id="rm_nombre" type="text" class="form-control form-control-sm"></td>
            <td><input id="rm_valeur" type="text" class="form-control form-control-sm"></td>
            <td><button type="button" onclick="add_rm()" class="btn btn-sm btn-outline-success"><span class="fa fa-plus"></span></button></td>
        </tr>
        `
    }
    function add_rh(){
        const nom=document.getElementById('rh_nom').value
        const profil=document.getElementById('rh_profil').value
        const pays=document.getElementById('rh_pays').value
        
        rh.push({
            nom:nom,
            profil:profil,
            pays:pays,
        })
        document.getElementById('rh').value=JSON.stringify(rh)
        load_rh()
    }
    function add_rm(){
        const nature=document.getElementById('rm_nature').value
        const type=document.getElementById('rm_type').value
        const nombre=document.getElementById('rm_nombre').value
        const valeur=document.getElementById('rm_valeur').value
        
        rm.push({
            nature:nature,
            type:type,
            nombre:nombre,
            valeur:valeur,
        })
        document.getElementById('rm').value=JSON.stringify(rm)
        load_rm()
    }
    function rm_rh(index){
        rh.splice(index,1)
        load_rh()
    }
    function rm_rm(index){
        rm.splice(index,1)
        load_rm()
    }
    
    load_rh()
    load_rm()
</script>