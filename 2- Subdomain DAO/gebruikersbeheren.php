<!DOCTYPE html>
<?
	include 'includes/header.php';

	if ($Rank !== "Administrator") {
		echo "<script type='text/javascript'>window.top.location='https://blockchainminor.nl';</script>"; exit;
	}
?>

<head>
	<title>DAO | Gebruikers</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Gebruikers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Gebruikers</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
    	<div class="row">
        <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <h5 class="card-title">Overzicht van gebruikers</span></h5>
              <div class="input-outline">
                <div class="form">
                  <input type="search" id="Input" class="form-control" placeholder="Zoeken..." />
                </div> <br>
              </div>                  
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Naam</th>
                      <th scope="col">Wallet Adres</th>
                      <th scope="col">Adres</th>
                      <th scope="col">Postcode</th>
                      <th scope="col">Plaats</th>
                      <th scope="col">Rang</th>
                      <th scope="col"></th>
                    </tr>
                  </thead><?
      					    $query = "SELECT * FROM users ORDER BY ID";
      					    $result = $conn->query($query);

      					    while($row = $result->fetch_array()) { ?>
      							<tbody id="Gebruikers">
      								<tr>
      								    <td><?php echo $row['ID']; ?></td>
      								    <td><?php echo $row['Naam'];?></td>
      								    <td><?php echo $row['WalletID'];?></td>
      								    <td><?php echo $row['Adres'];?></td>
      								    <td><?php echo $row['Postcode'];?></td>
      								    <td><?php echo $row['Plaats'];?></td>
      								    <? if ($row['Rang'] === "Administrator") { ?>
      								    	<td><span class="badge bg-danger"><?php echo $row['Rang'];?></span></td> <?
      								    } else {?>
      								    	<td><span class="badge bg-success"><?php echo $row['Rang'];?></span></td> <?
      								    } ?>
                          <td><a href="profiel.php?ID=<?php echo $row['ID']; ?>"><i class="bi bi-arrow-right"></i></a></td>
      						  <? } ?>   
							      </tr>
					  	     </tbody>
                  </tbody>
                </table>
              </div>
            </div>
        	</div>
      	</div>
  		</div>
    </section>
</main>

<?
  include 'includes/footer.php';
?>

<!--Functie voor het filteren in de tabel-->
<script>
  $(document).ready(function(){
    $("#Input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#Gebruikers tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
</html>