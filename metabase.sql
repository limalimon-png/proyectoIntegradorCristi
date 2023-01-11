-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2023 a las 18:36:37
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `metabase`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `categoria_padre` int(11) DEFAULT NULL,
  `titulo` varchar(60) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `puntuacion` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `categoria_padre`, `titulo`, `descripcion`, `foto`, `puntuacion`) VALUES
(1, 1, 'prueba', '1531324', '0', 0),
(2, 1, 'prueba', '1531324', '0', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_usuario` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id_usuario`, `id_objeto`, `comentario`, `fecha`) VALUES
(1, 1, 'sdfgsdejhfsdjhf', '2023-01-04'),
(1, 2, 'yhrtr', '2023-01-26');

--
-- Disparadores `comentario`
--
DELIMITER $$
CREATE TRIGGER `sumaComentarios` AFTER INSERT ON `comentario` FOR EACH ROW UPDATE objeto set objeto.puntuacion_comentarios=objeto.puntuacion_comentarios+1 WHERE objeto.id = new.id_objeto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_usuario` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_usuario`, `id_objeto`, `fecha`) VALUES
(1, 1, '2023-01-18');

--
-- Disparadores `compra`
--
DELIMITER $$
CREATE TRIGGER `sumaCompra` AFTER INSERT ON `compra` FOR EACH ROW UPDATE objeto set objeto.puntuacion_compra=objeto.puntuacion_compra+1 WHERE objeto.id = new.id_objeto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objeto`
--

CREATE TABLE `objeto` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `foto1` varchar(255) NOT NULL,
  `foto2` varchar(255) DEFAULT NULL,
  `foto3` varchar(255) DEFAULT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,4) NOT NULL,
  `latitud` varchar(255) DEFAULT NULL,
  `longitud` varchar(255) DEFAULT NULL,
  `puntuacion_compra` int(11) NOT NULL,
  `puntuacion_comentarios` int(11) NOT NULL,
  `puntuacion_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `objeto`
--

INSERT INTO `objeto` (`id`, `id_categoria`, `foto1`, `foto2`, `foto3`, `nombre`, `descripcion`, `precio`, `latitud`, `longitud`, `puntuacion_compra`, `puntuacion_comentarios`, `puntuacion_total`) VALUES
(1, 1, 'drgfdfgfd', NULL, NULL, 'pruebaobjeto', 'asdasd', '242.5200', NULL, NULL, 1, 5, 0),
(2, 1, 'jhgnfbdvxs', NULL, NULL, 'pruebaobjeto2', 'sdfsdf', '50.0000', NULL, NULL, 0, 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellidos` varchar(90) NOT NULL,
  `monedero` decimal(10,4) NOT NULL,
  `admin` int(1) DEFAULT NULL,
  `foto` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`, `nombre`, `apellidos`, `monedero`, `admin`, `foto`) VALUES
(1, 'prueba@gmail.com', '1234', 'prueba', 'pureba prueba', '100.0000', NULL, NULL);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `RestaComentarios` BEFORE DELETE ON `usuario` FOR EACH ROW update  objeto set objeto.puntuacion_comentarios=objeto.puntuacion_comentarios-1 where objeto.id in (select comentario.id_objeto from comentario where comentario.id_usuario=old.id )
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`categoria_padre`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_usuario`,`id_objeto`),
  ADD KEY `fk_objeto_comentario` (`id_objeto`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_usuario`,`id_objeto`),
  ADD KEY `fk_objeto_compra` (`id_objeto`);

--
-- Indices de la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria_objeto` (`id_categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria_padre`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_objeto_comentario` FOREIGN KEY (`id_objeto`) REFERENCES `objeto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario_comentario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_objeto_compra` FOREIGN KEY (`id_objeto`) REFERENCES `objeto` (`id`),
  ADD CONSTRAINT `fk_usuario_compra` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD CONSTRAINT `fk_categoria_objeto` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
