SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `bitacora` (
  `idBitacora` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `tabla` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `operacion` varchar(3) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `bodegas` (
  `idBodega` int(11) NOT NULL,
  `descripcion` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `catalogo` (
  `idCatalogo` int(11) NOT NULL COMMENT 'primary key',
  `nombreProducto` varchar(64) DEFAULT NULL,
  `descripcionProducto` varchar(255) DEFAULT NULL,
  `precio` decimal(9,2) DEFAULT NULL,
  `exentoImpuesto` tinyint(1) NOT NULL DEFAULT 0,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `categoria_tipos` (
  `idTipo` int(11) NOT NULL,
  `descripcion` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `material` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `idFoto` int(11) NOT NULL DEFAULT 1,
  `nombreEmpresa` varchar(64) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `rtnEmpresa` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
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
  `credito` tinyint(1) NOT NULL DEFAULT 0,
  `usuario` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `cotizaciones` (
  `idCotizacion` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion` varchar(512) COLLATE utf8_spanish_ci NOT NULL,
  `estadoCotizacion` varchar(32) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'PENDIENTE',
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `datos_empresa` (
  `nombre` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `rtn` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `idFoto` int(11) NOT NULL,
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

CREATE TABLE `ficha_producto` (
  `idFichaProducto` int(11) NOT NULL,
  `descripcion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `idMateriaPrima` int(11) NOT NULL,
  `precio` decimal(9,2) NOT NULL DEFAULT 0.00,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `ficha_producto_materiales` (
  `idFichaProducto` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `fotografias_productos` (
  `idFotografia` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `fotografia` blob NOT NULL,
  `nombreFoto` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `tamanoFoto` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `formatoFoto` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `fotografias_usuarios` (
  `idFotografia` int(11) NOT NULL,
  `fotografia` longblob NOT NULL,
  `nombreFoto` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `tamano` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `formato` varchar(32) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `guia_remision` (
  `idGuia` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL DEFAULT 2,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `codigo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `empresa` varchar(32) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Mario Graphics Memories',
  `motivoTraslado` varchar(256) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'No especificado',
  `bodegaSalida` int(11) NOT NULL,
  `bodegaEntrada` int(11) NOT NULL,
  `estadoGuia` enum('EMITIDA','APROBADA','RECHAZADA','ANULADA') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'EMITIDA',
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `inventario_categorias` (
  `idCategoria` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `estilo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `inventario_defectuoso` (
  `idInventario` int(11) NOT NULL,
  `descripcion` int(11) NOT NULL,
  `observaciones` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `inventario_general` (
  `idInventarioGeneral` int(11) NOT NULL,
  `descripcion` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `idBodega` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `inventario_herramientas` (
  `idInventarioHerramienta` int(11) NOT NULL,
  `descripcion` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `idBodega` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `inventario_materiales` (
  `idInventarioMaterial` int(11) NOT NULL,
  `descripcion` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `idProveedor` int(11) DEFAULT NULL,
  `precio` decimal(9,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `puntoReorden` int(3) NOT NULL DEFAULT 3,
  `idBodega` int(11) NOT NULL DEFAULT 1,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `inventario_materia_prima` (
  `idInventario` int(11) NOT NULL,
  `descripcion` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idTalla` int(11) NOT NULL,
  `color` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `puntoReorden` int(3) NOT NULL DEFAULT 3,
  `precio` decimal(9,2) NOT NULL,
  `idBodega` int(11) NOT NULL DEFAULT 1,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `inventario_proveedores` (
  `idProveedor` int(11) NOT NULL,
  `empresa` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `nombreContacto` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `correoContacto` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `telefonoContacto` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `inventario_tallas` (
  `idTalla` int(11) NOT NULL,
  `descripcion` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `master_password` (
  `contra` tinyblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `materiales_remision` (
  `idGuia` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `cantidad` int(9) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `materia_prima_remision` (
  `idGuia` int(11) NOT NULL,
  `idMateriaPrima` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `ordenes` (
  `idOrden` int(11) NOT NULL,
  `idCotizacion` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `estadoOrden` varchar(32) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'GENERADA',
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `productos_cotizados` (
  `idCotizacion` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `rol` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `empleados` int(1) NOT NULL DEFAULT 0,
  `clientes` int(1) NOT NULL DEFAULT 0,
  `inventario` int(1) NOT NULL DEFAULT 0,
  `guiaRemision` int(1) NOT NULL,
  `bodegas` int(1) NOT NULL DEFAULT 0,
  `catalogo` int(1) NOT NULL DEFAULT 0,
  `cotizacion` int(1) NOT NULL DEFAULT 0,
  `pedido` int(1) NOT NULL DEFAULT 0,
  `configuracion` int(1) NOT NULL DEFAULT 0,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `tipo_cliente` (
  `idTipoCliente` int(11) NOT NULL,
  `descripcion` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `idRol` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `tipo_empleado` (
  `idTipoEmpleado` int(11) NOT NULL,
  `descripcion` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `idRol` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `TipoUsuario` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Ninguno',
  `password` blob DEFAULT NULL,
  `token` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`idBitacora`);

ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`idBodega`);

ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`idCatalogo`);

ALTER TABLE `categoria_tipos`
  ADD PRIMARY KEY (`idTipo`);

ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `tipoCliente` (`tipoCliente`),
  ADD KEY `dni` (`dni`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `idFoto` (`idFoto`);

ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`idCotizacion`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idEmpleado` (`idEmpleado`);

ALTER TABLE `datos_empresa`
  ADD PRIMARY KEY (`nombre`);

ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `tipoEmpleado` (`tipoEmpleado`),
  ADD KEY `dni` (`dni`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `idFoto` (`idFoto`);

ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `idPedido` (`idPedido`);

ALTER TABLE `ficha_producto`
  ADD PRIMARY KEY (`idFichaProducto`),
  ADD KEY `inventario_final_ibfk_1` (`idMateriaPrima`);

ALTER TABLE `ficha_producto_materiales`
  ADD KEY `idInventarioFinal` (`idFichaProducto`),
  ADD KEY `idMaterial` (`idMaterial`);

ALTER TABLE `fotografias_productos`
  ADD PRIMARY KEY (`idFotografia`),
  ADD KEY `idProducto` (`idProducto`);

ALTER TABLE `fotografias_usuarios`
  ADD PRIMARY KEY (`idFotografia`);

ALTER TABLE `guia_remision`
  ADD PRIMARY KEY (`idGuia`),
  ADD KEY `empresa` (`empresa`),
  ADD KEY `bodegaSalida` (`bodegaSalida`),
  ADD KEY `bodegaEntrada` (`bodegaEntrada`),
  ADD KEY `idEmpleado` (`idEmpleado`);

ALTER TABLE `inventario_categorias`
  ADD PRIMARY KEY (`idCategoria`),
  ADD KEY `idTipo` (`idTipo`);

ALTER TABLE `inventario_defectuoso`
  ADD PRIMARY KEY (`idInventario`);

ALTER TABLE `inventario_general`
  ADD PRIMARY KEY (`idInventarioGeneral`),
  ADD KEY `idBodega` (`idBodega`);

ALTER TABLE `inventario_herramientas`
  ADD PRIMARY KEY (`idInventarioHerramienta`),
  ADD KEY `idProveedor` (`idProveedor`),
  ADD KEY `idBodega` (`idBodega`);

ALTER TABLE `inventario_materiales`
  ADD PRIMARY KEY (`idInventarioMaterial`),
  ADD KEY `idProveedor` (`idProveedor`),
  ADD KEY `idBodega` (`idBodega`);

ALTER TABLE `inventario_materia_prima`
  ADD PRIMARY KEY (`idInventario`),
  ADD KEY `idCategoria` (`idCategoria`,`idProveedor`),
  ADD KEY `idProveedor` (`idProveedor`),
  ADD KEY `idTalla` (`idTalla`),
  ADD KEY `idBodega` (`idBodega`);

ALTER TABLE `inventario_proveedores`
  ADD PRIMARY KEY (`idProveedor`);

ALTER TABLE `inventario_tallas`
  ADD PRIMARY KEY (`idTalla`);

ALTER TABLE `materiales_remision`
  ADD KEY `idMaterial` (`idMaterial`),
  ADD KEY `idGuia` (`idGuia`);

ALTER TABLE `materia_prima_remision`
  ADD KEY `idGuia` (`idGuia`),
  ADD KEY `idMateriaPrima` (`idMateriaPrima`);

ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`idOrden`),
  ADD KEY `idCotizacion` (`idCotizacion`);

ALTER TABLE `productos_cotizados`
  ADD KEY `idCotizacion` (`idCotizacion`),
  ADD KEY `idProducto` (`idProducto`);

ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`idTipoCliente`),
  ADD KEY `idRol` (`idRol`);

ALTER TABLE `tipo_empleado`
  ADD PRIMARY KEY (`idTipoEmpleado`),
  ADD KEY `idRol` (`idRol`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `usuario` (`usuario`);


ALTER TABLE `bitacora`
  MODIFY `idBitacora` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bodegas`
  MODIFY `idBodega` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `catalogo`
  MODIFY `idCatalogo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';

ALTER TABLE `categoria_tipos`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `cotizaciones`
  MODIFY `idCotizacion` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ficha_producto`
  MODIFY `idFichaProducto` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `fotografias_productos`
  MODIFY `idFotografia` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `fotografias_usuarios`
  MODIFY `idFotografia` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `guia_remision`
  MODIFY `idGuia` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inventario_categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inventario_defectuoso`
  MODIFY `idInventario` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inventario_general`
  MODIFY `idInventarioGeneral` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inventario_herramientas`
  MODIFY `idInventarioHerramienta` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inventario_materiales`
  MODIFY `idInventarioMaterial` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inventario_materia_prima`
  MODIFY `idInventario` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inventario_proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inventario_tallas`
  MODIFY `idTalla` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ordenes`
  MODIFY `idOrden` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tipo_cliente`
  MODIFY `idTipoCliente` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tipo_empleado`
  MODIFY `idTipoEmpleado` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`tipoCliente`) REFERENCES `tipo_cliente` (`idTipoCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clientes_ibfk_3` FOREIGN KEY (`idFoto`) REFERENCES `fotografias_usuarios` (`idFotografia`);

ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `cotizaciones_ibfk_2` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`);

ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`tipoEmpleado`) REFERENCES `tipo_empleado` (`idTipoEmpleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleados_ibfk_3` FOREIGN KEY (`idFoto`) REFERENCES `fotografias_usuarios` (`idFotografia`);

ALTER TABLE `facturacion`
  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `ordenes` (`idOrden`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `ficha_producto`
  ADD CONSTRAINT `ficha_producto_ibfk_1` FOREIGN KEY (`idMateriaPrima`) REFERENCES `inventario_materia_prima` (`idInventario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ficha_producto_materiales`
  ADD CONSTRAINT `ficha_producto_materiales_ibfk_1` FOREIGN KEY (`idFichaProducto`) REFERENCES `ficha_producto` (`idFichaProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ficha_producto_materiales_ibfk_2` FOREIGN KEY (`idMaterial`) REFERENCES `inventario_materiales` (`idInventarioMaterial`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `fotografias_productos`
  ADD CONSTRAINT `fotografias_productos_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `catalogo` (`idCatalogo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `guia_remision`
  ADD CONSTRAINT `guia_remision_ibfk_1` FOREIGN KEY (`empresa`) REFERENCES `datos_empresa` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guia_remision_ibfk_2` FOREIGN KEY (`bodegaSalida`) REFERENCES `bodegas` (`idBodega`),
  ADD CONSTRAINT `guia_remision_ibfk_3` FOREIGN KEY (`bodegaEntrada`) REFERENCES `bodegas` (`idBodega`),
  ADD CONSTRAINT `guia_remision_ibfk_4` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`);

ALTER TABLE `inventario_categorias`
  ADD CONSTRAINT `inventario_categorias_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `categoria_tipos` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `inventario_general`
  ADD CONSTRAINT `inventario_general_ibfk_1` FOREIGN KEY (`idBodega`) REFERENCES `bodegas` (`idBodega`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `inventario_herramientas`
  ADD CONSTRAINT `inventario_herramientas_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `inventario_proveedores` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_herramientas_ibfk_2` FOREIGN KEY (`idBodega`) REFERENCES `bodegas` (`idBodega`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `inventario_materiales`
  ADD CONSTRAINT `inventario_materiales_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `inventario_proveedores` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_materiales_ibfk_2` FOREIGN KEY (`idBodega`) REFERENCES `bodegas` (`idBodega`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `inventario_materia_prima`
  ADD CONSTRAINT `inventario_materia_prima_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `inventario_categorias` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_materia_prima_ibfk_3` FOREIGN KEY (`idProveedor`) REFERENCES `inventario_proveedores` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_materia_prima_ibfk_4` FOREIGN KEY (`idTalla`) REFERENCES `inventario_tallas` (`idTalla`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_materia_prima_ibfk_5` FOREIGN KEY (`idBodega`) REFERENCES `bodegas` (`idBodega`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `materiales_remision`
  ADD CONSTRAINT `materiales_remision_ibfk_1` FOREIGN KEY (`idGuia`) REFERENCES `guia_remision` (`idGuia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materiales_remision_ibfk_2` FOREIGN KEY (`idMaterial`) REFERENCES `inventario_materiales` (`idInventarioMaterial`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `materia_prima_remision`
  ADD CONSTRAINT `materia_prima_remision_ibfk_1` FOREIGN KEY (`idGuia`) REFERENCES `guia_remision` (`idGuia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materia_prima_remision_ibfk_2` FOREIGN KEY (`idMateriaPrima`) REFERENCES `inventario_materia_prima` (`idInventario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ordenes`
  ADD CONSTRAINT `ordenes_ibfk_1` FOREIGN KEY (`idCotizacion`) REFERENCES `cotizaciones` (`idCotizacion`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `productos_cotizados`
  ADD CONSTRAINT `productos_cotizados_ibfk_1` FOREIGN KEY (`idCotizacion`) REFERENCES `cotizaciones` (`idCotizacion`),
  ADD CONSTRAINT `productos_cotizados_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `catalogo` (`idCatalogo`);

ALTER TABLE `tipo_cliente`
  ADD CONSTRAINT `tipo_cliente_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tipo_empleado`
  ADD CONSTRAINT `tipo_empleado_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
