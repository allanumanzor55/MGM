
DELIMITER /
CREATE OR REPLACE PROCEDURE agregarProducto(IN Descripcion TINYTEXT, IN Categoria INT, IN Proveedor INT, IN Talla INT,
                                IN Color TINYTEXT, IN Stock INT, IN Precio DECIMAL(9,2),IN PuntoReorden INT, IN Bodega INT)
BEGIN
    INSERT INTO inventario_materia_prima(descripcion,idCategoria,idProveedor,idTalla,color,stock,puntoReorden,precio,idBodega)
    VALUES(Descripcion,Categoria,Proveedor,Talla,Color,Stock,PuntoReorden,Precio,Bodega);
END/

CREATE OR REPLACE PROCEDURE obtenerProducto(IN Id INT)
BEGIN
    SELECT * FROM vw_inventario WHERE vw_inventario.idInventario = Id;
END/

CREATE OR REPLACE PROCEDURE obtenerProductos()
BEGIN
    SELECT * FROM vw_inventario;
END/

CREATE OR REPLACE  PROCEDURE obtenerInvPrimasPorBodega(IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario WHERE idBodega = Bodega;
END/

CREATE OR REPLACE PROCEDURE modificarProducto(IN Descripcion TINYTEXT, IN Categoria INT, IN Proveedor INT, IN Talla INT,
                                IN Color TINYTEXT, IN Stock INT, IN Precio DECIMAL(9,2),IN PuntoReorden INT, IN Id INT)
BEGIN
    UPDATE inventario_materia_prima SET
        descripcion = Descripcion,
        idCategoria = Categoria,
        idProveedor = Proveedor,
        idTalla = Talla,
        color = Color,
        stock = Stock,
        precio = Precio,
        puntoReorden = PuntoReorden
    WHERE idInventario = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE eliminarProducto(IN Id INT)
BEGIN
    UPDATE inventario_materia_prima SET estado = 0 WHERE idInventario = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE buscarProducto(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM vw_inventario WHERE 
    (descripcion LIKE CONCAT('%',Valor,'%') OR tipo LIKE CONCAT('%',Valor,'%') OR estilo LIKE CONCAT('%',Valor,'%'));
END/
CREATE OR REPLACE PROCEDURE buscarInvPrimaPorBodega(IN Valor TINYTEXT, IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario WHERE 
    idBodega = Bodega AND (descripcion LIKE CONCAT('%',Valor,'%') OR tipo LIKE CONCAT('%',Valor,'%') OR estilo LIKE CONCAT('%',Valor,'%'));
END/

CREATE OR REPLACE PROCEDURE agregarMaterial(IN Descripcion TINYTEXT, IN _marca TINYTEXT, IN Proveedor INT, IN Precio DECIMAL(9,2),IN Stock INT,IN PuntoReorden INT, IN Bodega INT)
BEGIN
    INSERT INTO inventario_materiales(descripcion,marca,idProveedor,precio,stock,puntoReorden,idBodega)
    VALUE (Descripcion,_marca,Proveedor,Precio,Stock,PuntoReorden,Bodega);
END/

CREATE OR REPLACE PROCEDURE obtenerMaterial(IN Id INT)
BEGIN 
    SELECT * FROM vw_inventario_materiales WHERE idInventario = Id;
END/

CREATE OR REPLACE PROCEDURE obtenerMateriales()
BEGIN 
    SELECT * FROM vw_inventario_materiales;
END/

CREATE OR REPLACE  PROCEDURE obtenerInvMaterialesPorBodega(IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_materiales WHERE idBodega = Bodega;
END/


CREATE OR REPLACE PROCEDURE eliminarMaterial(IN Id INT)
BEGIN
    UPDATE inventario_materiales SET estado = 0 WHERE idInventarioMaterial = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarMaterial(IN Descripcion TINYTEXT, IN _marca TINYTEXT, IN Proveedor INT, IN Precio DECIMAL(9,2), IN Stock INT, IN PuntoReorden INT, IN Id INT)
BEGIN
    UPDATE inventario_materiales 
    SET
        descripcion = Descripcion,
        marca = _marca,
        idProveedor = Proveedor,
        precio = Precio,
        stock = Stock,
        puntoReorden = PuntoReorden
    WHERE idInventarioMaterial = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE buscarMaterial(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM vw_inventario_materiales WHERE 
    (descripcion LIKE CONCAT('%',Valor,'%') OR empresa LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END/

CREATE OR REPLACE PROCEDURE buscarMaterialPorBodega(IN Valor TINYTEXT, IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_materiales WHERE 
    idBodega = Bodega AND (descripcion LIKE CONCAT('%',Valor,'%') OR empresa LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END/

CREATE OR REPLACE PROCEDURE agregarHerramienta(IN Descripcion TINYTEXT, IN _marca TINYTEXT, IN Proveedor INT, IN Stock INT, IN Bodega INT)
BEGIN
    INSERT INTO inventario_herramientas(descripcion,marca,idProveedor,stock,idBodega)
    VALUE (Descripcion,_marca,Proveedor,Stock,Bodega);
END/

CREATE OR REPLACE PROCEDURE obtenerHerramienta(IN Id INT)
BEGIN 
    SELECT * FROM vw_inventario_herramientas WHERE idInventario = Id;
END/

CREATE OR REPLACE PROCEDURE obtenerHerramientas()
BEGIN 
    SELECT * FROM vw_inventario_herramientas;
END/

CREATE OR REPLACE PROCEDURE eliminarHerramienta(IN Id INT)
BEGIN
    UPDATE inventario_herramientas SET estado = 0 WHERE idInventarioHerramienta = Id AND estado = 1;
END/

CREATE OR REPLACE  PROCEDURE obtenerInvHerramientasPorBodega(IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_herramientas WHERE idBodega = Bodega;
END/

CREATE OR REPLACE PROCEDURE modificarHerramienta(IN Descripcion TINYTEXT, IN _marca TINYTEXT, IN Proveedor INT, IN Stock INT, IN Id INT)
BEGIN
    UPDATE inventario_herramientas 
    SET
        descripcion = Descripcion,
        marca = _marca,
        idProveedor = Proveedor,
        stock = Stock
    WHERE idInventarioHerramienta = Id AND estado = 1;
END/


CREATE OR REPLACE PROCEDURE buscarHerramienta(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM vw_inventario_herramientas WHERE 
    (descripcion LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END/

CREATE OR REPLACE PROCEDURE buscarHerramientaPorBodega(IN Valor TINYTEXT, IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_herramientas WHERE 
    idBodega = Bodega AND (descripcion LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END/

CREATE OR REPLACE PROCEDURE agregarInvGeneral(IN Descripcion TINYTEXT, IN Stock INT, IN Bodega INT)
BEGIN
    INSERT INTO inventario_general(descripcion,stock,idBodega)
    VALUE (Descripcion,Stock, Bodega);
END/

CREATE OR REPLACE PROCEDURE obtenerInvGeneral(IN Id INT)
BEGIN 
    SELECT * FROM vw_inventario_general WHERE idInventario = Id;
END/

CREATE OR REPLACE PROCEDURE obtenerInvGenerales()
BEGIN 
    SELECT * FROM vw_inventario_general;
END/

CREATE OR REPLACE  PROCEDURE obtenerInvGeneralesPorBodega(IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_general WHERE idBodega = Bodega;
END/

CREATE OR REPLACE PROCEDURE eliminarInvGeneral(IN Id INT)
BEGIN
    UPDATE inventario_general SET estado = 0 WHERE idInventarioGeneral = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarInvGeneral(IN Descripcion TINYTEXT, IN Stock INT, IN Id INT)
BEGIN
    UPDATE inventario_general 
    SET
        descripcion = Descripcion,
        stock = Stock
    WHERE idInventarioGeneral = Id AND estado = 1;
END/
CREATE OR REPLACE PROCEDURE buscarInvGeneral(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM vw_inventario_general WHERE 
    (descripcion LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END/

CREATE OR REPLACE PROCEDURE buscarInvGeneralPorBodega(IN Valor TINYTEXT, IN Bodega INT)
BEGIN 
    SELECT * FROM vw_inventario_general WHERE 
    idBodega = Bodega AND (descripcion LIKE CONCAT('%',Valor,'%') OR stock LIKE CONCAT('%',Valor,'%'));
END/

CREATE OR REPLACE PROCEDURE modificarStock(IN Id INT, IN Stock INT, IN TipoInventario TINYTEXT)
BEGIN 
    IF TipoInventario = "Prima" THEN
        UPDATE inventario_materia_prima SET stock = Stock WHERE idInventario = Id AND estado = 1;
    ELSEIF TipoInventario = "Material" THEN
        UPDATE inventario_materiales SET stock = Stock WHERE idInventarioMaterial = Id AND estado = 1;
    ELSEIF TipoInventario = "Herramienta" THEN
        UPDATE inventario_herramientas SET stock = Stock WHERE idInventarioHerramienta = Id AND estado = 1;
    ELSEIF TipoInventario = "General" THEN
        UPDATE inventario_general SET stock = Stock WHERE idInventarioGeneral = Id AND estado = 1;
    END IF;
END/