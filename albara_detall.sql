-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-11-2019 a las 11:00:01
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albara_detall`
--

CREATE TABLE `albara_detall` (
  `id_lin` int(11) NOT NULL,
  `rid_venda` int(11) NOT NULL,
  `rid_prod` int(11) NOT NULL,
  `unitats` double NOT NULL,
  `preu_total_iva` double NOT NULL,
  `tipus_mov` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `albara_detall`
--

INSERT INTO `albara_detall` (`id_lin`, `rid_venda`, `rid_prod`, `unitats`, `preu_total_iva`, `tipus_mov`) VALUES
(1, 1, 9, 5, 1210, 'D'),
(2, 2, 9, 33, 7986, 'D'),
(3, 3, 3, 5, 605, 'V'),
(4, 4, 2, 5, 3025, 'V');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albara_detall`
--
ALTER TABLE `albara_detall`
  ADD PRIMARY KEY (`id_lin`),
  ADD KEY `albara_detall_ibfk_1` (`rid_venda`),
  ADD KEY `albara_detall_ibfk_2` (`rid_prod`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albara_detall`
--
ALTER TABLE `albara_detall`
  MODIFY `id_lin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albara_detall`
--
ALTER TABLE `albara_detall`
  ADD CONSTRAINT `albara_detall_ibfk_1` FOREIGN KEY (`rid_venda`) REFERENCES `albara` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `albara_detall_ibfk_2` FOREIGN KEY (`rid_prod`) REFERENCES `producte` (`id_producte`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
