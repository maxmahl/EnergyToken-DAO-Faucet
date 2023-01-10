<!DOCTYPE html>
<html>

<?
  // Header toevoegen
  include 'includes/header.php';

  //Variabelen krijgen van de stelling (Achter de URL ?stelling=)
  $stellingID = $_GET["stelling"];
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stelling | <? echo GetStellingName($stellingID, $conn); ?></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<main id="main" class="main"><?

  // Als de stelling disabled wordt
  if (isset($_POST['BtnDisableStelling'])) { 
    AddLog('Stelling #'.$stellingID.' is uitgeschakeld', $conn);
    DisableStelling($stellingID, $conn); ?>
    <div style="margin-bottom: 20px!important;" class="alert alert-warning" role="alert">De stelling is uitgeschakeld</div> <?
  }

  // Dit wordt uitgevoert als de gebruiker op submit drukt.
  if (isset($_POST['StemmenSubmit'])) {
    if (null === CheckIfUserVoted($GebruikerID, $stellingID, $conn)) {
      if (null != $_POST['Keuze'] && null != $_POST['Aantal']) {
        if ($_POST['Aantal'] > 0 && $_POST['Aantal'] <= $TokenAmount) {
          Stemmen($GebruikerID, $stellingID, $_POST['Keuze'], round(sqrt($_POST['Aantal']),2), $_POST['Aantal'], $conn); ?>
          <div style="margin-bottom: 20px!important;" class="alert alert-success" role="alert">Stemmen is succesvol uitgevoerd</div><?
        } else { ?>
          <div style="margin-bottom: 20px!important;" class="alert alert-danger" role="alert">Aantal moet tussen de waarde vallen</div><?
        }      
      }  else { ?>
        <div style="margin-bottom: 20px!important;" class="alert alert-danger" role="alert">Vul alle gegevens in</div> <?
      }
    } else { ?>
        <div style="margin-bottom: 20px!important;" class="alert alert-danger" role="alert">Je hebt al gestemd op deze stelling</div> <?
    }
  }?>

  <div class="pagetitle">
    <h1>Stelling "<? echo GetStellingName($stellingID, $conn); ?>"</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="stellingen.php">Stellingen</a></li>
        <li class="breadcrumb-item active"><? echo GetStellingName($stellingID, $conn); ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-8">
        <!-- Default Card -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Gegevens</h5>
              <div class="row">
                <div class="col-lg-3 col-md-4 label"><b>ID</b></div>
                <div class="col-lg-8 col-md-8"><? echo $stellingID; ?></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label"><b>Status</b></div>
                <div class="col-lg-8 col-md-4"><?
                  if (GetStellingStatus($stellingID, $conn) == 0 || GetStellingEindDatum($stellingID, $conn) < date("Y-m-d")) {
                    echo "Gesloten";
                  } else {
                    echo "Actief";
                  }?>                
                </div>
              </div> <?
              if (GetStellingStatus($stellingID, $conn) == 0 || GetStellingEindDatum($stellingID, $conn) < date("Y-m-d")) { ?>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label"><b>Resultaat</b></div>
                  <div class="col-lg-8 col-md-4"><?
                    if (GetStellingUitvoering($stellingID, $conn) == 1) {
                      echo "Uitgevoerd";
                    } else {
                      echo "Niet Uitgevoerd";
                    } ?>              
                  </div>
                </div><hr> <?
              } else { ?>
                <hr> <?
              } ?>

              <div class="row">
                <div class="col-lg-3 col-md-4 label"><b>Stelling</b></div>
                <div class="col-lg-8 col-md-8"><? echo GetStellingName($stellingID, $conn); ?></div> 
              </div>
              
              <div class="row">
                <div class="col-lg-3 col-md-4 label"><b>Beschrijving</b></div>
                <div class="col-lg-8 col-md-8"><? echo GetStellingBeschrijving($stellingID, $conn); ?></div>
              </div><hr>

              <div class="row">
                <div class="col-lg-3 col-md-4 label"><b>Start Datum</b></div>
                <div class="col-lg-8 col-md-8"><? echo GetStellingStartDatum($stellingID, $conn); ?></div>
              </div>
              
              <div class="row">
                <div class="col-lg-3 col-md-4 label"><b>Eind Datum</b></div>
                <div class="col-lg-8 col-md-8"><? echo GetStellingEindDatum($stellingID, $conn); ?></div> 
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label"><b>Gestart door</b></div>
                <div class="col-lg-8 col-md-8"><? echo (GetName(GetStellingGestartDoor($stellingID, $conn), $conn)); ?> (<? echo GetUserWalletID(GetStellingGestartDoor($stellingID, $conn), $conn); ?>)</div>
              </div>
          </div>
        </div><!-- End Default Card -->
      </div>

      <!-- Tabel Rechts-->
      <div class="col-lg-4">
        <!-- Default Card -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Acties</h5>

              <div class="row">
                <div class="col-lg-6 col-md-4 label ">Stemmen voor</div>
                <div class="col-lg-6 col-md-4"><b><? echo GetVoorVoting($stellingID, $conn); ?></b></div>
              </div>

              <div class="row">
                <div class="col-lg-6 col-md-4 label ">Stemmen tegen</div>
                <div class="col-lg-6 col-md-4"><b><? echo GetTegenVoting($stellingID, $conn);; ?></b></div> 
              </div> <br><?
              // Knoppen in het veld Acties (Stelling uitzetten, Stemmen of melding stelling is niet meer actief)
              if ($Rank !== "Administrator") { 
                if (GetStellingEindDatum($stellingID, $conn) >= date("Y-m-d") && GetStellingStatus($stellingID, $conn) === 1) {
                  if (null === CheckIfUserVoted($GebruikerID, $stellingID, $conn)) { ?>
                    <center><button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-primary">Stemmen</button></center> <?
                  }else {
                    echo '<div class="alert alert-danger text-center" role="alert">Je hebt al gestemd op deze stelling</div>';
                  } 
                } else {
                  echo '<div class="alert alert-danger text-center" role="alert">De stelling is niet meer actief</div>';
                }
              } elseif (GetStellingStatus($stellingID, $conn) == 1) { ?>
                <form method="POST">
                  <center><input type="submit" name="BtnDisableStelling" value="Stelling uitschakelen" class="btn btn-outline-danger"></input></center>
                </form> <?
              } ?>
          </div>
        </div><!-- End Default Card -->

        <!-- Accordion Contract informaite -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Technishce specificaties</h5>
            <!-- Accordion zonder borders -->
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Mumbai Testnetwerk
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <div class="row">
                      <div class="col-lg-4 col-md-4 label"><b>Contract</b></div>
                      <div class="col-lg-8 col-md-8"><a href="https://mumbai.polygonscan.com/address/<? echo GetStellingContractAdres($stellingID, $conn);?>"><? echo GetStellingContractAdres($stellingID, $conn); ?></a></div> <br> <hr>
                    </div>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 label"><b>Functie</b></div>
                      <div class="col-lg-8 col-md-8"><? echo GetStellingFunction($stellingID, $conn); ?></div> 
                    </div>   
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Accordion without outline borders -->
          </div>
        </div>
      </div>        
    </div>

    <!-- Tabel stemmen -->
    <div class="row">
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
          <h5 class="card-title">Stemmen (<? echo GetCountStemmenDAO($stellingID, $conn) ?> van de <? echo AantalGebruikers($conn); ?> gebruikers heeft gestemd)</span></h5>
            <div class="input-outline">
              <div class="form">
                <input type="search" id="Input" class="form-control" placeholder="Zoeken..." />
              </div> <br>
            </div>                  
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">Wallet adres</th>
                    <th scope="col">Voor / tegen</th>
                    <th scope="col">Stemmen</th>
                    <th scope="col">Tokens ingezet</th>
                    <th scope="col"></th>
                  </tr>
                </thead><?
                $query = "SELECT * FROM stemmen WHERE DaoID = '$stellingID' ORDER BY ID";
                $result = $conn->query($query);

                if (@mysqlI_num_rows($result) > 0) {
                  while($row = $result->fetch_array()){ ?>
                  <tbody id="Stemmen">
                    <tr><?
                        if ($row['UserID'] == $GebruikerID) { ?>
                          <td><b><i class="bi bi-star me-1"></i> <? echo GetUserWalletID($row['UserID'], $conn); ?></b></td> <?
                        } elseif (null !== GetUserWalletID($row['UserID'], $conn)) { ?>
                          <td><? echo GetUserWalletID($row['UserID'], $conn); ?></td> <? 
                        } else { ?>
                          <td><i>Gebruiker niet gevonden</i></td> <? 
                        }
                        
                        if ($row['Stemming'] === "Tegen") { ?>
                          <td><span class="badge bg-danger"><? echo $row['Stemming'];?></span></td> <?
                        } elseif ($row['Stemming'] === "Voor") { ?>
                          <td><span class="badge bg-success"><? echo $row['Stemming'];?></span></td> <?
                        } else { ?>
                          <td><span class="badge bg-light text-dark"><? echo $row['Stemming'];?></span></td> <?
                        } ?>
                          <td><? echo $row['Aantal'];?></td>
                          <td><? echo $row['Tokens'];?></td> <?
                          // Voor administrators om het gebruikers profiel te bezoeken
                          if ($Rank === "Administrator") { ?>
                            <td><a href="profiel.php?ID=<?php echo $row['UserID']; ?>"><i class="bi bi-arrow-right"></i></a></td> <?
                          }  ?>

                    </tr> <?
                  } 
                } else { ?>
                  <td colspan="5"><i><center>Er zijn nog geen stemmen plaatsgevonden</center></i></td> <?
                } ?> 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Stemmmen Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Stemmen op stelling</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> <? 
      	if ($TokenAmount != 0) { ?>
        <form method="POST">
          <div class="row mb-3">
            <label for="inputNumber" class="col-sm-12 col-form-label">Aantal stemmen (Tussen 1 - <? echo $TokenAmount; ?>)</label>
            <div class="col-sm-12">
              <input value="<? echo $TokenAmount; ?>" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)' name="Aantal" type="text" class="form-control">
            </div>
          </div>

          <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Keuze</legend>
            <div class="col-sm-10">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="Keuze" id="gridRadios1" value="Voor" checked>
                <label class="form-check-label" for="gridRadios1">
                  Voor
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="Keuze" id="gridRadios2" value="Neutraal">
                <label class="form-check-label" for="gridRadios2">
                  Neutraal
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="Keuze" id="gridRadios2" value="Tegen">
                <label class="form-check-label" for="gridRadios2">
                  Tegen
                </label>
              </div>
            </div>
          </fieldset> <?
      	} else {
      		echo "<center>Je geen stemrecht (Zie <a href='https://faucet.blockchainminor.nl/'>faucet</a>)</center>";
      	}  ?>


      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button><?
            if ($TokenAmount != 0) {
              echo '<input type="submit" name="StemmenSubmit" class="btn btn-primary" value="Stemmen"></input>';
            } ?>
          </div>
        </form>
    </div>
  </div>
</div>

<?
  include 'includes/footer.php';
?>


<!--Functie voor het filteren in de tabel-->
<script>
  $(document).ready(function(){
    $("#Input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#Stemmen tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
</body>
</html>