<!doctype html>
<?php include_once 'db.php'; ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Administrace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="./style/dashboard.css" rel="stylesheet">
    <?php
    $sql_get= mysqli_query($conn, "SELECT * FROM notifications WHERE status = '0'");
    $count = mysqli_num_rows($sql_get);
    ?>
</head>

<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="./">Los Lopatos</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav">
  <button class="btn btn-secondary dropdown-toggle bg-dark border border-dark " type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fa-regular fa-bell fa-2xl"></i> <span class="badge bg-danger" id="count"><?php echo $count; ?></span>
  </button>
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item dropdown">
    <ul class="dropdown-menu">
    <?php
      $sql_get1 = mysqli_query($conn, "SELECT * FROM notifications WHERE status = 0"); 
      if(mysqli_num_rows($sql_get1)>0)
      {
        while($row = mysqli_fetch_assoc($sql_get1))
        {
          $id = $row['id'];
          $subjekt = $row['subjekt'];
          $comment = $row['comment'];
          $status = $row['status'];
          $created_at = $row['created_at'];
          $ID_user = $row['ID_user'];
          echo '<a class="dropdown-item" target="_blank" href="read_msg.php?id='.$row['id'].'" >'.$row['subjekt'].'</a>';
        }
      }
      else
      {
        echo '<li class="dropdown-item">Žádné nové notifikace</li>';
      }
    ?>
  </ul>
  </li>
  </ul>
  </header>

  <div class="container-fluid">
    <div class="d-none id_user_hidden"><?php if(isset($_SESSION['id_user'])) echo $_SESSION['id_user']?></div>
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky sidebar-sticky">
        <?php if(isset($_SESSION['id_user'])) echo "
        <h6 class='sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase'>
          <span>Agenda</span>
        </h6> "; ?>
          <ul class="nav flex-column">
          <?php 
            if(isset($_SESSION['id_user'])) echo "
            <li class='nav-item'>
                <a class='nav-link' aria-current='page' href='./clanek'>
                <i class='fa-solid fa-plus fa-fw'></i>
              Přidat článek
              </a>
            </li>";
            if(isset($_SESSION['id_user'])) echo "
            <li class='nav-item'>
                <a class='nav-link' aria-current='page' href='./processes'>
                <i class='fa-solid fa-list-check fa-fw'></i>
              Řízení
              </a>
            </li>";
            if(isset($_SESSION['id_user'])) echo "
            <li class='nav-item'>
              <a class='nav-link' aria-current='page' href='./recenze'>
                <i class='fa-solid fa-file fa-fw'></i>
                Recenze
              </a>
            </li>"; ?>
          </ul> 

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Ostatní</span>
          </h6>
        <ul class="nav flex-column mb-2">
          <?php if(isset($_SESSION['id_user']) && $_SESSION['role'] == 4) echo "
          <li class='nav-item'>
            <a class='nav-link' aria-current='page' href='./users'>
              <i class='fa-solid fa-users fa-fw'></i>
              Uživatelé
            </a>
          </li>";
          if(isset($_SESSION['id_user'])) echo "
          <li class='nav-item'>
            <a class='nav-link' href='./user?id={$_SESSION['id_user']}'>
              <i class='fa-solid fa-user fa-fw'> </i>
              Můj účet
            </a>
          </li>"; ?>
          <li class="nav-item">
            <a class="nav-link" href="../">
              <i class="fa-solid fa-newspaper fa-fw"></i>
              Časopis
            </a>
          </li>
          <?php if(isset($_SESSION['id_user'])) echo "
          <li class='nav-item'>
            <a class='nav-link' href='../../php/logout'>
              <i class='fa-solid fa-right-from-bracket fa-fw'></i>
              Odhlásit se
            </a>
          </li>"; ?>
        </ul>
      </div>
    </nav>
        </div>
      
    </div>

  <main class="col-md-9 ms-md-auto col-lg-10 px-md-4">
