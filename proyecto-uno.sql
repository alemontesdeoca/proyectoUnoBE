-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2021 a las 19:52:22
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto-uno`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `crear_Encuesta` (IN `usuario` INT, IN `producto` INT, OUT `esta_encuesta` INT)  begin 
    	if(usuario is not null and producto is not null) then 
        	insert into encuesta_cabecera(id_producto,id_usuario,fecha)
            values (producto,usuario,now());
            select max(id_encuesta_cabecera) into esta_encuesta from encuesta_cabecera where id_usuario = usuario;
        else 
        	ROLLBACK;
            set esta_encuesta = 0;
        end if;
    end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_cabecera`
--

CREATE TABLE `encuesta_cabecera` (
  `id_encuesta_cabecera` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encuesta_cabecera`
--

INSERT INTO `encuesta_cabecera` (`id_encuesta_cabecera`, `id_usuario`, `fecha`, `id_producto`, `id_estado`, `puntuacion`) VALUES
(4, 5, NULL, 1, 2, 25),
(5, 5, NULL, 2, 4, 25),
(6, 5, NULL, 3, 2, 100),
(7, 5, NULL, 4, 2, 50),
(8, 5, NULL, 5, 2, 100),
(9, 5, NULL, 6, 2, 25),
(10, 5, NULL, 7, 2, 100),
(11, 5, NULL, 8, 2, 25),
(12, 5, NULL, 9, 2, 50),
(13, 5, NULL, 10, 2, 100),
(14, 5, NULL, 11, 2, 100),
(15, 5, NULL, 12, 2, 50),
(16, 5, NULL, 13, 2, 25),
(17, 8, NULL, 1, 2, 25),
(18, 8, NULL, 2, 4, 25),
(19, 8, NULL, 3, 2, 100),
(20, 8, NULL, 4, 2, 50),
(21, 8, NULL, 5, 4, 100),
(22, 8, NULL, 6, 2, 25),
(23, 8, NULL, 7, 2, 100),
(24, 8, NULL, 8, 2, 25),
(25, 8, NULL, 9, 2, 50),
(26, 8, NULL, 10, 2, 100),
(27, 8, NULL, 11, 2, 100),
(28, 8, NULL, 12, 2, 50),
(29, 8, NULL, 13, 2, 25),
(30, 9, NULL, 1, 2, 25),
(31, 9, NULL, 2, 2, 25),
(32, 9, NULL, 3, 2, 100),
(33, 9, NULL, 4, 2, 50),
(34, 9, NULL, 5, 2, 100),
(35, 9, NULL, 6, 2, 25),
(36, 9, NULL, 7, 2, 100),
(37, 9, NULL, 8, 2, 25),
(38, 9, NULL, 9, 2, 50),
(39, 9, NULL, 10, 2, 100),
(40, 9, NULL, 11, 2, 100),
(41, 9, NULL, 12, 2, 50),
(42, 9, NULL, 13, 2, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_detalles`
--

CREATE TABLE `encuesta_detalles` (
  `encuesta_detalles` int(11) NOT NULL,
  `id_pregunta` int(11) DEFAULT NULL,
  `id_respuesta` int(11) DEFAULT NULL,
  `id_encuesta_cabecera` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encuesta_detalles`
--

INSERT INTO `encuesta_detalles` (`encuesta_detalles`, `id_pregunta`, `id_respuesta`, `id_encuesta_cabecera`, `id_estado`) VALUES
(186, 1, 206, 5, NULL),
(187, 2, 207, 5, NULL),
(188, 3, 208, 5, NULL),
(189, 4, 209, 5, NULL),
(190, 1, 210, 18, NULL),
(191, 2, 211, 18, NULL),
(192, 3, 212, 18, NULL),
(193, 4, 213, 18, NULL),
(194, 1, 214, 20, NULL),
(195, 2, 215, 20, NULL),
(196, 3, 216, 20, NULL),
(197, 1, 217, 21, NULL),
(198, 2, 218, 21, NULL),
(199, 3, 219, 21, NULL),
(200, 4, 220, 21, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(1, 'respondida'),
(2, 'no respondida'),
(3, 'abierta'),
(4, 'cerrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre_marca`) VALUES
(1, 'arcor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(11) NOT NULL,
  `descripcion_pregunta` varchar(255) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `descripcion_pregunta`, `id_estado`) VALUES
(1, '¿Consumís habitualmente este producto?', NULL),
(2, '¿Qué es lo que más te gusta?', NULL),
(3, '¿Qué pensas sobre la calidad?', NULL),
(4, '¿Se lo recomendarías a alguien?', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `descripcion`, `imagen`, `id_marca`) VALUES
(1, 'BON O BON LECHE', 'Bon o Bon Leche (relleno con crema de mani y banhado en chocolate con leche)', 'imagenes/bonobon.png', 1),
(2, 'ARCOA', 'Alimento a base de cacao\r\n', 'imagenes/arcoa.png', 1),
(3, 'JUGO MULTIFRUTA', 'Polvo para preparar bebida analcohólica artificial dietética de bajas calorías sabor a multifruta', 'imagenes/arcorJugo.png', 1),
(4, 'MERMELADA FRUTILLA', 'Mermelada de frutilla libre de gluten.', 'imagenes/arcorMermeladaFrutilla.png', 1),
(5, 'ARVEJAS SECAS REMOJADAS', 'Arvejas secas remojadas libre de gluten', 'imagenes/arvejas.png', 1),
(6, 'ARCOR BLANCO', 'Chocolate Blanco', 'imagenes/chocolateBlanco.png', 1),
(7, 'CARAMELO MASTICABLE TUTTI FRUTTI CRAZY', 'Caramelo masticable sabor tutti frutti. Libre de gluten', 'imagenes/crazy.png', 1),
(8, 'KOPA ARCOR DULCE DE LECHE Y AMERICANA', 'Crema helada de dulce de leche y sabor Crema americana con salsa de dulce de leche', 'imagenes/kopa.png', 1),
(9, 'PALITO ARCOR CREMA AMERICANA', 'Helado de crema americana con cobertura de chocolate con leche', 'imagenes/palito.png', 1),
(10, 'OBLEAS ARCOR SABOR FRUTILLA', 'Obleas dulces con relleno sabor frutilla', 'imagenes/obleaFrutilla.png', 1),
(11, 'POSTRE HELADO TRES CREMAS', 'Crema helada de dulce de leche, chocolate y sabor vainilla', 'imagenes/tresCremas.png', 1),
(12, 'SLICE FRUTILLA CON FRUTA', 'Helado de agua de frutilla con frutilla en trozos', 'imagenes/slice.png', 1),
(13, 'TURRÓN', 'Oblea rellena con pasta de turrón y maní', 'imagenes/turronMani.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id_respuesta` int(11) NOT NULL,
  `descripcion_respuesta` varchar(255) DEFAULT NULL,
  `id_pregunta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id_respuesta`, `descripcion_respuesta`, `id_pregunta`) VALUES
(206, 'si', 1),
(207, 'su sabor', 2),
(208, 'es muy buena', 3),
(209, 'si', 4),
(210, 'si', 1),
(211, 'el precio', 2),
(212, 'media', 3),
(213, 'puede ser', 4),
(214, 'si', 1),
(215, 'El sabor', 2),
(216, 'Muy buena', 3),
(217, 'Si', 1),
(218, 'Su sabor', 2),
(219, 'Muy buena', 3),
(220, 'Si', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `alias` varchar(30) NOT NULL,
  `pass_word` varchar(255) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `usuario_activo` tinyint(4) DEFAULT 1,
  `puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `alias`, `pass_word`, `nombre`, `apellido`, `telefono`, `direccion`, `usuario_activo`, `puntos`) VALUES
(1, 'admin', '$2y$10$gf1eexrDxmz0woAjPMRgZOkZaWbYR/cKC8rTvjeQiK67W9F/jos0.', 'admin', 'admin', '123456789', 'calle123', 1, 0),
(2, 'juan', '$2y$10$58iieVpxjmicL4XSobmltOln9CLAHNOzySDHdHKck4F13uA4RWviq', 'juan ', 'juan', '1234567', 'calle 204', 0, 250),
(3, 'mario', '$2y$10$CwLYzWtlIvdxbC2tX3IzCOQh/VO/j7SZIQrPHqi3AnanOU9/sr3xe', 'mario', 'gonzales', '789456123', 'una calle', 0, 0),
(4, 'admin2', '$2y$10$N6hZsXYrEeuUFyVcsdF0KuKTKFgH2GJriCyVmFjsu3AQM2hACAZS.', 'admin', 'admin', '12124124', 'asdsa', 1, 1),
(5, 'juan-perez@gmail.com', '12345', 'Juan', 'Perez', '1200', 'Cervantez', 1, 325),
(6, 'Alexander-montes@gmail.com', '$2y$10$nO6hWtDZvR0uWWWmjrIIo.D6ToGXedBkZIEED3iYkytYjC/h0I3XO', 'asdas', 'sad', 'sad', 'asd', 1, 0),
(7, 'alex', '$2y$10$rC3QQduFr/e2KWPeA6Ftd.dmQQ.WhvfQY3E4IutAu9imwVK2Fwcea', 'alex', 'montes', '123123', 'cuenca', 1, 0),
(8, 'alex.montes@gmail.com', '12345', 'Alex', 'Montes de Oca', '11 ', 'Cervantez', 1, 225),
(9, 'ale.ramallo@gmail.com', '12345', 'alejandro', 'ramallo', '11123132', 'asda', 1, 100);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuesta_cabecera`
--
ALTER TABLE `encuesta_cabecera`
  ADD PRIMARY KEY (`id_encuesta_cabecera`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `encuesta_detalles`
--
ALTER TABLE `encuesta_detalles`
  ADD PRIMARY KEY (`encuesta_detalles`),
  ADD KEY `id_pregunta` (`id_pregunta`),
  ADD KEY `id_respuesta` (`id_respuesta`),
  ADD KEY `id_encuesta_cabecera` (`id_encuesta_cabecera`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `pregunta_ibfk_1` (`id_estado`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuesta_cabecera`
--
ALTER TABLE `encuesta_cabecera`
  MODIFY `id_encuesta_cabecera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `encuesta_detalles`
--
ALTER TABLE `encuesta_detalles`
  MODIFY `encuesta_detalles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `encuesta_cabecera`
--
ALTER TABLE `encuesta_cabecera`
  ADD CONSTRAINT `encuesta_cabecera_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `encuesta_cabecera_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `encuesta_cabecera_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `encuesta_detalles`
--
ALTER TABLE `encuesta_detalles`
  ADD CONSTRAINT `encuesta_detalles_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`),
  ADD CONSTRAINT `encuesta_detalles_ibfk_2` FOREIGN KEY (`id_respuesta`) REFERENCES `respuesta` (`id_respuesta`),
  ADD CONSTRAINT `encuesta_detalles_ibfk_3` FOREIGN KEY (`id_encuesta_cabecera`) REFERENCES `encuesta_cabecera` (`id_encuesta_cabecera`),
  ADD CONSTRAINT `encuesta_detalles_ibfk_4` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
