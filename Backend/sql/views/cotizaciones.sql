CREATE OR REPLACE VIEW vw_cotizaciones
AS
SELECT cotiz.idCotizacion, cotiz.idEmpleado, CONCAT(emp.nombre,' ',emp.primerApellido) AS "nombreEmpleado",
cotiz.idCliente, CONCAT(cli.nombre,' ',cli.primerApellido) AS "nombreCliente", cotiz.fecha, cotiz.descripcion,
cotiz.EstadoCotizacion FROM cotizaciones cotiz 
JOIN empleados emp ON emp.idEmpleado = cotiz.idEmpleado 
JOIN clientes cli ON cli.idCliente = cotiz.idCliente
WHERE cotiz.estado = 1