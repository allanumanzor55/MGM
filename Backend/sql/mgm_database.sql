-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2021 a las 07:33:44
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mgm_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `idBitacora` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `tabla` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `operacion` varchar(3) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `bitacora`
--

TRUNCATE TABLE `bitacora`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `tipoCliente` int(11) NOT NULL,
  `dni` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `primerApellido` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `segundoApellido` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `edad` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `clientes`
--

TRUNCATE TABLE `clientes`;
--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `tipoCliente`, `dni`, `nombre`, `primerApellido`, `segundoApellido`, `direccion`, `correo`, `celular`, `telefono`, `edad`, `estado`) VALUES
(1, 1, '0912', 'luz', 'umanzor', 'alvarez', 'colonia la sosa', 'luzae@gmail.com', '99212333', '22312211', '50', 1),
(2, 2, '01223', 'fabio', 'alonzo', '', 'colonia la sosa', 'macaalo@gmail.com', '99111233', '22222211', '52', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `tipoEmpleado` int(11) NOT NULL,
  `dni` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `primerApellido` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `segundoApellido` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `sueldo` decimal(9,2) NOT NULL,
  `usuario` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `empleados`
--

TRUNCATE TABLE `empleados`;
--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `tipoEmpleado`, `dni`, `nombre`, `primerApellido`, `segundoApellido`, `direccion`, `correo`, `celular`, `telefono`, `sueldo`, `usuario`, `estado`) VALUES
(11, 3, '111200012131', 'angel', 'sahir', 'lopez', 'colonia La paz', 'angel12@gmail.com', '99221112', '22211121', '130000.00', 'angelsah0', 1),
(12, 2, '31213', 'rafael', 'herrera', 'sagastume', 'colonia villanueva', 'rafa123@gmail.com', '8891221', '2311123', '10000.00', 'rafaelher1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `facturacion` (
  `idFactura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idPedido` int(11) NOT NULL,
  `subtotal` decimal(9,2) NOT NULL,
  `isv` decimal(9,2) NOT NULL,
  `descuento` decimal(9,2) NOT NULL,
  `total` decimal(9,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `facturacion`
--

TRUNCATE TABLE `facturacion`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idInventario` int(11) NOT NULL,
  `descripcion` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idEstilo` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `color` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `inventario`
--

TRUNCATE TABLE `inventario`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_categorias`
--

CREATE TABLE `inventario_categorias` (
  `idCategoria` int(11) NOT NULL,
  `descripcion` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `inventario_categorias`
--

TRUNCATE TABLE `inventario_categorias`;
--
-- Volcado de datos para la tabla `inventario_categorias`
--

INSERT INTO `inventario_categorias` (`idCategoria`, `descripcion`, `estado`) VALUES
(1, 'camisa algodon', 1),
(2, 'camisa seda', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_defectuoso`
--

CREATE TABLE `inventario_defectuoso` (
  `idInventario` int(11) NOT NULL,
  `descripcion` int(11) NOT NULL,
  `observaciones` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `inventario_defectuoso`
--

TRUNCATE TABLE `inventario_defectuoso`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_estilos`
--

CREATE TABLE `inventario_estilos` (
  `idEstilo` int(11) NOT NULL,
  `descripcion` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `inventario_estilos`
--

TRUNCATE TABLE `inventario_estilos`;
--
-- Volcado de datos para la tabla `inventario_estilos`
--

INSERT INTO `inventario_estilos` (`idEstilo`, `descripcion`, `estado`) VALUES
(1, '3/4', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_proveedores`
--

CREATE TABLE `inventario_proveedores` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `contacto` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `inventario_proveedores`
--

TRUNCATE TABLE `inventario_proveedores`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `fechaPedido` date NOT NULL,
  `descripcion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `idCliente` int(11) NOT NULL,
  `estadoPago` enum('PAGADO','PRIMA','PENDIENTE','') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'PENDIENTE',
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `pedidos`
--

TRUNCATE TABLE `pedidos`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_pagados`
--

CREATE TABLE `pedidos_pagados` (
  `idPedido` int(11) NOT NULL,
  `estadoPedido` enum('ESPERA','INGRESADO','PROCESANDO','TERMINADO','ENTREGADO') COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `pedidos_pagados`
--

TRUNCATE TABLE `pedidos_pagados`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `pedidos_productos`
--

TRUNCATE TABLE `pedidos_productos`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idPermiso` int(11) NOT NULL,
  `nivel` varchar(16) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `permisos`
--

TRUNCATE TABLE `permisos`;
--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idPermiso`, `nivel`) VALUES
(1, 'BAJO'),
(2, 'MEDIO'),
(3, 'ALTO'),
(4, 'TOTAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE `tipo_cliente` (
  `idTipoCliente` int(11) NOT NULL,
  `descripcion` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `tipo_cliente`
--

TRUNCATE TABLE `tipo_cliente`;
--
-- Volcado de datos para la tabla `tipo_cliente`
--

INSERT INTO `tipo_cliente` (`idTipoCliente`, `descripcion`, `estado`) VALUES
(1, 'MAYORISTA', 1),
(2, 'EVENTUAL', 1),
(3, 'DETALLE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empleado`
--

CREATE TABLE `tipo_empleado` (
  `idTipoEmpleado` int(11) NOT NULL,
  `descripcion` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `tipo_empleado`
--

TRUNCATE TABLE `tipo_empleado`;
--
-- Volcado de datos para la tabla `tipo_empleado`
--

INSERT INTO `tipo_empleado` (`idTipoEmpleado`, `descripcion`, `estado`) VALUES
(1, 'OPERADOR', 1),
(2, 'GESTOR', 1),
(3, 'ADMINISTRADOR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `token` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idPermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `usuarios`
--

TRUNCATE TABLE `usuarios`;
--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `password`, `token`, `idPermiso`) VALUES
('angelsah0', NULL, NULL, 4),
('rafaelher1', NULL, NULL, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`idBitacora`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `tipoCliente` (`tipoCliente`),
  ADD KEY `dni` (`dni`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `tipoEmpleado` (`tipoEmpleado`),
  ADD KEY `dni` (`dni`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `idPedido` (`idPedido`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idInventario`),
  ADD KEY `idCategoria` (`idCategoria`,`idEstilo`,`idProveedor`),
  ADD KEY `idEstilo` (`idEstilo`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indices de la tabla `inventario_categorias`
--
ALTER TABLE `inventario_categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `inventario_defectuoso`
--
ALTER TABLE `inventario_defectuoso`
  ADD PRIMARY KEY (`idInventario`);

--
-- Indices de la tabla `inventario_estilos`
--
ALTER TABLE `inventario_estilos`
  ADD PRIMARY KEY (`idEstilo`);

--
-- Indices de la tabla `inventario_proveedores`
--
ALTER TABLE `inventario_proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `pedidos_pagados`
--
ALTER TABLE `pedidos_pagados`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `cantidad` (`cantidad`),
  ADD KEY `idPedido` (`idPedido`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idPermiso`);

--
-- Indices de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`idTipoCliente`);

--
-- Indices de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  ADD PRIMARY KEY (`idTipoEmpleado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`),
  ADD KEY `idPermiso` (`idPermiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `idBitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idInventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_categorias`
--
ALTER TABLE `inventario_categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario_defectuoso`
--
ALTER TABLE `inventario_defectuoso`
  MODIFY `idInventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_estilos`
--
ALTER TABLE `inventario_estilos`
  MODIFY `idEstilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventario_proveedores`
--
ALTER TABLE `inventario_proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  MODIFY `idTipoCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  MODIFY `idTipoEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`tipoCliente`) REFERENCES `tipo_cliente` (`idTipoCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`tipoEmpleado`) REFERENCES `tipo_empleado` (`idTipoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `inventario_categorias` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`idEstilo`) REFERENCES `inventario_estilos` (`idEstilo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inventario_ibfk_3` FOREIGN KEY (`idProveedor`) REFERENCES `inventario_proveedores` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD CONSTRAINT `pedidos_productos_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pedidos_productos_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `inventario` (`idInventario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idPermiso`) REFERENCES `permisos` (`idPermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
