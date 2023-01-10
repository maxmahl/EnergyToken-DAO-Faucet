<!DOCTYPE html>
<?
  //Header toevoegen
  include 'includes/header.php';

  //Stelling toevoegen
  if (isset($_POST['BtnAddStelling'])) {
    // Controlleren of start datum voor de einddatum is
    if ($_POST['StartDate'] < $_POST['EndDate']) {
      // Controlleren of alle velden zijn ingevuld
      if (null != $_POST['Stelling'] && null != $_POST['Beschrijving'] && null != $_POST['Function'] && null != $_POST['ContractAdres'] && null != $_POST['StartDate'] && null != $_POST['EndDate'] && null != $_POST['ABI']) {
        // Stelling toevoegen in DB
        AddStelling($_POST['Stelling'], $_POST['Beschrijving'], $_POST['Function'], $_POST['ContractAdres'], $_POST['StartDate'], $_POST['EndDate'], $GebruikerID, $_POST['ABI'], $conn);
        //Melding toevoegen in Log
        AddLog('Nieuwe stelling is toegevoegd', $conn);
      } else {
      echo 'Vul alle gegevens in';
      }
    } else {
      echo 'Eind datum kan zich niet voor de start datum bevinden';
    }
  }


?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DAO | Stellingen</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>


<main id="main" class="main">
  <div class="pagetitle">
    <h1>Stellingen</h1>
      <? if ($Rank === "Administrator") { ?>
         <button style="float: right;" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#NieuweStelling">Nieuwe stelling toevoegen</button> <?
      } ?>   
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Stellingen</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section dashboard">
      <div class="pagetitle">
        <h1>Actieve stellingen</h1>
      </div>
      <div class="row">
    <div class="row"><?

      $query = "SELECT * FROM stellingen WHERE EindDatum >= CURDATE() AND Status = '1' ORDER BY ID";
      $result = $conn->query($query);

      if (@mysqlI_num_rows($result) > 0) {
        while($row = $result->fetch_array()) { 

          $AantalVoor = GetVoorVoting($row['ID'], $conn);
          $AantalTegen = GetTegenVoting($row['ID'], $conn);

          $TotaalAantal = $AantalVoor + $AantalTegen;

          $ProcentVoor = @round((100 / $TotaalAantal * $AantalVoor));
          $ProcentTegen = @round((100 / $TotaalAantal * $AantalTegen)); ?>

          <div class="col-sm-12 col-md-12 col-lg-6">
            <a href="stelling.php?stelling=<? echo $row['ID']; ?>">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">#<? echo $row['ID']; echo"\n"; echo $row['Stelling']; ?></h5>
                  <span style="color: black;" ><? echo $row['Beschrijving']; ?></span>
                </div> <br>
                  <div class="progress">
                    <? if ($TotaalAantal == 0) { ?>
                       <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%;">Er is nog niet gestemd</div>  <?                     
                    } else { ?>
                      <div class="progress-bar bg-success" role="progressbar" style="width: <? echo $ProcentVoor ?>%"><? echo $ProcentVoor ?>%</div>
                      <div class="progress-bar bg-danger" role="progressbar" style="width: <? echo $ProcentTegen ?>%"><? echo $ProcentTegen ?>%</div><?
                    } ?>
                  </div> 
                </div>           
            </a>
          </div><!-- End Default Card --><? 
        }
      } else {
        echo "<center>Geen actieve stellingen gevonden</center>";
      } ?> 
    </div>
      <hr style="color: #cddfff;">
      <div class="pagetitle">
        <h1>Afgeronde stellingen</h1>
      </div>
      <div class="row"><?

        $query = "SELECT * FROM stellingen WHERE EindDatum < CURDATE() AND Status = '1' ORDER BY ID";
        $result = $conn->query($query);

        if (@mysqlI_num_rows($result) > 0) {
          while($row = $result->fetch_array()) { 

            $AantalVoor = GetVoorVoting($row['ID'], $conn);
            $AantalTegen = GetTegenVoting($row['ID'], $conn);

            $TotaalAantal = $AantalVoor + $AantalTegen;

            $ProcentVoor = @ceil((100 / $TotaalAantal * $AantalVoor));
            $ProcentTegen = @floor((100 / $TotaalAantal * $AantalTegen)); ?>

            <div class="col-sm-12 col-md-12 col-lg-6">
              <a href="stelling.php?stelling=<? echo $row['ID']; ?>">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">#<? echo $row['ID']; echo"\n"; echo $row['Stelling']; ?></h5>
                    <span style="color: black;" ><? echo $row['Beschrijving']; ?></span>
                  </div> <br>
                    <div class="progress">
                      <? if ($TotaalAantal == 0) { ?>
                         <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%;">Er is niet gestemd op de stelling</div>  <?                     
                      } else { 
                        if (WhoWon($row['ID'], $conn) == "1") { ?>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%;">Stelling heeft gewonnen</div><?
                        } else { ?>
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;">De stelling is beëindigd met meerdere stemmen tegen</div><?
                        }                        
                      } ?>
                    </div> 
                  </div>           
              </a>
            </div><!-- End Default Card --><? 
          }
        } else {
          echo "Geen afgeronde stellingen";
        } ?> 
      </div>
  </section>
</main>

<!--Stelling toevoegen model-->
<div class="modal fade" id="NieuweStelling" tabindex="-1" aria-labelledby="NieuweStelling" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nieuwe stelling</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">


        <div class="row mb-3">
          <label for="inputText" class="col-form-label">Stelling *</label>
          <div class="col-sm-12">
            <input type="text" name="Stelling" class="form-control">
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputPassword" class="col-form-label">Beschrijving *</label>
          <div class="col-sm-12">
            <textarea class="form-control" name="Beschrijving" style="height: 100px"></textarea>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputDate" class="col-form-label">Start datum *</label>
          <div class="col-sm-12">
            <input type="date" name="StartDate" class="form-control">
          </div>
        </div>  

        <div class="row mb-3">
          <label for="inputDate" class="col-form-label">Eind datum *</label>
          <div class="col-sm-12">
            <input type="date" name="EndDate" class="form-control">
          </div>
        </div>        

        <div class="row mb-3">
          <label for="inputText" class="col-form-label">Contract adres *</label>
          <div class="col-sm-12">
            <input type="text" name="ContractAdres" class="form-control">
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputText" class="col-form-label">Functie in contract *</label>
          <div class="col-sm-12">
            <input type="text" name="Function" class="form-control">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-form-label">ABI *</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" name="ABI" style="height: 100px"></textarea>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Afsluiten</button>
        <input type="submit" class="btn btn-primary" placeholder="Aanmaken" name="BtnAddStelling"></input>
        </form>
      </div>
    </div>
  </div>
</div>

<?
  include 'includes/footer.php';
?>
</body>
</html>