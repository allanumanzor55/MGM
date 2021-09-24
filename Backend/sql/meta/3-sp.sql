DROP PROCEDURE IF EXISTS comprobarUser;
DROP PROCEDURE IF EXISTS obtenerId;
DELIMITER  /
CREATE OR REPLACE PROCEDURE agregarBodega(IN _descripcion TINYTEXT, IN _ubicacion  TINYTEXT)
BEGIN
    INSERT INTO bodegas(descripcion,ubicacion) VALUES (_descripcion,_ubicacion);
END/

CREATE OR REPLACE PROCEDURE modificarBodega(IN _descripcion TINYTEXT, IN _ubicacion TINYTEXT, IN _id INT)
BEGIN 
    UPDATE bodegas SET descripcion = _descripcion, ubicacion = _ubicacion WHERE idBodega = _id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerBodegas()
BEGIN
    SELECT * FROM bodegas WHERE estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerBodega(IN _id INT)
BEGIN
    SELECT * FROM bodegas WHERE idBodega = _id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE  eliminarBodega(IN _id INT)
BEGIN
    UPDATE bodegas SET estado = 0 WHERE idBodega = _id;
END/

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

CREATE OR REPLACE PROCEDURE guardarCliente(IN IdFoto INT,IN NombreEmpresa TINYTEXT, IN RtnEmpresa TINYTEXT,
IN TipoCliente INT, IN Dni TINYTEXT,IN Nombre TINYTEXT, IN PrimerApellido TINYTEXT, 
IN SegundoApellido TINYTEXT,IN Direccion TINYTEXT, IN Correo TINYTEXT, 
IN Celular TINYTEXT, IN Telefono TINYTEXT, IN Edad VARCHAR(3))
BEGIN
    INSERT INTO clientes (idFoto,nombreEmpresa,rtnEmpresa,tipoCliente,dni, nombre, primerApellido, segundoApellido,direccion, correo, celular, telefono,edad) 
    VALUES (IdFoto,NombreEmpresa,RtnEmpresa,TipoCliente,Dni, Nombre, PrimerApellido, SegundoApellido, Direccion, Correo, Celular, Telefono,Edad); 
END/

CREATE OR REPLACE PROCEDURE obtenerClientes()
BEGIN   
    SELECT * FROM clientes JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = clientes.idFoto WHERE estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerCliente(IN Id INT)
BEGIN
    SELECT * FROM clientes JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = clientes.idFoto WHERE idCliente = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarCliente(IN NombreEmpresa TINYTEXT, IN RtnEmpresa TINYTEXT,
IN TipoCliente INT,IN Dni TINYTEXT,IN Nombre TINYTEXT, IN PrimerApellido TINYTEXT, 
IN SegundoApellido TINYTEXT,IN Direccion TINYTEXT, IN Correo TINYTEXT, IN Celular TINYTEXT, 
IN Telefono TINYTEXT, IN Edad VARCHAR(3),IN Id INT)
BEGIN 
    UPDATE clientes SET
        nombreEmpresa = NombreEmpresa,
        rtnEmpresa = RtnEmpresa,
        tipoCliente = TipoCliente,
        dni = Dni,
        nombre = Nombre,
        primerApellido = PrimerApellido,
        segundoApellido = SegundoApellido,
        direccion = Direccion,
        correo = Correo,
        celular = Celular,
        telefono = Telefono,
        edad = Edad
    WHERE idCliente  = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE eliminarCliente(IN Id INT )
BEGIN
    UPDATE clientes SET estado = 0 WHERE idCliente = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE buscarCliente(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM clientes JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = clientes.idFoto
    WHERE estado=1 AND 
    (nombre LIKE CONCAT('%',Valor,'%') OR primerApellido LIKE CONCAT('%',Valor,'%') OR segundoApellido LIKE CONCAT('%',Valor,'%'));
END/

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

CREATE OR REPLACE PROCEDURE guardarEmpleado(IN IdFoto INT,IN TipoEmpleado INT, IN Dni TINYTEXT,
IN Nombre TINYTEXT, IN PrimerApellido TINYTEXT, IN SegundoApellido TINYTEXT,
IN Direccion TINYTEXT, IN Correo TINYTEXT, IN Celular TINYTEXT, IN Telefono TINYTEXT,
IN Sueldo DECIMAL(11,2))
BEGIN 
    INSERT INTO 
    empleados(idFoto,tipoEmpleado, nombre, dni , primerApellido, segundoApellido,direccion, correo, celular, telefono, sueldo) 
    VALUES(IdFoto,TipoEmpleado, Nombre, Dni, PrimerApellido, SegundoApellido, Direccion, Correo, Celular, Telefono, Sueldo); 
END/

CREATE OR REPLACE PROCEDURE obtenerEmpleados()
BEGIN
    SELECT * FROM empleados JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = empleados.idFoto WHERE estado=1;
END/

CREATE OR REPLACE PROCEDURE obtenerEmpleado(IN Id INT )
BEGIN
    SELECT * FROM empleados JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = empleados.idFoto WHERE idEmpleado = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerEmpleadosPorTipo(IN Tipo INT )
BEGIN
    SELECT * FROM empleados JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = empleados.idFoto WHERE tipoEmpleado = Tipo AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarEmpleado(IN Dni TINYTEXT,
IN Nombre TINYTEXT, IN PrimerApellido TINYTEXT, IN SegundoApellido TINYTEXT,
IN Direccion TINYTEXT, IN Correo TINYTEXT, IN Celular TINYTEXT, IN Telefono TINYTEXT,
IN Sueldo DECIMAL(11,2),IN Id INT )
BEGIN 
    UPDATE 
    empleados SET
        dni = Dni,
        nombre = Nombre,
        primerApellido = PrimerApellido,
        segundoApellido = SegundoApellido,
        direccion = Direccion,
        correo = Correo,
        celular = Celular,
        telefono = Telefono,
        sueldo = Sueldo
    WHERE idEmpleado = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE eliminarEmpleado(IN Id INT)
BEGIN 
    UPDATE empleados SET estado = 0 WHERE idEmpleado = Id AND estado =1;
END/

CREATE OR REPLACE PROCEDURE buscarEmpleado(IN Valor TINYTEXT,IN Tipo TINYTEXT)
BEGIN 
    SELECT * FROM empleados JOIN fotografias_usuarios fotografias ON fotografias.idFotografia = empleados.idFoto 
    WHERE estado=1 AND tipoEmpleado = Tipo AND 
    (nombre LIKE CONCAT('%',Valor,'%') OR primerApellido LIKE CONCAT('%',Valor,'%') OR segundoApellido LIKE CONCAT('%',Valor,'%'));
END/

CREATE OR REPLACE PROCEDURE obtenerTipoEmpleado(IN Id INT)
BEGIN
    SELECT * FROM tipo_empleado WHERE idTipoEmpleado = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarTipoEmpleado(IN Descripcion TINYTEXT, IN Rol INT, IN Id INT)
BEGIN
    UPDATE tipo_empleado SET descripcion = Descripcion, idRol = Rol WHERE idTipoEmpleado = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE eliminarTipoEmpleado( IN Id INT)
BEGIN
    UPDATE tipo_empleado SET estado = 0 WHERE idTipoEmpleado = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE agregarRol(IN Rol TINYTEXT, IN Descripcion TINYTEXT, 
IN Empleado INT, IN Cliente INT, IN Inventario INT, IN GuiaRemision INT, IN Bodega INT, IN Catalogo INT, IN Cotizacion INT,
IN Pedido INT, IN Configuracion INT)
BEGIN
    INSERT INTO roles(rol,descripcion,empleados,clientes,inventario,guiaRemision,bodegas,catalogo,cotizacion,pedido,configuracion)
    VALUES (Rol,Descripcion,Empleado,Cliente,Inventario,GuiaRemision,Bodega,Catalogo,Cotizacion,Pedido,Configuracion);
END/

CREATE OR REPLACE PROCEDURE obtenerRoles()
BEGIN
    SELECT * FROM roles WHERE estado = 1;
END/


CREATE OR REPLACE PROCEDURE obtenerRol(IN Id INT)
BEGIN
    SELECT * FROM roles WHERE idRol = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarRol(IN Rol TINYTEXT, IN Descripcion TINYTEXT, 
IN Empleado INT, IN Cliente INT, IN Inventario INT, IN GuiaRemision INT, IN Bodega INT, IN Catalogo INT, IN Cotizacion INT,
IN Pedido INT, IN Configuracion INT, IN Id INT)
BEGIN
    UPDATE roles SET 
        rol = Rol,
        descripcion = Descripcion,
        empleados = Empleado,
        clientes = Cliente,
        inventario = Inventario,
        guiaRemision = GuiaRemision,
        bodegas = Bodega,
        catalogo = Catalogo,
        cotizacion = Cotizacion,
        pedido = Pedido,
        configuracion = Configuracion
    WHERE idRol = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE eliminarRol( IN Id INT)
BEGIN
    UPDATE roles SET estado = 0 WHERE idRol = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE agregarFichaProducto(IN _descripcion TINYTEXT, IN _materiaPrima INT,IN _precio DECIMAL(9,2), OUT idFichaProducto INT)
BEGIN
    INSERT INTO ficha_producto(descripcion,idMateriaPrima,precio)
    VALUES (_descripcion,_materiaPrima,_precio);
    SELECT LAST_INSERT_ID() INTO idFichaProducto;
END/

CREATE OR REPLACE PROCEDURE agregarMaterialesFichaProducto(IN _idFichaProducto INT, IN _idMaterial INT, IN _cantidad INT)
BEGIN
    INSERT INTO ficha_producto_materiales VALUES (_idFichaProducto,_idMaterial,_cantidad,1);
END/

CREATE OR REPLACE PROCEDURE obtenerFichaProducto(IN _id INT)
BEGIN
    SELECT * FROM vw_ficha_producto WHERE idFichaProducto = _id;
END/

CREATE OR REPLACE PROCEDURE obtenerFichasProductos()
BEGIN
    SELECT * FROM vw_ficha_producto;
END/

CREATE OR REPLACE PROCEDURE obtenerMaterialesFichaProducto(IN _idFichaProducto INT)
BEGIN
    SELECT * FROM vw_materiales_ficha_producto WHERE idFichaProducto = _idFichaProducto;
END/

CREATE OR REPLACE PROCEDURE modificarFichaProducto(IN _descripcion TINYTEXT, IN _materiaPrima INT, IN _precio DECIMAL(9,2), IN _id INT)
BEGIN
    UPDATE ficha_producto SET
        descripcion = _descripcion,
        idMateriaPrima = _materiaPrima,
        precio = _precio
    WHERE
        idFichaProducto = _id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarMaterialFichaProducto(IN _idFicha INT,IN _idMaterial INT, IN _cantidad INT, IN cen INT)
BEGIN
    IF cen=0 THEN
        DELETE FROM ficha_producto_materiales WHERE idFichaProducto = _idFicha;
    END IF;
    INSERT INTO ficha_producto_materiales VALUES (_idFicha,_idMaterial,_cantidad,1);
END/

CREATE OR REPLACE PROCEDURE eliminarFichaProducto(IN _id INT)
BEGIN
    UPDATE ficha_producto SET estado = 0 WHERE idFichaProducto = _id;
    UPDATE ficha_producto_materiales SET estado = 0 WHERE idFichaProducto = _id;
END/

CREATE OR REPLACE PROCEDURE obtenerFotosProducto(IN Id INT)
BEGIN
    SELECT idFotografia,idProducto,fotografia,nombreFoto,tamanoFoto,formatoFoto
    FROM fotografias_productos WHERE idProducto = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerFotoProducto(IN Id INT)
BEGIN
    SELECT idFotografia,idProducto,fotografia,nombreFoto,tamanoFoto,formatoFoto
    FROM fotografias_productos WHERE idProducto = Id AND estado = 1 LIMIT 1;
END/

CREATE OR REPLACE PROCEDURE eliminarMaterialFichaProducto( IN _idFicha INT, IN _idMaterial INT) 
BEGIN
    UPDATE ficha_producto_materiales SET estado = 0 WHERE idFichaProducto = _idFicha AND idMaterial = _idMaterial;
END/

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

CREATE OR REPLACE PROCEDURE obtenerGuias()
BEGIN
    SELECT * FROM vw_guia_remision;
END/

CREATE OR REPLACE PROCEDURE obtenerGuia(IN id INT)
BEGIN
    SELECT * FROM vw_guia_remision WHERE idGuia = id;
END/

CREATE OR REPLACE PROCEDURE obtenerMateriaPrimaGuia(IN _guia INT, IN _materia INT)
BEGIN
    SELECT * FROM vw_materia_prima_remision WHERE idGuia = _guia AND idMateriaPrima = _materia;
END/

CREATE OR REPLACE PROCEDURE obtenerMaterialGuia(IN _guia INT, IN _material INT)
BEGIN
    SELECT * FROM vw_materiales_remision WHERE idGuia = _guia AND idMaterial = _material;
END/

CREATE OR REPLACE PROCEDURE obtenerMateriasPrimasGuia(IN _guia INT)
BEGIN
    SELECT * FROM vw_materia_prima_remision WHERE idGuia = _guia;
END/

CREATE OR REPLACE PROCEDURE obtenerMaterialesGuia(IN _guia INT)
BEGIN
    SELECT * FROM vw_materiales_remision WHERE idGuia = _guia;
END/

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


CREATE OR REPLACE PROCEDURE comprobarUser(IN Usuario TINYTEXT)
BEGIN
    DECLARE n INT;
    SELECT COUNT(*) INTO n FROM vw_usuarios WHERE usuario = Usuario;
    IF n>0 THEN
        SELECT idUsuario as "idUser",id,TipoUsuario FROM vw_usuarios WHERE usuario = Usuario;
    ELSE 
        SELECT 0 as "idUser";
    END IF;
END/

CREATE PROCEDURE obtenerId(IN Us TINYTEXT)
BEGIN 
DECLARE ID INT;
    SELECT id INTO ID FROM vw_usuarios WHERE usuario = Us;
    SELECT idUsuario FROM vw_usuarios WHERE id = ID;
END/

CREATE OR REPLACE PROCEDURE comprobarPassword(IN id INT, IN Contra TINYTEXT,OUT Validado BOOLEAN)
BEGIN
    DECLARE pass TINYTEXT;
    SELECT CONVERT(UNHEX(AES_DECRYPT(usuarios.password,usuarios.usuario)) USING utf8) INTO pass
    FROM usuarios WHERE idUsuario=id;
    IF Contra = pass THEN
        SET Validado := TRUE;
    ELSE
        SET Validado := FALSE;
    END IF;
END/

CREATE OR REPLACE PROCEDURE Login(IN Id INT, IN Token VARCHAR(1024))
BEGIN
    UPDATE usuarios SET token=Token WHERE idUsuario = Id;
END/ 

CREATE OR REPLACE PROCEDURE comprobarLogin(IN _token TINYTEXT, OUT Validado BOOLEAN)
BEGIN
    DECLARE n INT;
    SELECT COUNT(*) INTO n FROM usuarios WHERE token = _token;
    IF n > 0 THEN
        SET Validado = TRUE;
    ELSE 
        SET Validado = FALSE;
    END IF;
END/

CREATE OR REPLACE PROCEDURE logout(IN Id INT)
BEGIN
    UPDATE usuarios SET token = "" WHERE idUsuario = Id;
END/

CREATE OR REPLACE PROCEDURE obtenerPermisos(IN Id INT)
BEGIN
    SELECT rol.idRol,rol.empleados,rol.clientes,rol.inventario,rol.guiaRemision,
    rol.bodegas,rol.catalogo,rol.cotizacion,rol.pedido,rol.configuracion
    FROM roles rol 
    JOIN vw_usuarios us ON us.idRol = rol.idRol
    WHERE us.idUsuario = Id;
END/


CREATE OR REPLACE PROCEDURE obtenerOrdenes()
BEGIN
    SELECT * FROM vw_ordenes;
END/

CREATE OR REPLACE PROCEDURE obtenerOrdenesPorEstado(IN Estado VARCHAR(32))
BEGIN
    SELECT * FROM vw_ordenes WHERE estadoOrden = Estado;
END/
