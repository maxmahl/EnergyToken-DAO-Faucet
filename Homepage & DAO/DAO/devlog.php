<!DOCTYPE html>
<?
  include 'includes/header.php';

  if ($Rank !== "Administrator") {
    echo "<script type='text/javascript'>window.top.location='https://blockchainminor.nl';</script>"; exit;
  }

  if (isset($_POST['Truncate'])) {
   TruncateDevLog($conn);
  }
?>

<head>
  <title>DAO | Devlog</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<main id="main" class="main">
    <div class="pagetitle">   
        <form method="POST">
          <input type="submit" name="Truncate" value="Tabel legen" class="btn btn-outline-primary" style="float: right;">
        </form>   
      <h1>Development Log</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Development Log</li>
        </ol>
      </nav>

    </div><!-- End Page Title -->
    <section class="section dashboard">
      <div class="row">
        <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <h5 class="card-title">Overzicht van log bestanden (<a href="https://blockchainminor.nl/DAO/includes/cronjob.php">Start Cronjob</a>)</span></h5>
              <div class="input-outline">
                <div class="form">
                  <input type="search" id="Input" class="form-control" placeholder="Zoeken..." />
                </div> <br>
              </div>                  
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Bericht</th>
                      <th scope="col">Day/ Time</th>
                    </tr>
                  </thead><?
                    $query = "SELECT * FROM log ORDER BY ID DESC";
                    $result = $conn->query($query);

                    while($row = $result->fetch_array()) { ?>
                    <tbody id="Log">
                      <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['Bericht'];?></td>
                        <td><?php echo $row['DayTime'];?></td> <? 
                    } ?>   
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
      $("#Log tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
</html>