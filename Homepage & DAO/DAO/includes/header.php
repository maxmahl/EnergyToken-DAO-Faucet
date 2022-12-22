<!-- Adding Token script -->
  <script type="module">
    import { GetTokenBalance } from '/DAO/assets/js/token.js';
    GetTokenBalance();
  </script> 
<?
  // Include de connectie van de DB en functies
  include 'includes/functions.php';
 	include 'includes/connection.php';

  //Variabelen krijgen van cookie(s)
	$walletID = @$_COOKIE["WalletID"];
  $TokenAmount = @$_COOKIE["TokenAmount"];

  // Variabelen zetten van de gebruiker
  $GebruikerID = GetID($walletID, $conn);
  $Rank = GetRang($GebruikerID, $conn);
  $Name = GetName($GebruikerID, $conn);

  // Als WalletID niet gezet is ga terug naar home
  if (null == $walletID) {
  	//$_SESSION["WalletID"] = $walletID;
  	echo "<script type='text/javascript'>window.top.location='https://blockchainminor.nl';</script>"; exit;
  } 

?>
  <!-- Favicons -->
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/EnergyToken.png" alt="">
        <span class="d-none d-lg-block">Energy Provenance</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"><? echo $Name; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><? echo $Rank; ?></h6>
              <span><? echo $walletID; ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profiel.php">
                <i class="bi bi-person"></i>
                <span>Mijn profiel</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="faq.php">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q.</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="uitloggen.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Uitloggen</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Pagina's</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="stellingen.php">
          <i class="bi bi-card-list"></i>
          <span>Stellingen</span>
        </a>
      </li>

      <? if ($Rank === "Administrator") { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="gebruikersbeheren.php">
          <i class="bi bi-people"></i>
          <span>Gebruikers beheren</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="devlog.php">
          <i class="bi bi-list-columns-reverse"></i>
          <span>Dev log</span>
        </a>
      </li><?
      }?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="https://faucet.blockchainminor.nl">
          <i class="bi bi-gem"></i>
          <span>Faucet</span>
        </a>
      </li><!-- End Blank Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="faq.php">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q.</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="uitloggen.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Uitloggen</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->


<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Adding Web3JS -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/web3modal@1.9.8/dist/index.js"></script>
<script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.7.8/dist/umd/index.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
