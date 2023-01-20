-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2023 at 01:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `categoria_padre` int(11) DEFAULT NULL,
  `titulo` varchar(60) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `puntuacion` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `categoria_padre`, `titulo`, `descripcion`, `foto`, `puntuacion`) VALUES
(1, 1, 'prueba', '1531324', 'projects.jpg', 0),
(2, 1, 'prueba', '1531324', '0', 0),
(5, NULL, 'nueva', 'supernueva', '', 0),
(6, NULL, 'otra', 'otraandsjhfds', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `id_usuario` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comentario`
--

INSERT INTO `comentario` (`id_usuario`, `id_objeto`, `comentario`, `fecha`) VALUES
(1, 1, 'sdfgsdejhfsdjhf', '2023-01-04'),
(1, 2, 'yhrtr', '2023-01-26');

--
-- Triggers `comentario`
--
DELIMITER $$
CREATE TRIGGER `sumaComentarios` AFTER INSERT ON `comentario` FOR EACH ROW UPDATE objeto set objeto.puntuacion_comentarios=objeto.puntuacion_comentarios+1 WHERE objeto.id = new.id_objeto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `id_usuario` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`id_usuario`, `id_objeto`, `fecha`) VALUES
(1, 1, '2023-01-18');

--
-- Triggers `compra`
--
DELIMITER $$
CREATE TRIGGER `sumaCompra` AFTER INSERT ON `compra` FOR EACH ROW UPDATE objeto set objeto.puntuacion_compra=objeto.puntuacion_compra+1 WHERE objeto.id = new.id_objeto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `objeto`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `objeto`
--

INSERT INTO `objeto` (`id`, `id_categoria`, `foto1`, `foto2`, `foto3`, `nombre`, `descripcion`, `precio`, `latitud`, `longitud`, `puntuacion_compra`, `puntuacion_comentarios`, `puntuacion_total`) VALUES
(1, 1, 'drgfdfgfd', NULL, NULL, 'pruebaobjeto', 'asdasd', '242.5200', NULL, NULL, 1, 5, 0),
(2, 1, 'jhgnfbdvxs', NULL, NULL, 'pruebaobjeto2', 'sdfsdf', '50.0000', NULL, NULL, 0, 5, 0),
(3, 1, 'null', NULL, NULL, 'objeto3', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(4, 1, 'null', NULL, NULL, 'objeto4', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(5, 1, 'null', NULL, NULL, 'objeto5', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(6, 1, 'null', NULL, NULL, 'objeto6', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(7, 1, 'null', NULL, NULL, 'objeto7', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(8, 1, 'null', NULL, NULL, 'objeto8', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(9, 1, 'null', NULL, NULL, 'objeto9', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(10, 1, 'null', NULL, NULL, 'objeto10', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(11, 1, 'null', NULL, NULL, 'objeto11', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(12, 1, 'null', NULL, NULL, 'objeto12', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(13, 1, 'null', NULL, NULL, 'objeto13', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(14, 1, 'null', NULL, NULL, 'objeto14', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(15, 1, 'null', NULL, NULL, 'objeto15', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(16, 1, 'null', NULL, NULL, 'objeto16', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(17, 1, 'null', NULL, NULL, 'objeto17', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0),
(18, 1, 'null', NULL, NULL, 'objeto18', 'hfrewhtrehtrejkhterhteherk', '13.0000', NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`, `nombre`, `apellidos`, `monedero`, `admin`, `foto`) VALUES
(1, 'prueba@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'prueba', 'pureba prueba', '100.0000', NULL, 'matrix.gif'),
(8, 'admin@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'null', 'null', '9999.0000', 1, NULL),
(9, 'guiller@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'guiller', 'luigi roldan', '1.0000', NULL, NULL),
(10, 'juan@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'juan', 'luigi roldan', '1.0000', NULL, NULL),
(11, 'p@p.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'p', 'p', '1.0000', NULL, NULL),
(12, 'sdfsd@skdfhj.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'aom', 'sdsfs', '1.0000', NULL, NULL),
(14, 'sdfsa@skdfhj.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin@gmail.com', 'sdsfs', '1.0000', NULL, 'avatar-removebg-preview.png'),
(15, 'fgvhbjn@gvhbjn', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admihgbjnn@gmail.com', 'fghbjn', '1.0000', NULL, NULL),
(16, 'fgvhb@fgbhj.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'fdcgvhbjn', 'dfcgvhbjn', '1.0000', NULL, NULL),
(17, '', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin@gmail.com', '', '1.0000', NULL, NULL),
(20, 'rxtcvybu@vybunm.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'fghjk', 'dfcgvbnkm', '1.0000', NULL, NULL);

--
-- Triggers `usuario`
--
DELIMITER $$
CREATE TRIGGER `RestaComentarios` BEFORE DELETE ON `usuario` FOR EACH ROW update  objeto set objeto.puntuacion_comentarios=objeto.puntuacion_comentarios-1 where objeto.id in (select comentario.id_objeto from comentario where comentario.id_usuario=old.id )
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`categoria_padre`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_usuario`,`id_objeto`),
  ADD KEY `fk_objeto_comentario` (`id_objeto`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_usuario`,`id_objeto`),
  ADD KEY `fk_objeto_compra` (`id_objeto`);

--
-- Indexes for table `objeto`
--
ALTER TABLE `objeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria_objeto` (`id_categoria`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria_padre`) REFERENCES `categoria` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_objeto_comentario` FOREIGN KEY (`id_objeto`) REFERENCES `objeto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario_comentario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_objeto_compra` FOREIGN KEY (`id_objeto`) REFERENCES `objeto` (`id`),
  ADD CONSTRAINT `fk_usuario_compra` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `objeto`
--
ALTER TABLE `objeto`
  ADD CONSTRAINT `fk_categoria_objeto` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
