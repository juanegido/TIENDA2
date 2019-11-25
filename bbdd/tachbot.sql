-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2019 a las 00:13:45
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tachbot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `nombre` varchar(15) NOT NULL,
  `ciudad` varchar(12) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `correo` varchar(20) DEFAULT NULL,
  `contrasena` varchar(100) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `administrador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`nombre`, `ciudad`, `telefono`, `correo`, `contrasena`, `id_cliente`, `administrador`) VALUES
('', '', 0, 'paloma@gmail.com', '$2y$10$9nF1PXH9T/7ECebeaAKpruUhbXxt6C3WwVWoqvZKvM4aItiLSx/5e', 1, 1),
('', '', 0, 'pepe@gmail.com', '$2y$10$2LVmQLvNmFN6R2fhX.b4UeQAgJeYghYQqRoRXGUkL1qA9a95HrqfK', 9, 0),
('', '', 0, 'antonio@gmail.com', '$2y$10$kDlHSlgCPm7bN7.xvbDiUOhfRDJDJlVbGZWL1oScpt1IOBgCOPvja', 10, 0),
('', '', 0, 'prueba@gmail.com', '$2y$10$oUyvfFf.LNwdLlIo5WBlF.ngqnbTR6UVFOVwI9UbhNO/baItwEaBq', 11, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_serv` int(11) NOT NULL,
  `precioUnitario` decimal(20,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descargado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`id_detalle`, `id_pedido`, `id_serv`, `precioUnitario`, `cantidad`, `descargado`) VALUES
(5, 3, 3, '35.00', 1, 0),
(9, 5, 2, '30.00', 1, 0),
(12, 1, 4, '35.00', 1, 0),
(13, 2, 3, '35.00', 1, 0),
(14, 3, 3, '35.00', 1, 0),
(15, 3, 2, '30.00', 1, 0),
(16, 4, 1, '25.00', 1, 0),
(17, 4, 3, '35.00', 1, 0),
(18, 5, 1, '25.00', 1, 0),
(19, 5, 3, '35.00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidad`
--

CREATE TABLE `habilidad` (
  `id_habilidad` int(9) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `habilidad`
--

INSERT INTO `habilidad` (`id_habilidad`, `nombre`, `precio`, `descripcion`) VALUES
(1, 'ingles', 20, 'Chatbot con habilidad para traducir cualquier palabra/frase a inglés.'),
(2, 'Alarma', 50, 'Chatbot con habilidades para crear y gestionar alarmas. '),
(3, 'calculos', 40, 'Chatbot con habilidad para realizar cualquier cálculo matemático.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidad_pedido`
--

CREATE TABLE `habilidad_pedido` (
  `id_hab` int(11) NOT NULL,
  `id_ped` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `habilidad_pedido`
--

INSERT INTO `habilidad_pedido` (`id_hab`, `id_ped`) VALUES
(1, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_cli` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fecha_expiracion` date NOT NULL,
  `precio_total` int(11) DEFAULT NULL,
  `id_pedido` int(9) NOT NULL,
  `reclamacion` tinyint(1) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_cli`, `fecha_pedido`, `fecha_expiracion`, `precio_total`, `id_pedido`, `reclamacion`, `correo`) VALUES
(1, '2019-11-24', '2019-11-24', 35, 1, 0, 'aa@aa'),
(9, '2019-11-25', '2019-11-25', 35, 2, 0, 'ejempo@gmail.com'),
(9, '2019-11-25', '2019-11-25', 65, 3, 0, 'ejempo@gmail.com'),
(9, '2019-11-25', '2019-11-25', 60, 4, 0, 'p@p'),
(9, '2019-11-25', '2019-11-25', 60, 5, 0, 'deleteBueno@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `nombre` varchar(15) NOT NULL,
  `id_servicio` int(9) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`nombre`, `id_servicio`, `precio`, `descripcion`, `imagen`) VALUES
('CBmayor', 1, 25, 'Chatbot destinado a personas mayores', 'mayorBot.jpg'),
('CBjoven', 2, 30, 'Chatbot destinado a un público joven', 'huevo.jpg'),
('CBgeneral', 3, 35, 'Chatbot destinado a un público general', 'traductorBot.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_habilidad`
--

CREATE TABLE `servicio_habilidad` (
  `id_ser` int(11) NOT NULL,
  `id_hab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio_habilidad`
--

INSERT INTO `servicio_habilidad` (`id_ser`, `id_hab`) VALUES
(1, 2),
(3, 3),
(2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `correo_2` (`correo`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_serv` (`id_serv`);

--
-- Indices de la tabla `habilidad`
--
ALTER TABLE `habilidad`
  ADD PRIMARY KEY (`id_habilidad`);

--
-- Indices de la tabla `habilidad_pedido`
--
ALTER TABLE `habilidad_pedido`
  ADD KEY `id_hab` (`id_hab`),
  ADD KEY `id_ped` (`id_ped`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cli` (`id_cli`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `servicio_habilidad`
--
ALTER TABLE `servicio_habilidad`
  ADD KEY `id_ser` (`id_ser`),
  ADD KEY `id_hab` (`id_hab`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `habilidad`
--
ALTER TABLE `habilidad`
  MODIFY `id_habilidad` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`id_serv`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `habilidad_pedido`
--
ALTER TABLE `habilidad_pedido`
  ADD CONSTRAINT `habilidad_pedido_ibfk_1` FOREIGN KEY (`id_hab`) REFERENCES `habilidad` (`id_habilidad`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cli`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `servicio_habilidad`
--
ALTER TABLE `servicio_habilidad`
  ADD CONSTRAINT `servicio_habilidad_ibfk_1` FOREIGN KEY (`id_ser`) REFERENCES `servicio` (`id_servicio`),
  ADD CONSTRAINT `servicio_habilidad_ibfk_2` FOREIGN KEY (`id_hab`) REFERENCES `habilidad` (`id_habilidad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
