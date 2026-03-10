<?php 

if(!isset($_SESSION['user-id'])){
    header('location:login');
    exit();
}

$vague=$cn->query("select v.*,e.lib epidemie_lib from instance v join epidemie e on e.id=v.epidemie_id where v.etat='En cours'")->fetchAll();
$demandes=$cn->query('select d.*,v.lib as instance_lib,e.lib as epidemie_lib from demande d join instance v on v.id=d.instance_id join epidemie e on e.id=v.epidemie_id where user_id='.$_SESSION['user-id'])->fetchAll();

$clause='1';
if($_user->org_nom!='INSP'){
  $clause="org_id=$_user->organisation_id";
}
$demande_all=$cn->query("select count(*) nbr from v_demande where $clause")->fetch()->nbr;
$demande_en_cours=$cn->query("select count(*) nbr from v_demande where etat='En cours' and $clause")->fetch()->nbr;
$demande_accepte=$cn->query("select count(*) nbr from v_demande where etat='Accepté' and  $clause")->fetch()->nbr;
$demande_rejete=$cn->query("select count(*) nbr from v_demande where etat='Refusé' and  $clause")->fetch()->nbr;
?>
<div class="row" data-aos="fade-up" >
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Demandes</span>
          <span class="info-box-number" id="n_total"><?= $demande_all ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">En cours</span>
          <span class="info-box-number" id="n_en_cours"><?= $demande_en_cours ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Acceptées</span>
          <span class="info-box-number" id="n_accepte"><?= $demande_accepte ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Refusées</span>
          <span class="info-box-number" id="n_refuse"><?= $demande_rejete ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
</div>
<div class="row">
    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
      <?php foreach($vague as $v): ?>
      <div class="card card-success card-outline">
       <div class="card-body">
         <h4 class="card-title text-bold">
          <?= $v->epidemie_lib ?> -
          <small><?= $v->lib ?></small>
        </h4>
         <p class="card-text">
          <dl><dt>Date de début</dt><dd><?= $v->create_at ?></dd></dl>
        </p>
        <p><?= $v->obs ?></p>
         <a href="form?id=<?= $v->id ?>" class="btn btn-outline-success float-right">Demander accreditation</a>
       </div>
      </div>
      <?php endforeach ?>
    </div>
    <div class="col" data-aos="fade-up" data-aos-delay="300">
      <div class="card card-body card-warning card-outline">
        <div id="chart-container" style="position: relative; height: 300px; width: 100%;">
          <canvas id="donutChart" style="height: 100%;"></canvas>
        </div>
      </div>
      <div class="card card-body card-warning card-outline d-none" >
        <div id="chart-container" style="position: relative; height: 300px; width: 100%;">
          <canvas id="stackedBarChart" style="height: 100%;"></canvas>
        </div>
      </div>
    </div>
</div>

<script>
window.onload = function(){
  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var donutData        = {
    labels: [ 
        'En cours', 
        'Acceptées', 
        'Refusées'
    ],
    datasets: [
      {
        data: [
          document.querySelector('#n_en_cours').innerText, 
          document.querySelector('#n_accepte').innerText, 
          document.querySelector('#n_refuse').innerText, 
        ],
        backgroundColor : ['#f39c12', '#00a65a', '#f56954'],
      }
    ]
  }
  var donutOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    plugins: {
        legend: {
            labels: {
                // Change la couleur du texte de la légende
                color: '#ffffff'
            }
        }
    }
  }
  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })


  var barChartData = {
      labels: ['EBOLA', 'COVID', 'CHOLERA'],
      datasets: [
        {
          label: 'Financement',
          backgroundColor: '#3c8dbc',
          data: [650000, 59000, 80000, 810000, 56000, 0, 400000]
        },
        {
          label: 'Gap',
          backgroundColor: '#f39c12',
          data: [280000, 480000, 40000, 19000, 86000, 0, 0]
        },
      ]
    }

  var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)
    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
}
</script>