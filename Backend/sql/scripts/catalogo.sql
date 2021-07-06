DELIMITER /
CREATE OR REPLACE PROCEDURE guardarCatalogo(IN NombreProducto TINYTEXT, IN DescripcionProducto TINYTEXT, IN Precio DECIMAL(9,2))
BEGIN 
    INSERT INTO catalogo (nombreProducto,descripcionProducto,precio) VALUES (NombreProducto,DescripcionProducto,Precio);
END/

CREATE OR REPLACE PROCEDURE obtenerCatalogos()
BEGIN
    SELECT * FROM catalogo WHERE estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerCatalogo(IN Id INT)
BEGIN 
    SELECT * FROM catalogo WHERE idCatalogo = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE eliminarCatalogo(IN Id INT)
BEGIN 
    UPDATE catalogo SET estado = 0 WHERE  idCatalogo = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarCatalogo(IN NombreProducto TINYTEXT, IN DescripcionProducto TINYTEXT, IN Precio DECIMAL(9,2), IN Id INT)
BEGIN 
    UPDATE catalogo SET nombreProducto = NombreProducto, descripcionProducto = DescripcionProducto, precio = Precio 
    WHERE idCatalogo = Id AND estado = 1;
END/