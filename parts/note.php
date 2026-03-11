<?php
require '../config.php';
require '../libs/phpqrcode/qrlib.php';


$data=$cn->query("select * from v_note_accredit where id=$id")->fetch();
$rh=json_decode($data->rh);
$nbr=count($rh);

ob_start();
QRcode::png("$data->user_nom $data->email - $data->epidemie_lib $data->instance_lib", null);
$image_data = ob_get_contents();
ob_end_clean();
$base64 = base64_encode($image_data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .header{text-align:center; font-weight: bold;}
        body{
            background-color: gray;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        .page{
            height: 29.7cm;
            width: 21cm;
            background-color: white;
            margin: auto;
            padding: 0cm;
        }
        .titre{border:3px solid black;margin: 30px 0;padding: 5px}
        .bold{font-weight: bold;}
        .center{text-align: center;}
        .content{padding: 2cm;}
        .justify{text-align:justify}
        .body{height:820px}
        .w-100{width:100%}
        .table{width: 100%;border-collapse: collapse;}
        .table td,.table th{border: 1px solid black; text-align: left;padding: 5px;}

    </style>
</head>
<body>
    <div class="page">
        <div class="content">
            <table class="header">
                <tr>
                    <td><img src="../assets/img/gouv-logo.jpg" width="100" alt=""></td>
                    <td> 
                        <div class="ministere"><small>MINISTERE DE SANTE PUBLIQUE, HYGIENE ET PREVOYANCE SOCIALE</small></div>
                        <div class="ets" style="color:orangered">INSTITUT NATIONALE DE SANTE PUBLIQUE</div>
                        <div class="direction">Direction Générale</div>
                        <hr>
                        
                    </td>
                    <td><img src="../assets/img/insp-logo.jpg" width="100" alt=""></td>
                </tr>
            </table>
            <div class="body">
                <div class="titre center bold">
                    NOTE D'ACCREDITATION DES ORGANISATIONS D'APPUI A LA RIPOSTE CONTRE LA MALADIE
                    A VIRUS D'EBOLA (MVE) N° <b>004</b>/DG/INSP/MVE/2025
                </div>
                <p>
                    Organisation : <b><?= $data->org_nom ?></b> <br>
                    Type : <b><?= $data->org_type ?></b>
                </p>
                <p class="justify">Est accréditée par le Directeur Général de l'Institut National de Santé Publique pour appuyer la riposte <b><?= $data->instance_lib ?>/<?= $data->epidemie_lib ?></b> déclarée dans la province du Kasaï.</p>
                <p class="justify">Par cette note l'organisation accepte de s'aligner sur les orientations du Gouvernement de la République pour l'atteinte des objectifs de la riposte.</p>
                <table class="table">
                    <tr>
                        <th>N°</th>
                        <th>Noms</th>
                        <th>Profil</th>
                        <th>Zones de santé appuyées</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Axes Axe d'intervention</th>
                    </tr>
                    <?php ob_start(); ?>
                        <td rowspan="<?= $nbr ?>">
                            <ul>
                                <?= array_reduce(json_decode($data->zones),function($carry,$item){
                                    return $carry.'<li>'.$item.'</li>';
                                },'') ?>
                            </ul>
                        </td>
                        <td rowspan="<?= $nbr ?>"><?= $data->date_debut_est ?></td>
                        <td rowspan="<?= $nbr ?>"><?= $data->date_fin_est ?></td>
                        <td rowspan="<?= $nbr ?>">
                            <ul>
                                <?= array_reduce(json_decode($data->domaine_intervention,true),function($carry,$item){
                                    return $carry.'<li><small>'.$item.'</small></li>';
                                },'') ?>
                            </ul>
                        </td>
                    <?php $full_cols=ob_get_clean(); $showed=false ?>
                    <?php $i=0;foreach($rh as $r): $i++ ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $r->nom ?></td>
                        <td><?= $r->profil ?></td>
                        <?php if(!$showed){echo $full_cols;$showed=true;} ?>
                    </tr>
                    <?php endforeach?>
                </table>
    
                <p class="justify">A cet effet, nous prions à toutes les autorités tant civiles que militaires de lui apporter une assistance en cas de besoin.</p>
                <table class="w-100"><tr>
                    <td width="50%"><img src="data:image/png;base64,<?= $base64 ?>"   alt=""></td>
                    <td width="50%" style="text-align: center; margin-top:100px">
                        Fait Kinshasa, le <?php $date=new DateTime($data->note_create_at);echo $date->format('d/m/Y') ?> <br><br>
                        <b><?= $data->sign_nom ?></b><br>
                        <span><?= $data->sign_titre ?></span>
                    </td>
                </tr></table>
                
            </div>
            <div class="footer" style="text-align: center;">
                <hr>
                <small>
                    05 Avenue du Rail, Q.Basoko, Commune de Ngaliema, Kinshasa-RDC <br>
                    E-mail: secretariat.insp@sante.gouv.cd/Tel. : +243817792764/www.insp.cd
                </small>
            </div>
        </div>
    </div>
</body>
</html>