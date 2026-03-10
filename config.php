<?php 
session_start();

$db=(object)[
    'dsn'=>'mysql:host=localhost;dbname=accred;charset=utf8',
    'user'=>'root',
    'pwd'=>''
];
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active les exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,       // Retourne des tableaux associatifs
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Désactive l'émulation pour plus de sécurité
];
try{
    $cn=new PDO($db->dsn,$db->user,$db->pwd,$options);

}catch(Exception $e){
    die($e->getMessage());
}

extract($_REQUEST);
$_c??='index';
$_a??='';
$id??=false;

$_pays=json_decode(file_get_contents(__DIR__.'/pays.json'));
$_province=json_decode(file_get_contents(__DIR__.'/province.json'));


