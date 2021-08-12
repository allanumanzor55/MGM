DELIMITER /

CREATE OR REPLACE PROCEDURE obtenerOrdenes()
BEGIN
    SELECT * FROM vw_ordenes;
END/

CREATE OR REPLACE PROCEDURE obtenerOrdenesPorEstado(IN Estado VARCHAR(32))
BEGIN
    SELECT * FROM vw_ordenes WHERE estadoOrden = Estado;
END/