DROP PROCEDURE IF EXISTS agregarProceso;
DROP PROCEDURE IF EXISTS obtenerProceso;
DROP PROCEDURE IF EXISTS obtenerProcesos;
DROP PROCEDURE IF EXISTS eliminarProceso;
DROP PROCEDURE IF EXISTS modificarProceso;
DROP PROCEDURE IF EXISTS buscarProceso;
DELIMITER /
CREATE PROCEDURE agregarProceso(IN _descripcion TINYTEXT)
BEGIN
    INSERT INTO procesos(descripcion) VALUES (_descripcion);
END/

CREATE PROCEDURE obtenerProceso(IN _id INT)
BEGIN
    SELECT idProceso,descripcion FROM procesos WHERE idProceso = _id AND estado = 1;
END/

CREATE PROCEDURE obtenerProcesos()
BEGIN
    SELECT idProceso,descripcion FROM procesos WHERE estado = 1;
END/

CREATE PROCEDURE eliminarProceso(IN _id INT)
BEGIN
    UPDATE procesos SET estado = 0 WHERE idProceso = _id;
END/

CREATE PROCEDURE modificarProceso(IN _descripcion TINYTEXT, IN _id INT)
BEGIN
    UPDATE procesos SET descripcion = _descripcion WHERE idProceso = _id;
END/

CREATE PROCEDURE buscarProceso(IN _valor TINYTEXT)
BEGIN
    SELECT * FROM procesos
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',_valor,'%'));
END/

