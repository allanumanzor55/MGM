DROP PROCEDURE IF EXISTS agregarProducto;
DROP PROCEDURE IF EXISTS obtenerProducto;
DROP PROCEDURE IF EXISTS obtenerProductos;
DROP PROCEDURE IF EXISTS modificarProducto;
DROP PROCEDURE IF EXISTS eliminarProducto;
DROP PROCEDURE IF EXISTS buscarProducto;
DROP PROCEDURE IF EXISTS agregarMaterial;
DROP PROCEDURE IF EXISTS obtenerMaterial;
DROP PROCEDURE IF EXISTS obtenerMateriales;
DROP PROCEDURE IF EXISTS modificarMaterial;
DROP PROCEDURE IF EXISTS eliminarMaterial;
DROP PROCEDURE IF EXISTS agregarHerramienta;
DROP PROCEDURE IF EXISTS obtenerHerramienta;
DROP PROCEDURE IF EXISTS obtenerHerramientas;
DROP PROCEDURE IF EXISTS modificarHerramienta;
DROP PROCEDURE IF EXISTS eliminarHerramienta;
DROP PROCEDURE IF EXISTS agregarInvGeneral;
DROP PROCEDURE IF EXISTS obtenerInvGeneral;
DROP PROCEDURE IF EXISTS obtenerInvGenerales;
DROP PROCEDURE IF EXISTS modificarInvGeneral;
DROP PROCEDURE IF EXISTS eliminarInvGeneral;
/**INVENTARIO MATERIA PRIMA **/
DELIMITER /
CREATE PROCEDURE agregarProducto(IN _descripcion TINYTEXT, IN _categoria INT, IN _proveedor INT, IN _talla INT,
                                IN _color TINYTEXT, IN _stock INT, IN _precio DECIMAL(9,2))
BEGIN
    INSERT INTO inventario_materia_prima(descripcion,idCategoria,idProveedor,idTalla,color,stock,precio)
    VALUES(_descripcion,_categoria,_proveedor,_talla,_color,_stock,_precio);
END/

CREATE PROCEDURE obtenerProducto(IN _id INT)
BEGIN
    SELECT * FROM vw_inventario WHERE vw_inventario.idInventario = _id;
END/

CREATE PROCEDURE obtenerProductos()
BEGIN
    SELECT * FROM vw_inventario;
END/

CREATE PROCEDURE modificarProducto(IN _descripcion TINYTEXT, IN _categoria INT, IN _proveedor INT, IN _talla INT,
                                IN _color TINYTEXT, IN _stock INT, IN _precio DECIMAL(9,2), IN _id INT)
BEGIN
    UPDATE inventario_materia_prima SET
        descripcion = _descripcion,
        idCategoria = _categoria,
        idProveedor = _proveedor,
        idTalla = _talla,
        color = _color,
        stock = _stock,
        precio = _precio
    WHERE idInventario = _id AND estado = 1;
END/

CREATE PROCEDURE eliminarProducto(IN _id INT)
BEGIN
    UPDATE inventario_materia_prima SET estado = 0 WHERE idInventario = _id AND estado = 1;
END/

CREATE PROCEDURE buscarProducto(IN _valor TINYTEXT)
BEGIN 
    SELECT * FROM vw_inventario WHERE 
    (descripcion LIKE CONCAT('%',_valor,'%') OR tipo LIKE CONCAT('%',_valor,'%') OR estilo LIKE CONCAT('%',_valor,'%'));
END/

/** INVENTARIO MATERIALES **/

CREATE PROCEDURE agregarMaterial(IN _descripcion TINYTEXT, IN _marca TINYTEXT, IN _proveedor INT, IN _precio DECIMAL(9,2), IN _stock INT)
BEGIN
    INSERT INTO inventario_materiales(descripcion,marca,idProveedor,precio,stock)
    VALUE (_descripcion,_marca,_proveedor,_precio,_stock);
END/

CREATE PROCEDURE obtenerMaterial(IN _id INT)
BEGIN 
    SELECT * FROM vw_inventario_materiales WHERE idInventario = _id;
END/

CREATE PROCEDURE obtenerMateriales()
BEGIN 
    SELECT * FROM vw_inventario_materiales;
END/

CREATE PROCEDURE eliminarMaterial(IN _id INT)
BEGIN
    UPDATE inventario_materiales SET estado = 0 WHERE idInventarioMaterial = _id AND estado = 1;
END/

CREATE PROCEDURE modificarMaterial(IN _descripcion TINYTEXT, IN _marca TINYTEXT, IN _proveedor INT, IN _precio DECIMAL(9,2), IN _stock INT, IN _id INT)
BEGIN
    UPDATE inventario_materiales 
    SET
        descripcion = _descripcion,
        marca = _marca,
        idProveedor = _proveedor,
        precio = _precio,
        stock = _stock
    WHERE idInventarioMaterial = _id AND estado = 1;
END/

/** INVENTARIO HERRAMIENTAS **/

CREATE PROCEDURE agregarHerramienta(IN _descripcion TINYTEXT, IN _marca TINYTEXT, IN _proveedor INT, IN _stock INT)
BEGIN
    INSERT INTO inventario_herramientas(descripcion,marca,idProveedor,stock)
    VALUE (_descripcion,_marca,_proveedor,_stock);
END/

CREATE PROCEDURE obtenerHerramienta(IN _id INT)
BEGIN 
    SELECT * FROM vw_inventario_herramientas WHERE idInventario = _id;
END/

CREATE PROCEDURE obtenerHerramientas()
BEGIN 
    SELECT * FROM vw_inventario_herramientas;
END/

CREATE PROCEDURE eliminarHerramienta(IN _id INT)
BEGIN
    UPDATE inventario_herramientas SET estado = 0 WHERE idInventarioHerramienta = _id AND estado = 1;
END/

CREATE PROCEDURE modificarHerramienta(IN _descripcion TINYTEXT, IN _marca TINYTEXT, IN _proveedor INT, IN _stock INT, IN _id INT)
BEGIN
    UPDATE inventario_herramientas 
    SET
        descripcion = _descripcion,
        marca = _marca,
        idProveedor = _proveedor,
        stock = _stock
    WHERE idInventarioHerramienta = _id AND estado = 1;
END/

/** INVENTARIO GENERAL **/

CREATE PROCEDURE agregarInvGeneral(IN _descripcion TINYTEXT, IN _stock INT)
BEGIN
    INSERT INTO inventario_general(descripcion,stock)
    VALUE (_descripcion,_stock);
END/

CREATE PROCEDURE obtenerInvGeneral(IN _id INT)
BEGIN 
    SELECT * FROM vw_inventario_general WHERE idInventario = _id;
END/

CREATE PROCEDURE obtenerInvGenerales()
BEGIN 
    SELECT * FROM vw_inventario_general;
END/

CREATE PROCEDURE eliminarInvGeneral(IN _id INT)
BEGIN
    UPDATE inventario_general SET estado = 0 WHERE idInventarioGeneral = _id AND estado = 1;
END/

CREATE PROCEDURE modificarInvGeneral(IN _descripcion TINYTEXT, IN _stock INT, IN _id INT)
BEGIN
    UPDATE inventario_general 
    SET
        descripcion = _descripcion,
        stock = _stock
    WHERE idInventarioGeneral = _id AND estado = 1;
END/