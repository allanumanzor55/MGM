DROP PROCEDURE IF EXISTS agregarCategoria; 
DROP PROCEDURE IF EXISTS obtenerCategoria;
DROP PROCEDURE IF EXISTS obtenerCategorias;
DROP PROCEDURE IF EXISTS eliminarCategoria;
DROP PROCEDURE IF EXISTS modificarCategoria;
DROP PROCEDURE IF EXISTS buscarCategoria;
DROP PROCEDURE IF EXISTS agregarEstilo;
DROP PROCEDURE IF EXISTS obtenerEstilo;
DROP PROCEDURE IF EXISTS obtenerEstilos;
DROP PROCEDURE IF EXISTS eliminarEstilo;
DROP PROCEDURE IF EXISTS modificarEstilo;
DROP PROCEDURE IF EXISTS buscarEstilo;
DROP PROCEDURE IF EXISTS agregarProveedor;
DELIMITER /
/**CATEGORIAS**/
CREATE PROCEDURE agregarCategoria(IN _categoria TINYTEXT)
BEGIN
    INSERT INTO inventario_categorias(descripcion) VALUES (_categoria);
END/

CREATE PROCEDURE obtenerCategorias()
BEGIN
    SELECT * FROM inventario_categorias WHERE estado = 1;
END/

CREATE PROCEDURE obtenerCategoria(IN _id INT)
BEGIN
    SELECT * FROM inventario_categorias WHERE estado = 1 AND idCategoria=_id;
END/

CREATE PROCEDURE eliminarCategoria(IN _id INT)
BEGIN
    UPDATE inventario_categorias SET estado = 0 WHERE idCategoria = _id AND estado = 1;
END/

CREATE PROCEDURE modificarCategoria(IN _categoria TINYTEXT,IN _id INT)
BEGIN
    UPDATE inventario_categorias SET descripcion = _categoria WHERE idCategoria = _id AND estado = 1;
END/

CREATE PROCEDURE buscarCategoria(IN _valor TINYTEXT)
BEGIN 
    SELECT * FROM inventario_categorias 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',_valor,'%'));
END/

/** ESTILOS**/
CREATE PROCEDURE agregarEstilo(IN _estilo TINYTEXT)
BEGIN 
    INSERT INTO inventario_estilos(descripcion) VALUES (_estilo);
END/


CREATE PROCEDURE obtenerEstilos()
BEGIN
    SELECT * FROM inventario_estilos WHERE estado = 1;
END/

CREATE PROCEDURE obtenerEstilo(IN _id INT)
BEGIN
    SELECT * FROM inventario_estilos WHERE estado = 1 AND idEstilo=_id;
END/

CREATE PROCEDURE eliminarEstilo(IN _id INT)
BEGIN
    UPDATE inventario_estilos SET estado = 0 WHERE idEstilo = _id AND estado = 1;
END/

CREATE PROCEDURE modificarEstilo(IN _estilo TINYTEXT,IN _id INT)
BEGIN
    UPDATE inventario_estilos SET descripcion = _estilo WHERE idEstilo = _id AND estado = 1;
END/

CREATE PROCEDURE buscarEstilo(IN _valor TINYTEXT)
BEGIN 
    SELECT * FROM inventario_estilos 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',_valor,'%'));
END/


CREATE PROCEDURE agregarProveedor(IN _nombre TINYTEXT, IN _direccion TINYTEXT, IN _correo TINYTEXT,
IN _telefono TINYTEXT, IN _celular TINYTEXT)
BEGIN
    INSERT INTO inventario_proveedores(nombre,direccion,correo,telefono,celular)
    VALUES(_nombre,_direccion,_correo,_telefono,_celular);
END/
