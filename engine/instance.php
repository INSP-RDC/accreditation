<?php
if($_a=='submit'){
    $obs=str_replace("'","\'",$obs);
    $zones='[]';
    if($id){
        // update
        $sql="update instance set epidemie_id='$epidemie_id',lib='$lib',obs='$obs',zones='$zones',etat='$etat' where id=$id";
    }
    else{
        // add
        $sql="insert into instance(epidemie_id,lib,obs,zones) values('$epidemie_id','$lib','$obs','$zones')";
    }
    $cn->exec($sql);
    $l='instance';
}
if($_a=='delete'){
    $sql="delete from instance where id=$id";
    $cn->exec($sql);
    $l='instance';
}
if($_a=="zone-sante"){
    // ajax
    $sql="select * from zone_sante where province='$province'";
    echo json_encode(array_map(function($item){
        return $item->zone;
    },$cn->query($sql)->fetchAll()));
}