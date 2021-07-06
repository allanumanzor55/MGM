DELIMITER  /
CREATE OR REPLACE PROCEDURE agregarBodega(IN _descripcion TINYTEXT, IN _ubicacion  TINYTEXT)
BEGIN
    INSERT INTO bodegas(descripcion,ubicacion) VALUES (_descripcion,_ubicacion);
END/

CREATE OR REPLACE PROCEDURE modificarBodega(IN _descripcion TINYTEXT, IN _ubicacion TINYTEXT, IN _id INT)
BEGIN 
    UPDATE bodegas SET descripcion = _descripcion, ubicacion = _ubicacion WHERE idBodega = _id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerBodegas()
BEGIN
    SELECT * FROM bodegas WHERE estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerBodega(IN _id INT)
BEGIN
    SELECT * FROM bodegas WHERE idBodega = _id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE  eliminarBodega(IN _id INT)
BEGIN
    UPDATE bodegas SET estado = 0 WHERE idBodega = _id;
END/