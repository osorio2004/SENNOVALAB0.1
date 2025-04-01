-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2025 a las 15:12:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestordocumentalsennova`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriadocumento`
--

CREATE TABLE `categoriadocumento` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `fechaEdicion` date NOT NULL,
  `estado` varchar(45) NOT NULL,
  `idUsuarioCreador` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `version` int(11) NOT NULL,
  `idUsuarioAprobo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentoexterno`
--

CREATE TABLE `documentoexterno` (
  `idDocumentoExterno` int(11) NOT NULL,
  `nombreDocumento` varchar(45) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `version` int(11) NOT NULL,
  `grupo` varchar(1) NOT NULL,
  `ubicacion` varchar(45) NOT NULL,
  `medio` varchar(45) NOT NULL,
  `fechaEdicion` date NOT NULL,
  `idUsuarioAprobo` int(11) NOT NULL,
  `idUsuarioCreador` int(11) NOT NULL,
  `idProceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato`
--

CREATE TABLE `formato` (
  `idFormato` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `nombreFormato` varchar(45) NOT NULL,
  `internoExterno` varchar(1) NOT NULL,
  `version` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `retencion` date NOT NULL,
  `disposicionFnl` varchar(45) NOT NULL,
  `idProceso` int(11) NOT NULL,
  `idUsuarioAprobo` int(11) NOT NULL,
  `idUsuarioCreador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialrevision`
--

CREATE TABLE `historialrevision` (
  `idRevision` int(11) NOT NULL,
  `fechaRevision` date NOT NULL,
  `comentarios` varchar(255) NOT NULL,
  `idUsuarioRevisor` int(11) NOT NULL,
  `idDocumento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesodocumento`
--

CREATE TABLE `procesodocumento` (
  `idProceso` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`) VALUES
(1, 'super_admin'),
(2, 'editor'),
(3, 'visualizador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumental`
--

CREATE TABLE `tipodocumental` (
  `idTipoDocumental` int(11) NOT NULL,
  `tipoDocumental` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correoElectronico` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `correoElectronico`, `contraseña`, `idRol`) VALUES
(1, 'Juan Pablo', 'Aristizabal', 'juanp@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `versiondocumento`
--

CREATE TABLE `versiondocumento` (
  `idVersion` int(11) NOT NULL,
  `numeroVersion` int(11) NOT NULL,
  `fechaModificacion` date NOT NULL,
  `cambios` varchar(255) NOT NULL,
  `idDocumento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoriadocumento`
--
ALTER TABLE `categoriadocumento`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`idDocumento`),
  ADD KEY `idUsuarioCreador` (`idUsuarioCreador`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `idUsuarioAprobo` (`idUsuarioAprobo`);

--
-- Indices de la tabla `documentoexterno`
--
ALTER TABLE `documentoexterno`
  ADD PRIMARY KEY (`idDocumentoExterno`),
  ADD KEY `fk_documentoExterno_usuarioCreador` (`idUsuarioCreador`),
  ADD KEY `fk_documentoExterno_proceso` (`idProceso`),
  ADD KEY `fk_documentoExterno_usuarioAprobo` (`idUsuarioAprobo`);

--
-- Indices de la tabla `formato`
--
ALTER TABLE `formato`
  ADD PRIMARY KEY (`idFormato`),
  ADD KEY `fk_formato_proceso` (`idProceso`),
  ADD KEY `fk_formato_usuarioAprobo` (`idUsuarioAprobo`),
  ADD KEY `fk_formato_usuarioCreador` (`idUsuarioCreador`);

--
-- Indices de la tabla `historialrevision`
--
ALTER TABLE `historialrevision`
  ADD PRIMARY KEY (`idRevision`),
  ADD KEY `idUsuarioRevisor` (`idUsuarioRevisor`),
  ADD KEY `idDocumento` (`idDocumento`);

--
-- Indices de la tabla `procesodocumento`
--
ALTER TABLE `procesodocumento`
  ADD PRIMARY KEY (`idProceso`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tipodocumental`
--
ALTER TABLE `tipodocumental`
  ADD PRIMARY KEY (`idTipoDocumental`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `correoElectronico` (`correoElectronico`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `versiondocumento`
--
ALTER TABLE `versiondocumento`
  ADD PRIMARY KEY (`idVersion`),
  ADD KEY `idDocumento` (`idDocumento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoriadocumento`
--
ALTER TABLE `categoriadocumento`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historialrevision`
--
ALTER TABLE `historialrevision`
  MODIFY `idRevision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `versiondocumento`
--
ALTER TABLE `versiondocumento`
  MODIFY `idVersion` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`idUsuarioCreador`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoriadocumento` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idUsuarioAprobo` FOREIGN KEY (`idUsuarioAprobo`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `documentoexterno`
--
ALTER TABLE `documentoexterno`
  ADD CONSTRAINT `fk_documentoExterno_proceso` FOREIGN KEY (`idProceso`) REFERENCES `procesodocumento` (`idProceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documentoExterno_usuarioAprobo` FOREIGN KEY (`idUsuarioAprobo`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documentoExterno_usuarioCreador` FOREIGN KEY (`idUsuarioCreador`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `formato`
--
ALTER TABLE `formato`
  ADD CONSTRAINT `fk_formato_proceso` FOREIGN KEY (`idProceso`) REFERENCES `procesodocumento` (`idProceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_formato_usuarioAprobo` FOREIGN KEY (`idUsuarioAprobo`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_formato_usuarioCreador` FOREIGN KEY (`idUsuarioCreador`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historialrevision`
--
ALTER TABLE `historialrevision`
  ADD CONSTRAINT `historialrevision_ibfk_1` FOREIGN KEY (`idUsuarioRevisor`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `historialrevision_ibfk_2` FOREIGN KEY (`idDocumento`) REFERENCES `documento` (`idDocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `versiondocumento`
--
ALTER TABLE `versiondocumento`
  ADD CONSTRAINT `versiondocumento_ibfk_1` FOREIGN KEY (`idDocumento`) REFERENCES `documento` (`idDocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
