-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-09-2016 a las 20:28:20
-- Versión del servidor: 5.1.36-community-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `eayaadmin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientes`
--

CREATE TABLE IF NOT EXISTS `dbclientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nrodocumento` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(22) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `apellido`, `nombre`, `nrodocumento`, `telefono`) VALUES
(1, 'Saupurein Safar', 'Marcos', '31552466', '0226184415'),
(2, 'Tripodi', 'Diego', '19855644', ''),
(3, 'Milanovic', 'Gaston', '29333111', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuarios`
--

CREATE TABLE IF NOT EXISTS `dbusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `refroles` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecompleto` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `fk_dbusuarios_tbroles1_idx` (`refroles`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroles`, `email`, `nombrecompleto`) VALUES
(1, 'admin', 'admin', 1, 'admin@msn.com', 'Administrador'),
(2, 'Daniela', 'daniela', 1, 'danuja86@hotmail.com', 'Ropaldo Daniela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbventas`
--

CREATE TABLE IF NOT EXISTS `dbventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `refclientes` int(11) NOT NULL,
  `reftipoventa` int(11) NOT NULL,
  `tarjeta` smallint(6) DEFAULT NULL,
  `adicionales` int(11) DEFAULT NULL,
  `seguros` smallint(6) DEFAULT NULL,
  `upgrate` smallint(6) DEFAULT NULL,
  `observaciones` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechacreacion` datetime DEFAULT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_dbventas_tbtipoventa1_idx` (`reftipoventa`),
  KEY `fk_dbventas_dbclientes1_idx` (`refclientes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `dbventas`
--

INSERT INTO `dbventas` (`idventa`, `numero`, `refclientes`, `reftipoventa`, `tarjeta`, `adicionales`, `seguros`, `upgrate`, `observaciones`, `fechacreacion`) VALUES
(1, 'VEN000001', 1, 1, 1, NULL, 1, NULL, '', '2016-09-16 15:00:00'),
(3, 'ORD000002', 2, 2, 1, NULL, NULL, NULL, 'Le falta la fotocopia del documento', '2016-09-16 15:53:07'),
(4, 'ORD000004', 2, 1, NULL, NULL, 1, NULL, '', '2016-09-16 15:53:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE IF NOT EXISTS `predio_menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(12, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Administrador'),
(13, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Administrador'),
(16, '../clientes/', 'icojugadores', 'Clientes', 2, NULL, 'Administrador'),
(21, '../reportes/', 'icoreportes', 'Reportes', 10, NULL, 'Administrador'),
(22, '../usuarios/', 'icousuarios', 'Usuarios', 7, NULL, 'Administrador'),
(24, '../ventas/', 'icopagos', 'Ventas', 3, NULL, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1'),
(2, 'Empleado', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipoventa`
--

CREATE TABLE IF NOT EXISTS `tbtipoventa` (
  `idtipoventa` int(11) NOT NULL AUTO_INCREMENT,
  `tipoventa` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idtipoventa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbtipoventa`
--

INSERT INTO `tbtipoventa` (`idtipoventa`, `tipoventa`) VALUES
(1, 'Venta'),
(2, 'Pre-Aprobado'),
(3, 'No Aplica');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbventas`
--
ALTER TABLE `dbventas`
  ADD CONSTRAINT `fk_dbventas_dbclientes1` FOREIGN KEY (`refclientes`) REFERENCES `dbclientes` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dbventas_tbtipoventa1` FOREIGN KEY (`reftipoventa`) REFERENCES `tbtipoventa` (`idtipoventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
