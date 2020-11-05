-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Hoszt: 127.0.0.1
-- Létrehozás ideje: 2020. nov. 05. 02:54
-- Szerver verzió: 5.0.96
-- PHP verzió: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `czoltan`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet: `SZF_regisztracio`
--

CREATE TABLE IF NOT EXISTS `SZF_regisztracio` (
  `id` int(7) NOT NULL auto_increment,
  `Vezeteknev` varchar(31) character set utf8 collate utf8_hungarian_ci NOT NULL,
  `Keresztnev` varchar(31) character set ucs2 collate ucs2_hungarian_ci NOT NULL,
  `Iranyítoszam` int(2) NOT NULL,
  `Helysegnev` varchar(31) character set ucs2 collate ucs2_hungarian_ci NOT NULL,
  `Telefonszam` varchar(31) character set ucs2 collate ucs2_hungarian_ci NOT NULL,
  `Email` varchar(63) character set utf8 collate utf8_hungarian_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- A tábla adatainak kiíratása `SZF_regisztracio`
--

INSERT INTO `SZF_regisztracio` (`id`, `Vezeteknev`, `Keresztnev`, `Iranyítoszam`, `Helysegnev`, `Telefonszam`, `Email`) VALUES
(1, 'Csóti', 'Zoltán', 1041, 'Budapest', '70 510-5271', 'csoti.zoltan@gmail.com'),
(2, 'Babusáné Gazdik', 'Ágnes', 1161, 'Budapest', '30 346-5852', 'agnes.gazdik@gmail.com'),
(3, 'Tóth Sándor', 'Tibor', 2481, 'Velence', '06 70 123-4567', 'toth.sandor.bead@gmail.com');
