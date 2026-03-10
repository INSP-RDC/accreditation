<?php
function checks($array,$name){
    $ret='';
    foreach($array as $item){
        $ret.=<<<eot
        <input type="checkbox" name="{$name}[]" value="$item"> &nbsp; $item <br>
eot;
    }
    return $ret;
}