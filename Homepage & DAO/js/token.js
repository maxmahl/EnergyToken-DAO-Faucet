import TokenABI from 'https://blockchainminor.nl/DAO/assets/js/ABI.js';

const web3 = new Web3(window.ethereum)

var tokenInst = new web3.eth.Contract(TokenABI, "0x71c7715eb45d5afe38fcfdc359889edb3aeabbef");

export function GetTokenBalance() {
    tokenInst.methods.balanceOf(getCookie('WalletID')).call().then(function (bal) {
        setCookie("TokenAmount",Web3.utils.fromWei(bal),"10");
        return Web3.utils.fromWei(bal);
    })
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}