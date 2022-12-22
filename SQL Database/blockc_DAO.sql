-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: blockc-DAO.db.transip.me:3306
-- Generation Time: Dec 22, 2022 at 12:28 PM
-- Server version: 5.7.40-43-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blockc_DAO`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `ID` int(255) NOT NULL,
  `Bericht` varchar(255) NOT NULL,
  `DayTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`ID`, `Bericht`, `DayTime`) VALUES
(1, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-12 22:25:13'),
(3, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-12 22:25:14'),
(5, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-12 22:25:14'),
(7, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-12 22:25:14'),
(9, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-12 22:25:14'),
(11, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-13 01:02:01'),
(13, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-14 01:02:01'),
(15, '(Cronjob) Stelling #1 is voltooid....', '2022-12-14 15:14:01'),
(16, '(Cronjob) Stelling #1 is afgelopen en heeft meer dan 50% van de stemmingen, De stelling wordt uitgevoerd...', '2022-12-14 15:14:01'),
(17, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-15 01:02:01'),
(18, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-16 01:02:01'),
(19, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-17 01:02:01'),
(20, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-18 01:02:01'),
(21, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-19 01:02:01'),
(22, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-20 01:02:01'),
(23, '(Cronjob) Stelling #2 is voltooid....', '2022-12-21 01:02:01'),
(24, '(Cronjob) Stelling #2 is afgelopen en heeft meer dan 50% van de stemmingen, De stelling wordt uitgevoerd...', '2022-12-21 01:02:01'),
(25, '(Cronjob) Stelling #2 is voltooid....', '2022-12-21 14:09:14'),
(26, '(Cronjob) Stelling #2 is afgelopen en heeft meer dan 50% van de stemmingen, De stelling wordt uitgevoerd...', '2022-12-21 14:09:14'),
(27, '(Cronjob) Geen stellingen gevonden die voltooid zijn', '2022-12-22 01:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `stellingen`
--

CREATE TABLE `stellingen` (
  `ID` int(255) NOT NULL,
  `Stelling` varchar(255) NOT NULL,
  `Beschrijving` varchar(3000) NOT NULL,
  `Functie` varchar(255) NOT NULL,
  `ContractAdres` varchar(255) NOT NULL,
  `StartDatum` date NOT NULL,
  `EindDatum` date NOT NULL,
  `GestartDoor` int(11) NOT NULL,
  `Status` int(2) NOT NULL,
  `Gecontroleerd` int(1) NOT NULL,
  `Uitgevoerd` int(1) NOT NULL,
  `ABI` varchar(30000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stellingen`
--

INSERT INTO `stellingen` (`ID`, `Stelling`, `Beschrijving`, `Functie`, `ContractAdres`, `StartDatum`, `EindDatum`, `GestartDoor`, `Status`, `Gecontroleerd`, `Uitgevoerd`, `ABI`) VALUES
(1, 'Extra token supply voor ontwikkelaars', 'Hier moet nog tekst komen', 'mint(\'0xc7deAF4E3C5900a725c1d5D076859c9606395620\', web3.utils.toWei(\'2.70\', \'ether\')).encodeABI()', '0x71c7715eb45d5afe38fcfdc359889edb3aeabbef', '2022-11-04', '2022-12-13', 1, 1, 1, 1, '[{\"inputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"constructor\"},{\"anonymous\":false,\"inputs\":[{\"indexed\":true,\"internalType\":\"address\",\"name\":\"owner\",\"type\":\"address\"},{\"indexed\":true,\"internalType\":\"address\",\"name\":\"spender\",\"type\":\"address\"},{\"indexed\":false,\"internalType\":\"uint256\",\"name\":\"value\",\"type\":\"uint256\"}],\"name\":\"Approval\",\"type\":\"event\"},{\"anonymous\":false,\"inputs\":[{\"indexed\":true,\"internalType\":\"address\",\"name\":\"previousOwner\",\"type\":\"address\"},{\"indexed\":true,\"internalType\":\"address\",\"name\":\"newOwner\",\"type\":\"address\"}],\"name\":\"OwnershipTransferred\",\"type\":\"event\"},{\"anonymous\":false,\"inputs\":[{\"indexed\":true,\"internalType\":\"address\",\"name\":\"from\",\"type\":\"address\"},{\"indexed\":true,\"internalType\":\"address\",\"name\":\"to\",\"type\":\"address\"},{\"indexed\":false,\"internalType\":\"uint256\",\"name\":\"value\",\"type\":\"uint256\"}],\"name\":\"Transfer\",\"type\":\"event\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"owner\",\"type\":\"address\"},{\"internalType\":\"address\",\"name\":\"spender\",\"type\":\"address\"}],\"name\":\"allowance\",\"outputs\":[{\"internalType\":\"uint256\",\"name\":\"\",\"type\":\"uint256\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"spender\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"approve\",\"outputs\":[{\"internalType\":\"bool\",\"name\":\"\",\"type\":\"bool\"}],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"account\",\"type\":\"address\"}],\"name\":\"balanceOf\",\"outputs\":[{\"internalType\":\"uint256\",\"name\":\"\",\"type\":\"uint256\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"burn\",\"outputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"account\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"burnFrom\",\"outputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"decimals\",\"outputs\":[{\"internalType\":\"uint8\",\"name\":\"\",\"type\":\"uint8\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"spender\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"subtractedValue\",\"type\":\"uint256\"}],\"name\":\"decreaseAllowance\",\"outputs\":[{\"internalType\":\"bool\",\"name\":\"\",\"type\":\"bool\"}],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"spender\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"addedValue\",\"type\":\"uint256\"}],\"name\":\"increaseAllowance\",\"outputs\":[{\"internalType\":\"bool\",\"name\":\"\",\"type\":\"bool\"}],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"to\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"mint\",\"outputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"name\",\"outputs\":[{\"internalType\":\"string\",\"name\":\"\",\"type\":\"string\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"owner\",\"outputs\":[{\"internalType\":\"address\",\"name\":\"\",\"type\":\"address\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"renounceOwnership\",\"outputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"symbol\",\"outputs\":[{\"internalType\":\"string\",\"name\":\"\",\"type\":\"string\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"totalSupply\",\"outputs\":[{\"internalType\":\"uint256\",\"name\":\"\",\"type\":\"uint256\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"to\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"transfer\",\"outputs\":[{\"internalType\":\"bool\",\"name\":\"\",\"type\":\"bool\"}],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"from\",\"type\":\"address\"},{\"internalType\":\"address\",\"name\":\"to\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"transferFrom\",\"outputs\":[{\"internalType\":\"bool\",\"name\":\"\",\"type\":\"bool\"}],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"newOwner\",\"type\":\"address\"}],\"name\":\"transferOwnership\",\"outputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"function\"}]'),
(2, 'Test stelling', 'Dit is een test stelling', 'mint(\'0xc7deAF4E3C5900a725c1d5D076859c9606395620\', web3.utils.toWei(\'2.70\', \'ether\')).encodeABI()', '0x71c7715eb45d5afe38fcfdc359889edb3aeabbef', '2022-12-08', '2022-12-20', 1, 1, 1, 1, '[{\"inputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"constructor\"},{\"anonymous\":false,\"inputs\":[{\"indexed\":true,\"internalType\":\"address\",\"name\":\"owner\",\"type\":\"address\"},{\"indexed\":true,\"internalType\":\"address\",\"name\":\"spender\",\"type\":\"address\"},{\"indexed\":false,\"internalType\":\"uint256\",\"name\":\"value\",\"type\":\"uint256\"}],\"name\":\"Approval\",\"type\":\"event\"},{\"anonymous\":false,\"inputs\":[{\"indexed\":true,\"internalType\":\"address\",\"name\":\"previousOwner\",\"type\":\"address\"},{\"indexed\":true,\"internalType\":\"address\",\"name\":\"newOwner\",\"type\":\"address\"}],\"name\":\"OwnershipTransferred\",\"type\":\"event\"},{\"anonymous\":false,\"inputs\":[{\"indexed\":true,\"internalType\":\"address\",\"name\":\"from\",\"type\":\"address\"},{\"indexed\":true,\"internalType\":\"address\",\"name\":\"to\",\"type\":\"address\"},{\"indexed\":false,\"internalType\":\"uint256\",\"name\":\"value\",\"type\":\"uint256\"}],\"name\":\"Transfer\",\"type\":\"event\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"owner\",\"type\":\"address\"},{\"internalType\":\"address\",\"name\":\"spender\",\"type\":\"address\"}],\"name\":\"allowance\",\"outputs\":[{\"internalType\":\"uint256\",\"name\":\"\",\"type\":\"uint256\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"spender\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"approve\",\"outputs\":[{\"internalType\":\"bool\",\"name\":\"\",\"type\":\"bool\"}],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"account\",\"type\":\"address\"}],\"name\":\"balanceOf\",\"outputs\":[{\"internalType\":\"uint256\",\"name\":\"\",\"type\":\"uint256\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"burn\",\"outputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"account\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"burnFrom\",\"outputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"decimals\",\"outputs\":[{\"internalType\":\"uint8\",\"name\":\"\",\"type\":\"uint8\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"spender\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"subtractedValue\",\"type\":\"uint256\"}],\"name\":\"decreaseAllowance\",\"outputs\":[{\"internalType\":\"bool\",\"name\":\"\",\"type\":\"bool\"}],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"spender\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"addedValue\",\"type\":\"uint256\"}],\"name\":\"increaseAllowance\",\"outputs\":[{\"internalType\":\"bool\",\"name\":\"\",\"type\":\"bool\"}],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"to\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"mint\",\"outputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"name\",\"outputs\":[{\"internalType\":\"string\",\"name\":\"\",\"type\":\"string\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"owner\",\"outputs\":[{\"internalType\":\"address\",\"name\":\"\",\"type\":\"address\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"renounceOwnership\",\"outputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"symbol\",\"outputs\":[{\"internalType\":\"string\",\"name\":\"\",\"type\":\"string\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[],\"name\":\"totalSupply\",\"outputs\":[{\"internalType\":\"uint256\",\"name\":\"\",\"type\":\"uint256\"}],\"stateMutability\":\"view\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"to\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"transfer\",\"outputs\":[{\"internalType\":\"bool\",\"name\":\"\",\"type\":\"bool\"}],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"from\",\"type\":\"address\"},{\"internalType\":\"address\",\"name\":\"to\",\"type\":\"address\"},{\"internalType\":\"uint256\",\"name\":\"amount\",\"type\":\"uint256\"}],\"name\":\"transferFrom\",\"outputs\":[{\"internalType\":\"bool\",\"name\":\"\",\"type\":\"bool\"}],\"stateMutability\":\"nonpayable\",\"type\":\"function\"},{\"inputs\":[{\"internalType\":\"address\",\"name\":\"newOwner\",\"type\":\"address\"}],\"name\":\"transferOwnership\",\"outputs\":[],\"stateMutability\":\"nonpayable\",\"type\":\"function\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `stemmen`
--

CREATE TABLE `stemmen` (
  `ID` int(11) NOT NULL,
  `UserID` int(255) NOT NULL,
  `DaoID` int(255) NOT NULL,
  `Stemming` varchar(255) NOT NULL,
  `Aantal` varchar(255) NOT NULL,
  `Tokens` varchar(255) NOT NULL,
  `DayTime` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stemmen`
--

INSERT INTO `stemmen` (`ID`, `UserID`, `DaoID`, `Stemming`, `Aantal`, `Tokens`, `DayTime`) VALUES
(8, 10, 1, 'Voor', '2.24', '5', '0000-00-00 00:00:00.000000'),
(12, 2, 1, 'Neutraal', '3.49', '12.2', '0000-00-00 00:00:00.000000'),
(13, 8, 1, 'Voor', '1.41', '2', '0000-00-00 00:00:00.000000'),
(15, 12, 1, 'Tegen', '2.55', '6.5', '0000-00-00 00:00:00.000000'),
(16, 12, 2, 'Voor', '2.55', '6.5', '0000-00-00 00:00:00.000000'),
(17, 2, 2, 'Voor', '3.49', '12.2', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tmp`
--

CREATE TABLE `tmp` (
  `ID` int(11) NOT NULL,
  `address` varchar(42) NOT NULL,
  `publicName` tinytext,
  `nonce` tinytext,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp`
--

INSERT INTO `tmp` (`ID`, `address`, `publicName`, `nonce`, `created`) VALUES
(1, '0xc7deaf4e3c5900a725c1d5d076859c9606395620', NULL, '63927098cd367', '2022-10-10 17:39:54'),
(2, '0x4f01ad21910ae8f7437e53ae4d41072dad330cb5', NULL, '639ad9b812626', '2022-10-10 20:23:13'),
(3, '0x7b0aa292f4ddb61a150a17ecab7c02a6af57fd66', NULL, '6373511defe36', '2022-10-11 15:33:34'),
(4, '0xfe1a7563d3fdbaa676bad7ac3dec61dd07e977e8', NULL, '639078fc7c25e', '2022-10-12 12:24:01'),
(5, '0xe717ef965d277c6821a2e7eb9a0dbb64e8593f52', NULL, '6390793122688', '2022-10-12 12:58:25'),
(6, '0xa3ae4d47afcbf39d0230bdfd1e4c4321de789aa1', NULL, '6346bc72670e5', '2022-10-12 13:09:03'),
(7, '0xee5b94922035fb0984bd2d48fca168971b812cdc', NULL, '6347d6d1eeff3', '2022-10-13 09:13:47'),
(8, '0x159486629e24f1dad3b9d2a66e30e142f5736896', NULL, '6347d71163fa7', '2022-10-13 09:14:39'),
(9, '0xf63655270352123d265bcb8fbff459e081a81044', NULL, '6347d70db1607', '2022-10-13 09:14:43'),
(10, '0xd8a1797a8ee74cbc0449a23d7b4ca06622c33301', NULL, '6347d73f39869', '2022-10-13 09:15:27'),
(11, '0x9bdcabdb40b656cef82acedd9d0066945da50f8c', NULL, '6347d733dbcaa', '2022-10-13 09:15:27'),
(12, '0x3ffd366ca554254fe09c302bd937e619f8fed830', NULL, '6347d8629535f', '2022-10-13 09:20:23'),
(13, '0xcb96d4af6cf4819ae1fb2e16b8a136590310d4c8', NULL, '637c94aab5de2', '2022-10-22 12:30:49'),
(14, '0x2c08e24a39cf49cb0205183663539db77069fff7', NULL, '636fa4c9e685d', '2022-11-06 18:57:35'),
(15, '0x88658a9ffaafe850606a11e5bdc2b4647d32f6e5', NULL, '637f32f38d328', '2022-11-24 09:01:36'),
(16, '0xecd24ccc3dfd50b282264be9b7e8eb8ba35cb9ef', NULL, '639078afd69ec', '2022-11-30 12:43:27'),
(17, '0x04f5df957ce0405ba0264eca6130161cfaa12571', NULL, '6389af7513e5e', '2022-12-02 07:55:33'),
(18, '0x34bc8ef6538609ca77f56beb38b6bfb9c41a2188', NULL, '639485edcca0b', '2022-12-10 13:13:16'),
(19, '0x623022107545164ae0f0f8f541fafa6b5244265c', NULL, '63a255bda3da8', '2022-12-21 00:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(255) NOT NULL,
  `WalletID` varchar(42) NOT NULL,
  `Adres` varchar(255) NOT NULL,
  `Postcode` varchar(255) NOT NULL,
  `Plaats` varchar(255) NOT NULL,
  `Naam` varchar(255) DEFAULT NULL,
  `Rang` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `WalletID`, `Adres`, `Postcode`, `Plaats`, `Naam`, `Rang`) VALUES
(1, '0x4f01ad21910ae8f7437e53ae4d41072dad330cb5', 'Van Essenlaan 3', '3907 JA', 'Veenendaal', 'Max Mahl | Chrome', 'Administrator'),
(7, '0x7b0aa292f4ddb61a150a17ecab7c02a6af57fd66', 'Straatweg 3', '1234AB', 'Utrecht', 'Mark | Desktop', 'Administrator'),
(6, '0x2c08e24a39cf49cb0205183663539db77069fff7', 'Van Banenerf 43', '3907MA', 'Veenendaal', 'Max Mahl | Phone', 'Gebruiker'),
(2, '0xc7deaf4e3c5900a725c1d5d076859c9606395620', 'Nieuwstraat 201', '2934 EW', 'Rhenen', 'Max Mahl | Firefox', 'Gebruiker'),
(5, '0xfe1a7563d3fdbaa676bad7ac3dec61dd07e977e8', 'Heidelberglaan 15', '1234 AB', 'Utrecht', 'Mark de R.', 'Administrator'),
(9, '0xcb96d4af6cf4819ae1fb2e16b8a136590310d4c8', 'Heidelberglaan 15', '3911ER', 'Veenendaal', 'Mox Mohl | Surface', 'Administrator'),
(8, '0xe717ef965d277c6821a2e7eb9a0dbb64e8593f52', 'De Wegisweg', '4567HY', 'Utrecht', 'Lex Zwakenberg', 'Gebruiker'),
(10, '0x88658a9ffaafe850606a11e5bdc2b4647d32f6e5', 'Heidelberglaan 23', '3932 ER', 'Maarssen', 'Laurens', 'Gebruiker'),
(11, '0x34bc8ef6538609ca77f56beb38b6bfb9c41a2188', 'Heidelberglaan 23', '3969ER', 'Rhenen', 'Max Phone', 'Gebruiker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stellingen`
--
ALTER TABLE `stellingen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stemmen`
--
ALTER TABLE `stemmen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `address` (`address`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `address` (`WalletID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `stellingen`
--
ALTER TABLE `stellingen`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stemmen`
--
ALTER TABLE `stemmen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tmp`
--
ALTER TABLE `tmp`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
