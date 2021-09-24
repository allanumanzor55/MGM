CREATE OR REPLACE VIEW vw_categorias
AS
SELECT  inventario_categorias.idCategoria as "idCategoria",categoria_tipos.idTipo, categoria_tipos.descripcion as "tipo", categoria_tipos.material as "material",
        inventario_categorias.estilo as "estilo"
        FROM inventario_categorias
        JOIN categoria_tipos ON inventario_categorias.idTipo = categoria_tipos.idTipo
        WHERE inventario_categorias.estado = 1 AND categoria_tipos.estado=1;
CREATE OR REPLACE VIEW vw_inventario
AS
SELECT  inventario.idInventario, vw_categorias.idCategoria, vw_categorias.tipo, vw_categorias.idTipo, vw_categorias.material, vw_categorias.estilo,
        inventario_proveedores.idProveedor, inventario_proveedores.empresa,inventario_proveedores.nombreContacto, inventario_proveedores.correoContacto,
        inventario_proveedores.telefonoContacto, inventario.descripcion, inventario.idTalla, 
        inventario_tallas.descripcion as "talla", inventario.color, inventario.stock, inventario.precio,
        inventario.idBodega, bodega.descripcion as "bodega", inventario.puntoReorden
FROM inventario_materia_prima inventario
JOIN vw_categorias ON vw_categorias.idCategoria = inventario.idCategoria 
JOIN inventario_proveedores ON inventario_proveedores.idProveedor = inventario.idProveedor
JOIN inventario_tallas ON inventario_tallas.idTalla = inventario.idTalla
JOIN bodegas bodega ON inventario.idBodega = bodega.idBodega
WHERE inventario.estado=1;

CREATE OR REPLACE VIEW vw_inventario_materiales
AS
SELECT  inventario.idInventarioMaterial as "idInventario", inventario.marca,
        inventario_proveedores.idProveedor, inventario_proveedores.empresa,inventario_proveedores.nombreContacto, 
        inventario_proveedores.correoContacto,inventario_proveedores.telefonoContacto, inventario.descripcion, 
        inventario.stock, inventario.precio, inventario.idBodega,bodega.descripcion as "bodega", inventario.puntoReorden
FROM inventario_materiales inventario
JOIN inventario_proveedores ON inventario_proveedores.idProveedor = inventario.idProveedor
JOIN bodegas bodega ON inventario.idBodega = bodega.idBodega
WHERE inventario.estado=1;

CREATE OR REPLACE VIEW vw_inventario_herramientas
AS
SELECT  inventario.idInventarioHerramienta as "idInventario", inventario.marca,
        inventario_proveedores.idProveedor, inventario_proveedores.empresa,inventario_proveedores.nombreContacto, 
        inventario_proveedores.correoContacto,inventario_proveedores.telefonoContacto, inventario.descripcion, 
        inventario.stock, inventario.idBodega, bodega.descripcion as "bodega"
FROM inventario_herramientas inventario
JOIN inventario_proveedores ON inventario_proveedores.idProveedor = inventario.idProveedor
JOIN bodegas bodega ON inventario.idBodega = bodega.idBodega
WHERE inventario.estado=1;

CREATE OR REPLACE VIEW vw_inventario_general
AS
SELECT  inventario.idInventarioGeneral as "idInventario",inventario.descripcion, inventario.stock, 
inventario.idBodega, bodega.descripcion as "bodega"
FROM inventario_general inventario
JOIN bodegas bodega ON inventario.idBodega = bodega.idBodega
WHERE inventario.estado=1;


CREATE OR REPLACE VIEW vw_cotizaciones
AS
SELECT cotiz.idCotizacion, cotiz.idEmpleado, CONCAT(emp.nombre,' ',emp.primerApellido) AS "nombreEmpleado",
cotiz.idCliente, CONCAT(cli.nombre,' ',cli.primerApellido) AS "nombreCliente", cotiz.fecha, cotiz.descripcion,
cotiz.EstadoCotizacion FROM cotizaciones cotiz 
JOIN empleados emp ON emp.idEmpleado = cotiz.idEmpleado 
JOIN clientes cli ON cli.idCliente = cotiz.idCliente
WHERE cotiz.estado = 1;

CREATE OR REPLACE VIEW vw_guia_remision
AS
SELECT guia.idGuia, guia.fecha, guia.codigo, emp.nombre, emp.rtn, guia.motivoTraslado, 
guia.bodegaSalida as "idBodegaSalida", bodegaS.descripcion as "bodegaSalida",
guia.bodegaEntrada as "idBodegaEntrada", bodegaE.descripcion as "bodegaEntrada", guia.estadoGuia
FROM guia_remision guia
JOIN datos_empresa emp ON emp.nombre = guia.empresa
JOIN bodegas bodegaS ON guia.bodegaSalida = bodegaS.idBodega
JOIN bodegas bodegaE ON guia.bodegaEntrada = bodegaE.idBodega
WHERE guia.estado = 1;

CREATE OR REPLACE VIEW vw_materiales_remision
AS 
SELECT rem.idGuia, rem.idMaterial, guia.bodegaSalida, guia.bodegaEntrada, material.descripcion, material.marca, rem.cantidad
FROM materiales_remision rem
JOIN vw_inventario_materiales material ON rem.idMaterial = material.idInventario
JOIN vw_guia_remision guia ON rem.idGuia = guia.idGuia
WHERE rem.estado = 1;

CREATE OR REPLACE VIEW vw_materia_prima_remision
AS 
SELECT  
    rem.idGuia, rem.idMateriaPrima, guia.bodegaSalida, guia.bodegaEntrada, materia.descripcion, materia.tipo, materia.estilo, materia.talla, rem.cantidad
FROM materia_prima_remision rem
JOIN vw_inventario materia ON rem.idMateriaPrima = materia.idInventario
JOIN vw_guia_remision guia ON rem.idGuia = guia.idGuia
WHERE rem.estado = 1;

CREATE OR REPLACE VIEW vw_ficha_producto
AS 
SELECT ficha.idFichaProducto, ficha.descripcion as "descripcionFicha", ficha.idMateriaPrima, 
prima.descripcion as "descripcionMateriaPrima", prima.tipo, prima.material, prima.estilo, prima.talla, prima.color,
prima.empresa as "proveedor", prima.precio as "precioPrima", prima.stock, ficha.precio
FROM ficha_producto ficha
JOIN vw_inventario prima ON ficha.idMateriaPrima = prima.idInventario
WHERE ficha.estado = 1;

CREATE OR REPLACE VIEW vw_materiales_ficha_producto
AS 
SELECT ficha.idFichaProducto, ficha.idMaterial, material.descripcion , material.marca, material.empresa,
material.precio , material.stock, ficha.cantidad
FROM ficha_producto_materiales ficha
JOIN vw_inventario_materiales material ON ficha.idMaterial = material.idInventario
WHERE ficha.estado = 1;

CREATE OR REPLACE VIEW vw_ordenes
AS
SELECT orden.idOrden, orden.idCotizacion, orden.fecha, cotiz.descripcion, cotiz.idEmpleado, 
cotiz.nombreEmpleado, cotiz.idCliente, cotiz.nombreCliente, orden.estadoOrden
FROM ordenes orden JOIN vw_cotizaciones cotiz ON orden.idCotizacion = cotiz.idCotizacion
WHERE orden.estado = 1;

CREATE OR REPLACE VIEW vw_productosOrdenes
AS 
SELECT vw_ordenes.idOrden, productos_cotizados.idCotizacion,productos_cotizados.IdProducto,catalogo.nombreProducto,
    catalogo.descripcionProducto,catalogo.precio, productos_cotizados.cantidad 
    FROM productos_cotizados
    JOIN cotizaciones ON cotizaciones.idCotizacion = productos_cotizados.idCotizacion
    JOIN vw_ordenes ON vw_ordenes.idCotizacion = cotizaciones.idCotizacion
    JOIN catalogo ON productos_cotizados.idProducto = catalogo.idCatalogo
    WHERE productos_cotizados.estado = 1;

CREATE OR REPLACE VIEW vw_usuarios
AS
SELECT empleado.idEmpleado as "id",empleado.tipoEmpleado as "idTipo",empleado.dni,empleado.nombre, 
empleado.primerApellido,empleado.segundoApellido,empleado.direccion,empleado.correo,empleado.celular,empleado.telefono,
empleado.sueldo,tipo.descripcion as "tipo",usuario.idUsuario,usuario.usuario,usuario.TipoUsuario, usuario.password,usuario.token,tipo.idRol
FROM empleados empleado 
JOIN tipo_empleado tipo ON empleado.tipoEmpleado = tipo.idTipoEmpleado
JOIN usuarios usuario ON empleado.usuario = usuario.usuario
WHERE empleado.estado = 1
UNION ALL
SELECT cliente.idCliente as "id",cliente.tipoCliente as "idTipo",cliente.dni,cliente.nombre, 
cliente.primerApellido,cliente.segundoApellido,cliente.direccion,cliente.correo,cliente.celular,cliente.telefono,
0,tipo.descripcion as "tipo",usuario.idUsuario,usuario.usuario,usuario.TipoUsuario, usuario.password,usuario.token,tipo.idRol
FROM clientes cliente 
JOIN tipo_cliente tipo ON cliente.tipoCliente = tipo.idTipoCliente
JOIN usuarios usuario ON cliente.usuario = usuario.usuario
WHERE cliente.estado = 1