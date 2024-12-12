-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2024 a las 03:04:47
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
-- Base de datos: `roomify`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancelaciones`
--

CREATE TABLE `cancelaciones` (
  `id_cancelacion` int(11) NOT NULL,
  `reserva_id` int(11) DEFAULT NULL,
  `fecha_cancelacion` date DEFAULT NULL,
  `motivo_cancelacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cancelaciones`
--

INSERT INTO `cancelaciones` (`id_cancelacion`, `reserva_id`, `fecha_cancelacion`, `motivo_cancelacion`) VALUES
(1, 2, '2024-10-07', 'Cambio de planes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `email_cliente` varchar(100) DEFAULT NULL,
  `contrasena_cliente` varchar(200) DEFAULT NULL,
  `telefono_cliente` varchar(15) DEFAULT NULL,
  `direccion_cliente` varchar(100) DEFAULT NULL,
  `fecha_nacimiento_cliente` date DEFAULT NULL,
  `fecha_registro_cliente` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `email_cliente`, `contrasena_cliente`, `telefono_cliente`, `direccion_cliente`, `fecha_nacimiento_cliente`, `fecha_registro_cliente`) VALUES
(1, 'Juan Perez', 'juan.perez@example.com', '1234567', '3108990802', 'Calle 123 #45-67', '1990-01-27', '2024-10-30'),
(2, 'Maria Lopez', 'maria.lopez@example.com', '7654321', '3012345678', 'Avenida 456 #78-90', '1985-05-05', '2024-10-04'),
(4, 'Johan', 'johannuseche2020@gmail.com', NULL, '3108990802', 'Kr 81A #57-28 norte', '2024-11-30', '2024-11-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL,
  `tipo_habitacion_id` int(11) DEFAULT NULL,
  `numero_habitacion` varchar(100) DEFAULT NULL,
  `detalle_habitacion` varchar(100) DEFAULT NULL,
  `disponibilidad_habitacion` enum('disponible','reservada','limpieza') DEFAULT NULL,
  `capacidad_habitacion` int(11) DEFAULT NULL,
  `costo_habitacion` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `tipo_habitacion_id`, `numero_habitacion`, `detalle_habitacion`, `disponibilidad_habitacion`, `capacidad_habitacion`, `costo_habitacion`) VALUES
(3, 3, '201', 'Suite de lujo', 'limpieza', 3, 300.00),
(11, 2, '93631', 'Descripcion de la habitacion #41', '', 31, 100973.00),
(27, 2, '123451', 'Descripcion de la habitacion #123451', '', 311, 50000.00),
(33, 3, '87', 'Descripcion de la habitacion #87', '', 2, 587.00),
(53, 3, '1231', 'Descripcion de la habitacion #123', 'disponible', 2, 100.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id_metodo_pago` int(11) NOT NULL,
  `tipo_pago` varchar(50) DEFAULT NULL,
  `descripcion_pago` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`id_metodo_pago`, `tipo_pago`, `descripcion_pago`) VALUES
(1, 'Tarjeta de Crédito', NULL),
(2, 'Efectivo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id_promocion` int(11) NOT NULL,
  `tp_id` int(11) DEFAULT NULL,
  `nombre_promocion` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `fecha_incio_promocion` date DEFAULT NULL,
  `fecha_fin_promocion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id_promocion`, `tp_id`, `nombre_promocion`, `descripcion`, `descuento`, `fecha_incio_promocion`, `fecha_fin_promocion`) VALUES
(2, 3, 'Fin de Año', 'Descuento especial en suite', 0.2, '2024-12-01', '2024-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resena`
--

CREATE TABLE `resena` (
  `id_reseña` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `reserva_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resena`
--

INSERT INTO `resena` (`id_reseña`, `cliente_id`, `reserva_id`, `fecha`, `calificacion`, `descripcion`) VALUES
(1, 1, 1, '2024-10-12', 5, 'Excelente servicio y comodidad'),
(2, 2, 2, '2024-10-18', 4, 'Muy buena experiencia, pero el check-in fue lento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `fecha_reserva` date DEFAULT NULL,
  `estado_reserva` enum('pendiente','confirmada','cancelada') DEFAULT NULL,
  `descripcion_reserva` varchar(200) DEFAULT NULL,
  `check_in_reserva` datetime DEFAULT NULL,
  `check_out_reserva` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `cliente_id`, `fecha_reserva`, `estado_reserva`, `descripcion_reserva`, `check_in_reserva`, `check_out_reserva`) VALUES
(1, 1, '2024-10-05', 'confirmada', 'Reserva de habitación sencilla', '2024-10-10 14:00:00', '2024-10-12 11:00:00'),
(2, 2, '2024-10-06', 'pendiente', 'Reserva de habitación doble', '2024-10-15 15:00:00', '2024-10-18 10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_habitacion`
--

CREATE TABLE `reserva_habitacion` (
  `id_reserva_habitacion` int(11) NOT NULL,
  `reserva_id` int(11) DEFAULT NULL,
  `habitacion_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'Administrador', 'Acceso completo al sistema'),
(2, 'Recepcionista', 'Gestiona reservas y clientes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_adicionales`
--

CREATE TABLE `servicios_adicionales` (
  `id_servicio_adicional` int(11) NOT NULL,
  `descripcion_servicio` varchar(100) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios_adicionales`
--

INSERT INTO `servicios_adicionales` (`id_servicio_adicional`, `descripcion_servicio`, `costo`, `nombre`) VALUES
(1, 'postre', 30.00, 'postre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_habitacion`
--

CREATE TABLE `tipos_habitacion` (
  `id_tipo_habitacion` int(11) NOT NULL,
  `tipo_habitacion` varchar(50) DEFAULT NULL,
  `num_camas` int(11) DEFAULT NULL,
  `descripcion_tipo_habitacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_habitacion`
--

INSERT INTO `tipos_habitacion` (`id_tipo_habitacion`, `tipo_habitacion`, `num_camas`, `descripcion_tipo_habitacion`) VALUES
(2, 'Doble', 7, 'Habitación con una cama doble'),
(3, 'Suite', 3, 'Habitación con cama doble y sala de estar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id_pago` int(11) NOT NULL,
  `metodo_pago_id` int(11) DEFAULT NULL,
  `reserva_id` int(11) DEFAULT NULL,
  `fecha_hora_pago` datetime DEFAULT NULL,
  `estado_pago` enum('confirmado','cancelado') DEFAULT NULL,
  `costo_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `email_usuario` varchar(50) DEFAULT NULL,
  `contrasena_usuario` varchar(200) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `fecha_creacion_usuario` date DEFAULT NULL,
  `estado_usuario` enum('activo','inactivo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `email_usuario`, `contrasena_usuario`, `rol_id`, `fecha_creacion_usuario`, `estado_usuario`) VALUES
(1, 'admin', 'admin@example.com', 'hashed_password_1', 1, '2024-10-01', 'activo'),
(2, 'reception', 'reception@example.com', 'hashed_password_2', 2, '2024-10-02', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancelaciones`
--
ALTER TABLE `cancelaciones`
  ADD PRIMARY KEY (`id_cancelacion`),
  ADD KEY `reserva_id` (`reserva_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_habitacion`),
  ADD KEY `tipo_habitacion_id` (`tipo_habitacion_id`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id_metodo_pago`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id_promocion`),
  ADD KEY `tp_id` (`tp_id`);

--
-- Indices de la tabla `resena`
--
ALTER TABLE `resena`
  ADD PRIMARY KEY (`id_reseña`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `reserva_id` (`reserva_id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `reserva_habitacion`
--
ALTER TABLE `reserva_habitacion`
  ADD PRIMARY KEY (`id_reserva_habitacion`),
  ADD KEY `reserva_id` (`reserva_id`),
  ADD KEY `habitacion_id` (`habitacion_id`),
  ADD KEY `servicio_id` (`servicio_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `servicios_adicionales`
--
ALTER TABLE `servicios_adicionales`
  ADD PRIMARY KEY (`id_servicio_adicional`);

--
-- Indices de la tabla `tipos_habitacion`
--
ALTER TABLE `tipos_habitacion`
  ADD PRIMARY KEY (`id_tipo_habitacion`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `metodo_pago_id` (`metodo_pago_id`),
  ADD KEY `reserva_id` (`reserva_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_metodo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicios_adicionales`
--
ALTER TABLE `servicios_adicionales`
  MODIFY `id_servicio_adicional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cancelaciones`
--
ALTER TABLE `cancelaciones`
  ADD CONSTRAINT `cancelaciones_ibfk_1` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id_reserva`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`tipo_habitacion_id`) REFERENCES `tipos_habitacion` (`id_tipo_habitacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`tp_id`) REFERENCES `tipos_habitacion` (`id_tipo_habitacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `resena`
--
ALTER TABLE `resena`
  ADD CONSTRAINT `resena_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resena_ibfk_2` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id_reserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva_habitacion`
--
ALTER TABLE `reserva_habitacion`
  ADD CONSTRAINT `reserva_habitacion_ibfk_1` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id_reserva`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_habitacion_ibfk_2` FOREIGN KEY (`habitacion_id`) REFERENCES `habitaciones` (`id_habitacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_habitacion_ibfk_3` FOREIGN KEY (`servicio_id`) REFERENCES `servicios_adicionales` (`id_servicio_adicional`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodo_pago` (`id_metodo_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transacciones_ibfk_2` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id_reserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
