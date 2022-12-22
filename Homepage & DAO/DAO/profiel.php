<!DOCTYPE html>
<?
  include 'includes/header.php';

  //ID zetten
  if (isset($_GET["ID"])) {
    $ID = $_GET["ID"];
  } else {
    $ID = $GebruikerID;
  }

  //Controle of gebruiker toestemming heeft om de pagina te bekijken
  if ($GebruikerID !== $ID && $Rank !== "Administrator") {
    echo "<script type='text/javascript'>window.top.location='https://blockchainminor.nl/DAO/profiel.php';</script>"; exit;
  }  

  // Verwijder gebruiker
  if (isset($_POST['VerwijderenAccount'])){
    RemoveUser($ID, $conn);
    AddLog('Gebruiker met ID '.$ID." is verwijderd", $conn);
    if ($ID === $GebruikerID) {
      echo "<script type='text/javascript'>window.top.location='https://blockchainminor.nl/';</script>"; exit;
    }
  }

  if (isset($_POST['ChangeAccountDetails'])) {
    UpdateUser($ID, $_POST['FiedName'], $_POST['FieldAdres'], $_POST['FieldPostcode'], $_POST['FieldPlaats'], $conn);
  }

  if (isset($_POST['PromoteToAdmin'])) {
    PromoteUser($ID, $conn);
    AddLog('Gebruiker met ID '.$ID." is gepromovoeerd naar Administrator", $conn);    
  }


?>

<head>
    <title>DAO | Profiel van <? echo GetName($ID, $conn); ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Profiel</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><? echo GetName($ID, $conn); ?></h2>
              <h3><? echo GetRang($ID, $conn); ?></h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overzicht</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Profile bewerken</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">ID</div>
                    <div class="col-lg-9 col-md-8"><? echo $ID; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Naam</div>
                    <div class="col-lg-9 col-md-8"><? echo GetName($ID, $conn); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Adres</div>
                    <div class="col-lg-9 col-md-8"><? echo GetAdres($ID, $conn); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Postcode</div>
                    <div class="col-lg-9 col-md-8"><? echo GetPostcode($ID, $conn); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Plaats</div>
                    <div class="col-lg-9 col-md-8"><? echo GetPlaats($ID, $conn); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Rang</div>
                    <div class="col-lg-9 col-md-8"><? echo GetRang($ID, $conn); ?></div>
                  </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Afbeelding</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/profile-img.jpg" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">ID</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" value="<? echo $ID; ?>" readonly>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Naam</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="FiedName" type="text" class="form-control" value="<? echo GetName($ID, $conn); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Adres</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="FieldAdres" type="text" class="form-control" value="<? echo GetAdres($ID, $conn); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Postcode</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="FieldPostcode" type="text" class="form-control" value="<? echo GetPostcode($ID, $conn); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Plaats</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="FieldPlaats" type="text" class="form-control" value="<? echo GetPlaats($ID, $conn); ?>">
                      </div>
                    </div> <br>

                    <div class="text-center"><?
                      if (GetRang($ID, $conn) === "Gebruiker" && $ID !== $GebruikerID) { ?>
                        <input type="submit" class="btn btn-outline-success" name="PromoteToAdmin" value="Promoveer naar administrator"></input> <?
                      } ?>
                      <input type="submit" class="btn btn-outline-primary" name="ChangeAccountDetails" value="Opslaan"></input>
                      <input type="submit" class="btn btn-outline-danger" name="VerwijderenAccount" value="Verwijder account"></input>
                    </div>                   
                  </form><!-- End Profile Edit Form -->
                </div>
              </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>

      <!-- Gestemde stellingen-->
      <div class="row">
        <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <h5 class="card-title">Stem historie</span></h5>
              <div class="input-outline">
                <div class="form">
                  <input type="search" id="Input" class="form-control" placeholder="Zoeken..." />
                </div> <br>
              </div>                  
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">Stelling</th>
                      <th scope="col">Stemming</th>
                      <th scope="col">Aantal stemmen</th>
                      <th scope="col">Tokens ingezet</th>
                      <th scope="col"></th>
                    </tr>
                  </thead><?
                    $query = "SELECT * FROM stemmen WHERE UserID = '$ID' ORDER BY ID";
                    $result = $conn->query($query);
                    
                    if (@mysqlI_num_rows($result) > 0) {
                      while($row = $result->fetch_array()){ ?>
                      <tbody id="Stemmen">
                        <tr><?
                          if ($row['UserID'] == $ID) { ?>
                              <td><? echo GetStellingName($row['DaoID'], $conn); ?></td> <? 
                            
                            if ($row['Stemming'] === "Tegen") { ?>
                              <td><span class="badge bg-danger"><? echo $row['Stemming'];?></span></td> <?
                            } elseif ($row['Stemming'] === "Voor") { ?>
                              <td><span class="badge bg-success"><? echo $row['Stemming'];?></span></td> <?
                            } else { ?>
                              <td><span class="badge bg-light text-dark"><? echo $row['Stemming'];?></span></td> <?
                            } ?>
                              <td><? echo $row['Aantal'];?></td>
                              <td><? echo $row['Tokens'];?></td>
                              <td><a href="stelling.php?stelling=<?php echo $row['DaoID']; ?>"><i class="bi bi-arrow-right"></i></a></td> <?                       
                          } ?>
                          </tr> <?
                        } 
                    } else { ?>
                      <td colspan="5"><i><center>De gebruiker heeft nog niet gestemd</center></i></td> <?
                    } ?>   
                   </tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </section>

  </main><!-- End #main -->
<?
  include 'includes/footer.php';

?>
</html>
