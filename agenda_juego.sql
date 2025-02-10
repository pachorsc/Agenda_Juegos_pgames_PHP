-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2025 a las 10:27:47
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda_juego`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `usuario` int(50) NOT NULL,
  `amigo_id` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_nac` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`usuario`, `amigo_id`, `nombre`, `apellido`, `fecha_nac`) VALUES
(7, 1, 'Maite', 'Martinez', '2007-12-31'),
(5, 2, 'Frodo', 'Balba', '2020-06-04'),
(7, 3, 'Pepa', 'Rodrigoa', '1966-06-28'),
(7, 15, 'Julia', 'Martinez', '2007-01-01'),
(9, 16, 'empalo', 'Que empalo?', '2009-06-10'),
(7, 17, 'Pepa', 'Maracena', '2017-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `usuario` int(11) NOT NULL,
  `juego_id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `plataforma` int(1) NOT NULL,
  `fech_lanz` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`usuario`, `juego_id`, `titulo`, `imagen`, `plataforma`, `fech_lanz`) VALUES
(7, 1, 'Zelda', 'img_juegos/Zelda', 2, '2023-07-06'),
(7, 2, 'Fifa', 'img_juegos/fifa', 1, '2024-01-31'),
(7, 8, 'Cup Head', 'img_juegos/Cup Head', 1, '2017-07-13'),
(7, 10, 'snake', 'img_juegos/snake', 1, '2015-01-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `usuario` int(11) NOT NULL,
  `amigo` int(11) NOT NULL,
  `juego` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`usuario`, `amigo`, `juego`, `fecha`, `estado`) VALUES
(7, 1, 2, '2025-01-30', 0),
(7, 1, 1, '2025-01-30', 0),
(7, 1, 2, '2025-01-30', 0),
(7, 1, 1, '2025-01-30', 0),
(7, 3, 1, '2025-02-06', 0),
(7, 3, 2, '2025-02-06', 0),
(7, 3, 8, '2025-02-06', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `fech_nac` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`, `fech_nac`) VALUES
(4, 'Jojo\'s', '123456', '2000-01-11'),
(5, 'Pablo', '000', '2015-01-15'),
(6, 'Marta', '123', '2010-01-19'),
(7, 'Pacho', '123', '1985-01-18'),
(8, 'admin', 'admin', '2003-01-08'),
(9, 'guason', '123456', '2005-01-14'),
(10, 'Payaso', '123456789', '1990-01-01'),
(12, 'nuevo ', 'zuzu', '1989-06-07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`amigo_id`),
  ADD KEY `usu_amigos-fk` (`usuario`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`juego_id`),
  ADD KEY `juego_usu_fk` (`usuario`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD KEY `usu_prestamo` (`usuario`),
  ADD KEY `juego_prestamo` (`juego`),
  ADD KEY `amigo_prestamo` (`amigo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
  MODIFY `amigo_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `juego_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `usu_amigos-fk` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `juego_usu_fk` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `amigo_prestamo` FOREIGN KEY (`amigo`) REFERENCES `amigos` (`amigo_id`),
  ADD CONSTRAINT `juego_prestamo` FOREIGN KEY (`juego`) REFERENCES `juegos` (`juego_id`),
  ADD CONSTRAINT `usu_prestamo` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
