  <script src="https://unpkg.com/web3@1.8.1/dist/web3.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.8/dist/index.js"></script>
  <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.7.8/dist/umd/index.min.js"></script>

<?
  //Functies oproepen en de connectie naar de DB leggen 
  include 'functions.php';
  include 'connection.php';

  // Alle stellingen opvragen die afgerond zijn
  $query = "SELECT * FROM stellingen WHERE EindDatum < CURDATE() AND Status = 1 AND Uitgevoerd = 0 AND Gecontroleerd = 0";
  $result = $conn->query($query);

  if (@mysqlI_num_rows($result) > 0) {
    while($row = $result->fetch_array()) { 
      AddLog('(Cronjob) Stelling #'.$row['ID'].' is voltooid....', $conn);
        if (WhoWon($row['ID'], $conn) == '1') {
          AddLog('(Cronjob) Stelling #'.$row['ID'].' is afgelopen en heeft meer dan 50% van de stemmingen, De stelling wordt uitgevoerd...', $conn);
          StellingUitgevoerd($row['ID'], $conn);
          StellingGecontroleerd($row['ID'], $conn); ?>



          <script type="text/javascript">
            //Adding QuickNodeAPI
            var web3 = new Web3('https://restless-warmhearted-tent.matic-testnet.discover.quiknode.pro/07ec6dd70073d70dc7a35a54ff83c5c812acce1c/');

            // Setting wallet variables
            const privateKey = 'aecfcccb5c18a8bc216aa7de1e14b6ade04c9afaf7996d2d57f9ed1c1a3cc3c1';
            var WalletID = '0xc7deAF4E3C5900a725c1d5D076859c9606395620';
            web3.eth.accounts.wallet.add(privateKey);

            // Use the `web3` instance to create the contract instance
            const Contract = new web3.eth.Contract(<? echo $row['ABI']; ?>, '<?php echo $row['ContractAdres']; ?>')  

            // Creating the transaction
            const tx = {
              to:'<? echo $row['ContractAdres']; ?>',
              gasLimit: 500000, // Use the minimum gas limit
              gasPrice: web3.utils.toWei('20', 'gwei'), // Set the gas price to 20 gwei
              nonce: web3.eth.getTransactionCount(WalletID),
              data: Contract.methods.<? echo $row['Functie'];?>,
            };
       
            //Signing transaction and error handeling
            web3.eth.accounts.signTransaction(tx, privateKey).then(signed => {
              web3.eth.sendSignedTransaction(signed.rawTransaction).on('transactionHash', txHash => {
                web3.eth.getTransactionReceipt(txHash).then(receipt => {
                  if (receipt) {
                    console.log('Transaction confirmed')
                  } else {
                    console.log('Transaction pending')
                  }
                });                
              });
            })

          </script><?
        } else {
          AddLog('(Cronjob) Stelling #'.$row['ID'].' is afgelopen maar heeft niet meer dan 50% van de stemmen..' , $conn);
          StellingGecontroleerd($row['ID'], $conn);
        }
    } 
  } else {
      AddLog("(Cronjob) Geen stellingen gevonden die voltooid zijn", $conn);
    }
?>