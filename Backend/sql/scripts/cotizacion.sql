DELIMITER /
CREATE OR REPLACE PROCEDURE guardarCotizacion(IN Descripcion TINYTEXT, OUT IdCotizacion INT)
BEGIN 
    INSERT INTO cotizaciones(descripcion) VALUES (Descripcion);
    SELECT LAST_INSERT_ID() INTO IdCotizacion;
END/
CREATE OR REPLACE PROCEDURE agregarProductoCotizacion(IN IdCotizacion INT, IN IdProducto INT, IN Cantidad INT)
BEGIN 
    INSERT INTO productos_cotizados(idCotizacion,idProducto,cantidad)
    VALUES  (IdCotizacion,IdProducto,Cantidad);
END/

CREATE OR REPLACE PROCEDURE obtenerCotizaciones()
BEGIN 
    SELECT idCotizacion,descripcion FROM cotizaciones WHERE estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerCotizacion(IN Id INT)
BEGIN 
    SELECT idCotizacion,descripcion FROM cotizaciones WHERE idCotizacion = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE eliminarCotizacion(IN Id INT)
BEGIN 
    UPDATE cotizaciones SET estado = 0 WHERE idCotizacion = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerProductosCotizados(IN Id INT)
BEGIN 
    SELECT idCotizacion,IdProducto,nombreProducto,descripcionProducto,precio 
    FROM productos_cotizados
    JOIN cotizacion ON cotizacion.idCotizacion = productos_cotizados.idCotizacion
    JOIN catalogo ON catalogo.idProducot = catalogo.idCatalogo
    WHERE productos_cotizados.idCotizacion = Id AND estado = 1;
END/