document.addEventListener("DOMContentLoaded", () => {
  const web3 = new Web3(window.ethereum)
  document.getElementById("load_button").addEventListener("click", SendToken);
})

function SendToken(){
  console.log(window.ethereum.networkVersion);

  var FromWalletID = getCookie("WalletID")
  var TowalletID = document.getElementById('wallet_address').value
  var Aantal = document.getElementById('aantal').value

  if (Aantal) {
    if (window.ethereum.networkVersion == "80001") {
      const EnergyContract = new web3.eth.Contract(TokenABI, "0x71c7715eB45d5Afe38FCFDC359889eDB3aeabbef")
      EnergyContract.methods.mint(TowalletID, Web3.utils.toWei(Aantal, 'ether')).send({from: FromWalletID}).then(console.log);

    } else {
      SwitchNetwork("80001")
    } 
  } else { 
    document.getElementById('AantalDanger').style.display = 'block';
  } 
} 

export function KycComplete() {
  addCustomToken("0x71c7715eB45d5Afe38FCFDC359889eDB3aeabbef", "ENGV", "18", "https://faucet.blockchainminor.nl/images/EnergyIcon.png")
  AddNewNetwork("80001", "Mumbai Testnet", "MATIC", "MATIC", "https://rpc-mumbai.maticvigil.com/", "https://mumbai.polygonscan.com/")
}

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}

function addCustomToken(tokenAddress, tokenSymbol, tokenDecimals, tokenImage) { 
  try {
    const isAdded = web3.currentProvider.request({
      method: 'wallet_watchAsset',
      params: {
        type: 'ERC20',
        options: {
          address: tokenAddress,
          symbol: tokenSymbol,
          decimals: tokenDecimals,
          image: tokenImage,
        },
      },
    });
  } finally {
  }
}

function SwitchNetwork(chainId){
  ethereum.request({
      method: 'wallet_switchEthereumChain',
      params: [{ chainId: web3.utils.toHex(chainId) }],
  })
  .then(() => console.log('network has been set'))
  .catch((e) => {
      if (e.code === 4902) {
        console.log('Mumbai netwerk niet gevonden, Add in Metamask')
        AddNewNetwork("80001", "Mumbai Testnet", "MATIC", "MATIC", "https://rpc-mumbai.maticvigil.com/", "https://mumbai.polygonscan.com/")
      } else {
        console.log('Kan netwerk niet toevoegen')
      }
  })
  }


function AddNewNetwork(chainId, chainName, CurrencyName, CurrencySymbol, rcpURL, blockExplorerUrl){
  ethereum.request({
      method: 'wallet_addEthereumChain',
      params: [{ 
          chainId: web3.utils.toHex(chainId),
          chainName: chainName,
          nativeCurrency: {
              name: CurrencyName,
              symbol: CurrencySymbol,
              decimals: 18
          },
          rpcUrls: [rcpURL],
          blockExplorerUrls: [blockExplorerUrl]
      }],
  })
  .then(() => console.log('Mumbai toegevoegt'))
  .catch(() => console.log('Kan netwerk niet toeveogen'))
}