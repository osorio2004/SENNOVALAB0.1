-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-04-2025 a las 14:52:56
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
  `ruta_archivo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anexo`
--

INSERT INTO `anexo` (`idAnexo`, `nombre`, `fecha`, `ruta_archivo`) VALUES
(1, 'Pagos', '2025-04-28', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_externo`
--

CREATE TABLE `documento_externo` (
  `idDocumentoExterno` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `observacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documento_formato`
--

INSERT INTO `documento_formato` (`idDocumentoFormato`, `codigo`, `nombre`, `tipo`, `tipo_doc_formato`, `fkProceso`, `fkTipoDocumental`) VALUES
(1, 'msg', 'sistemas', 'algo', 'algo', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_archivos`
--

CREATE TABLE `historial_archivos` (
  `idHistorial` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `vigenteDesde` date NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `retencion` date NOT NULL,
  `disposicionFinal` varchar(50) NOT NULL,
  `medioAlmacenamiento` varchar(45) NOT NULL,
  `ubicacionEnlace` varchar(50) NOT NULL,
  `rutaArchivo` varchar(45) NOT NULL,
  `fkDocumentoFormado` int(11) DEFAULT NULL,
  `fkUsuarioAprobo` int(11) NOT NULL,
  `fkDocumentoExterno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `idproceso` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `siglaCod` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`idproceso`, `nombre`, `siglaCod`) VALUES
(1, 'Manual del Sistema de Gestión Documental', 'SL-MSGI-001'),
(2, 'Caracterización Proceso de Gestión de I+D+i', 'SL-C-001'),
(3, 'Guia para gestion documental', 'SL-G-001'),
(4, 'Guia para la gestion de riesgos en proyectos ', 'SL-G-003');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `nombreRol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombreRol`) VALUES
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipodocumental`
--

INSERT INTO `tipodocumental` (`idTipoDocumental`, `nombre`) VALUES
(1, 'Manual'),
(2, 'Caracterización'),
(3, 'Guía'),
(4, 'Procedimiento'),
(5, 'Instructivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('super_admin','coordinador','trabajador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `rol`) VALUES
(1, 'Juan', '', 'juan@example.com', '$2y$10$p5MPYWBTRUBfpy2zVVBwN.akXweMdkHhV1e1QqCiKSz0zuris12g.', 'super_admin'),
(2, 'Samuel', '', 'samuel@gmail.com', '$2y$10$Gs8QPoCI43Aq9RYWDWchq.2Az7xEFuxji7PAhSVj4GaJJJPQ2T192', 'super_admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD PRIMARY KEY (`idAnexo`);

--
-- Indices de la tabla `documento_externo`
--
ALTER TABLE `documento_externo`
  ADD PRIMARY KEY (`idDocumentoExterno`);

--
-- Indices de la tabla `documento_formato`
--
ALTER TABLE `documento_formato`
  ADD PRIMARY KEY (`idDocumentoFormato`),
  ADD KEY `fkProceso` (`fkProceso`),
  ADD KEY `fkTipoDocumental` (`fkTipoDocumental`);

--
-- Indices de la tabla `historial_archivos`
--
ALTER TABLE `historial_archivos`
  ADD PRIMARY KEY (`idHistorial`),
  ADD KEY `fkDocumentoFormado` (`fkDocumentoFormado`),
  ADD KEY `fkUsuarioAprobo` (`fkUsuarioAprobo`),
  ADD KEY `fkDocumentoExterno` (`fkDocumentoExterno`);

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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anexo`
--
ALTER TABLE `anexo`
  MODIFY `idAnexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `documento_externo`
--
ALTER TABLE `documento_externo`
  MODIFY `idDocumentoExterno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documento_formato`
--
ALTER TABLE `documento_formato`
  MODIFY `idDocumentoFormato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historial_archivos`
--
ALTER TABLE `historial_archivos`
  MODIFY `idHistorial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documento_formato`
--
ALTER TABLE `documento_formato`
  ADD CONSTRAINT `documento_formato_ibfk_1` FOREIGN KEY (`fkProceso`) REFERENCES `proceso` (`idproceso`),
  ADD CONSTRAINT `documento_formato_ibfk_2` FOREIGN KEY (`fkTipoDocumental`) REFERENCES `tipodocumental` (`idTipoDocumental`);

--
-- Filtros para la tabla `historial_archivos`
--
ALTER TABLE `historial_archivos`
  ADD CONSTRAINT `historial_archivos_ibfk_1` FOREIGN KEY (`fkDocumentoFormado`) REFERENCES `documento_formato` (`idDocumentoFormato`),
  ADD CONSTRAINT `historial_archivos_ibfk_2` FOREIGN KEY (`fkUsuarioAprobo`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `historial_archivos_ibfk_3` FOREIGN KEY (`fkDocumentoExterno`) REFERENCES `documento_externo` (`idDocumentoExterno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
