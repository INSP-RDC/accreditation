<?php 
require 'config.php';
require 'functions.php';
// Engine

if($_c=='new-accredit'){
    $_SESSION['instance-id']=$id;
    header('location:form');
}

if(isset($_SESSION['user-id'])){
    $_user=$cn->query("select * from v_user where id={$_SESSION['user-id']}")->fetch();
}

$title='Tableau de bord';
$layout='layout';

$url=is_file("pages/$_c.php")?"pages/$_c.php":"pages/404.php";
ob_start();require$url;
$content=ob_get_clean();

$url="pages/$_c.js";
$script='';
if(is_file($url)){
    ob_start();require$url;
    $script=ob_get_clean();
}


require "layers/$layout.php";