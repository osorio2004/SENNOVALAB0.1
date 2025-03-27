-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2025 a las 16:59:18
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
-- Base de datos: `gestordocumental`
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

--
-- Volcado de datos para la tabla `categoriadocumento`
--

INSERT INTO `categoriadocumento` (`idCategoria`, `nombre`, `descripcion`) VALUES
(1, 'flexiones', 'puedo hacer flexiones y saltos al mismo tiempo');

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
  `idUsuarioAprobo` int(11) NOT NULL,
  `idUsuarioElaboro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(50) NOT NULL,
  `Permisos` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo_doc` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('super_admin','coordinador','trabajador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`) VALUES
(5, 'Juan', 'juan@example.com', '$2y$10$p5MPYWBTRUBfpy2zVVBwN.akXweMdkHhV1e1QqCiKSz0zuris12g.', 'super_admin'),
(9, 'pablo', 'pablo@gmail.com', '$2y$10$pVdid0cDj1e.la47X257x.qwid0wcXKl00jwbvHv5SNe4OqLr28om', 'coordinador'),
(10, 'Andres', 'andres@gmail.com', '$2y$10$Cf37h3EAKJK9u4vdtUFv2OMJfthR6tnfM.joSIHtbxHkHBQghiMfS', 'super_admin'),
(11, 'Esteban', 'esteban@gmail.com', '$2y$10$PfJ8E3soJaCl2x/lj9Z7h.p6J096xteyDx1MLUjGQt7gol6lTeCUK', 'coordinador'),
(12, 'Samuel', 'samuel@gmail.com', '$2y$10$5ERlr8FcIsX75HUAz4U82eibRTueS9nfivRW2yGMzN/P5JHhAYEq6', 'trabajador'),
(13, 'Diego', 'diego@gmail.com', '$2y$10$9w5tJAfLZIpuPZeUBlmfqe/aEx4Ym47MSYia6BaAHqDesavGcMxYy', 'trabajador'),
(14, 'vallejo', 'vallejo@gmail.com', '$2y$10$aqZJqgHB452tdoITYN3ryeE1urNAsTJXxBnn3iybpscND/Lc/E5ry', 'coordinador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoriadocumento`
--
ALTER TABLE `categoriadocumento`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo_doc`);

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
-- AUTO_INCREMENT de la tabla `categoriadocumento`
--
ALTER TABLE `categoriadocumento`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo_doc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
