CREATE OR REPLACE VIEW vw_guia_remision
AS
SELECT guia.idGuia, guia.fecha, guia.codigo, emp.nombre, emp.rtn, guia.motivoTraslado, 
guia.bodegaSalida as "idBodegaSalida", bodegaS.descripcion as "bodegaSalida",
guia.bodegaEntrada as "idBodegaEntrada", bodegaE.descripcion as "bodegaEntrada", guia.estadoGuia
FROM guia_remision guia
JOIN datos_empresa emp ON emp.nombre = guia.empresa
JOIN bodegas bodegaS ON guia.bodegaSalida = bodegaS.idBodega
JOIN bodegas bodegaE ON guia.bodegaEntrada = bodegaE.idBodega
WHERE guia.estado = 1;

CREATE OR REPLACE VIEW vw_materiales_remision
AS 
SELECT rem.idGuia, rem.idMaterial, guia.bodegaSalida, guia.bodegaEntrada, material.descripcion, material.marca, rem.cantidad
FROM materiales_remision rem
JOIN vw_inventario_materiales material ON rem.idMaterial = material.idInventario
JOIN vw_guia_remision guia ON rem.idGuia = guia.idGuia
WHERE rem.estado = 1;

CREATE OR REPLACE VIEW vw_materia_prima_remision
AS 
SELECT  
    rem.idGuia, rem.idMateriaPrima, guia.bodegaSalida, guia.bodegaEntrada, materia.descripcion, materia.tipo, materia.estilo, materia.talla, rem.cantidad
FROM materia_prima_remision rem
JOIN vw_inventario materia ON rem.idMateriaPrima = materia.idInventario
JOIN vw_guia_remision guia ON rem.idGuia = guia.idGuia
WHERE rem.estado = 1;
