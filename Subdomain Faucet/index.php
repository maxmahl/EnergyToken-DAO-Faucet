<script language="JavaScript" src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script type="module" src="includes/js/faucet.js"></script>
<?
	// Functions en connectie met de DB oproepen
  	include_once 'includes/functions.php';
  	include 'includes/connection.php';

  	// Krijg WalletID van Cookie
	$walletID = @$_COOKIE["WalletID"];	 
	// controleren of de gebruiker al KYC is

  	if (!isKYC($walletID, $conn) && @$_COOKIE["Connected"] == 1) { ?>
		<script type="text/javascript">
			$(document).ready(function() {
			    $("#KYCModal").modal({
			        show: false,
			        backdrop: 'static'
			    });

			    $("#KYCModal").modal("show");             
			});
		</script> <? 
	}

	// If KYC
    if (isset($_POST['KYCBtn'])) {
	   	@$Naam = $_POST['naam']; 
  	  	@$Adres = $_POST['adres'];
	    @$Postcode = $_POST['postcode'];
	    @$Plaats = $_POST['plaats'];

	    if (null != $_POST['naam'] && null != $_POST['adres'] && null != $_POST['plaats'] && null != $_POST['postcode']) {
	    	addUser($walletID, $Adres, $Postcode, $Plaats, $Naam, "Gebruiker", $conn);?>
	    		<div style="margin-bottom: 0px;" class="alert alert-success" role="alert">U bent succesvol geregistreerd</div>
		    		<script type="module">
		    			import { KycComplete } from '/includes/js/faucet.js';
		    			KycComplete();
						window.location.href = "\?v=1";
		    		</script><?
	    } else { ?>
	    	<div style="margin-bottom: 0px;" class="alert alert-danger" role="alert">Vul graag de ontbrekende gegevens in</div><?
	    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Faucet | Energy Token</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/web3modal@1.9.8/dist/index.js"></script>
	<script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.7.8/dist/umd/index.min.js"></script>
</head>
<body>
<div id="AantalDanger" style="display:none; margin-bottom: 0px;" class="alert alert-danger">Vul het aantal tokens in</div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img id="AddToken" src="images/faucet.gif" alt="IMG">
				</div>

				<div class="login100-form validate-form">
					<span class="login100-form-title">
						Faucet | Energy Token
					</span>
						<div id="needLogInToMetaMask" style="display:none;color: rgb(255, 115, 0);" class="alert alert-warning">
							<center>Log eerst in op uw wallet</center>
						</div>
						<div id="signTheMessage" style="display:none;" class="alert alert-warning">
							<center>Onderteken het bericht in uw metamask</center>
						</div>
						<div id="loggedIn" style="display:none;" class="alert alert-success">
							<center>Succesvolle authenticatie</center>
						</div>
					<? if ($walletID) { ?>	
						<div class="wrap-input100 validate-input">
							<input id="wallet_address" class="input100" type="text" name="email" value="<? echo $walletID; ?>" readonly>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-address-book" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input">
							<input class="input100" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)' id="aantal" type="text" placeholder="Aantal Tokens">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-diamond"></i>
							</span>
						</div>

						<div class="container-login100-form-btn">
							<button id="load_button" class="login100-form-btn">
								Mint Token(s)
							</button>
						</div>	
							<div class="text-center p-t-80">
								<a class="txt2" href="https://faucet.polygon.technology/">
									Mumbai faucet
									<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> <br>						
								<a class="txt2" href="https://www.blockchainminor.nl">
									<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
									Terug
								</a>									
							</div>	
					<? } else { ?>					
						<div class="container-login100-form-btn">
							<button onclick="userLoginOut()" class="login100-form-btn">
								<img style="height: 20px; padding-right: 5px;" src="images/metamask.svg" alt="IMG"> Connect MetaMask
							</button>
						</div>	
							<div class="text-center p-t-190">					
								<a class="txt2" href="https://www.blockchainminor.nl">
									<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
									Terug
								</a>							
							</div>	
					<? } ?>
		
				</div>
			</div>
		</div>
	</div>
	
	
	<!--KYC Modal-->
	<div id="KYCModal" class="modal hide fade in" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Gegevens verificatie (KYC)</h5>
				</div>
				<div class="modal-body">
					<center><bold><p class="font-weight-light">Het liefste geen echte gegevens invullen</p></bold></center>
					<form method="POST">
						<label for="formFile" class="form-label">Wallet adres</label>
							<input class="form-control" name="wallet" type="text" value="<? echo $walletID; ?>" aria-label="default input example" readonly> <br>
						<label for="formFile" class="form-label">Naam *</label>
							<input class="form-control" name="naam" type="text" placeholder="..." aria-label="default input example"> <br>
						<label for="formFile" class="form-label">Adres *</label>
							<input class="form-control" name="adres" type="text" placeholder="..." aria-label="default input example"> <br>
						<label for="formFile" class="form-label">Postcode *</label>
							<input class="form-control" name="postcode" type="text" placeholder="..." aria-label="default input example"> <br>
						<label for="formFile" class="form-label">Plaats *</label>
							<input class="form-control" name="plaats" type="text" placeholder="..." aria-label="default input example">									
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Registreren" name="KYCBtn"></input>
					</form>
				</div>
			</div>
		</div>
	</div>	

	<script type="module">  
		import { KycComplete } from '/includes/js/faucet.js';
		document.getElementById("AddToken").addEventListener("click", KycComplete);
	</script>  



	<!--Login script-->
	<script src="includes/js/web3-modal.js?v=010"></script>
	<script src="includes/js/web3-login.js?v=011"></script>	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>