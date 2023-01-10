<!DOCTYPE html>
<html lang="en">
<?
  include 'includes/header.php';
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DAO | Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
</head>

<body>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Aantal kW/u</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-lightning"></i>
                    </div>
                    <div class="ps-3">
                      <h6><? echo round(@$_COOKIE["TokenAmount"], 2); ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Open stellingen</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6><? echo AantalOpenStellingen($conn); ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Personen in DAO</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><? echo AantalGebruikers($conn); ?></h6>
                    </div>
                  </div>
                </div>
              </div>

            </div><!-- End Customers Card --> <?

        // Als gebruiker administrator is zie admin power bi 
        if ($Rank === "Administrator") { ?>
        <div class="pagetitle">
          <h1>Inzicht gebruikers</h1>
        </div>
        <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <center>
                  <br>
                  <iframe title="Administrator - Administrator" width="100%" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiYWI5NjRmN2QtZWY0ZS00ODA2LTg4MjAtNjlhMDA2MjBiMGU1IiwidCI6ImYzMjgzMDAzLTk3NmYtNDQxNi1hOGFjLWIyMDVhOTY3YmZlOSIsImMiOjl9" frameborder="0" allowFullScreen="true"></iframe>
                </center>            
              </div>
            </div>
          </div>
        </div>
        <!-- Anders zie persoonlijk scherm --><?
        } else { ?>
          <div class="pagetitle">
            <h1>Inzicht zonnenpanelen</h1>
          </div>
          <div class="col-12">
            <div class="card recent-sales overflow-auto">
              <div class="card-body">
                  <center>
                    <br>
                    <iframe title="Persoonlijk & met zoeken" width="100%" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiOGE3NzQ1NzktZjk2Mi00MGIxLWFlNDQtMjZlMDVjZmExYzRlIiwidCI6ImYzMjgzMDAzLTk3NmYtNDQxNi1hOGFjLWIyMDVhOTY3YmZlOSIsImMiOjl9&pageName=ReportSection8280b8a00d2d2c1a630a" frameborder="0" allowFullScreen="true"></iframe>
                  </center>            
                </div>
              </div>
            </div>
          </div><?
        } ?>

    </section>

  </main>
<?
  include 'includes/footer.php';
?>
</body>
</html>