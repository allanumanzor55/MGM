/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ mgm_database /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE mgm_database;

DROP TABLE IF EXISTS bitacora;
CREATE TABLE `bitacora` (
  `idBitacora` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `descripcion` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `tabla` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `operacion` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idBitacora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS bodegas;
CREATE TABLE `bodegas` (
  `idBodega` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idBodega`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS catalogo;
CREATE TABLE `catalogo` (
  `idCatalogo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `nombreProducto` varchar(64) DEFAULT NULL,
  `descripcionProducto` varchar(255) DEFAULT NULL,
  `precio` decimal(9,2) DEFAULT NULL,
  `exentoImpuesto` tinyint(1) NOT NULL DEFAULT 0,
  `estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`idCatalogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS categoria_tipos;
CREATE TABLE `categoria_tipos` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `material` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS clientes;
CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
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
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idCliente`),
  KEY `tipoCliente` (`tipoCliente`),
  KEY `dni` (`dni`),
  KEY `usuario` (`usuario`),
  KEY `idFoto` (`idFoto`),
  CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`tipoCliente`) REFERENCES `tipo_cliente` (`idTipoCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `clientes_ibfk_3` FOREIGN KEY (`idFoto`) REFERENCES `fotografias_usuarios` (`idFotografia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS cotizaciones;
CREATE TABLE `cotizaciones` (
  `idCotizacion` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpleado` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion` varchar(512) COLLATE utf8_spanish_ci NOT NULL,
  `estadoCotizacion` varchar(32) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'PENDIENTE',
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idCotizacion`),
  KEY `idCliente` (`idCliente`),
  KEY `idEmpleado` (`idEmpleado`),
  CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`),
  CONSTRAINT `cotizaciones_ibfk_2` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS datos_empresa;
CREATE TABLE `datos_empresa` (
  `nombre` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `rtn` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS empleados;
CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL AUTO_INCREMENT,
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
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idEmpleado`),
  KEY `tipoEmpleado` (`tipoEmpleado`),
  KEY `dni` (`dni`),
  KEY `usuario` (`usuario`),
  KEY `idFoto` (`idFoto`),
  CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`tipoEmpleado`) REFERENCES `tipo_empleado` (`idTipoEmpleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `empleados_ibfk_3` FOREIGN KEY (`idFoto`) REFERENCES `fotografias_usuarios` (`idFotografia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS facturacion;
CREATE TABLE `facturacion` (
  `idFactura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idPedido` int(11) NOT NULL,
  `subtotal` decimal(9,2) NOT NULL,
  `isv` decimal(9,2) NOT NULL,
  `descuento` decimal(9,2) NOT NULL,
  `total` decimal(9,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idFactura`),
  KEY `idPedido` (`idPedido`),
  CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `ordenes` (`idOrden`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS ficha_producto;
CREATE TABLE `ficha_producto` (
  `idFichaProducto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `idMateriaPrima` int(11) NOT NULL,
  `precio` decimal(9,2) NOT NULL DEFAULT 0.00,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idFichaProducto`),
  KEY `inventario_final_ibfk_1` (`idMateriaPrima`),
  CONSTRAINT `ficha_producto_ibfk_1` FOREIGN KEY (`idMateriaPrima`) REFERENCES `inventario_materia_prima` (`idInventario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS ficha_producto_materiales;
CREATE TABLE `ficha_producto_materiales` (
  `idFichaProducto` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  KEY `idInventarioFinal` (`idFichaProducto`),
  KEY `idMaterial` (`idMaterial`),
  CONSTRAINT `ficha_producto_materiales_ibfk_1` FOREIGN KEY (`idFichaProducto`) REFERENCES `ficha_producto` (`idFichaProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ficha_producto_materiales_ibfk_2` FOREIGN KEY (`idMaterial`) REFERENCES `inventario_materiales` (`idInventarioMaterial`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS fotografias_productos;
CREATE TABLE `fotografias_productos` (
  `idFotografia` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `fotografia` blob NOT NULL,
  `nombreFoto` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `tamanoFoto` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `formatoFoto` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idFotografia`),
  KEY `idProducto` (`idProducto`),
  CONSTRAINT `fotografias_productos_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `catalogo` (`idCatalogo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS fotografias_usuarios;
CREATE TABLE `fotografias_usuarios` (
  `idFotografia` int(11) NOT NULL AUTO_INCREMENT,
  `fotografia` longblob NOT NULL,
  `nombreFoto` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `tamano` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `formato` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idFotografia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS guia_remision;
CREATE TABLE `guia_remision` (
  `idGuia` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpleado` int(11) NOT NULL DEFAULT 2,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `codigo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `empresa` varchar(32) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Mario Graphics Memories',
  `motivoTraslado` varchar(256) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'No especificado',
  `bodegaSalida` int(11) NOT NULL,
  `bodegaEntrada` int(11) NOT NULL,
  `estadoGuia` enum('EMITIDA','APROBADA','RECHAZADA','ANULADA') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'EMITIDA',
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idGuia`),
  KEY `empresa` (`empresa`),
  KEY `bodegaSalida` (`bodegaSalida`),
  KEY `bodegaEntrada` (`bodegaEntrada`),
  KEY `idEmpleado` (`idEmpleado`),
  CONSTRAINT `guia_remision_ibfk_1` FOREIGN KEY (`empresa`) REFERENCES `datos_empresa` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `guia_remision_ibfk_2` FOREIGN KEY (`bodegaSalida`) REFERENCES `bodegas` (`idBodega`),
  CONSTRAINT `guia_remision_ibfk_3` FOREIGN KEY (`bodegaEntrada`) REFERENCES `bodegas` (`idBodega`),
  CONSTRAINT `guia_remision_ibfk_4` FOREIGN KEY (`idEmpleado`) REFERENCES `empleados` (`idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS inventario_categorias;
CREATE TABLE `inventario_categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `idTipo` int(11) NOT NULL,
  `estilo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idCategoria`),
  KEY `idTipo` (`idTipo`),
  CONSTRAINT `inventario_categorias_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `categoria_tipos` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS inventario_defectuoso;
CREATE TABLE `inventario_defectuoso` (
  `idInventario` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` int(11) NOT NULL,
  `observaciones` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`idInventario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS inventario_general;
CREATE TABLE `inventario_general` (
  `idInventarioGeneral` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `idBodega` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idInventarioGeneral`),
  KEY `idBodega` (`idBodega`),
  CONSTRAINT `inventario_general_ibfk_1` FOREIGN KEY (`idBodega`) REFERENCES `bodegas` (`idBodega`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS inventario_herramientas;
CREATE TABLE `inventario_herramientas` (
  `idInventarioHerramienta` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `idBodega` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idInventarioHerramienta`),
  KEY `idProveedor` (`idProveedor`),
  KEY `idBodega` (`idBodega`),
  CONSTRAINT `inventario_herramientas_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `inventario_proveedores` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventario_herramientas_ibfk_2` FOREIGN KEY (`idBodega`) REFERENCES `bodegas` (`idBodega`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS inventario_materiales;
CREATE TABLE `inventario_materiales` (
  `idInventarioMaterial` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `idProveedor` int(11) DEFAULT NULL,
  `precio` decimal(9,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `puntoReorden` int(3) NOT NULL DEFAULT 3,
  `idBodega` int(11) NOT NULL DEFAULT 1,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idInventarioMaterial`),
  KEY `idProveedor` (`idProveedor`),
  KEY `idBodega` (`idBodega`),
  CONSTRAINT `inventario_materiales_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `inventario_proveedores` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventario_materiales_ibfk_2` FOREIGN KEY (`idBodega`) REFERENCES `bodegas` (`idBodega`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS inventario_materia_prima;
CREATE TABLE `inventario_materia_prima` (
  `idInventario` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idTalla` int(11) NOT NULL,
  `color` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `puntoReorden` int(3) NOT NULL DEFAULT 3,
  `precio` decimal(9,2) NOT NULL,
  `idBodega` int(11) NOT NULL DEFAULT 1,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idInventario`),
  KEY `idCategoria` (`idCategoria`,`idProveedor`),
  KEY `idProveedor` (`idProveedor`),
  KEY `idTalla` (`idTalla`),
  KEY `idBodega` (`idBodega`),
  CONSTRAINT `inventario_materia_prima_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `inventario_categorias` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventario_materia_prima_ibfk_3` FOREIGN KEY (`idProveedor`) REFERENCES `inventario_proveedores` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventario_materia_prima_ibfk_4` FOREIGN KEY (`idTalla`) REFERENCES `inventario_tallas` (`idTalla`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventario_materia_prima_ibfk_5` FOREIGN KEY (`idBodega`) REFERENCES `bodegas` (`idBodega`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS inventario_proveedores;
CREATE TABLE `inventario_proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `nombreContacto` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `correoContacto` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `telefonoContacto` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS inventario_tallas;
CREATE TABLE `inventario_tallas` (
  `idTalla` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idTalla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS master_password;
CREATE TABLE `master_password` (
  `contra` tinyblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS materiales_remision;
CREATE TABLE `materiales_remision` (
  `idGuia` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `cantidad` int(9) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  KEY `idMaterial` (`idMaterial`),
  KEY `idGuia` (`idGuia`),
  CONSTRAINT `materiales_remision_ibfk_1` FOREIGN KEY (`idGuia`) REFERENCES `guia_remision` (`idGuia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `materiales_remision_ibfk_2` FOREIGN KEY (`idMaterial`) REFERENCES `inventario_materiales` (`idInventarioMaterial`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS materia_prima_remision;
CREATE TABLE `materia_prima_remision` (
  `idGuia` int(11) NOT NULL,
  `idMateriaPrima` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  KEY `idGuia` (`idGuia`),
  KEY `idMateriaPrima` (`idMateriaPrima`),
  CONSTRAINT `materia_prima_remision_ibfk_1` FOREIGN KEY (`idGuia`) REFERENCES `guia_remision` (`idGuia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `materia_prima_remision_ibfk_2` FOREIGN KEY (`idMateriaPrima`) REFERENCES `inventario_materia_prima` (`idInventario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS ordenes;
CREATE TABLE `ordenes` (
  `idOrden` int(11) NOT NULL AUTO_INCREMENT,
  `idCotizacion` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `estadoOrden` varchar(32) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'GENERADA',
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idOrden`),
  KEY `idCotizacion` (`idCotizacion`),
  CONSTRAINT `ordenes_ibfk_1` FOREIGN KEY (`idCotizacion`) REFERENCES `cotizaciones` (`idCotizacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS productos_cotizados;
CREATE TABLE `productos_cotizados` (
  `idCotizacion` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  KEY `idCotizacion` (`idCotizacion`),
  KEY `idProducto` (`idProducto`),
  CONSTRAINT `productos_cotizados_ibfk_1` FOREIGN KEY (`idCotizacion`) REFERENCES `cotizaciones` (`idCotizacion`),
  CONSTRAINT `productos_cotizados_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `catalogo` (`idCatalogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS roles;
CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
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
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS tipo_cliente;
CREATE TABLE `tipo_cliente` (
  `idTipoCliente` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `idRol` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idTipoCliente`),
  KEY `idRol` (`idRol`),
  CONSTRAINT `tipo_cliente_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS tipo_empleado;
CREATE TABLE `tipo_empleado` (
  `idTipoEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `idRol` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idTipoEmpleado`),
  KEY `idRol` (`idRol`),
  CONSTRAINT `tipo_empleado_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `TipoUsuario` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Ninguno',
  `password` blob DEFAULT NULL,
  `token` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE OR REPLACE VIEW `vw_categorias` AS select `inventario_categorias`.`idCategoria` AS `idCategoria`,`categoria_tipos`.`idTipo` AS `idTipo`,`categoria_tipos`.`descripcion` AS `tipo`,`categoria_tipos`.`material` AS `material`,`inventario_categorias`.`estilo` AS `estilo` from (`inventario_categorias` join `categoria_tipos` on(`inventario_categorias`.`idTipo` = `categoria_tipos`.`idTipo`)) where `inventario_categorias`.`estado` = 1 and `categoria_tipos`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_cotizaciones` AS select `cotiz`.`idCotizacion` AS `idCotizacion`,`cotiz`.`idEmpleado` AS `idEmpleado`,concat(`emp`.`nombre`,' ',`emp`.`primerApellido`) AS `nombreEmpleado`,`cotiz`.`idCliente` AS `idCliente`,concat(`cli`.`nombre`,' ',`cli`.`primerApellido`) AS `nombreCliente`,`cotiz`.`fecha` AS `fecha`,`cotiz`.`descripcion` AS `descripcion`,`cotiz`.`estadoCotizacion` AS `EstadoCotizacion` from ((`cotizaciones` `cotiz` join `empleados` `emp` on(`emp`.`idEmpleado` = `cotiz`.`idEmpleado`)) join `clientes` `cli` on(`cli`.`idCliente` = `cotiz`.`idCliente`)) where `cotiz`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_ficha_producto` AS select `ficha`.`idFichaProducto` AS `idFichaProducto`,`ficha`.`descripcion` AS `descripcionFicha`,`ficha`.`idMateriaPrima` AS `idMateriaPrima`,`prima`.`descripcion` AS `descripcionMateriaPrima`,`prima`.`tipo` AS `tipo`,`prima`.`material` AS `material`,`prima`.`estilo` AS `estilo`,`prima`.`talla` AS `talla`,`prima`.`color` AS `color`,`prima`.`empresa` AS `proveedor`,`prima`.`precio` AS `precioPrima`,`prima`.`stock` AS `stock`,`ficha`.`precio` AS `precio` from (`ficha_producto` `ficha` join `vw_inventario` `prima` on(`ficha`.`idMateriaPrima` = `prima`.`idInventario`)) where `ficha`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_guia_remision` AS select `guia`.`idGuia` AS `idGuia`,`guia`.`fecha` AS `fecha`,`guia`.`codigo` AS `codigo`,`emp`.`nombre` AS `nombre`,`emp`.`rtn` AS `rtn`,`guia`.`motivoTraslado` AS `motivoTraslado`,`guia`.`bodegaSalida` AS `idBodegaSalida`,`bodegas`.`descripcion` AS `bodegaSalida`,`guia`.`bodegaEntrada` AS `idBodegaEntrada`,`bodegae`.`descripcion` AS `bodegaEntrada`,`guia`.`estadoGuia` AS `estadoGuia` from (((`guia_remision` `guia` join `datos_empresa` `emp` on(`emp`.`nombre` = `guia`.`empresa`)) join `bodegas` on(`guia`.`bodegaSalida` = `bodegas`.`idBodega`)) join `bodegas` `bodegae` on(`guia`.`bodegaEntrada` = `bodegae`.`idBodega`)) where `guia`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_inventario` AS select `inventario`.`idInventario` AS `idInventario`,`vw_categorias`.`idCategoria` AS `idCategoria`,`vw_categorias`.`tipo` AS `tipo`,`vw_categorias`.`idTipo` AS `idTipo`,`vw_categorias`.`material` AS `material`,`vw_categorias`.`estilo` AS `estilo`,`inventario_proveedores`.`idProveedor` AS `idProveedor`,`inventario_proveedores`.`empresa` AS `empresa`,`inventario_proveedores`.`nombreContacto` AS `nombreContacto`,`inventario_proveedores`.`correoContacto` AS `correoContacto`,`inventario_proveedores`.`telefonoContacto` AS `telefonoContacto`,`inventario`.`descripcion` AS `descripcion`,`inventario`.`idTalla` AS `idTalla`,`inventario_tallas`.`descripcion` AS `talla`,`inventario`.`color` AS `color`,`inventario`.`stock` AS `stock`,`inventario`.`precio` AS `precio`,`inventario`.`idBodega` AS `idBodega`,`bodega`.`descripcion` AS `bodega`,`inventario`.`puntoReorden` AS `puntoReorden` from ((((`inventario_materia_prima` `inventario` join `vw_categorias` on(`vw_categorias`.`idCategoria` = `inventario`.`idCategoria`)) join `inventario_proveedores` on(`inventario_proveedores`.`idProveedor` = `inventario`.`idProveedor`)) join `inventario_tallas` on(`inventario_tallas`.`idTalla` = `inventario`.`idTalla`)) join `bodegas` `bodega` on(`inventario`.`idBodega` = `bodega`.`idBodega`)) where `inventario`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_inventario_general` AS select `inventario`.`idInventarioGeneral` AS `idInventario`,`inventario`.`descripcion` AS `descripcion`,`inventario`.`stock` AS `stock`,`inventario`.`idBodega` AS `idBodega`,`bodega`.`descripcion` AS `bodega` from (`inventario_general` `inventario` join `bodegas` `bodega` on(`inventario`.`idBodega` = `bodega`.`idBodega`)) where `inventario`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_inventario_herramientas` AS select `inventario`.`idInventarioHerramienta` AS `idInventario`,`inventario`.`marca` AS `marca`,`inventario_proveedores`.`idProveedor` AS `idProveedor`,`inventario_proveedores`.`empresa` AS `empresa`,`inventario_proveedores`.`nombreContacto` AS `nombreContacto`,`inventario_proveedores`.`correoContacto` AS `correoContacto`,`inventario_proveedores`.`telefonoContacto` AS `telefonoContacto`,`inventario`.`descripcion` AS `descripcion`,`inventario`.`stock` AS `stock`,`inventario`.`idBodega` AS `idBodega`,`bodega`.`descripcion` AS `bodega` from ((`inventario_herramientas` `inventario` join `inventario_proveedores` on(`inventario_proveedores`.`idProveedor` = `inventario`.`idProveedor`)) join `bodegas` `bodega` on(`inventario`.`idBodega` = `bodega`.`idBodega`)) where `inventario`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_inventario_materiales` AS select `inventario`.`idInventarioMaterial` AS `idInventario`,`inventario`.`marca` AS `marca`,`inventario_proveedores`.`idProveedor` AS `idProveedor`,`inventario_proveedores`.`empresa` AS `empresa`,`inventario_proveedores`.`nombreContacto` AS `nombreContacto`,`inventario_proveedores`.`correoContacto` AS `correoContacto`,`inventario_proveedores`.`telefonoContacto` AS `telefonoContacto`,`inventario`.`descripcion` AS `descripcion`,`inventario`.`stock` AS `stock`,`inventario`.`precio` AS `precio`,`inventario`.`idBodega` AS `idBodega`,`bodega`.`descripcion` AS `bodega`,`inventario`.`puntoReorden` AS `puntoReorden` from ((`inventario_materiales` `inventario` join `inventario_proveedores` on(`inventario_proveedores`.`idProveedor` = `inventario`.`idProveedor`)) join `bodegas` `bodega` on(`inventario`.`idBodega` = `bodega`.`idBodega`)) where `inventario`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_materiales_ficha_producto` AS select `ficha`.`idFichaProducto` AS `idFichaProducto`,`ficha`.`idMaterial` AS `idMaterial`,`material`.`descripcion` AS `descripcion`,`material`.`marca` AS `marca`,`material`.`empresa` AS `empresa`,`material`.`precio` AS `precio`,`material`.`stock` AS `stock`,`ficha`.`cantidad` AS `cantidad` from (`ficha_producto_materiales` `ficha` join `vw_inventario_materiales` `material` on(`ficha`.`idMaterial` = `material`.`idInventario`)) where `ficha`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_materiales_remision` AS select `rem`.`idGuia` AS `idGuia`,`rem`.`idMaterial` AS `idMaterial`,`guia`.`bodegaSalida` AS `bodegaSalida`,`guia`.`bodegaEntrada` AS `bodegaEntrada`,`material`.`descripcion` AS `descripcion`,`material`.`marca` AS `marca`,`rem`.`cantidad` AS `cantidad` from ((`materiales_remision` `rem` join `vw_inventario_materiales` `material` on(`rem`.`idMaterial` = `material`.`idInventario`)) join `vw_guia_remision` `guia` on(`rem`.`idGuia` = `guia`.`idGuia`)) where `rem`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_materia_prima_remision` AS select `rem`.`idGuia` AS `idGuia`,`rem`.`idMateriaPrima` AS `idMateriaPrima`,`guia`.`bodegaSalida` AS `bodegaSalida`,`guia`.`bodegaEntrada` AS `bodegaEntrada`,`materia`.`descripcion` AS `descripcion`,`materia`.`tipo` AS `tipo`,`materia`.`estilo` AS `estilo`,`materia`.`talla` AS `talla`,`rem`.`cantidad` AS `cantidad` from ((`materia_prima_remision` `rem` join `vw_inventario` `materia` on(`rem`.`idMateriaPrima` = `materia`.`idInventario`)) join `vw_guia_remision` `guia` on(`rem`.`idGuia` = `guia`.`idGuia`)) where `rem`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_ordenes` AS select `orden`.`idOrden` AS `idOrden`,`orden`.`idCotizacion` AS `idCotizacion`,`orden`.`fecha` AS `fecha`,`cotiz`.`descripcion` AS `descripcion`,`cotiz`.`idEmpleado` AS `idEmpleado`,`cotiz`.`nombreEmpleado` AS `nombreEmpleado`,`cotiz`.`idCliente` AS `idCliente`,`cotiz`.`nombreCliente` AS `nombreCliente`,`orden`.`estadoOrden` AS `estadoOrden` from (`ordenes` `orden` join `vw_cotizaciones` `cotiz` on(`orden`.`idCotizacion` = `cotiz`.`idCotizacion`)) where `orden`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_productosordenes` AS select `vw_ordenes`.`idOrden` AS `idOrden`,`productos_cotizados`.`idCotizacion` AS `idCotizacion`,`productos_cotizados`.`idProducto` AS `IdProducto`,`catalogo`.`nombreProducto` AS `nombreProducto`,`catalogo`.`descripcionProducto` AS `descripcionProducto`,`catalogo`.`precio` AS `precio`,`productos_cotizados`.`cantidad` AS `cantidad` from (((`productos_cotizados` join `cotizaciones` on(`cotizaciones`.`idCotizacion` = `productos_cotizados`.`idCotizacion`)) join `vw_ordenes` on(`vw_ordenes`.`idCotizacion` = `cotizaciones`.`idCotizacion`)) join `catalogo` on(`productos_cotizados`.`idProducto` = `catalogo`.`idCatalogo`)) where `productos_cotizados`.`estado` = 1;

CREATE OR REPLACE VIEW `vw_usuarios` AS select `empleado`.`idEmpleado` AS `id`,`empleado`.`tipoEmpleado` AS `idTipo`,`empleado`.`dni` AS `dni`,`empleado`.`nombre` AS `nombre`,`empleado`.`primerApellido` AS `primerApellido`,`empleado`.`segundoApellido` AS `segundoApellido`,`empleado`.`direccion` AS `direccion`,`empleado`.`correo` AS `correo`,`empleado`.`celular` AS `celular`,`empleado`.`telefono` AS `telefono`,`empleado`.`sueldo` AS `sueldo`,`tipo`.`descripcion` AS `tipo`,`usuario`.`idUsuario` AS `idUsuario`,`usuario`.`usuario` AS `usuario`,`usuario`.`TipoUsuario` AS `TipoUsuario`,`usuario`.`password` AS `password`,`usuario`.`token` AS `token`,`tipo`.`idRol` AS `idRol` from ((`empleados` `empleado` join `tipo_empleado` `tipo` on(`empleado`.`tipoEmpleado` = `tipo`.`idTipoEmpleado`)) join `usuarios` `usuario` on(`empleado`.`usuario` = `usuario`.`usuario`)) where `empleado`.`estado` = 1 union all select `cliente`.`idCliente` AS `id`,`cliente`.`tipoCliente` AS `idTipo`,`cliente`.`dni` AS `dni`,`cliente`.`nombre` AS `nombre`,`cliente`.`primerApellido` AS `primerApellido`,`cliente`.`segundoApellido` AS `segundoApellido`,`cliente`.`direccion` AS `direccion`,`cliente`.`correo` AS `correo`,`cliente`.`celular` AS `celular`,`cliente`.`telefono` AS `telefono`,0 AS `0`,`tipo`.`descripcion` AS `tipo`,`usuario`.`idUsuario` AS `idUsuario`,`usuario`.`usuario` AS `usuario`,`usuario`.`TipoUsuario` AS `TipoUsuario`,`usuario`.`password` AS `password`,`usuario`.`token` AS `token`,`tipo`.`idRol` AS `idRol` from ((`clientes` `cliente` join `tipo_cliente` `tipo` on(`cliente`.`tipoCliente` = `tipo`.`idTipoCliente`)) join `usuarios` `usuario` on(`cliente`.`usuario` = `usuario`.`usuario`)) where `cliente`.`estado` = 1;DROP PROCEDURE IF EXISTS agregarBodega;
CREATE PROCEDURE `agregarBodega`(IN _descripcion TINYTEXT, IN _ubicacion  TINYTEXT)
BEGIN
    INSERT INTO bodegas(descripcion,ubicacion) VALUES (_descripcion,_ubicacion);
END;

DROP PROCEDURE IF EXISTS agregarCategoria;
CREATE PROCEDURE `agregarCategoria`(IN Tipo INT, IN Estilo TINYTEXT)
BEGIN
    INSERT INTO inventario_categorias(idTipo,estilo) VALUES (Tipo,Estilo);
END;

DROP PROCEDURE IF EXISTS agregarFichaProducto;
CREATE PROCEDURE `agregarFichaProducto`(IN _descripcion TINYTEXT, IN _materiaPrima INT,IN _precio DECIMAL(9,2), OUT idFichaProducto INT)
BEGIN
    INSERT INTO ficha_producto(descripcion,idMateriaPrima,precio)
    VALUES (_descripcion,_materiaPrima,_precio);
    SELECT LAST_INSERT_ID() INTO idFichaProducto;
END;

DROP PROCEDURE IF EXISTS agregarHerramienta;
CREATE PROCEDURE `agregarHerramienta`(IN Descripcion TINYTEXT, IN _marca TINYTEXT, IN Proveedor INT, IN Stock INT, IN Bodega INT)
BEGIN
    INSERT INTO inventario_herramientas(descripcion,marca,idProveedor,stock,idBodega)
    VALUE (Descripcion,_marca,Proveedor,Stock,Bodega);
END;

DROP PROCEDURE IF EXISTS agregarInvGeneral;
CREATE PROCEDURE `agregarInvGeneral`(IN Descripcion TINYTEXT, IN Stock INT, IN Bodega INT)
BEGIN
    INSERT INTO inventario_general(descripcion,stock,idBodega)
    VALUE (Descripcion,Stock, Bodega);
END;

DROP PROCEDURE IF EXISTS agregarMaterial;
CREATE PROCEDURE `agregarMaterial`(IN Descripcion TINYTEXT, IN _marca TINYTEXT, IN Proveedor INT, IN Precio DECIMAL(9,2),IN Stock INT,IN PuntoReorden INT, IN Bodega INT)
BEGIN
    INSERT INTO inventario_materiales(descripcion,marca,idProveedor,precio,stock,puntoReorden,idBodega)
    VALUE (Descripcion,_marca,Proveedor,Precio,Stock,PuntoReorden,Bodega);
END;

DROP PROCEDURE IF EXISTS agregarMaterialesFichaProducto;
CREATE PROCEDURE `agregarMaterialesFichaProducto`(IN _idFichaProducto INT, IN _idMaterial INT, IN _cantidad INT)
BEGIN
    INSERT INTO ficha_producto_materiales VALUES (_idFichaProducto,_idMaterial,_cantidad,1);
END;

DROP PROCEDURE IF EXISTS agregarMaterialesProductoFinal;
CREATE PROCEDURE `agregarMaterialesProductoFinal`(IN _idProductoFinal INT, IN _idMaterial INT, IN _cantidad INT)
BEGIN
    INSERT INTO inventario_final_materiales VALUES (_idProductoFinal,_idMaterial,_cantidad,1);
END;

DROP PROCEDURE IF EXISTS agregarMaterialGuia;
CREATE PROCEDURE `agregarMaterialGuia`(IN _guia INT, IN _material INT, IN _cantidad INT)
BEGIN
    INSERT INTO materiales_remision(idGuia, idMaterial, cantidad) VALUES (_guia,_material,_cantidad);
END;

DROP PROCEDURE IF EXISTS agregarMateriaPrimaGuia;
CREATE PROCEDURE `agregarMateriaPrimaGuia`(IN _guia INT, IN _materia INT, IN _cantidad INT)
BEGIN
    INSERT INTO materia_prima_remision(idGuia, idMateriaPrima, cantidad) VALUES (_guia,_materia,_cantidad);
END;

DROP PROCEDURE IF EXISTS agregarProceso;
CREATE PROCEDURE `agregarProceso`(IN _descripcion TINYTEXT)
BEGIN
    INSERT INTO procesos(descripcion) VALUES (_descripcion);
END;

DROP PROCEDURE IF EXISTS agregarProducto;
CREATE PROCEDURE `agregarProducto`(IN Descripcion TINYTEXT, IN Categoria INT, IN Proveedor INT, IN Talla INT,
                                IN Color TINYTEXT, IN Stock INT, IN Precio DECIMAL(9,2),IN PuntoReorden INT, IN Bodega INT)
BEGIN
    INSERT INTO inventario_materia_prima(descripcion,idCategoria,idProveedor,idTalla,color,stock,puntoReorden,precio,idBodega)
    VALUES(Descripcion,Categoria,Proveedor,Talla,Color,Stock,PuntoReorden,Precio,Bodega);
END;

DROP PROCEDURE IF EXISTS agregarProductoCotizacion;
CREATE PROCEDURE `agregarProductoCotizacion`(IN IdCotizacion INT, IN IdProducto INT, IN Cantidad INT)
BEGIN 
    INSERT INTO productos_cotizados(idCotizacion,idProducto,cantidad)
    VALUES  (IdCotizacion,IdProducto,Cantidad);
END;

DROP PROCEDURE IF EXISTS agregarProductoFinal;
CREATE PROCEDURE `agregarProductoFinal`(IN _descripcion TINYTEXT, IN _materiaPrima INT,IN _precio DECIMAL(9,2), OUT idProductoFinal INT)
BEGIN
    INSERT INTO inventario_producto_final(descripcion,idMateriaPrima,precio)
    VALUES (_descripcion,_materiaPrima,_precio);
    SELECT LAST_INSERT_ID() INTO idProductoFinal;
END;

DROP PROCEDURE IF EXISTS agregarProveedor;
CREATE PROCEDURE `agregarProveedor`(IN _empresa TINYTEXT, IN _correo TINYTEXT,IN _telefono TINYTEXT, 
IN _contacto TINYTEXT, IN _correoContacto TINYTEXT, IN _telefonoContacto TINYTEXT)
BEGIN
    INSERT INTO inventario_proveedores(empresa,direccion,correo,telefono,nombreContacto,correoContacto, telefonoContacto)
    VALUES(_empresa,_direccion,_correo,_telefono,_contacto, _correoContacto, _telefonoContacto);
END;

DROP PROCEDURE IF EXISTS agregarRol;
CREATE PROCEDURE `agregarRol`(IN Rol TINYTEXT, IN Descripcion TINYTEXT, 
IN Empleado INT, IN Cliente INT, IN Inventario INT, IN GuiaRemision INT, IN Bodega INT, IN Catalogo INT, IN Cotizacion INT,
IN Pedido INT, IN Configuracion INT)
BEGIN
    INSERT INTO roles(rol,descripcion,empleados,clientes,inventario,guiaRemision,bodegas,catalogo,cotizacion,pedido,configuracion)
    VALUES (Rol,Descripcion,Empleado,Cliente,Inventario,GuiaRemision,Bodega,Catalogo,Cotizacion,Pedido,Configuracion);
END;

DROP PROCEDURE IF EXISTS agregarTalla;
CREATE PROCEDURE `agregarTalla`(IN Descripcion TINYTEXT)
BEGIN 
    INSERT INTO inventario_tallas(descripcion) VALUES (Descripcion);
END;

DROP PROCEDURE IF EXISTS agregarTipo;
CREATE PROCEDURE `agregarTipo`(IN Descripcion TINYTEXT, IN Material TINYTEXT)
BEGIN 
    INSERT INTO categoria_tipos(descripcion,material) VALUES (Descripcion,Material);
END;

DROP PROCEDURE IF EXISTS agregarTipoEmpleado;
CREATE PROCEDURE `agregarTipoEmpleado`(IN Descripcion TINYTEXT, IN Rol INT)
BEGIN
    INSERT INTO tipo_empleado(descripcion,idRol) VALUES (Descripcion, Rol);
END;

DROP PROCEDURE IF EXISTS buscarCategoria;
CREATE PROCEDURE `buscarCategoria`(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM inventario_categorias 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarCliente;
CREATE PROCEDURE `buscarCliente`(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM clientes JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = clientes.idFoto
    WHERE estado=1 AND 
    (nombre LIKE CONCAT('%',Valor,'%') OR primerApellido LIKE CONCAT('%',Valor,'%') OR segundoApellido LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarEmpleado;
CREATE PROCEDURE `buscarEmpleado`(IN Valor TINYTEXT,IN Tipo TINYTEXT)
BEGIN 
    SELECT * FROM empleados JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = empleados.idFoto 
    WHERE estado=1 AND tipoEmpleado = Tipo AND 
    (nombre LIKE CONCAT('%',Valor,'%') OR primerApellido LIKE CONCAT('%',Valor,'%') OR segundoApellido LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarHerramienta;
CREATE PROCEDURE `buscarHerramienta`(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM vw_inventario_herramientas WHERE 
    (descripcion LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarHerramientaPorBodega;
CREATE PROCEDURE `buscarHerramientaPorBodega`(IN Valor TINYTEXT, IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_herramientas WHERE 
    idBodega = Bodega AND (descripcion LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarInvGeneral;
CREATE PROCEDURE `buscarInvGeneral`(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM vw_inventario_general WHERE 
    (descripcion LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarInvGeneralPorBodega;
CREATE PROCEDURE `buscarInvGeneralPorBodega`(IN Valor TINYTEXT, IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_general WHERE 
    idBodega = Bodega AND (descripcion LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarInvPrimaPorBodega;
CREATE PROCEDURE `buscarInvPrimaPorBodega`(IN Valor TINYTEXT, IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario WHERE 
    idBodega = Bodega AND (descripcion LIKE CONCAT('%',Valor,'%') OR tipo LIKE CONCAT('%',Valor,'%') OR estilo LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarMaterial;
CREATE PROCEDURE `buscarMaterial`(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM vw_inventario_materiales WHERE 
    (descripcion LIKE CONCAT('%',Valor,'%') OR empresa LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarMaterialPorBodega;
CREATE PROCEDURE `buscarMaterialPorBodega`(IN Valor TINYTEXT, IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_materiales WHERE 
    idBodega = Bodega AND (descripcion LIKE CONCAT('%',Valor,'%') OR empresa LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarProceso;
CREATE PROCEDURE `buscarProceso`(IN _valor TINYTEXT)
BEGIN
    SELECT * FROM procesos
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',_valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarProducto;
CREATE PROCEDURE `buscarProducto`(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM vw_inventario WHERE 
    (descripcion LIKE CONCAT('%',Valor,'%') OR tipo LIKE CONCAT('%',Valor,'%') OR estilo LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarTalla;
CREATE PROCEDURE `buscarTalla`(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM inventario_tallas 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS buscarTipo;
CREATE PROCEDURE `buscarTipo`(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM categoria_tipos 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',Valor,'%'));
END;

DROP PROCEDURE IF EXISTS cambiarEstadoSolicitudGuia;
CREATE PROCEDURE `cambiarEstadoSolicitudGuia`(IN _estadoGuia VARCHAR(10),IN _id INT)
BEGIN
    UPDATE guia_remision SET estadoGuia = _estadoGuia WHERE  idGuia = _id;
END;

DROP PROCEDURE IF EXISTS comprobarLogin;
CREATE PROCEDURE `comprobarLogin`(IN _token TINYTEXT, OUT Validado BOOLEAN)
BEGIN
    DECLARE n INT;
    SELECT COUNT(*) INTO n FROM usuarios WHERE token = _token;
    IF n > 0 THEN
        SET Validado = TRUE;
    ELSE 
        SET Validado = FALSE;
    END IF;
END;

DROP PROCEDURE IF EXISTS comprobarPassword;
CREATE PROCEDURE `comprobarPassword`(IN id INT, IN Contra TINYTEXT,OUT Validado BOOLEAN)
BEGIN
    DECLARE pass TINYTEXT;
    SELECT CONVERT(UNHEX(AES_DECRYPT(usuarios.password,usuarios.usuario)) USING utf8) INTO pass
    FROM usuarios WHERE idUsuario=id;
    IF Contra = pass THEN
        SET Validado := TRUE;
    ELSE
        SET Validado := FALSE;
    END IF;
END;

DROP PROCEDURE IF EXISTS comprobarUser;
CREATE PROCEDURE `comprobarUser`(IN Usuario TINYTEXT)
BEGIN
    DECLARE n INT;
    SELECT COUNT(*) INTO n FROM vw_usuarios WHERE usuario = Usuario;
    IF n>0 THEN
        SELECT idUsuario as "idUser",id,TipoUsuario FROM vw_usuarios WHERE usuario = Usuario;
    ELSE 
        SELECT 0 as "idUser";
    END IF;
END;

DROP PROCEDURE IF EXISTS eliminarBodega;
CREATE PROCEDURE `eliminarBodega`(IN _id INT)
BEGIN
    UPDATE bodegas SET estado = 0 WHERE idBodega = _id;
END;

DROP PROCEDURE IF EXISTS eliminarCatalogo;
CREATE PROCEDURE `eliminarCatalogo`(IN Id INT)
BEGIN 
    UPDATE catalogo SET estado = 0 WHERE  idCatalogo = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS eliminarCategoria;
CREATE PROCEDURE `eliminarCategoria`(IN Id INT)
BEGIN
    UPDATE inventario_categorias SET estado = 0 WHERE idCategoria = Id;
    UPDATE inventario_categorias
    JOIN inventario_materia_prima inventario ON inventario_categorias.idCategoria = inventario.idCategoria 
    SET 
    inventario_categorias.estado = 0,
    inventario.estado=0 
    WHERE inventario_categorias.idCategoria = Id;
END;

DROP PROCEDURE IF EXISTS eliminarCliente;
CREATE PROCEDURE `eliminarCliente`(IN Id INT )
BEGIN
    UPDATE clientes SET estado = 0 WHERE idCliente = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS eliminarCotizacion;
CREATE PROCEDURE `eliminarCotizacion`(IN Id INT)
BEGIN 
    UPDATE cotizaciones SET estado = 0 WHERE idCotizacion = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS eliminarEmpleado;
CREATE PROCEDURE `eliminarEmpleado`(IN Id INT)
BEGIN 
    UPDATE empleados SET estado = 0 WHERE idEmpleado = Id AND estado =1;
END;

DROP PROCEDURE IF EXISTS eliminarFichaProducto;
CREATE PROCEDURE `eliminarFichaProducto`(IN _id INT)
BEGIN
    UPDATE ficha_producto SET estado = 0 WHERE idFichaProducto = _id;
    UPDATE ficha_producto_materiales SET estado = 0 WHERE idFichaProducto = _id;
END;

DROP PROCEDURE IF EXISTS eliminarGuia;
CREATE PROCEDURE `eliminarGuia`(IN id INT)
BEGIN
    UPDATE guia_remision SET estado = 0 WHERE idGuia = id;
END;

DROP PROCEDURE IF EXISTS eliminarHerramienta;
CREATE PROCEDURE `eliminarHerramienta`(IN Id INT)
BEGIN
    UPDATE inventario_herramientas SET estado = 0 WHERE idInventarioHerramienta = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS eliminarInvGeneral;
CREATE PROCEDURE `eliminarInvGeneral`(IN Id INT)
BEGIN
    UPDATE inventario_general SET estado = 0 WHERE idInventarioGeneral = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS eliminarMaterial;
CREATE PROCEDURE `eliminarMaterial`(IN Id INT)
BEGIN
    UPDATE inventario_materiales SET estado = 0 WHERE idInventarioMaterial = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS eliminarMaterialFichaProducto;
CREATE PROCEDURE `eliminarMaterialFichaProducto`( IN _idFicha INT, IN _idMaterial INT)
BEGIN
    UPDATE ficha_producto_materiales SET estado = 0 WHERE idFichaProducto = _idFicha AND idMaterial = _idMaterial;
END;

DROP PROCEDURE IF EXISTS eliminarMaterialProductoFinal;
CREATE PROCEDURE `eliminarMaterialProductoFinal`( IN _idProducto INT, IN _idMaterial INT)
BEGIN
    UPDATE inventario_final_materiales SET estado = 0 WHERE idInventarioFinal = _idProducto AND idMaterial = _idMaterial;
END;

DROP PROCEDURE IF EXISTS eliminarProceso;
CREATE PROCEDURE `eliminarProceso`(IN _id INT)
BEGIN
    UPDATE procesos SET estado = 0 WHERE idProceso = _id;
END;

DROP PROCEDURE IF EXISTS eliminarProducto;
CREATE PROCEDURE `eliminarProducto`(IN Id INT)
BEGIN
    UPDATE inventario_materia_prima SET estado = 0 WHERE idInventario = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS eliminarProductoFinal;
CREATE PROCEDURE `eliminarProductoFinal`(IN _id INT)
BEGIN
    UPDATE inventario_producto_final SET estado = 0 WHERE idInventarioFinal = _id;
    UPDATE inventario_final_materiales SET estado = 0 WHERE idInventarioFinal = _id;
END;

DROP PROCEDURE IF EXISTS eliminarProveedor;
CREATE PROCEDURE `eliminarProveedor`(IN Id INT)
BEGIN
    UPDATE inventario_proveedores
    JOIN inventario ON inventario_proveedores.idProveedor = inventario.idProveedor
    SET inventario_proveedores.estado=0,inventario.estado=0
    WHERE inventario_proveedores.idProveedor=Id AND inventario_proveedores.estado=1;
END;

DROP PROCEDURE IF EXISTS eliminarRol;
CREATE PROCEDURE `eliminarRol`( IN Id INT)
BEGIN
    UPDATE roles SET estado = 0 WHERE idRol = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS eliminarTalla;
CREATE PROCEDURE `eliminarTalla`(IN Id INT)
BEGIN
    UPDATE inventario_tallas SET estado = 0 WHERE idTalla = Id;
    UPDATE inventario_tallas
    JOIN inventario_materia_prima inventario ON inventario_tallas.idTalla = inventario.idTalla
    SET inventario_tallas.estado = 0,inventario.estado=0 
    WHERE inventario_tallas.idTalla = Id AND inventario_tallas.estado = 1;
END;

DROP PROCEDURE IF EXISTS eliminarTipo;
CREATE PROCEDURE `eliminarTipo`(IN Id INT)
BEGIN
    UPDATE categoria_tipos SET estado = 0 WHERE idTipo = Id;
    
    UPDATE categoria_tipos 
    JOIN inventario_categorias ON categoria_tipos.idTipo = inventario_categorias.idTipo
    SET 
    categoria_tipos.estado=0,
    inventario_categorias.estado = 0
    WHERE categoria_tipos.idTipo = Id AND inventario_categorias.idTipo = Id;
    
    UPDATE inventario_materia_prima 
    JOIN inventario_categorias ON inventario_materia_prima.idCategoria = inventario_categorias.idCategoria
    SET
    inventario_materia_prima.estado=0
    WHERE inventario_categorias.idTipo=Id;
END;

DROP PROCEDURE IF EXISTS eliminarTipoEmpleado;
CREATE PROCEDURE `eliminarTipoEmpleado`( IN Id INT)
BEGIN
    UPDATE tipo_empleado SET estado = 0 WHERE idTipoEmpleado = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS generarTrasladoBodegas;
CREATE PROCEDURE `generarTrasladoBodegas`(IN _tipo VARCHAR(10),IN _idGuia INT, IN _idInventario INT)
BEGIN 
    DECLARE bodegaS INT;
    DECLARE bodegaE INT;
    DECLARE centinela BOOLEAN;
    DECLARE stockS INT;

    SELECT bodegaSalida,bodegaEntrada INTO bodegaS,bodegaE FROM guia_remision WHERE idGuia = _idGuia AND estado = 1;
    SET centinela := comprobarExistenciaBodega(_tipo,bodegaE,_idInventario);
    IF _tipo = "MATERIAL" THEN
        SELECT cantidad INTO stockS FROM materiales_remision 
        WHERE idGuia = _idGuia AND idMaterial = _idInventario AND estado = 1;
        UPDATE inventario_materiales SET stock = stock-cantidad 
        WHERE idInventarioMaterial = _idInventario AND idBodega = bodegaS;
        IF centinela = TRUE THEN
            UPDATE inventario_materiales SET stock = stock+cantidad 
            WHERE idInventarioMaterial = _idInventario AND idBodega = bodegaE;
        ELSE
            SET centinela := crearInventarioBodega(_tipo, _idInventario, bodegaE,stockS);
        END IF;
    ELSEIF _tipo = "MATERIA" THEN
        SELECT cantidad INTO stockS FROM materia_prima_remision 
        WHERE idGuia = _idGuia AND idMateriaPrima = _idInventario AND estado = 1;
        UPDATE inventario_materia_prima SET stock = stock-cantidad 
        WHERE idInventario = _idInventario AND idBodega = bodegaS;
        IF centinela = TRUE THEN
            UPDATE inventario_materia_prima SET stock = stock+cantidad 
            WHERE idInventario = _idInventario AND idBodega = bodegaE;
        ELSE
            SET centinela := crearInventarioBodega(_tipo, _idInventario, bodegaE,stockS);
        END IF;
    END IF;
END;

DROP PROCEDURE IF EXISTS guardarCatalogo;
CREATE PROCEDURE `guardarCatalogo`(IN NombreProducto TINYTEXT, IN DescripcionProducto TINYTEXT, IN Precio DECIMAL(9,2), IN ExentoImpuesto INT, OUT idCatalogo INT)
BEGIN 
    INSERT INTO catalogo (nombreProducto,descripcionProducto,precio,exentoImpuesto) 
    VALUES (NombreProducto,DescripcionProducto,Precio,ExentoImpuesto);
    SELECT LAST_INSERT_ID() INTO idCatalogo;
END;

DROP PROCEDURE IF EXISTS guardarCliente;
CREATE PROCEDURE `guardarCliente`(IN IdFoto INT,IN NombreEmpresa TINYTEXT, IN RtnEmpresa TINYTEXT,
IN TipoCliente INT, IN Dni TINYTEXT,IN Nombre TINYTEXT, IN PrimerApellido TINYTEXT, 
IN SegundoApellido TINYTEXT,IN Direccion TINYTEXT, IN Correo TINYTEXT, 
IN Celular TINYTEXT, IN Telefono TINYTEXT, IN Edad VARCHAR(3))
BEGIN
    INSERT INTO clientes (idFoto,nombreEmpresa,rtnEmpresa,tipoCliente,dni, nombre, primerApellido, segundoApellido,direccion, correo, celular, telefono,edad) 
    VALUES (IdFoto,NombreEmpresa,RtnEmpresa,TipoCliente,Dni, Nombre, PrimerApellido, SegundoApellido, Direccion, Correo, Celular, Telefono,Edad); 
END;

DROP PROCEDURE IF EXISTS guardarCotizacion;
CREATE PROCEDURE `guardarCotizacion`(IN Descripcion TINYTEXT,IN Empleado INT, IN Cliente INT, OUT IdCotizacion INT)
BEGIN 
    INSERT INTO cotizaciones(idEmpleado,idCliente,descripcion) VALUES (Empleado,Cliente,Descripcion);
    SELECT LAST_INSERT_ID() INTO IdCotizacion;
END;

DROP PROCEDURE IF EXISTS guardarEmpleado;
CREATE PROCEDURE `guardarEmpleado`(IN IdFoto INT,IN TipoEmpleado INT, IN Dni TINYTEXT,
IN Nombre TINYTEXT, IN PrimerApellido TINYTEXT, IN SegundoApellido TINYTEXT,
IN Direccion TINYTEXT, IN Correo TINYTEXT, IN Celular TINYTEXT, IN Telefono TINYTEXT,
IN Sueldo DECIMAL(11,2))
BEGIN 
    INSERT INTO 
    empleados(idFoto,tipoEmpleado, nombre, dni , primerApellido, segundoApellido,direccion, correo, celular, telefono, sueldo) 
    VALUES(IdFoto,TipoEmpleado, Nombre, Dni, PrimerApellido, SegundoApellido, Direccion, Correo, Celular, Telefono, Sueldo); 
END;

DROP PROCEDURE IF EXISTS guardarGuia;
CREATE PROCEDURE `guardarGuia`(IN _idEmpleado INT,IN _motivo TINYTEXT, IN _bodegaSalida INT, IN _bodegaEntrada INT, OUT _idGuia INT)
BEGIN
    DECLARE codGuia TINYTEXT;
    DECLARE nombreEmpresa TINYTEXT;
    SET codGuia:=generarCodigoGuia();
    SELECT nombre INTO nombreEmpresa FROM datos_empresa WHERE activo = 1;
    SELECT CONCAT(EXTRACT(YEAR FROM CURDATE()),"-",EXTRACT(MONTH FROM CURDATE()),"-",codGuia) INTO codGuia;
    INSERT INTO guia_remision(idEmpleado,codigo,empresa,motivoTraslado,bodegaSalida,bodegaEntrada)
    VALUES (_idEmpleado,codGuia,nombreEmpresa,_motivo,_bodegaSalida,_bodegaEntrada);
    SELECT LAST_INSERT_ID() INTO _idGuia;
END;

DROP PROCEDURE IF EXISTS Login;
CREATE PROCEDURE `Login`(IN Id INT, IN Token VARCHAR(1024))
BEGIN
    UPDATE usuarios SET token=Token WHERE idUsuario = Id;
END;

DROP PROCEDURE IF EXISTS logout;
CREATE PROCEDURE `logout`(IN Id INT)
BEGIN
    UPDATE usuarios SET token = "" WHERE idUsuario = Id;
END;

DROP PROCEDURE IF EXISTS modificarBodega;
CREATE PROCEDURE `modificarBodega`(IN _descripcion TINYTEXT, IN _ubicacion TINYTEXT, IN _id INT)
BEGIN 
    UPDATE bodegas SET descripcion = _descripcion, ubicacion = _ubicacion WHERE idBodega = _id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarCatalogo;
CREATE PROCEDURE `modificarCatalogo`(IN NombreProducto TINYTEXT, IN DescripcionProducto TINYTEXT, IN Precio DECIMAL(9,2), IN ExentoImpuesto INT, IN Id INT)
BEGIN 
    UPDATE catalogo SET nombreProducto = NombreProducto, descripcionProducto = DescripcionProducto, precio = Precio, exentoImpuesto = ExentoImpuesto
    WHERE idCatalogo = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarCategoria;
CREATE PROCEDURE `modificarCategoria`(IN Tipo INT, IN Estilo TINYTEXT, IN Id INT)
BEGIN
    UPDATE inventario_categorias SET 
        idTipo = Tipo,
        estilo = Estilo
    WHERE idCategoria = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarCliente;
CREATE PROCEDURE `modificarCliente`(IN NombreEmpresa TINYTEXT, IN RtnEmpresa TINYTEXT,
IN TipoCliente INT,IN Dni TINYTEXT,IN Nombre TINYTEXT, IN PrimerApellido TINYTEXT, 
IN SegundoApellido TINYTEXT,IN Direccion TINYTEXT, IN Correo TINYTEXT, IN Celular TINYTEXT, 
IN Telefono TINYTEXT, IN Edad VARCHAR(3),IN Id INT)
BEGIN 
    UPDATE clientes SET
        nombreEmpresa = NombreEmpresa,
        rtnEmpresa = RtnEmpresa,
        tipoCliente = TipoCliente,
        dni = Dni,
        nombre = Nombre,
        primerApellido = PrimerApellido,
        segundoApellido = SegundoApellido,
        direccion = Direccion,
        correo = Correo,
        celular = Celular,
        telefono = Telefono,
        edad = Edad
    WHERE idCliente  = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarEmpleado;
CREATE PROCEDURE `modificarEmpleado`(IN Dni TINYTEXT,
IN Nombre TINYTEXT, IN PrimerApellido TINYTEXT, IN SegundoApellido TINYTEXT,
IN Direccion TINYTEXT, IN Correo TINYTEXT, IN Celular TINYTEXT, IN Telefono TINYTEXT,
IN Sueldo DECIMAL(11,2),IN Id INT )
BEGIN 
    UPDATE 
    empleados SET
        dni = Dni,
        nombre = Nombre,
        primerApellido = PrimerApellido,
        segundoApellido = SegundoApellido,
        direccion = Direccion,
        correo = Correo,
        celular = Celular,
        telefono = Telefono,
        sueldo = Sueldo
    WHERE idEmpleado = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarEstado;
CREATE PROCEDURE `modificarEstado`(IN Id INT, IN Estado TINYTEXT)
BEGIN
    UPDATE cotizaciones SET estadoCotizacion = "APROBADA" WHERE idCotizacion = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarEstadoCotizacion;
CREATE PROCEDURE `modificarEstadoCotizacion`(IN Id INT, IN Estado VARCHAR(32))
BEGIN
    UPDATE cotizaciones SET estadoCotizacion = Estado WHERE idCotizacion = Id;
    IF Estado = "APROBADA" THEN
        INSERT INTO ordenes(idCotizacion) VALUES (Id);
    END IF;
END;

DROP PROCEDURE IF EXISTS modificarFichaProducto;
CREATE PROCEDURE `modificarFichaProducto`(IN _descripcion TINYTEXT, IN _materiaPrima INT, IN _precio DECIMAL(9,2), IN _id INT)
BEGIN
    UPDATE ficha_producto SET
        descripcion = _descripcion,
        idMateriaPrima = _materiaPrima,
        precio = _precio
    WHERE
        idFichaProducto = _id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarHerramienta;
CREATE PROCEDURE `modificarHerramienta`(IN Descripcion TINYTEXT, IN _marca TINYTEXT, IN Proveedor INT, IN Stock INT, IN Id INT)
BEGIN
    UPDATE inventario_herramientas 
    SET
        descripcion = Descripcion,
        marca = _marca,
        idProveedor = Proveedor,
        stock = Stock
    WHERE idInventarioHerramienta = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarInvGeneral;
CREATE PROCEDURE `modificarInvGeneral`(IN Descripcion TINYTEXT, IN Stock INT, IN Id INT)
BEGIN
    UPDATE inventario_general 
    SET
        descripcion = Descripcion,
        stock = Stock
    WHERE idInventarioGeneral = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarMaterial;
CREATE PROCEDURE `modificarMaterial`(IN Descripcion TINYTEXT, IN _marca TINYTEXT, IN Proveedor INT, IN Precio DECIMAL(9,2), IN Stock INT, IN PuntoReorden INT, IN Id INT)
BEGIN
    UPDATE inventario_materiales 
    SET
        descripcion = Descripcion,
        marca = _marca,
        idProveedor = Proveedor,
        precio = Precio,
        stock = Stock,
        puntoReorden = PuntoReorden
    WHERE idInventarioMaterial = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarMaterialFichaProducto;
CREATE PROCEDURE `modificarMaterialFichaProducto`(IN _idFicha INT,IN _idMaterial INT, IN _cantidad INT, IN cen INT)
BEGIN
    IF cen=0 THEN
        DELETE FROM ficha_producto_materiales WHERE idFichaProducto = _idFicha;
    END IF;
    INSERT INTO ficha_producto_materiales VALUES (_idFicha,_idMaterial,_cantidad,1);
END;

DROP PROCEDURE IF EXISTS modificarMaterialProductoFinal;
CREATE PROCEDURE `modificarMaterialProductoFinal`(IN _idProducto INT,IN _idMaterial INT, IN _cantidad INT, IN cen INT)
BEGIN
    IF cen=0 THEN
        DELETE FROM inventario_final_materiales WHERE idInventarioFinal = _idProducto;
    END IF;
    INSERT INTO inventario_final_materiales VALUES (_idProducto,_idMaterial,_cantidad,1);
END;

DROP PROCEDURE IF EXISTS modificarProceso;
CREATE PROCEDURE `modificarProceso`(IN _descripcion TINYTEXT, IN _id INT)
BEGIN
    UPDATE procesos SET descripcion = _descripcion WHERE idProceso = _id;
END;

DROP PROCEDURE IF EXISTS modificarProducto;
CREATE PROCEDURE `modificarProducto`(IN Descripcion TINYTEXT, IN Categoria INT, IN Proveedor INT, IN Talla INT,
                                IN Color TINYTEXT, IN Stock INT, IN Precio DECIMAL(9,2),IN PuntoReorden INT, IN Id INT)
BEGIN
    UPDATE inventario_materia_prima SET
        descripcion = Descripcion,
        idCategoria = Categoria,
        idProveedor = Proveedor,
        idTalla = Talla,
        color = Color,
        stock = Stock,
        precio = Precio,
        puntoReorden = PuntoReorden
    WHERE idInventario = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarProductoFinal;
CREATE PROCEDURE `modificarProductoFinal`(IN _descripcion TINYTEXT, IN _materiaPrima INT, IN _precio DECIMAL(9,2), IN _id INT)
BEGIN
    UPDATE inventario_producto_final SET
        descripcion = _descripcion,
        idMateriaPrima = _materiaPrima,
        precio = _precio
    WHERE
        idInventarioFinal = _id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarRol;
CREATE PROCEDURE `modificarRol`(IN Rol TINYTEXT, IN Descripcion TINYTEXT, 
IN Empleado INT, IN Cliente INT, IN Inventario INT, IN GuiaRemision INT, IN Bodega INT, IN Catalogo INT, IN Cotizacion INT,
IN Pedido INT, IN Configuracion INT, IN Id INT)
BEGIN
    UPDATE roles SET 
        rol = Rol,
        descripcion = Descripcion,
        empleados = Empleado,
        clientes = Cliente,
        inventario = Inventario,
        guiaRemision = GuiaRemision,
        bodegas = Bodega,
        catalogo = Catalogo,
        cotizacion = Cotizacion,
        pedido = Pedido,
        configuracion = Configuracion
    WHERE idRol = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarStock;
CREATE PROCEDURE `modificarStock`(IN Id INT, IN Stock INT, IN TipoInventario TINYTEXT)
BEGIN 
    IF TipoInventario = "Prima" THEN
        UPDATE inventario_materia_prima SET stock = Stock WHERE idInventario = Id AND estado = 1;
    ELSEIF TipoInventario = "Material" THEN
        UPDATE inventario_materiales SET stock = Stock WHERE idInventarioMaterial = Id AND estado = 1;
    ELSEIF TipoInventario = "Herramienta" THEN
        UPDATE inventario_herramientas SET stock = Stock WHERE idInventarioHerramienta = Id AND estado = 1;
    ELSEIF TipoInventario = "General" THEN
        UPDATE inventario_general SET stock = Stock WHERE idInventarioGeneral = Id AND estado = 1;
    END IF;
END;

DROP PROCEDURE IF EXISTS modificarTalla;
CREATE PROCEDURE `modificarTalla`(IN Descripcion TINYTEXT, IN Id INT)
BEGIN
    UPDATE inventario_tallas SET 
    descripcion = Descripcion
    WHERE idTalla = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarTipo;
CREATE PROCEDURE `modificarTipo`(IN Descripcion TINYTEXT, IN Material TINYTEXT, IN Id INT)
BEGIN
    UPDATE categoria_tipos SET 
    descripcion = Descripcion,  
    material = Material
    WHERE idTipo = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS modificarTipoEmpleado;
CREATE PROCEDURE `modificarTipoEmpleado`(IN Descripcion TINYTEXT, IN Rol INT, IN Id INT)
BEGIN
    UPDATE tipo_empleado SET descripcion = Descripcion, idRol = Rol WHERE idTipoEmpleado = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerBodega;
CREATE PROCEDURE `obtenerBodega`(IN _id INT)
BEGIN
    SELECT * FROM bodegas WHERE idBodega = _id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerBodegas;
CREATE PROCEDURE `obtenerBodegas`()
BEGIN
    SELECT * FROM bodegas WHERE estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerCatalogo;
CREATE PROCEDURE `obtenerCatalogo`(IN Id INT)
BEGIN 
    SELECT * FROM catalogo WHERE idCatalogo = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerCatalogos;
CREATE PROCEDURE `obtenerCatalogos`()
BEGIN
    SELECT * FROM catalogo WHERE estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerCategoria;
CREATE PROCEDURE `obtenerCategoria`(IN Id INT)
BEGIN
    SELECT * FROM vw_categorias WHERE idCategoria=Id;
END;

DROP PROCEDURE IF EXISTS obtenerCategorias;
CREATE PROCEDURE `obtenerCategorias`()
BEGIN
    SELECT * FROM vw_categorias;
END;

DROP PROCEDURE IF EXISTS obtenerCategoriasPorTipo;
CREATE PROCEDURE `obtenerCategoriasPorTipo`(IN Tipo INT)
BEGIN
    SELECT idCategoria,estilo FROM vw_categorias WHERE idTipo=Tipo;
END;

DROP PROCEDURE IF EXISTS obtenerCliente;
CREATE PROCEDURE `obtenerCliente`(IN Id INT)
BEGIN
    SELECT * FROM clientes JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = clientes.idFoto WHERE idCliente = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerClientes;
CREATE PROCEDURE `obtenerClientes`()
BEGIN   
    SELECT * FROM clientes JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = clientes.idFoto WHERE estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerCotizacion;
CREATE PROCEDURE `obtenerCotizacion`(IN Id INT)
BEGIN 
    SELECT idCotizacion,descripcion FROM cotizaciones WHERE idCotizacion = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerCotizaciones;
CREATE PROCEDURE `obtenerCotizaciones`()
BEGIN 
    SELECT idCotizacion,descripcion FROM cotizaciones WHERE estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerCotizacionEstado;
CREATE PROCEDURE `obtenerCotizacionEstado`(IN EstadoC VARCHAR(32))
BEGIN
    SELECT idCotizacion, fecha, descripcion, idEmpleado, nombreEmpleado, idCliente, nombreCliente, estadoCotizacion
    FROM vw_cotizaciones WHERE estadoCotizacion = EstadoC;
END;

DROP PROCEDURE IF EXISTS obtenerEmpleado;
CREATE PROCEDURE `obtenerEmpleado`(IN Id INT )
BEGIN
    SELECT * FROM empleados JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = empleados.idFoto WHERE idEmpleado = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerEmpleados;
CREATE PROCEDURE `obtenerEmpleados`()
BEGIN
    SELECT * FROM empleados JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = empleados.idFoto WHERE estado=1;
END;

DROP PROCEDURE IF EXISTS obtenerEmpleadosPorTipo;
CREATE PROCEDURE `obtenerEmpleadosPorTipo`(IN Tipo INT )
BEGIN
    SELECT * FROM empleados JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = empleados.idFoto WHERE tipoEmpleado = Tipo AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerFichaProducto;
CREATE PROCEDURE `obtenerFichaProducto`(IN _id INT)
BEGIN
    SELECT * FROM vw_ficha_producto WHERE idFichaProducto = _id;
END;

DROP PROCEDURE IF EXISTS obtenerFichasProductos;
CREATE PROCEDURE `obtenerFichasProductos`()
BEGIN
    SELECT * FROM vw_ficha_producto;
END;

DROP PROCEDURE IF EXISTS obtenerFotoProducto;
CREATE PROCEDURE `obtenerFotoProducto`(IN Id INT)
BEGIN
    SELECT idFotografia,idProducto,fotografia,nombreFoto,tamanoFoto,formatoFoto
    FROM fotografias_productos WHERE idProducto = Id AND estado = 1 LIMIT 1;
END;

DROP PROCEDURE IF EXISTS obtenerFotosProducto;
CREATE PROCEDURE `obtenerFotosProducto`(IN Id INT)
BEGIN
    SELECT idFotografia,idProducto,fotografia,nombreFoto,tamanoFoto,formatoFoto
    FROM fotografias_productos WHERE idProducto = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerGuia;
CREATE PROCEDURE `obtenerGuia`(IN id INT)
BEGIN
    SELECT * FROM vw_guia_remision WHERE idGuia = id;
END;

DROP PROCEDURE IF EXISTS obtenerGuias;
CREATE PROCEDURE `obtenerGuias`()
BEGIN
    SELECT * FROM vw_guia_remision;
END;

DROP PROCEDURE IF EXISTS obtenerHerramienta;
CREATE PROCEDURE `obtenerHerramienta`(IN Id INT)
BEGIN 
    SELECT * FROM vw_inventario_herramientas WHERE idInventario = Id;
END;

DROP PROCEDURE IF EXISTS obtenerHerramientas;
CREATE PROCEDURE `obtenerHerramientas`()
BEGIN 
    SELECT * FROM vw_inventario_herramientas;
END;

DROP PROCEDURE IF EXISTS obtenerId;
CREATE PROCEDURE `obtenerId`(IN Us TINYTEXT)
BEGIN 
DECLARE ID INT;
    SELECT id INTO ID FROM vw_usuarios WHERE usuario = Us;
    SELECT idUsuario FROM vw_usuarios WHERE id = ID;
END;

DROP PROCEDURE IF EXISTS obtenerInvGeneral;
CREATE PROCEDURE `obtenerInvGeneral`(IN Id INT)
BEGIN 
    SELECT * FROM vw_inventario_general WHERE idInventario = Id;
END;

DROP PROCEDURE IF EXISTS obtenerInvGenerales;
CREATE PROCEDURE `obtenerInvGenerales`()
BEGIN 
    SELECT * FROM vw_inventario_general;
END;

DROP PROCEDURE IF EXISTS obtenerInvGeneralesPorBodega;
CREATE PROCEDURE `obtenerInvGeneralesPorBodega`(IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_general WHERE idBodega = Bodega;
END;

DROP PROCEDURE IF EXISTS obtenerInvHerramientasPorBodega;
CREATE PROCEDURE `obtenerInvHerramientasPorBodega`(IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_herramientas WHERE idBodega = Bodega;
END;

DROP PROCEDURE IF EXISTS obtenerInvMaterialesPorBodega;
CREATE PROCEDURE `obtenerInvMaterialesPorBodega`(IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_materiales WHERE idBodega = Bodega;
END;

DROP PROCEDURE IF EXISTS obtenerInvPrimasPorBodega;
CREATE PROCEDURE `obtenerInvPrimasPorBodega`(IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario WHERE idBodega = Bodega;
END;

DROP PROCEDURE IF EXISTS obtenerMaterial;
CREATE PROCEDURE `obtenerMaterial`(IN Id INT)
BEGIN 
    SELECT * FROM vw_inventario_materiales WHERE idInventario = Id;
END;

DROP PROCEDURE IF EXISTS obtenerMateriales;
CREATE PROCEDURE `obtenerMateriales`()
BEGIN 
    SELECT * FROM vw_inventario_materiales;
END;

DROP PROCEDURE IF EXISTS obtenerMaterialesFichaProducto;
CREATE PROCEDURE `obtenerMaterialesFichaProducto`(IN _idFichaProducto INT)
BEGIN
    SELECT * FROM vw_materiales_ficha_producto WHERE idFichaProducto = _idFichaProducto;
END;

DROP PROCEDURE IF EXISTS obtenerMaterialesGuia;
CREATE PROCEDURE `obtenerMaterialesGuia`(IN _guia INT)
BEGIN
    SELECT * FROM vw_materiales_remision WHERE idGuia = _guia;
END;

DROP PROCEDURE IF EXISTS obtenerMaterialesProductoFinal;
CREATE PROCEDURE `obtenerMaterialesProductoFinal`(IN _idProductoFinal INT)
BEGIN
    SELECT * FROM vw_materiales_inventario_final WHERE idInventarioFinal = _idProductoFinal;
END;

DROP PROCEDURE IF EXISTS obtenerMaterialGuia;
CREATE PROCEDURE `obtenerMaterialGuia`(IN _guia INT, IN _material INT)
BEGIN
    SELECT * FROM vw_materiales_remision WHERE idGuia = _guia AND idMaterial = _material;
END;

DROP PROCEDURE IF EXISTS obtenerMateriaPrimaGuia;
CREATE PROCEDURE `obtenerMateriaPrimaGuia`(IN _guia INT, IN _materia INT)
BEGIN
    SELECT * FROM vw_materia_prima_remision WHERE idGuia = _guia AND idMateriaPrima = _materia;
END;

DROP PROCEDURE IF EXISTS obtenerMateriasPrimasGuia;
CREATE PROCEDURE `obtenerMateriasPrimasGuia`(IN _guia INT)
BEGIN
    SELECT * FROM vw_materia_prima_remision WHERE idGuia = _guia;
END;

DROP PROCEDURE IF EXISTS obtenerOrdenes;
CREATE PROCEDURE `obtenerOrdenes`()
BEGIN
    SELECT * FROM vw_ordenes;
END;

DROP PROCEDURE IF EXISTS obtenerOrdenesPorEstado;
CREATE PROCEDURE `obtenerOrdenesPorEstado`(IN Estado VARCHAR(32))
BEGIN
    SELECT * FROM vw_ordenes WHERE estadoOrden = Estado;
END;

DROP PROCEDURE IF EXISTS obtenerPermisos;
CREATE PROCEDURE `obtenerPermisos`(IN Id INT)
BEGIN
    SELECT rol.idRol,rol.empleados,rol.clientes,rol.inventario,rol.guiaRemision,
    rol.bodegas,rol.catalogo,rol.cotizacion,rol.pedido,rol.configuracion
    FROM roles rol 
    JOIN vw_usuarios us ON us.idRol = rol.idRol
    WHERE us.idUsuario = Id;
END;

DROP PROCEDURE IF EXISTS obtenerProceso;
CREATE PROCEDURE `obtenerProceso`(IN _id INT)
BEGIN
    SELECT idProceso,descripcion FROM procesos WHERE idProceso = _id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerProcesos;
CREATE PROCEDURE `obtenerProcesos`()
BEGIN
    SELECT idProceso,descripcion FROM procesos WHERE estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerProducto;
CREATE PROCEDURE `obtenerProducto`(IN Id INT)
BEGIN
    SELECT * FROM vw_inventario WHERE vw_inventario.idInventario = Id;
END;

DROP PROCEDURE IF EXISTS obtenerProductoFinal;
CREATE PROCEDURE `obtenerProductoFinal`(IN _id INT)
BEGIN
    SELECT * FROM vw_inventario_final_producto WHERE idInventarioFinal = _id;
END;

DROP PROCEDURE IF EXISTS obtenerProductos;
CREATE PROCEDURE `obtenerProductos`()
BEGIN
    SELECT * FROM vw_inventario;
END;

DROP PROCEDURE IF EXISTS obtenerProductosCotizados;
CREATE PROCEDURE `obtenerProductosCotizados`(IN Id INT)
BEGIN 
    SELECT productos_cotizados.idCotizacion,productos_cotizados.IdProducto,catalogo.nombreProducto,
    catalogo.descripcionProducto,catalogo.precio, productos_cotizados.cantidad 
    FROM productos_cotizados
    JOIN cotizaciones ON cotizaciones.idCotizacion = productos_cotizados.idCotizacion
    JOIN catalogo ON productos_cotizados.idProducto = catalogo.idCatalogo
    WHERE productos_cotizados.idCotizacion = Id AND productos_cotizados.estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerProductosFinales;
CREATE PROCEDURE `obtenerProductosFinales`()
BEGIN
    SELECT * FROM vw_inventario_final_producto;
END;

DROP PROCEDURE IF EXISTS obtenerRol;
CREATE PROCEDURE `obtenerRol`(IN Id INT)
BEGIN
    SELECT * FROM roles WHERE idRol = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerRoles;
CREATE PROCEDURE `obtenerRoles`()
BEGIN
    SELECT * FROM roles WHERE estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerTalla;
CREATE PROCEDURE `obtenerTalla`(IN Id INT)
BEGIN
    SELECT * FROM inventario_tallas WHERE estado = 1 AND idTalla=Id;
END;

DROP PROCEDURE IF EXISTS obtenerTallas;
CREATE PROCEDURE `obtenerTallas`()
BEGIN
    SELECT * FROM inventario_tallas WHERE estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerTipo;
CREATE PROCEDURE `obtenerTipo`(IN Id INT)
BEGIN
    SELECT * FROM categoria_tipos WHERE estado = 1 AND idTipo=Id;
END;

DROP PROCEDURE IF EXISTS obtenerTipoEmpleado;
CREATE PROCEDURE `obtenerTipoEmpleado`(IN Id INT)
BEGIN
    SELECT * FROM tipo_empleado WHERE idTipoEmpleado = Id AND estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerTipoEmpleados;
CREATE PROCEDURE `obtenerTipoEmpleados`()
BEGIN
    SELECT * FROM tipo_empleado WHERE estado = 1;
END;

DROP PROCEDURE IF EXISTS obtenerTipos;
CREATE PROCEDURE `obtenerTipos`()
BEGIN
    SELECT * FROM categoria_tipos WHERE estado = 1;
END;

DROP Function IF EXISTS comprobarExistenciaBodega;
CREATE FUNCTION `comprobarExistenciaBodega`(_tipo TINYTEXT,_idInv INT, _idBodega INT) RETURNS tinyint(1)
BEGIN 
    DECLARE c INT;
    IF _tipo = "MATERIAL" THEN
        SELECT COUNT(*) INTO c FROM inventario_materiales 
        WHERE idInventarioMaterial = _idInv AND idBodega = _idBodega;
    ELSEIF _tipo = "MATERIA" THEN
        SELECT COUNT(*) INTO c FROM inventario_materia_prima 
        WHERE idInventario = _idInv AND idBodega = _idBodega;
    END IF;
    IF c = 1 THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
END;

DROP Function IF EXISTS crearInventarioBodega;
CREATE FUNCTION `crearInventarioBodega`(_tipo TINYTEXT, _idInv INT, _idBodega INT, _stock INT) RETURNS tinyint(1)
BEGIN 
    DECLARE _descripcion TINYTEXT;
    DECLARE _marca TINYTEXT;
    DECLARE _idProveedor INT;
    DECLARE _precio DECIMAL(9,2);
    DECLARE _puntoReorden INT;
    DECLARE _idCategoria INT;
    DECLARE _idTalla INT;
    DECLARE _color TINYTEXT;
    IF _tipo = "MATERIAL" THEN
        SELECT descripcion, marca, idProveedor, precio, puntoReorden INTO _descripcion, _marca, _idProveedor, _precio, _puntoReorden
        FROM inventario_materiales WHERE idInventarioMaterial = _idInv;
        
        INSERT INTO inventario_materiales(descripcion, marca, idProveedor, precio, puntoReorden,idBodega)
        VALUES (descripcion, _marca, _idProveedor, _precio, _puntoReorden,_idBodega);
    ELSEIF _tipo = "MATERIA" THEN
        SELECT descripcion,idCategoria,idProveedor,idTalla,color,precio INTO _descripcion, _idCategoria, _idProveedor, _idTalla, _color, _precio 
        FROM inventario_materia_prima WHERE idInventario = _idInv;

        INSERT INTO inventario_materia_prima(descripcion,idCategoria,idProveedor,idTalla,color,stock,precio)
        VALUES(_descripcion,_categoria,_proveedor,_talla,_color,_stock,_precio);
    END IF;
    RETURN TRUE;
END;

DROP Function IF EXISTS generarCodigoGuia;
CREATE FUNCTION `generarCodigoGuia`() RETURNS tinytext CHARSET utf8 COLLATE utf8_spanish_ci
BEGIN
    DECLARE __idGuia INT;
    DECLARE codGuia TINYTEXT;
    DECLARE ceros INT;
    SELECT COUNT(*) INTO __idGuia FROM guia_remision;
    SET __idGuia := __idGuia + 1;
    SET ceros := 8-LENGTH(__idGuia);
    SET codGuia :="";
    WHILE ceros > 0 DO
        SET codGuia := CONCAT(codGuia,"0");
        SET ceros:= ceros-1;
    END WHILE;
    SET codGuia := CONCAT (codGuia,__idGuia);
    RETURN codGuia;
END;

DROP TRIGGER IF EXISTS tg_crearCatSinEstilo;
CREATE TRIGGER tg_crearCatSinEstilo
AFTER INSERT ON categoria_tipos
FOR EACH ROW
BEGIN
    INSERT INTO inventario_categorias(idTipo,estilo) VALUES (NEW.idTipo,"Sin Estilo");
END;