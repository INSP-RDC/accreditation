<?php
if($_a=='logout'){
    session_destroy();
    $l='login';
}
if($_a=='login'){
    $sql="select * from user where email='$email' and pwd='$pwd'";
    $r=$cn->query($sql)->fetch();
    if($r){
        $_SESSION['user-id']=$r->id;
        $l='./';
    }else{$l='login?err=1';}
    
}
if($_a=='update-org'):
    $id=$cn->query("select organisation_id id from user where id={$_SESSION['user-id']}")->fetch()->id;
    $siege=htmlspecialchars($siege);
    $sql="update organisation set siege='$siege' where id=$id";
    $cn->exec($sql);
    $l='org';
endif;
if($_a=='register'){
    if($pwd!=$confirm){$l='?err=1';}
    else{
        if($organisation_id==0){
            $sql="insert into organisation(nom,type_acteur,siege) values('$nom','$type_acteur','$siege')";
            $cn->exec($sql);
            $organisation_id=$cn->lastInsertId();
        }
        $sql="insert into user(titre,nom,prenom,email,pwd,telephone,organisation_id,role) values('$titre','$nom','$prenom','$email','$pwd','$telephone',$organisation_id,'Point Focal')";
        $cn->exec($sql);
        $l='login';
    }
}
if($_a=='add'){
    $pwd=rand('100000','999999');
    $sql="insert into user(titre,nom,prenom,email,pwd,telephone,organisation_id,role) values('$titre','$nom','$prenom','$email','$pwd','$telephone',$organisation_id,'Agent')";
    $cn->exec($sql);
    $l='users';
}
if($_a=='profil'){
    $sql="update user set nom='$nom', prenom='$prenom',email='$email',telephone='$telephone' where id={$_SESSION['user-id']} ";
    $cn->exec($sql);
    $l='profil';
}
if($_a=='pwd'){
    
    if($old!=$cn->query("select pwd from user where id='{$_SESSION['user-id']}'")->fetch()->pwd){
        $l="pwd?err=old";
    }
    elseif($pwd!=$confirm){$l='pwd?err=confirm';}
    else{
        $sql="update user set pwd='$pwd' where id='{$_SESSION['user-id']}'";
        echo $sql;
        $cn->exec($sql);
        $l='.';
    }
    
}