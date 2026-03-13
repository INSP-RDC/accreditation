<?php 
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'accred');
define('DB_USER', 'root');
define('DB_PASS', '');

$db=(object)[
    'dsn'=>'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',
    'user'=>DB_USER,
    'pwd'=>DB_PASS
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


