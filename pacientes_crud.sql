-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-08-2022 a las 04:50:09
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pacientes_crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_civil`
--

DROP TABLE IF EXISTS `estado_civil`;
CREATE TABLE IF NOT EXISTS `estado_civil` (
  `idestado_civil` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idestado_civil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado_civil`
--

INSERT INTO `estado_civil` (`idestado_civil`, `estado`) VALUES
(1, 'Casado'),
(2, 'Soltero'),
(3, 'Union libre'),
(4, 'Divorsiado'),
(5, 'Viudo'),
(6, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `idgenero` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_genero` varchar(45) NOT NULL,
  PRIMARY KEY (`idgenero`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`idgenero`, `nombre_genero`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'Indefinido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `idPacientes` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `numero_documento` varchar(45) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int(2) NOT NULL,
  `doctor` varchar(60) NOT NULL,
  `odontologico` varchar(10) DEFAULT NULL,
  `genero_idgenero` int(11) NOT NULL,
  `tipo_documento_idtipo_documento` int(11) NOT NULL,
  `estado_civil_idestado_civil` int(11) NOT NULL,
  PRIMARY KEY (`idPacientes`,`genero_idgenero`,`tipo_documento_idtipo_documento`,`estado_civil_idestado_civil`),
  KEY `fk_Pacientes_genero1_idx` (`genero_idgenero`),
  KEY `fk_Pacientes_tipo_documento1_idx` (`tipo_documento_idtipo_documento`),
  KEY `fk_Pacientes_estado_civil1_idx` (`estado_civil_idestado_civil`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`idPacientes`, `nombre`, `apellido`, `numero_documento`, `fecha_nacimiento`, `edad`, `doctor`, `odontologico`, `genero_idgenero`, `tipo_documento_idtipo_documento`, `estado_civil_idestado_civil`) VALUES
(10, 'Marta', 'Mendez', '98757344', '2011-04-23', 11, 'Carlos Torres', '', 2, 2, 2),
(18, 'Daniel', 'Diaz', '12233', '2015-08-12', 6, 'Carlos Torres', 'si', 1, 5, 6),
(21, 'Marcela', 'Betancourt', '1223321', '2022-07-04', 1, 'Ana Gutierrez', 'si', 1, 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `idtipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`idtipo_documento`, `tipo`) VALUES
(1, 'Cedula'),
(2, 'Tarjeta de identidad'),
(3, 'Pasaporte'),
(4, 'Permiso especial de permanencia'),
(5, 'Cedula de extranjeria'),
(6, 'Registro civil');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `fk_Pacientes_estado_civil1` FOREIGN KEY (`estado_civil_idestado_civil`) REFERENCES `estado_civil` (`idestado_civil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pacientes_tipo_documento1` FOREIGN KEY (`tipo_documento_idtipo_documento`) REFERENCES `tipo_documento` (`idtipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
