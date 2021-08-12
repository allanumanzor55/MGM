CREATE OR REPLACE VIEW vw_ordenes
AS
SELECT orden.idOrden, orden.idCotizacion, orden.fecha, cotiz.descripcion, cotiz.idEmpleado, 
cotiz.nombreEmpleado, cotiz.idCliente, cotiz.nombreCliente, orden.estadoOrden
FROM ordenes orden JOIN vw_cotizaciones cotiz ON orden.idCotizacion = cotiz.idCotizacion
WHERE orden.estado = 1;

CREATE OR REPLACE VIEW vw_productosOrdenes
AS 
SELECT vw_ordenes.idOrden, productos_cotizados.idCotizacion,productos_cotizados.IdProducto,catalogo.nombreProducto,
    catalogo.descripcionProducto,catalogo.precio, productos_cotizados.cantidad 
    FROM productos_cotizados
    JOIN cotizaciones ON cotizaciones.idCotizacion = productos_cotizados.idCotizacion
    JOIN vw_ordenes ON vw_ordenes.idCotizacion = cotizaciones.idCotizacion
    JOIN catalogo ON productos_cotizados.idProducto = catalogo.idCatalogo
    WHERE productos_cotizados.estado = 1;