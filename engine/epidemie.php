<?php
if($_a=='add'){
    $sql="insert into epidemie(lib) values('$lib')";
    $cn->exec($sql);
    $l='epidemie';

}
if($_a=='del'){
    $cn->exec("delete from epidemie where id=$id");
    $l='epidemie';
}