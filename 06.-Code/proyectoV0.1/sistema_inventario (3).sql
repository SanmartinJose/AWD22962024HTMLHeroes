-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-09-2024 a las 13:49:23
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_CLIENTE` int(11) NOT NULL,
  `NOMBRE_CLIENTE` varchar(255) NOT NULL,
  `CEDULA` varchar(13) NOT NULL,
  `TELEFONO` varchar(10) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `DIRECCION` varchar(255) NOT NULL,
  `FECHA_REGISTRO` datetime NOT NULL,
  `ESTADO` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_CLIENTE`, `NOMBRE_CLIENTE`, `CEDULA`, `TELEFONO`, `EMAIL`, `DIRECCION`, `FECHA_REGISTRO`, `ESTADO`) VALUES
(1, 'crema33', '1726338443', '0962846564', 'mssalcedo2@espe', 'El ', '0000-00-00 00:00:00', 'activo'),
(2, 'plancha', '1726338443', '0962846565', 'mssalcedo2@espe.edu.ec', 'El inca', '0000-00-00 00:00:00', 'activo'),
(3, 'crema33', '1726338443', '0962846565', 'mssalcedo2@espe.edu.ec', 'El inca', '0000-00-00 00:00:00', 'activo'),
(4, 'Juana', '4555555555', '0962846565', 'mssalcedo2@espe.edu.ec', 'El inca', '0000-00-00 00:00:00', 'activo'),
(5, 'cremaCAMI', '1726338443', '0962846565', 'mssalcedo2@espe.edu.ec', 'El inca', '0000-00-00 00:00:00', 'activo'),
(6, 'plancha', '1726338443', '0962846565', 'mssalcedo2@espe.edu.ec', 'El inca', '0000-00-00 00:00:00', 'activo'),
(7, 'crema', '1726338443', '0962846565', 'mssalcedo2@espe.edu.ec', 'El inca', '0000-00-00 00:00:00', 'activo'),
(8, 'micaela', '1726338443', '0962846565', 'mssalcedo2@espe.edu.ec', 'El inca', '0000-00-00 00:00:00', 'activo'),
(9, 'crema', '1726338443', '0962846565', 'mssalcedo2@espe.edu.ec', 'El inca', '0000-00-00 00:00:00', 'activo'),
(10, 'Micaela Salcedo', '0802518894', '0962846565', 'mssalcedo2@espe.edu.ec', 'El inca', '0000-00-00 00:00:00', 'inactivo'),
(11, 'crema', '1707583108', '0962846565', 'mssalcedo2@espe.edu.ec', 'El inca', '0000-00-00 00:00:00', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crear_categoria`
--

CREATE TABLE `crear_categoria` (
  `id_categoria` int(4) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `crear_categoria`
--
DELIMITER $$
CREATE TRIGGER `after_category_insert` AFTER INSERT ON `crear_categoria` FOR EACH ROW BEGIN
    -- Suponiendo que quieres insertar o actualizar con un ID_USUARIO predeterminado
    INSERT INTO inventario (id_usuario, fecha, id_categoria)
    VALUES (1, NOW(), NEW.id_categoria);
    -- Aquí se inserta un nuevo registro en la tabla inventario con un ID_USUARIO predeterminado
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta`
--

CREATE TABLE `detalles_venta` (
  `id_detalles` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `ID_FACTURA` int(11) NOT NULL,
  `CODIGO_PRODUCTO` varchar(5) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `PRECIO_UNITARIO` float NOT NULL,
  `subtotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalles_venta`
--

INSERT INTO `detalles_venta` (`id_detalles`, `ID_PRODUCTO`, `ID_FACTURA`, `CODIGO_PRODUCTO`, `CANTIDAD`, `PRECIO_UNITARIO`, `subtotal`) VALUES
(1, 4, 1, '4', 5, 45, '225');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `ID_FACTURA` int(11) NOT NULL,
  `ID_CLIENTE` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `NUMERO_FACTURA` varchar(100) NOT NULL,
  `FECHA_EMISION` datetime NOT NULL,
  `MONTO_TOTAL` double NOT NULL,
  `ESTADO_PAGO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`ID_FACTURA`, `ID_CLIENTE`, `id_venta`, `NUMERO_FACTURA`, `FECHA_EMISION`, `MONTO_TOTAL`, `ESTADO_PAGO`) VALUES
(1, 10, 0, 'FAC-66d5b416405b4', '2024-09-02 07:48:22', 225, 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `ID_INVENTARIO` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `FECHA` datetime NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`ID_INVENTARIO`, `ID_USUARIO`, `FECHA`, `ID_PRODUCTO`) VALUES
(1, 1, '2024-09-01 13:15:19', 10),
(2, 1, '2024-09-01 13:20:23', 11),
(3, 1, '2024-09-01 13:59:23', 12),
(4, 1, '2024-09-01 14:20:23', 13),
(5, 1, '2024-09-01 14:23:15', 14),
(6, 1, '2024-09-01 14:25:14', 15),
(7, 1, '2024-09-01 14:31:05', 16),
(8, 1, '2024-09-01 16:11:35', 17),
(9, 1, '2024-09-01 16:39:26', 18),
(10, 1, '2024-09-01 16:45:24', 19),
(11, 1, '2024-09-01 17:47:12', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `ID_PAGO` int(11) NOT NULL,
  `ID_FACTURA` int(11) NOT NULL,
  `MONTO` decimal(10,0) NOT NULL,
  `FECHA_PAGO` datetime NOT NULL,
  `METODO_PAGO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `precio_unitario` double NOT NULL,
  `categoria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `producto_iva_rise` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `valor_iva_risa` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `precio_unitario`, `categoria`, `stock`, `estado`, `producto_iva_rise`, `valor_iva_risa`) VALUES
(1, 'crema', 'azul', 45, 'cuidaoP', 7, 'activo', 'sinImpuesto', '0'),
(2, 'LABIAL', 'rojo', 45, 'maquillaje', 30, 'activo', 'sinImpuesto', '0'),
(3, 'Jabon', 'rosas', 3, 'cuidaoP', 3, 'activo', 'iva', '3'),
(4, 'crema33', 'kkjk', 45, 'cuidadoC', 7, 'activo', 'rise', '5'),
(5, 'crema33', 'dasda', 45, 'cuidaoP', 7, 'inactivo', 'sinImpuesto', '0');

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `after_product_insert` AFTER INSERT ON `productos` FOR EACH ROW BEGIN
    INSERT INTO inventario (ID_USUARIO, FECHA, ID_PRODUCTO)
    VALUES (1, NOW(), NEW.id_producto); -- Reemplaza 1 con el ID de usuario predeterminado
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID_ROL` int(11) NOT NULL,
  `NOMBRE_ROL` varchar(60) DEFAULT NULL,
  `ACCESOS` varchar(250) NOT NULL,
  `DESCRIPCION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID_ROL`, `NOMBRE_ROL`, `ACCESOS`, `DESCRIPCION`) VALUES
(1, 'Administrador', 'reportes,inventario,ventas,usuarios,clientes', 'ACceso a todo'),
(2, 'Vendedor', 'reportes, inventario, ventas, usuarios, clientes', 'Acceso a todo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `cedula` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwordLogin` varbinary(255) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `cedula`, `email`, `username`, `passwordLogin`, `telefono`, `direccion`, `id_rol`, `fecha_creacion`, `estado`) VALUES
(1, 'Josue', 'Guallichico', 1754143707, 'josueloy12@gmail.com', 'josuexda', 0x31323334, '0992622594', 'Amaguana, barrio la victoria', 1, '2020-07-13 00:00:00', 'activo'),
(2, 'Juan', 'Pérez', 12345678, 'juan@example.com', 'admin', 0x7365637265746f313233, '0991234567', 'Av. Principal 123', 2, '2024-08-27 00:00:00', 'activo');


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_CLIENTE`);

--
-- Indices de la tabla `crear_categoria`
--
ALTER TABLE `crear_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD PRIMARY KEY (`id_detalles`),
  ADD UNIQUE KEY `ID_PRODUCTO` (`ID_PRODUCTO`,`ID_FACTURA`),
  ADD KEY `FK_DETALLES_RELATIONS_FACTURAS` (`ID_FACTURA`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`ID_FACTURA`),
  ADD KEY `FK_FACTURAS_RELATIONS_CLIENTES` (`ID_CLIENTE`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`ID_INVENTARIO`),
  ADD KEY `id_producto_inv` (`ID_PRODUCTO`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`ID_PAGO`),
  ADD KEY `id_factura` (`ID_FACTURA`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria` (`categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID_ROL`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_CLIENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  MODIFY `id_detalles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `ID_FACTURA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `ID_INVENTARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `ID_PAGO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID_ROL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD CONSTRAINT `FK_DETALLES_RELATIONS_FACTURAS` FOREIGN KEY (`ID_FACTURA`) REFERENCES `facturas` (`ID_FACTURA`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_producto_det` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `productos` (`id_producto`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `FK_FACTURAS_RELATIONS_CLIENTES` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `clientes` (`ID_CLIENTE`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `id_producto_inv` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `productos` (`id_producto`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `id_factura` FOREIGN KEY (`ID_FACTURA`) REFERENCES `facturas` (`ID_FACTURA`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
