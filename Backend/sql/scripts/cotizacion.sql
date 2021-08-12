DELIMITER /
CREATE OR REPLACE PROCEDURE guardarCotizacion(IN Descripcion TINYTEXT,IN Empleado INT, IN Cliente INT, OUT IdCotizacion INT)
BEGIN 
    INSERT INTO cotizaciones(idEmpleado,idCliente,descripcion) VALUES (Empleado,Cliente,Descripcion);
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

CREATE OR REPLACE PROCEDURe obtenerCotizacionEstado(IN EstadoC VARCHAR(32))
BEGIN
    SELECT idCotizacion, fecha, descripcion, idEmpleado, nombreEmpleado, idCliente, nombreCliente, estadoCotizacion
    FROM vw_cotizaciones WHERE estadoCotizacion = EstadoC;
END/

CREATE OR REPLACE PROCEDURE eliminarCotizacion(IN Id INT)
BEGIN 
    UPDATE cotizaciones SET estado = 0 WHERE idCotizacion = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerProductosCotizados(IN Id INT)
BEGIN 
    SELECT productos_cotizados.idCotizacion,productos_cotizados.IdProducto,catalogo.nombreProducto,
    catalogo.descripcionProducto,catalogo.precio, productos_cotizados.cantidad 
    FROM productos_cotizados
    JOIN cotizaciones ON cotizaciones.idCotizacion = productos_cotizados.idCotizacion
    JOIN catalogo ON productos_cotizados.idProducto = catalogo.idCatalogo
    WHERE productos_cotizados.idCotizacion = Id AND productos_cotizados.estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarEstadoCotizacion(IN Id INT, IN Estado VARCHAR(32))
BEGIN
    UPDATE cotizaciones SET estadoCotizacion = Estado WHERE idCotizacion = Id;
    IF Estado = "APROBADA" THEN
        INSERT INTO ordenes(idCotizacion) VALUES (Id);
    END IF;
END/