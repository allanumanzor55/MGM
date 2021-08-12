DELIMITER /

CREATE OR REPLACE PROCEDURE obtenerFotosProducto(IN Id INT)
BEGIN
    SELECT idFotografia,idProducto,fotografia,nombreFoto,tamanoFoto,formatoFoto
    FROM fotografias_productos WHERE idProducto = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerFotoProducto(IN Id INT)
BEGIN
    SELECT idFotografia,idProducto,fotografia,nombreFoto,tamanoFoto,formatoFoto
    FROM fotografias_productos WHERE idProducto = Id AND estado = 1 LIMIT 1;
END/