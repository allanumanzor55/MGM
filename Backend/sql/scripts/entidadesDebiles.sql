DROP PROCEDURE IF EXISTS agregarCategoria; 
DROP PROCEDURE IF EXISTS obtenerCategoria;
DROP PROCEDURE IF EXISTS obtenerCategorias;
DROP PROCEDURE IF EXISTS eliminarCategoria;
DROP PROCEDURE IF EXISTS modificarCategoria;
DROP PROCEDURE IF EXISTS buscarCategoria;
DROP PROCEDURE IF EXISTS agregarTipo;
DROP PROCEDURE IF EXISTS obtenerTipo;
DROP PROCEDURE IF EXISTS obtenerTipos;
DROP PROCEDURE IF EXISTS eliminarTipo;
DROP PROCEDURE IF EXISTS modificarTipo;
DROP PROCEDURE IF EXISTS buscarTipo;
DROP PROCEDURE IF EXISTS agregarTalla;
DROP PROCEDURE IF EXISTS obtenerTalla;
DROP PROCEDURE IF EXISTS obtenerTallas;
DROP PROCEDURE IF EXISTS eliminarTalla;
DROP PROCEDURE IF EXISTS modificarTalla;
DROP PROCEDURE IF EXISTS buscarTalla;
DROP PROCEDURE IF EXISTS agregarProveedor;
DROP PROCEDURE IF EXISTS eliminarProveedor;
DELIMITER /
/**CATEGORIAS**/
CREATE PROCEDURE agregarCategoria(IN _tipo INT, IN _estilo TINYTEXT)
BEGIN
    INSERT INTO inventario_categorias(idTipo,estilo) VALUES (_tipo,_estilo);
END/

CREATE PROCEDURE obtenerCategorias()
BEGIN
    SELECT * FROM vw_categorias;
END/

CREATE PROCEDURE obtenerCategoria(IN _id INT)
BEGIN
    SELECT * FROM vw_categorias WHERE idCategoria=_id;
END/

CREATE PROCEDURE eliminarCategoria(IN _id INT)
BEGIN
    UPDATE inventario_categorias SET estado = 0 WHERE idCategoria = _id;
    UPDATE inventario_categorias
    JOIN inventario ON inventario_categorias.idCategoria = inventario.idCategoria 
    SET 
    inventario_categorias.estado = 0,
    inventario.estado=0 
    WHERE inventario_categorias.idCategoria = _id;
END/

CREATE PROCEDURE modificarCategoria(IN _tipo INT, IN _estilo TINYTEXT, IN _id INT)
BEGIN
    UPDATE inventario_categorias SET 
        idTipo = _tipo,
        estilo = _estilo
    WHERE idCategoria = _id AND estado = 1;
END/

CREATE PROCEDURE buscarCategoria(IN _valor TINYTEXT)
BEGIN 
    SELECT * FROM inventario_categorias 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',_valor,'%'));
END/
/** TIPOS**/
CREATE PROCEDURE agregarTipo(IN _descripcion TINYTEXT, IN _material TINYTEXT)
BEGIN 
    INSERT INTO categoria_tipos(descripcion,material) VALUES (_descripcion,_material);
END/


CREATE PROCEDURE obtenerTipos()
BEGIN
    SELECT * FROM categoria_tipos WHERE estado = 1;
END/

CREATE PROCEDURE obtenerTipo(IN _id INT)
BEGIN
    SELECT * FROM categoria_tipos WHERE estado = 1 AND idTipo=_id;
END/

CREATE PROCEDURE eliminarTipo(IN _id INT)
BEGIN
    UPDATE categoria_tipos SET estado = 0 WHERE idTipo = _id;
    
    UPDATE categoria_tipos 
    JOIN inventario_categorias ON categoria_tipos.idTipo = inventario_categorias.idTipo
    SET 
    categoria_tipos.estado=0,
    inventario_categorias.estado = 0
    WHERE categoria_tipos.idTipo = _id AND inventario_categorias.idTipo = _id;
    
    UPDATE inventario 
    JOIN inventario_categorias ON inventario.idCategoria = inventario_categorias.idCategoria
    SET
    inventario.estado=0
    WHERE inventario_categorias.idTipo=_id;
END/

CREATE PROCEDURE modificarTipo(IN _descripcion TINYTEXT, IN _material TINYTEXT, IN _id INT)
BEGIN
    UPDATE categoria_tipos SET 
    descripcion = _descripcion,  
    material = _material
    WHERE idTipo = _id AND estado = 1;
END/

CREATE PROCEDURE buscarTipo(IN _valor TINYTEXT)
BEGIN 
    SELECT * FROM categoria_tipos 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',_valor,'%'));
END/

/** TALLAS**/
CREATE PROCEDURE agregarTalla(IN _descripcion TINYTEXT)
BEGIN 
    INSERT INTO inventario_tallas(descripcion) VALUES (_descripcion);
END/


CREATE PROCEDURE obtenerTallas()
BEGIN
    SELECT * FROM inventario_tallas WHERE estado = 1;
END/

CREATE PROCEDURE obtenerTalla(IN _id INT)
BEGIN
    SELECT * FROM inventario_tallas WHERE estado = 1 AND idTalla=_id;
END/

CREATE PROCEDURE eliminarTalla(IN _id INT)
BEGIN
    UPDATE inventario_tallas SET estado = 0 WHERE idTalla = _id;
    UPDATE inventario_tallas
    JOIN inventario ON inventario_tallas.idTalla = inventario.idTalla
    SET inventario_tallas.estado = 0,inventario.estado=0 
    WHERE inventario_tallas.idTalla = _id AND inventario_tallas.estado = 1;
END/

CREATE PROCEDURE modificarTalla(IN _descripcion TINYTEXT, IN _id INT)
BEGIN
    UPDATE inventario_tallas SET 
    descripcion = _descripcion
    WHERE idTalla = _id AND estado = 1;
END/

CREATE PROCEDURE buscarTalla(IN _valor TINYTEXT)
BEGIN 
    SELECT * FROM inventario_tallas 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',_valor,'%'));
END/

/**PROVEEDORES**/
CREATE PROCEDURE agregarProveedor(IN _nombre TINYTEXT, IN _direccion TINYTEXT, IN _correo TINYTEXT,
IN _telefono TINYTEXT, IN _celular TINYTEXT)
BEGIN
    INSERT INTO inventario_proveedores(nombre,direccion,correo,telefono,celular)
    VALUES(_nombre,_direccion,_correo,_telefono,_celular);
END/

CREATE PROCEDURE eliminarProveedor(IN _id INT)
BEGIN
    UPDATE inventario_proveedores
    JOIN inventario ON inventario_proveedores.idProveedor = inventario.idProveedor
    SET inventario_proveedores.estado=0,inventario.estado=0
    WHERE inventario_proveedores.idProveedor=_id AND inventario_proveedores.estado=1;
END/
