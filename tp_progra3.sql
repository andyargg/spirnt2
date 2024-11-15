-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2024 a las 14:38:15
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
-- Base de datos: `tp_progra3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `codigoMesa` varchar(255) DEFAULT NULL,
  `capacidad` int(11) NOT NULL,
  `estado` enum('con cliente esperando pedido','con cliente comiendo','con cliente pagando','cerrada') NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `codigoMesa`, `capacidad`, `estado`, `fecha_creacion`) VALUES
(1, '3', 3, 'cerrada', '2024-11-06 03:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `mesaId` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','completado','cancelado') DEFAULT 'pendiente',
  `horaInicio` datetime DEFAULT NULL,
  `horaFinalizacion` datetime DEFAULT NULL,
  `importe` decimal(10,2) DEFAULT 0.00,
  `codigoPedido` int(11) DEFAULT NULL,
  `nombreCliente` varchar(20) DEFAULT NULL,
  `productoId` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `sector` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `mesaId`, `fecha_pedido`, `estado`, `horaInicio`, `horaFinalizacion`, `importe`, `codigoPedido`, `nombreCliente`, `productoId`, `cantidad`, `sector`) VALUES
(15, 1, '2024-11-14 19:38:48', 'completado', '2024-11-14 20:38:48', '2024-11-14 21:39:02', 250.00, 231231, 'Juan', 1, 2, 'cocina'),
(17, 1, '2024-11-14 19:39:02', 'pendiente', '2024-11-14 20:39:02', NULL, 250.00, 231231, 'Juan', 2, 2, 'cocina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` enum('bebida','comida') NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `disponible` tinyint(1) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `cantidadVendida` int(11) DEFAULT 0,
  `sector` enum('barra','cocina','candy_bar') NOT NULL,
  `tiempo_preparacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `tipo`, `precio`, `disponible`, `fecha_creacion`, `cantidadVendida`, `sector`, `tiempo_preparacion`) VALUES
(1, 'andres', 'comida', 400.00, 1, '2024-11-06 14:51:53', 0, '', 0),
(2, 'lechuga', 'comida', 150.00, 1, '2024-11-13 01:05:59', 0, 'cocina', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` enum('mozo','bartender','socio','cocinero','cervecero') NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_baja` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `rol`, `fecha_creacion`, `fecha_baja`) VALUES
(1, 'franco', 'Hsu23sDsjseWs', 'mozo', '2024-11-06 13:54:10', NULL),
(2, 'pedro', 'dasdqsdw2sd23', 'mozo', '2024-11-06 13:54:10', '2024-11-13 03:00:00'),
(3, 'jorge', 'sda2s2f332f2', 'mozo', '2024-11-06 13:54:10', '2024-11-13 03:00:00'),
(16, 'aeasa', '$2y$10$WJTLTn7u0MsTjkpYiW.KY.TxSh1o3lETB7bnw.B/4Ns6kmMUeomUW', 'socio', '2024-11-12 22:32:43', '2024-11-13 03:00:00'),
(18, 'yooo321', '$2y$10$GQTTnN2w8YEZtZGGETZKs.2rUsvJvftShAF9/AeJpdzkDsWDYtu1K', 'socio', '2024-11-12 22:48:57', NULL),
(19, 'Duko', '$2y$10$5t7g6xgFl2seJeGEWSDb7.3alPnydDoonosyQO3uKnC0Ets7QdvBW', 'bartender', '2024-11-12 23:44:01', NULL),
(21, 'Akon', '$2y$10$UXn5EvGuMnJNWLR/1ZdGIe4jY0W45f/p7G7u54Lw4Sf1ecY5PDZPS', 'mozo', '2024-11-13 00:31:52', NULL),
(22, 'Pablo', '$2y$10$Ogsz8Px28GXyQY3W7uOdrOUXHMYg/ylMb4xJlzN77JiKZEhS.dQEC', 'bartender', '2024-11-14 18:58:15', NULL),
(23, 'sergio', '$2y$10$fJOu3cMl7HlSi7kq3hxYYOkzc5vwlF2UDVTrmwcozVA8kmXu11QeS', 'mozo', '2024-11-14 18:58:22', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mesa_id` (`mesaId`),
  ADD KEY `fk_producto` (`productoId`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`productoId`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`mesaId`) REFERENCES `mesas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
