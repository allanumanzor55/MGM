DELIMITER  /
CREATE OR REPLACE FUNCTION generarCodigoGuia() RETURNS TINYTEXT
BEGIN
    DECLARE __idGuia INT;
    DECLARE codGuia TINYTEXT;
    DECLARE ceros INT;
    SELECT COUNT(*) INTO __idGuia FROM guia_remision;
    SET __idGuia := __idGuia + 1;
    SET ceros := 8-LENGTH(__idGuia);
    SET codGuia :="";
    WHILE ceros > 0 DO
        SET codGuia := CONCAT(codGuia,"0");
        SET ceros:= ceros-1;
    END WHILE;
    SET codGuia := CONCAT (codGuia,__idGuia);
    RETURN codGuia;
END/

CREATE OR REPLACE FUNCTION comprobarExistenciaBodega(_tipo TINYTEXT,_idInv INT, _idBodega INT) RETURNS BOOLEAN
BEGIN 
    DECLARE c INT;
    IF _tipo = "MATERIAL" THEN
        SELECT COUNT(*) INTO c FROM inventario_materiales 
        WHERE idInventarioMaterial = _idInv AND idBodega = _idBodega;
    ELSEIF _tipo = "MATERIA" THEN
        SELECT COUNT(*) INTO c FROM inventario_materia_prima 
        WHERE idInventario = _idInv AND idBodega = _idBodega;
    END IF;
    IF c = 1 THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
END/

CREATE OR REPLACE FUNCTION crearInventarioBodega(_tipo TINYTEXT, _idInv INT, _idBodega INT, _stock INT) RETURNS BOOLEAN
BEGIN 
    DECLARE _descripcion TINYTEXT;
    DECLARE _marca TINYTEXT;
    DECLARE _idProveedor INT;
    DECLARE _precio DECIMAL(9,2);
    DECLARE _puntoReorden INT;
    DECLARE _idCategoria INT;
    DECLARE _idTalla INT;
    DECLARE _color TINYTEXT;
    IF _tipo = "MATERIAL" THEN
        SELECT descripcion, marca, idProveedor, precio, puntoReorden INTO _descripcion, _marca, _idProveedor, _precio, _puntoReorden
        FROM inventario_materiales WHERE idInventarioMaterial = _idInv;
        
        INSERT INTO inventario_materiales(descripcion, marca, idProveedor, precio, puntoReorden,idBodega)
        VALUES (descripcion, _marca, _idProveedor, _precio, _puntoReorden,_idBodega);
    ELSEIF _tipo = "MATERIA" THEN
        SELECT descripcion,idCategoria,idProveedor,idTalla,color,precio INTO _descripcion, _idCategoria, _idProveedor, _idTalla, _color, _precio 
        FROM inventario_materia_prima WHERE idInventario = _idInv;

        INSERT INTO inventario_materia_prima(descripcion,idCategoria,idProveedor,idTalla,color,stock,precio)
        VALUES(_descripcion,_categoria,_proveedor,_talla,_color,_stock,_precio);
    END IF;
    RETURN TRUE;
END/

CREATE OR REPLACE  PROCEDURE cambiarEstadoSolicitudGuia(IN _estadoGuia VARCHAR(10),IN _id INT)
BEGIN
    UPDATE guia_remision SET estadoGuia = _estadoGuia WHERE  idGuia = _id;
END/

CREATE OR REPLACE  PROCEDURE generarTrasladoBodegas(IN _tipo VARCHAR(10),IN _idGuia INT, IN _idInventario INT)
BEGIN 
    DECLARE bodegaS INT;
    DECLARE bodegaE INT;
    DECLARE centinela BOOLEAN;
    DECLARE stockS INT;

    SELECT bodegaSalida,bodegaEntrada INTO bodegaS,bodegaE FROM guia_remision WHERE idGuia = _idGuia AND estado = 1;
    SET centinela := comprobarExistenciaBodega(_tipo,bodegaE,_idInventario);
    IF _tipo = "MATERIAL" THEN
        SELECT cantidad INTO stockS FROM materiales_remision 
        WHERE idGuia = _idGuia AND idMaterial = _idInventario AND estado = 1;
        UPDATE inventario_materiales SET stock = stock-cantidad 
        WHERE idInventarioMaterial = _idInventario AND idBodega = bodegaS;
        IF centinela = TRUE THEN
            UPDATE inventario_materiales SET stock = stock+cantidad 
            WHERE idInventarioMaterial = _idInventario AND idBodega = bodegaE;
        ELSE
            SET centinela := crearInventarioBodega(_tipo, _idInventario, bodegaE,stockS);
        END IF;
    ELSEIF _tipo = "MATERIA" THEN
        SELECT cantidad INTO stockS FROM materia_prima_remision 
        WHERE idGuia = _idGuia AND idMateriaPrima = _idInventario AND estado = 1;
        UPDATE inventario_materia_prima SET stock = stock-cantidad 
        WHERE idInventario = _idInventario AND idBodega = bodegaS;
        IF centinela = TRUE THEN
            UPDATE inventario_materia_prima SET stock = stock+cantidad 
            WHERE idInventario = _idInventario AND idBodega = bodegaE;
        ELSE
            SET centinela := crearInventarioBodega(_tipo, _idInventario, bodegaE,stockS);
        END IF;
    END IF;
END/