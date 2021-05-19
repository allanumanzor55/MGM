DROP PROCEDURE IF EXISTS agregarProducto;
DROP PROCEDURE IF EXISTS obtenerProducto;
DROP PROCEDURE IF EXISTS obtenerProductos;
DROP PROCEDURE IF EXISTS modificarProducto;
DROP PROCEDURE IF EXISTS eliminarProducto;
DELIMITER /
CREATE PROCEDURE agregarProducto(IN _descripcion TINYTEXT, IN _categoria INT, IN _proveedor INT, IN _talla INT,
                                IN _color TINYTEXT, IN _stock INT, IN _precio DECIMAL(9,2))
BEGIN
    INSERT INTO inventario(descripcion,idCategoria,idProveedor,idTalla,color,stock,precio)
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
    UPDATE inventario SET
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
    UPDATE inventario SET estado = 0 WHERE idInventario = _id AND estado = 1;
END/