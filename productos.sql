-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-11-2019 a las 18:44:58
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
-- Estructura de tabla para la tabla `albara`
--

CREATE TABLE `albara` (
  `id_venta` int(11) NOT NULL,
  `rid_client` int(11) NOT NULL,
  `dia` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(500) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `albara`
--

INSERT INTO `albara` (`id_venta`, `rid_client`, `dia`, `nombre`) VALUES
(1, 5, '2019-11-16 17:25:22', 'tablet Hp 1013 elite x2'),
(2, 22, '2019-11-16 17:25:32', 'tablet Hp 1013 elite x2'),
(3, 4, '2019-11-16 17:25:39', 'tablet Hp 1013 elite x2'),
(4, 222, '2019-11-16 17:26:02', 'tablet Hp 1013 elite x2'),
(7, 5, '2019-11-16 17:38:30', 'tablet Hp 1013 elite x2');

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
(1, 1, 1, 2, 484, 'V'),
(2, 2, 1, 5, 1210, 'V'),
(3, 3, 1, 3, 726, 'V'),
(4, 4, 1, 5, 1210, 'V'),
(7, 7, 1, 3, 726, 'V');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producte`
--

CREATE TABLE `producte` (
  `id_producte` int(11) NOT NULL,
  `stock_act` double NOT NULL,
  `preu` double NOT NULL,
  `nombre_producte` varchar(500) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producte`
--

INSERT INTO `producte` (`id_producte`, `stock_act`, `preu`, `nombre_producte`) VALUES
(1, 2197, 200, 'tablet Hp 1013 elite x2'),
(2, 25, 500, 'Monitor Hp  24'),
(3, 18, 100, 'dock');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albara`
--
ALTER TABLE `albara`
  ADD PRIMARY KEY (`id_venta`);

--
-- Indices de la tabla `albara_detall`
--
ALTER TABLE `albara_detall`
  ADD PRIMARY KEY (`id_lin`),
  ADD KEY `albara_detall_ibfk_1` (`rid_venda`),
  ADD KEY `albara_detall_ibfk_2` (`rid_prod`);

--
-- Indices de la tabla `producte`
--
ALTER TABLE `producte`
  ADD PRIMARY KEY (`id_producte`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albara`
--
ALTER TABLE `albara`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `albara_detall`
--
ALTER TABLE `albara_detall`
  MODIFY `id_lin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producte`
--
ALTER TABLE `producte`
  MODIFY `id_producte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
