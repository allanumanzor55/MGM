DELIMITER /
CREATE OR REPLACE PROCEDURE agregarFichaProducto(IN _descripcion TINYTEXT, IN _materiaPrima INT,IN _precio DECIMAL(9,2), OUT idFichaProducto INT)
BEGIN
    INSERT INTO ficha_producto(descripcion,idMateriaPrima,precio)
    VALUES (_descripcion,_materiaPrima,_precio);
    SELECT LAST_INSERT_ID() INTO idFichaProducto;
END/

CREATE OR REPLACE PROCEDURE agregarMaterialesFichaProducto(IN _idFichaProducto INT, IN _idMaterial INT, IN _cantidad INT)
BEGIN
    INSERT INTO ficha_producto_materiales VALUES (_idFichaProducto,_idMaterial,_cantidad,1);
END/

CREATE OR REPLACE PROCEDURE obtenerFichaProducto(IN _id INT)
BEGIN
    SELECT * FROM vw_ficha_producto WHERE idFichaProducto = _id;
END/

CREATE OR REPLACE PROCEDURE obtenerFichasProductos()
BEGIN
    SELECT * FROM vw_ficha_producto;
END/

CREATE OR REPLACE PROCEDURE obtenerMaterialesFichaProducto(IN _idFichaProducto INT)
BEGIN
    SELECT * FROM vw_materiales_ficha_producto WHERE idFichaProducto = _idFichaProducto;
END/

CREATE OR REPLACE PROCEDURE modificarFichaProducto(IN _descripcion TINYTEXT, IN _materiaPrima INT, IN _precio DECIMAL(9,2), IN _id INT)
BEGIN
    UPDATE ficha_producto SET
        descripcion = _descripcion,
        idMateriaPrima = _materiaPrima,
        precio = _precio
    WHERE
        idFichaProducto = _id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarMaterialFichaProducto(IN _idFicha INT,IN _idMaterial INT, IN _cantidad INT, IN cen INT)
BEGIN
    IF cen=0 THEN
        DELETE FROM ficha_producto_materiales WHERE idFichaProducto = _idFicha;
    END IF;
    INSERT INTO ficha_producto_materiales VALUES (_idFicha,_idMaterial,_cantidad,1);
END/

CREATE OR REPLACE PROCEDURE eliminarFichaProducto(IN _id INT)
BEGIN
    UPDATE ficha_producto SET estado = 0 WHERE idFichaProducto = _id;
    UPDATE ficha_producto_materiales SET estado = 0 WHERE idFichaProducto = _id;
END/

CREATE OR REPLACE PROCEDURE eliminarMaterialFichaProducto( IN _idFicha INT, IN _idMaterial INT) 
BEGIN
    UPDATE ficha_producto_materiales SET estado = 0 WHERE idFichaProducto = _idFicha AND idMaterial = _idMaterial;
END/
