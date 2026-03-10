<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark <?= !isset($_SESSION['user-id']) ?'d-none':'' ?>">
    <div class="container">
      <a href="./" class="navbar-brand">
        <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Accredit</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item"><a href="./" class="nav-link">Accueil</a></li>
          <li class="nav-item"><a href="list-demande" class="nav-link">Mes demandes</a></li>
          <?php if($_user->role=='Editeur'): ?>
          <li class="nav-item"><a href="epidemie" class="nav-link">Epidémies</a></li>
          <li class="nav-item"><a href="instance" class="nav-link">Instances</a></li>
          <?php endif?>
          <?php if($_user->role=='Point Focal'): ?>
          <li class="nav-item"><a href="users" class="nav-link">Utilisateurs</a></li>
          <?php endif?>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown"><a href="#" class="nav-link"><?= $_user->nom??'' ?></a></li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="profil" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> Profil
            </a>
            <div class="dropdown-divider"></div>
            <a href="org" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> Organisation
            </a>
            <div class="dropdown-divider"></div>
            <a href="pwd" class="dropdown-item">
              <i class="fas fa-key mr-2"></i> Changer mot de passe
            </a>
            <div class="dropdown-divider"></div>
            <a href="engine/user/logout" class="dropdown-item">
              <i class="fas fa-power-off mr-2"></i> Deconnexion
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->