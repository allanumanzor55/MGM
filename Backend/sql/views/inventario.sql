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