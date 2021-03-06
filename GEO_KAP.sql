-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2018. Aug 14. 21:30
-- Kiszolgáló verziója: 10.1.26-MariaDB-0+deb9u1
-- PHP verzió: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `GEO_KAP`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `Eszkozok`
--

CREATE TABLE `Eszkozok` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mac` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `uplimit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `Eszkozok`
--

INSERT INTO `Eszkozok` (`id`, `user_id`, `name`, `mac`, `ip`, `uplimit`) VALUES
(1, 1, 'normális', 'aa:bb:cc:dd:ee:10', '172.22.0.70', 0),
(10, 7, 'gep', 'aa:bb:cc:dd:ee:00', '172.30.2.1', 1),
(11, 7, 'gep1', 'aa:bb:cc:dd:ee:01', '172.22.0.40', 1),
(12, 8, 'gep2', 'aa:bb:cc:dd:ee:02', '172.22.0.41', 1),
(13, 9, 'gep3', 'aa:bb:cc:dd:ee:03', '172.22.0.74', 1),
(14, 9, 'nemletezik', '00:AA:BB:BB:CC:C2', '172.30.0.1', 0),
(18, 1, 'sajat2', 'e0:d5:5e:26:9f:27', '172.30.2.2', 1),
(19, 9, 'ödöné', 'e0:d5:5e:26:9f:99', '172.30.1.1', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `Felhasznalok`
--

CREATE TABLE `Felhasznalok` (
  `id` int(10) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `realname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `permission` int(1) NOT NULL,
  `regtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `Felhasznalok`
--

INSERT INTO `Felhasznalok` (`id`, `username`, `password`, `realname`, `email`, `permission`, `regtime`) VALUES
(1, 'admin', '5BE2BCF5718118EAEAB4FE7AE57543262082A8FCE89420A5FC4799D99AF2F161', 'admin', 'adasdas', 9, '2018-08-14 01:34:16'),
(7, 'demo1', '2A97516C354B68848CDBD8F54A226A0A55B21ED138E207AD6C5CBB9C00AA5AEA', 'Vég Béla', 'fulopdvd@gmail.com', 0, '2018-08-14 05:23:14'),
(8, 'demo2', '9D5C9C11E89ABAA5207E039DD3EE3DAA0B683C14EC641DBA6950D2A67C73D165', 'Drótos Karesz', 'fulopdvd@gmail.com', 0, '2018-08-14 06:43:06'),
(9, 'demo3', '2A97516C354B68848CDBD8F54A226A0A55B21ED138E207AD6C5CBB9C00AA5AEA', 'Pöcs Ödön', 'fulopdvd@gmail.com', 0, '2018-08-14 10:11:15');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `Eszkozok`
--
ALTER TABLE `Eszkozok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mac` (`mac`),
  ADD UNIQUE KEY `ip` (`ip`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `Felhasznalok`
--
ALTER TABLE `Felhasznalok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `Eszkozok`
--
ALTER TABLE `Eszkozok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT a táblához `Felhasznalok`
--
ALTER TABLE `Felhasznalok`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `Eszkozok`
--
ALTER TABLE `Eszkozok`
  ADD CONSTRAINT `Eszkozok_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Felhasznalok` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
