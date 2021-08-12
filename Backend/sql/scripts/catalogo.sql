DELIMITER /
CREATE OR REPLACE PROCEDURE guardarCatalogo(IN NombreProducto TINYTEXT, IN DescripcionProducto TINYTEXT, IN Precio DECIMAL(9,2), IN ExentoImpuesto INT, OUT idCatalogo INT)
BEGIN 
    INSERT INTO catalogo (nombreProducto,descripcionProducto,precio,exentoImpuesto) 
    VALUES (NombreProducto,DescripcionProducto,Precio,ExentoImpuesto);
    SELECT LAST_INSERT_ID() INTO idCatalogo;
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

CREATE OR REPLACE PROCEDURE modificarCatalogo(IN NombreProducto TINYTEXT, IN DescripcionProducto TINYTEXT, IN Precio DECIMAL(9,2), IN ExentoImpuesto INT, IN Id INT)
BEGIN 
    UPDATE catalogo SET nombreProducto = NombreProducto, descripcionProducto = DescripcionProducto, precio = Precio, exentoImpuesto = ExentoImpuesto
    WHERE idCatalogo = Id AND estado = 1;
END/