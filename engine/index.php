<?php
require_once '../config.php';

$url="$_c.php";
if(is_file($url)&& $_c!='index'){
    require_once $url;
    if($l??''){header("location:../../$l");}
}
