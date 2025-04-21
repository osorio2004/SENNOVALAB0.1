-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2025 a las 05:35:18
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
-- Base de datos: `gestor_documental`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexo`
--

CREATE TABLE `anexo` (
  `idAnexo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `ruta_archivo` varchar(100) NOT NULL,
  `fkProceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_historial`
--

CREATE TABLE `archivo_historial` (
  `version` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `vigenteDesde` date NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `retencion` date NOT NULL,
  `disposicionFinal` varchar(50) NOT NULL,
  `medioAlmacenamiento` varchar(45) NOT NULL,
  `ubicacionEnlace` varchar(50) NOT NULL,
  `rutaArchivo` varchar(100) NOT NULL,
  `fkDocumentoFormado` int(11) NOT NULL,
  `fkUsuarioAprobo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_externo`
--

CREATE TABLE `documento_externo` (
  `idDocumentoExterno` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fkProceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_formato`
--

CREATE TABLE `documento_formato` (
  `idDocumentoFormato` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `tipo_doc_formato` varchar(50) NOT NULL,
  `fkProceso` int(11) NOT NULL,
  `fkTipoDocumental` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `idproceso` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `siglaCod` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `tipoRol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `tipoRol`) VALUES
(1, 'Super Admin'),
(2, 'Editor'),
(3, 'Visualizador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumental`
--

CREATE TABLE `tipodocumental` (
  `idTipoDocumental` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipodocumental`
--

INSERT INTO `tipodocumental` (`idTipoDocumental`, `nombre`) VALUES
(1, 'Manual'),
(2, 'Caracterización'),
(3, 'Guia'),
(4, 'Procedimiento'),
(5, 'Instructivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correoElectronico` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fkIdRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD PRIMARY KEY (`idAnexo`),
  ADD KEY `fk_anexo_proceso` (`fkProceso`);

--
-- Indices de la tabla `archivo_historial`
--
ALTER TABLE `archivo_historial`
  ADD PRIMARY KEY (`version`),
  ADD KEY `fk_historial_documento` (`fkDocumentoFormado`),
  ADD KEY `fk_historial_usuario` (`fkUsuarioAprobo`);

--
-- Indices de la tabla `documento_externo`
--
ALTER TABLE `documento_externo`
  ADD PRIMARY KEY (`idDocumentoExterno`),
  ADD KEY `fk_doc_externo_proceso` (`fkProceso`);

--
-- Indices de la tabla `documento_formato`
--
ALTER TABLE `documento_formato`
  ADD PRIMARY KEY (`idDocumentoFormato`),
  ADD KEY `fk_doc_formato_proceso` (`fkProceso`),
  ADD KEY `fk_doc_formato_tipo` (`fkTipoDocumental`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`idproceso`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tipodocumental`
--
ALTER TABLE `tipodocumental`
  ADD PRIMARY KEY (`idTipoDocumental`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `fk_usuario_rol` (`fkIdRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anexo`
--
ALTER TABLE `anexo`
  MODIFY `idAnexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_historial`
--
ALTER TABLE `archivo_historial`
  MODIFY `version` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documento_externo`
--
ALTER TABLE `documento_externo`
  MODIFY `idDocumentoExterno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documento_formato`
--
ALTER TABLE `documento_formato`
  MODIFY `idDocumentoFormato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipodocumental`
--
ALTER TABLE `tipodocumental`
  MODIFY `idTipoDocumental` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD CONSTRAINT `fk_anexo_proceso` FOREIGN KEY (`fkProceso`) REFERENCES `proceso` (`idproceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `archivo_historial`
--
ALTER TABLE `archivo_historial`
  ADD CONSTRAINT `fk_historial_documento` FOREIGN KEY (`fkDocumentoFormado`) REFERENCES `documento_formato` (`idDocumentoFormato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_historial_usuario` FOREIGN KEY (`fkUsuarioAprobo`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documento_externo`
--
ALTER TABLE `documento_externo`
  ADD CONSTRAINT `fk_doc_externo_proceso` FOREIGN KEY (`fkProceso`) REFERENCES `proceso` (`idproceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documento_formato`
--
ALTER TABLE `documento_formato`
  ADD CONSTRAINT `fk_doc_formato_proceso` FOREIGN KEY (`fkProceso`) REFERENCES `proceso` (`idproceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_doc_formato_tipo` FOREIGN KEY (`fkTipoDocumental`) REFERENCES `tipodocumental` (`idTipoDocumental`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`fkIdRol`) REFERENCES `rol` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
