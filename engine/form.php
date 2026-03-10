<?php 
if($_a=='submit'){
    $domaine_intervention=$domaine_intervention?array_filter($domaine_intervention,function($v){return $v!='';}):[];
    $site_intervention=$site_intervention?array_filter($site_intervention,function($v){return $v!='';}):[];
    $modalite=$modalite?array_filter($modalite,function($v){return $v!='';}):[];
    $engagement=$engagement?array_filter($engagement,function($v){return $v!='';}):[];
    
    $sql="insert into demande(
        user_id,
        instance_id,
        domaine_intervention,
        site_intervention,
        zones,
        modalite,
        budget,
        date_debut,
        date_fin,
        date_debut_est,
        date_fin_est,
        engagement,
        pf_national,
        pf_provincial,
        pf_local,
        rh,
        rm,
        obs
    ) values({$_SESSION['user-id']},$id,";
    $sql.="'".str_replace("'","\'",json_encode($domaine_intervention,JSON_UNESCAPED_UNICODE))."',";
    $sql.="'".str_replace("'","\'",json_encode($site_intervention,JSON_UNESCAPED_UNICODE))."',";
    $sql.="'".str_replace("'","\'",$zones)."',";
    $sql.="'".str_replace("'","\'",json_encode($modalite,JSON_UNESCAPED_UNICODE))."',";
    $sql.="'".$budget."',";
    $sql.="'".$date_debut_est."',";
    $sql.="'".$date_fin_est."',";
    $sql.="'".$date_debut_est."',";
    $sql.="'".$date_fin_est."',";
    $sql.="'".str_replace("'","\'",json_encode($engagement,JSON_UNESCAPED_UNICODE))."',";
    $sql.="'".str_replace("'","\'",$pf_national)."',";
    $sql.="'".str_replace("'","\'",$pf_provincial)."',";
    $sql.="'".str_replace("'","\'",$pf_local)."',";
    $sql.="'".str_replace("'","\'",$rh)."',";
    $sql.="'".str_replace("'","\'",$rm)."',";
    $sql.="'".str_replace("'","\'",$obs)."')";
    
    
    $cn->exec($sql); 
    $l="form-success";
}
if($_a=='add-zone'){
    // Ajax

}
if($_a=='zone-sante'){
    // ajax
    $ret=[];
    $tmp=json_decode($cn->query("select zones from instance where id=$id")->fetch()->zones,true);
    foreach($tmp as $t){
        if($t['province']==$province){
            $ret['zones']=$t['zones'];
            break;
        }
    }
    $tmp=$cn->query("select zone,province from zone_sante where province='$province'")->fetchAll();
    
    foreach($tmp as $t){
        if($t->province==$province){
            if(!in_array($t->zone,$ret['zones'])){
                $ret['autres'][]=$t->zone;
            }
        }
    }
    
    echo json_encode($ret);
}
if($_a=='add-rh'){
    // ajax
    $_SESSION['form']['rh'][]=[
        'nom'=>$nom,
        'profil'=>$profil,
        'pays'=>$pays,
    ];
}
if($_a=='rm-rh'){
    // ajax
    array_splice($_SESSION['form']['rh'],$index,1);
}
if($_a=='load-rh'){
    $r='';
    if(count($_SESSION['form']['rh']??[])):
        $i=0;
        foreach($_SESSION['form']['rh'] as $item){
            $r.='<tr>';
            $r.="<td>{$item['nom']}</td>";
            $r.="<td>{$item['profil']}</td>";
            $r.="<td>{$item['pays']}</td>";
            $r.='<td><button onclick="rh_rm('.$i.')" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"></span></button></td>';
            $r.='</tr>';
            $i++;
        }
    else:
        $r.= '<tr><td colspan="4" style="text-align:center">Pas de données</td></tr>';
    endif;
    ob_start(); ?>
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
    <?php $r.=ob_get_clean();
    echo $r;
}
if($_a=='add-rm'){
    // ajax
    $_SESSION['form']['rm'][]=[
        'nature'=>$nature,
        'type'=>$type,
        'nombre'=>$nombre,
        'valeur'=>$valeur,
    ];
}
if($_a=='rm-rm'){
    // ajax
    array_splice($_SESSION['form']['rm'],$index,1);
}
if($_a=='load-rm'){
    $r='';
    if(count($_SESSION['form']['rm']??[])):
        $i=0;
        foreach($_SESSION['form']['rm'] as $item){
            $r.='<tr>';
            $r.="<td>{$item['nature']}</td>";
            $r.="<td>{$item['type']}</td>";
            $r.="<td>{$item['nombre']}</td>";
            $r.="<td>{$item['valeur']}</td>";
            $r.='<td><button onclick="rm_rm('.$i.')" class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"></span></button></td>';
            $r.='</tr>';
            $i++;
        }
    else:
        $r.= '<tr><td colspan="5" style="text-align:center">Pas de données</td></tr>';
    endif;
    ob_start(); ?>
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
    <?php $r.=ob_get_clean();
    echo $r;
}
if($_a=='etat'){
    $obs=str_replace("'","\'",$raison_refus);
    $sql="update demande set raison_refus='$raison_refus',etat='$etat' where id=$id";
    $cn->exec($sql);

    if($etat='Accepté'){
        $sql="insert into note_accredit(demande_id,signataire_id) values($id,$signataire_id)";
        $cn->exec($sql);
    }
    $l="view?id=$id";
}