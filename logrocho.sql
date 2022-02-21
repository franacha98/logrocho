-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2022 a las 20:03:34
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `logrocho`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bares`
--

CREATE TABLE `bares` (
  `cod_bar` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bares`
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
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `cod_favoritos` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `pincho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_bares`
--

CREATE TABLE `fotos_bares` (
  `id` int(11) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `bar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fotos_bares`
--

INSERT INTO `fotos_bares` (`id`, `ruta`, `bar`) VALUES
(8, 'resources/img_bares/2/bar1.jpg', 2),
(13, 'resources/img_bares/3/bodeguilla-los-rotos (1).jpg', 3),
(15, 'resources/img_bares/3/los-rotos.jpg', 3),
(18, 'resources/img_bares/4/la-gota-de-vino.jpg', 4),
(24, 'resources/img_bares/2/fachada-tio-agus.jpg', 2),
(25, 'resources/img_bares/7/fondo2.jpg', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_pinchos`
--

CREATE TABLE `fotos_pinchos` (
  `id` int(11) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `pincho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fotos_pinchos`
--

INSERT INTO `fotos_pinchos` (`id`, `ruta`, `pincho`) VALUES
(10, 'resources/img_pinchos/2/tioagus5.jpg', 2),
(15, 'resources/img_pinchos/7/fondo2.jpg', 7),
(17, 'resources/img_pinchos/2/tioagus1.jpg', 2),
(18, 'resources/img_pinchos/2/tioagus3.jpg', 2),
(20, 'resources/img_pinchos/8/Captura de pantalla (1).png', 8),
(21, 'resources/img_pinchos/3/zorropito-gota-de-vino.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes_pincho`
--

CREATE TABLE `likes_pincho` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `pincho` int(11) NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `likes_pincho`
--

INSERT INTO `likes_pincho` (`id`, `usuario`, `pincho`, `nota`) VALUES
(1, 'gari@gmail.com', 2, 4),
(2, 'fran@gmail.com', 2, 5),
(3, 'sergio@gmail.com', 7, 1),
(4, 'fran@gmail.com', 6, 4),
(5, 'sarah@gmail.com', 2, 5),
(6, 'sarah@gmail.com', 3, 5),
(7, 'invitado', 2, 3),
(8, 'invitado', 4, 1),
(9, 'invitado', 6, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes_valoracion`
--

CREATE TABLE `likes_valoracion` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `valoracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pinchos`
--

CREATE TABLE `pinchos` (
  `cod_pincho` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `bar` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pinchos`
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
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contrasena`, `admin`, `nombre`) VALUES
('admin', 'admin', 1, 'Administrador'),
('fran@gmail.com', '1234', 1, 'Fran Acha'),
('gari@gmail.com', '1234', 0, 'Gari Acha'),
('hola@gmail.com', '1234', 0, 'Pimiento Amarillo'),
('invitado', '1234', 0, 'Invitado'),
('noro@gmail.com', '1234', 0, 'Fran Noro'),
('oscar@gmail.com', '1234', 0, 'Oscar'),
('pepito', '1234', 0, 'Pepito Grillo'),
('sarah@gmail.com', '1234', 1, 'Sarah Serrano'),
('sergio@gmail.com', '1234', 0, 'Sergio Quiñones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `cod_valoracion` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `pincho` int(11) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`cod_valoracion`, `usuario`, `pincho`, `comentario`, `likes`) VALUES
(1, 'sarah@gmail.com', 2, 'Estaba muy rico', 2),
(2, 'fran@gmail.com', 2, 'La salsa era increíble!', 5),
(3, 'sarah@gmail.com', 3, 'Un poco soso', 13),
(5, 'invitado', 2, 'Increible su sabor', 0),
(6, 'invitado', 4, 'De locos', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bares`
--
ALTER TABLE `bares`
  ADD PRIMARY KEY (`cod_bar`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`cod_favoritos`),
  ADD KEY `pincho` (`pincho`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `fotos_bares`
--
ALTER TABLE `fotos_bares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruta` (`ruta`),
  ADD KEY `bar` (`bar`);

--
-- Indices de la tabla `fotos_pinchos`
--
ALTER TABLE `fotos_pinchos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruta` (`ruta`),
  ADD KEY `pincho` (`pincho`);

--
-- Indices de la tabla `likes_pincho`
--
ALTER TABLE `likes_pincho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `pincho` (`pincho`);

--
-- Indices de la tabla `likes_valoracion`
--
ALTER TABLE `likes_valoracion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `valoracion` (`valoracion`);

--
-- Indices de la tabla `pinchos`
--
ALTER TABLE `pinchos`
  ADD PRIMARY KEY (`cod_pincho`),
  ADD KEY `bar` (`bar`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`cod_valoracion`),
  ADD KEY `pincho` (`pincho`),
  ADD KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bares`
--
ALTER TABLE `bares`
  MODIFY `cod_bar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `cod_favoritos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos_bares`
--
ALTER TABLE `fotos_bares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `fotos_pinchos`
--
ALTER TABLE `fotos_pinchos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `likes_pincho`
--
ALTER TABLE `likes_pincho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `likes_valoracion`
--
ALTER TABLE `likes_valoracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pinchos`
--
ALTER TABLE `pinchos`
  MODIFY `cod_pincho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `cod_valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`pincho`) REFERENCES `pinchos` (`cod_pincho`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `fotos_bares`
--
ALTER TABLE `fotos_bares`
  ADD CONSTRAINT `fotos_bares_ibfk_1` FOREIGN KEY (`bar`) REFERENCES `bares` (`cod_bar`) ON DELETE CASCADE;

--
-- Filtros para la tabla `fotos_pinchos`
--
ALTER TABLE `fotos_pinchos`
  ADD CONSTRAINT `fotos_pinchos_ibfk_1` FOREIGN KEY (`pincho`) REFERENCES `pinchos` (`cod_pincho`) ON DELETE CASCADE;

--
-- Filtros para la tabla `likes_pincho`
--
ALTER TABLE `likes_pincho`
  ADD CONSTRAINT `likes_pincho_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_pincho_ibfk_2` FOREIGN KEY (`pincho`) REFERENCES `pinchos` (`cod_pincho`) ON DELETE CASCADE;

--
-- Filtros para la tabla `likes_valoracion`
--
ALTER TABLE `likes_valoracion`
  ADD CONSTRAINT `likes_valoracion_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_valoracion_ibfk_2` FOREIGN KEY (`valoracion`) REFERENCES `valoraciones` (`cod_valoracion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pinchos`
--
ALTER TABLE `pinchos`
  ADD CONSTRAINT `pinchos_ibfk_1` FOREIGN KEY (`bar`) REFERENCES `bares` (`cod_bar`) ON DELETE CASCADE;

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`pincho`) REFERENCES `pinchos` (`cod_pincho`) ON DELETE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
