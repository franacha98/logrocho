-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 12:26 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logrocho`
--

-- --------------------------------------------------------

--
-- Table structure for table `bares`
--

CREATE TABLE `bares` (
  `cod_bar` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bares`
--

INSERT INTO `bares` (`cod_bar`, `nombre`, `latitud`, `longitud`) VALUES
(2, 'Bar Lorenzo ', 42.65444, -2.44191),
(3, 'Bodeguilla los Rotos', 42.62132, -2.448741),
(4, 'La Gota de vino', 42.15152, -2.44781),
(5, 'Bar Angel', 42.66512, -2.441112),
(6, 'Bar Jubera', 46.84575, -2.448877),
(7, 'Bar Soriano', 42.620051, -2.44665),
(8, 'La Mengula', 42.610212, -2.441411),
(10, 'Pulpería la Universidad', 42.46576, -2.44921),
(11, 'Bar de prueba', 2, 1),
(12, 'Bar de prueba2', 121, 123123),
(13, 'Bar Prueba 3', 123123123, 54121);

-- --------------------------------------------------------

--
-- Table structure for table `favoritos`
--

CREATE TABLE `favoritos` (
  `cod_favoritos` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `pincho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fotos_bares`
--

CREATE TABLE `fotos_bares` (
  `id` int(11) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `bar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fotos_bares`
--

INSERT INTO `fotos_bares` (`id`, `ruta`, `bar`) VALUES
(8, 'resources/img_bares/2/bar1.jpg', 2),
(13, 'resources/img_bares/3/bodeguilla-los-rotos (1).jpg', 3),
(15, 'resources/img_bares/3/los-rotos.jpg', 3),
(18, 'resources/img_bares/4/la-gota-de-vino.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `fotos_pinchos`
--

CREATE TABLE `fotos_pinchos` (
  `id` int(11) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `pincho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fotos_pinchos`
--

INSERT INTO `fotos_pinchos` (`id`, `ruta`, `pincho`) VALUES
(10, 'resources/img_pinchos/2/tioagus5.jpg', 2),
(15, 'resources/img_pinchos/7/fondo2.jpg', 7),
(17, 'resources/img_pinchos/2/tioagus1.jpg', 2),
(18, 'resources/img_pinchos/2/tioagus3.jpg', 2),
(20, 'resources/img_pinchos/8/Captura de pantalla (1).png', 8);

-- --------------------------------------------------------

--
-- Table structure for table `likes_pincho`
--

CREATE TABLE `likes_pincho` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `pincho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes_valoracion`
--

CREATE TABLE `likes_valoracion` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `valoracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pinchos`
--

CREATE TABLE `pinchos` (
  `cod_pincho` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `bar` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinchos`
--

INSERT INTO `pinchos` (`cod_pincho`, `nombre`, `descripcion`, `bar`, `precio`) VALUES
(2, 'Tío Agus', 'Cerdo adobado con salsa secreta de la abuela Damiana', 2, 1.6),
(3, 'Zorropito', 'Bacon o lomo sobre un bollo caliente con una suave salsa ali-oli a la que añadimos jamon york', 4, 2.1),
(4, 'Champis', 'Tres champis a la plancha con salsa secreta sobre una rodaja de pan y gamba', 7, 1.5),
(5, 'Zapatilla de jamón', 'Jamón serrano sobre pan tostado con tomate', 8, 2.2),
(6, 'Rotos de gulas', 'Huevos rotos sobre un bollo de pan tierno con patatas y gulas', 3, 2.5),
(7, 'Pincho prueba', 'Esto es una prueba', 2, 1.2),
(8, 'Pincho pruebaaa', 'Delicioso', 2, 1.4);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contrasena`, `admin`, `nombre`) VALUES
('admin', 'admin', 1, 'Administrador'),
('fran@gmail.com', '1234', 1, 'Fran Acha'),
('gari@gmail.com', '1234', 0, 'Gari Acha'),
('invitado', '1234', 0, 'Invitado'),
('sarah@gmail.com', '1234', 1, 'Sarah Serrano'),
('sergio@gmail.com', '1234', 0, 'Sergio Quiñones');

-- --------------------------------------------------------

--
-- Table structure for table `valoraciones`
--

CREATE TABLE `valoraciones` (
  `cod_valoracion` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `pincho` int(11) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `valoraciones`
--

INSERT INTO `valoraciones` (`cod_valoracion`, `usuario`, `pincho`, `comentario`, `likes`) VALUES
(1, 'sarah@gmail.com', 2, 'Estaba muy rico', 2),
(2, 'fran@gmail.com', 2, 'La salsa era increíble!', 5),
(3, 'sarah@gmail.com', 3, 'Un poco soso', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bares`
--
ALTER TABLE `bares`
  ADD PRIMARY KEY (`cod_bar`);

--
-- Indexes for table `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`cod_favoritos`),
  ADD KEY `pincho` (`pincho`),
  ADD KEY `usuario` (`usuario`);

--
-- Indexes for table `fotos_bares`
--
ALTER TABLE `fotos_bares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruta` (`ruta`),
  ADD KEY `bar` (`bar`);

--
-- Indexes for table `fotos_pinchos`
--
ALTER TABLE `fotos_pinchos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruta` (`ruta`),
  ADD KEY `pincho` (`pincho`);

--
-- Indexes for table `likes_pincho`
--
ALTER TABLE `likes_pincho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `pincho` (`pincho`);

--
-- Indexes for table `likes_valoracion`
--
ALTER TABLE `likes_valoracion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `valoracion` (`valoracion`);

--
-- Indexes for table `pinchos`
--
ALTER TABLE `pinchos`
  ADD PRIMARY KEY (`cod_pincho`),
  ADD KEY `bar` (`bar`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- Indexes for table `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`cod_valoracion`),
  ADD KEY `pincho` (`pincho`),
  ADD KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bares`
--
ALTER TABLE `bares`
  MODIFY `cod_bar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `cod_favoritos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fotos_bares`
--
ALTER TABLE `fotos_bares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `fotos_pinchos`
--
ALTER TABLE `fotos_pinchos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `likes_pincho`
--
ALTER TABLE `likes_pincho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes_valoracion`
--
ALTER TABLE `likes_valoracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinchos`
--
ALTER TABLE `pinchos`
  MODIFY `cod_pincho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `cod_valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`pincho`) REFERENCES `pinchos` (`cod_pincho`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE;

--
-- Constraints for table `fotos_bares`
--
ALTER TABLE `fotos_bares`
  ADD CONSTRAINT `fotos_bares_ibfk_1` FOREIGN KEY (`bar`) REFERENCES `bares` (`cod_bar`) ON DELETE CASCADE;

--
-- Constraints for table `fotos_pinchos`
--
ALTER TABLE `fotos_pinchos`
  ADD CONSTRAINT `fotos_pinchos_ibfk_1` FOREIGN KEY (`pincho`) REFERENCES `pinchos` (`cod_pincho`) ON DELETE CASCADE;

--
-- Constraints for table `likes_pincho`
--
ALTER TABLE `likes_pincho`
  ADD CONSTRAINT `likes_pincho_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_pincho_ibfk_2` FOREIGN KEY (`pincho`) REFERENCES `pinchos` (`cod_pincho`) ON DELETE CASCADE;

--
-- Constraints for table `likes_valoracion`
--
ALTER TABLE `likes_valoracion`
  ADD CONSTRAINT `likes_valoracion_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_valoracion_ibfk_2` FOREIGN KEY (`valoracion`) REFERENCES `valoraciones` (`cod_valoracion`) ON DELETE CASCADE;

--
-- Constraints for table `pinchos`
--
ALTER TABLE `pinchos`
  ADD CONSTRAINT `pinchos_ibfk_1` FOREIGN KEY (`bar`) REFERENCES `bares` (`cod_bar`) ON DELETE CASCADE;

--
-- Constraints for table `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`pincho`) REFERENCES `pinchos` (`cod_pincho`) ON DELETE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
