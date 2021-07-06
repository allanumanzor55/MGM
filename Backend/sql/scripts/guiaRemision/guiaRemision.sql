DELIMITER /

CREATE OR REPLACE PROCEDURE guardarGuia(IN _idEmpleado INT,IN _motivo TINYTEXT, IN _bodegaSalida INT, IN _bodegaEntrada INT, OUT _idGuia INT)
BEGIN
    DECLARE codGuia TINYTEXT;
    DECLARE nombreEmpresa TINYTEXT;
    SET codGuia:=generarCodigoGuia();
    SELECT nombre INTO nombreEmpresa FROM datos_empresa WHERE activo = 1;
    SELECT CONCAT(EXTRACT(YEAR FROM CURDATE()),"-",EXTRACT(MONTH FROM CURDATE()),"-",codGuia) INTO codGuia;
    INSERT INTO guia_remision(idEmpleado,codigo,empresa,motivoTraslado,bodegaSalida,bodegaEntrada)
    VALUES (_idEmpleado,codGuia,nombreEmpresa,_motivo,_bodegaSalida,_bodegaEntrada);
    SELECT LAST_INSERT_ID() INTO _idGuia;
END/

CREATE OR REPLACE PROCEDURE agregarMateriaPrimaGuia(IN _guia INT, IN _materia INT, IN _cantidad INT)
BEGIN
    INSERT INTO materia_prima_remision(idGuia, idMateriaPrima, cantidad) VALUES (_guia,_materia,_cantidad);
END/

CREATE OR REPLACE PROCEDURE agregarMaterialGuia(IN _guia INT, IN _material INT, IN _cantidad INT)
BEGIN
    INSERT INTO materiales_remision(idGuia, idMaterial, cantidad) VALUES (_guia,_material,_cantidad);
END/

CREATE OR REPLACE PROCEDURE eliminarGuia(IN id INT)
BEGIN
    UPDATE guia_remision SET estado = 0 WHERE idGuia = id;
END/
