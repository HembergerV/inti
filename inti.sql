-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2019 a las 18:00:43
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idcita` int(5) NOT NULL,
  `cedulaciudadano` varchar(12) NOT NULL,
  `fecha` date NOT NULL,
  `codcita` int(3) NOT NULL,
  `motivo` varchar(35) NOT NULL,
  `coddpto` int(2) NOT NULL,
  `codestatus` int(2) NOT NULL,
  `userid` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudadano`
--

CREATE TABLE `ciudadano` (
  `idciudadano` int(4) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `rif` varchar(12) DEFAULT NULL,
  `primernombre` varchar(50) NOT NULL,
  `segundonombre` varchar(50) DEFAULT NULL,
  `primerapellido` varchar(50) NOT NULL,
  `segundoapellido` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dpto`
--

CREATE TABLE `dpto` (
  `id` int(2) NOT NULL,
  `coddpto` int(2) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dpto`
--

INSERT INTO `dpto` (`id`, `coddpto`, `nombre`, `estatus`) VALUES
(1, 1, 'INFORMATICA', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `codestado` int(2) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `codpais` int(2) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `idestatus` int(2) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestrocita`
--

CREATE TABLE `maestrocita` (
  `idcita` int(3) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestrotramite`
--

CREATE TABLE `maestrotramite` (
  `idtramite` int(3) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `codmunicipio` int(2) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `codestado` int(2) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidad`
--

CREATE TABLE `nacionalidad` (
  `id` int(2) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `abreviatura` varchar(1) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nacionalidad`
--

INSERT INTO `nacionalidad` (`id`, `nombre`, `abreviatura`, `estatus`) VALUES
(1, 'VENEZOLANO', 'V', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetoroles`
--

CREATE TABLE `objetoroles` (
  `id` int(3) NOT NULL,
  `idroles` int(3) NOT NULL,
  `idobjeto` int(3) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetos`
--

CREATE TABLE `objetos` (
  `idobjeto` int(3) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `descripcion` varchar(70) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `codpais` int(2) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE `parroquia` (
  `codparroquia` int(2) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `codmunicipio` int(2) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recaudos`
--

CREATE TABLE `recaudos` (
  `idrecaudos` int(3) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `idtramite` int(5) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idroles` int(3) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `descripcion` varchar(70) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `codsector` int(4) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `codparroquia` int(2) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramite`
--

CREATE TABLE `tramite` (
  `idtramite` int(5) NOT NULL,
  `cedulasolicitante` varchar(12) NOT NULL,
  `fechacreacion` date NOT NULL,
  `codtramite` int(3) NOT NULL,
  `loteterreno` varchar(100) NOT NULL,
  `superficie` varchar(20) NOT NULL,
  `codsector` int(4) NOT NULL,
  `situacion` int(2) NOT NULL,
  `codestatus` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usersroles`
--

CREATE TABLE `usersroles` (
  `id` int(3) NOT NULL,
  `userid` int(8) NOT NULL,
  `idroles` int(3) NOT NULL,
  `estatus` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(12) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `cargo` enum('1','0') NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `password2` varchar(20) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `cedula`, `telefono`, `correo`, `direccion`, `cargo`, `usuario`, `password`, `password2`, `fecha_ingreso`, `estado`) VALUES
(3, 'juan jose', 'soto', '20391877', '04245555800', 'juanjosexdd7@gmail.com', 'durigua', '1', 'adolecentes', '123456', '123456', '2019-03-14', '1'),
(4, 'Raul', 'Oropeza', '20391878', '04123152698', 'raul@gmail.com', 'durigua', '0', 'Raul', '123456', '123456', '2019-03-14', '1'),
(5, 'irma josefina', 'peña mendoza', '14346723', '04121539213', 'irma_labonita@hotmail.com', 'la gonzalo', '1', 'irma', '123456', '123456', '2019-03-14', '1'),
(6, 'maria', 'perez', '21590055', '0412315000', 'mariaperez@gmail.com', 'la china', '1', 'mariaperez', '123456', '123456', '2019-03-14', '1'),
(7, 'yepeto', 'pepeto', '85566958', '04123152698', 'yepeto@gmail.com', 'pepe grillo', '0', 'yepeto', '123456', '123456', '2019-03-14', '1'),
(8, 'yoyito', 'tifon', '55584455', '0225555455', 'tifon@gmail.com', 'jsdñljasdhsdñsk', '1', 'tifon', '123456', '123456', '2019-03-14', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idcita`),
  ADD UNIQUE KEY `cedulaciudadano` (`cedulaciudadano`),
  ADD UNIQUE KEY `codcita` (`codcita`),
  ADD UNIQUE KEY `codestatus` (`codestatus`),
  ADD UNIQUE KEY `coddpto` (`coddpto`);

--
-- Indices de la tabla `ciudadano`
--
ALTER TABLE `ciudadano`
  ADD PRIMARY KEY (`idciudadano`),
  ADD UNIQUE KEY `UNIQUE` (`email`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `dpto`
--
ALTER TABLE `dpto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`codestado`),
  ADD UNIQUE KEY `codpais` (`codpais`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`idestatus`);

--
-- Indices de la tabla `maestrocita`
--
ALTER TABLE `maestrocita`
  ADD PRIMARY KEY (`idcita`);

--
-- Indices de la tabla `maestrotramite`
--
ALTER TABLE `maestrotramite`
  ADD PRIMARY KEY (`idtramite`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`codmunicipio`),
  ADD UNIQUE KEY `codestado` (`codestado`);

--
-- Indices de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `objetoroles`
--
ALTER TABLE `objetoroles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idroles` (`idroles`),
  ADD UNIQUE KEY `idobjeto` (`idobjeto`);

--
-- Indices de la tabla `objetos`
--
ALTER TABLE `objetos`
  ADD PRIMARY KEY (`idobjeto`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`codpais`);

--
-- Indices de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD PRIMARY KEY (`codparroquia`),
  ADD UNIQUE KEY `codmunicipio` (`codmunicipio`);

--
-- Indices de la tabla `recaudos`
--
ALTER TABLE `recaudos`
  ADD PRIMARY KEY (`idrecaudos`),
  ADD UNIQUE KEY `idtramite` (`idtramite`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idroles`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`codsector`),
  ADD UNIQUE KEY `codparroquia` (`codparroquia`);

--
-- Indices de la tabla `tramite`
--
ALTER TABLE `tramite`
  ADD PRIMARY KEY (`idtramite`),
  ADD UNIQUE KEY `cedulasolicitante` (`cedulasolicitante`),
  ADD UNIQUE KEY `codtramite` (`codtramite`),
  ADD UNIQUE KEY `codsector` (`codsector`),
  ADD UNIQUE KEY `situacion` (`situacion`),
  ADD UNIQUE KEY `codestatus` (`codestatus`);

--
-- Indices de la tabla `usersroles`
--
ALTER TABLE `usersroles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `idroles` (`idroles`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idcita` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudadano`
--
ALTER TABLE `ciudadano`
  MODIFY `idciudadano` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dpto`
--
ALTER TABLE `dpto`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `codestado` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `idestatus` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `maestrocita`
--
ALTER TABLE `maestrocita`
  MODIFY `idcita` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `maestrotramite`
--
ALTER TABLE `maestrotramite`
  MODIFY `idtramite` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `codmunicipio` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `objetoroles`
--
ALTER TABLE `objetoroles`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `objetos`
--
ALTER TABLE `objetos`
  MODIFY `idobjeto` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `codpais` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  MODIFY `codparroquia` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recaudos`
--
ALTER TABLE `recaudos`
  MODIFY `idrecaudos` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idroles` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `codsector` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tramite`
--
ALTER TABLE `tramite`
  MODIFY `idtramite` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usersroles`
--
ALTER TABLE `usersroles`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`cedulaciudadano`) REFERENCES `ciudadano` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`codestatus`) REFERENCES `estatus` (`idestatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`codcita`) REFERENCES `maestrocita` (`idcita`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_ibfk_1` FOREIGN KEY (`codpais`) REFERENCES `pais` (`codpais`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`codestado`) REFERENCES `estado` (`codestado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `objetoroles`
--
ALTER TABLE `objetoroles`
  ADD CONSTRAINT `objetoroles_ibfk_1` FOREIGN KEY (`idroles`) REFERENCES `roles` (`idroles`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `objetoroles_ibfk_2` FOREIGN KEY (`idobjeto`) REFERENCES `objetos` (`idobjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD CONSTRAINT `parroquia_ibfk_1` FOREIGN KEY (`codmunicipio`) REFERENCES `municipio` (`codmunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recaudos`
--
ALTER TABLE `recaudos`
  ADD CONSTRAINT `recaudos_ibfk_1` FOREIGN KEY (`idrecaudos`) REFERENCES `maestrotramite` (`idtramite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sector`
--
ALTER TABLE `sector`
  ADD CONSTRAINT `sector_ibfk_1` FOREIGN KEY (`codparroquia`) REFERENCES `parroquia` (`codparroquia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tramite`
--
ALTER TABLE `tramite`
  ADD CONSTRAINT `tramite_ibfk_1` FOREIGN KEY (`cedulasolicitante`) REFERENCES `ciudadano` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tramite_ibfk_2` FOREIGN KEY (`codsector`) REFERENCES `sector` (`codsector`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tramite_ibfk_3` FOREIGN KEY (`codestatus`) REFERENCES `estatus` (`idestatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tramite_ibfk_5` FOREIGN KEY (`situacion`) REFERENCES `dpto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tramite_ibfk_6` FOREIGN KEY (`codtramite`) REFERENCES `maestrotramite` (`idtramite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usersroles`
--
ALTER TABLE `usersroles`
  ADD CONSTRAINT `usersroles_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usersroles_ibfk_2` FOREIGN KEY (`idroles`) REFERENCES `roles` (`idroles`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
