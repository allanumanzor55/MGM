CREATE OR REPLACE VIEW vw_categorias
AS
SELECT  inventario_categorias.idCategoria as "idCategoria",categoria_tipos.idTipo, categoria_tipos.descripcion as "tipo", categoria_tipos.material as "material",
        inventario_categorias.estilo as "estilo"
        FROM inventario_categorias
        JOIN categoria_tipos ON inventario_categorias.idTipo = categoria_tipos.idTipo
        WHERE inventario_categorias.estado = 1 AND categoria_tipos.estado=1;

CREATE OR REPLACE VIEW vw_inventario
AS
SELECT  inventario.idInventario, vw_categorias.idCategoria, vw_categorias.tipo, vw_categorias.material, vw_categorias.estilo,
        inventario_proveedores.idProveedor, inventario_proveedores.proveedor,inventario_proveedores.nombreContacto, inventario_proveedores.correoContacto,
        inventario_proveedores.telefonoContacto, inventario.descripcion, inventario.idTalla, 
        inventario_tallas.descripcion as "talla", inventario.color, inventario.stock, inventario.precio
FROM inventario
JOIN vw_categorias ON vw_categorias.idCategoria = inventario.idCategoria 
JOIN inventario_proveedores ON inventario_proveedores.idProveedor = inventario.idProveedor
JOIN inventario_tallas ON inventario_tallas.idTalla = inventario.idTalla
WHERE inventario.estado=1;
1

