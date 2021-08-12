DELIMITER /
CREATE OR REPLACE PROCEDURE agregarCategoria(IN Tipo INT, IN Estilo TINYTEXT)
BEGIN
    INSERT INTO inventario_categorias(idTipo,estilo) VALUES (Tipo,Estilo);
END/

CREATE OR REPLACE PROCEDURE obtenerCategorias()
BEGIN
    SELECT * FROM vw_categorias;
END/

CREATE OR REPLACE PROCEDURE obtenerCategoria(IN Id INT)
BEGIN
    SELECT * FROM vw_categorias WHERE idCategoria=Id;
END/

CREATE OR REPLACE PROCEDURE obtenerCategoriasPorTipo(IN Tipo INT)
BEGIN
    SELECT idCategoria,estilo FROM vw_categorias WHERE idTipo=Tipo;
END/

CREATE OR REPLACE PROCEDURE eliminarCategoria(IN Id INT)
BEGIN
    UPDATE inventario_categorias SET estado = 0 WHERE idCategoria = Id;
    UPDATE inventario_categorias
    JOIN inventario_materia_prima inventario ON inventario_categorias.idCategoria = inventario.idCategoria 
    SET 
    inventario_categorias.estado = 0,
    inventario.estado=0 
    WHERE inventario_categorias.idCategoria = Id;
END/

CREATE OR REPLACE PROCEDURE modificarCategoria(IN Tipo INT, IN Estilo TINYTEXT, IN Id INT)
BEGIN
    UPDATE inventario_categorias SET 
        idTipo = Tipo,
        estilo = Estilo
    WHERE idCategoria = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE buscarCategoria(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM inventario_categorias 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',Valor,'%'));
END/
CREATE OR REPLACE PROCEDURE agregarTipo(IN Descripcion TINYTEXT, IN Material TINYTEXT)
BEGIN 
    INSERT INTO categoria_tipos(descripcion,material) VALUES (Descripcion,Material);
END/


CREATE OR REPLACE PROCEDURE obtenerTipos()
BEGIN
    SELECT * FROM categoria_tipos WHERE estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerTipo(IN Id INT)
BEGIN
    SELECT * FROM categoria_tipos WHERE estado = 1 AND idTipo=Id;
END/

CREATE OR REPLACE PROCEDURE eliminarTipo(IN Id INT)
BEGIN
    UPDATE categoria_tipos SET estado = 0 WHERE idTipo = Id;
    
    UPDATE categoria_tipos 
    JOIN inventario_categorias ON categoria_tipos.idTipo = inventario_categorias.idTipo
    SET 
    categoria_tipos.estado=0,
    inventario_categorias.estado = 0
    WHERE categoria_tipos.idTipo = Id AND inventario_categorias.idTipo = Id;
    
    UPDATE inventario_materia_prima 
    JOIN inventario_categorias ON inventario_materia_prima.idCategoria = inventario_categorias.idCategoria
    SET
    inventario_materia_prima.estado=0
    WHERE inventario_categorias.idTipo=Id;
END/

CREATE OR REPLACE PROCEDURE modificarTipo(IN Descripcion TINYTEXT, IN Material TINYTEXT, IN Id INT)
BEGIN
    UPDATE categoria_tipos SET 
    descripcion = Descripcion,  
    material = Material
    WHERE idTipo = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE buscarTipo(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM categoria_tipos 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',Valor,'%'));
END/

CREATE OR REPLACE PROCEDURE agregarTalla(IN Descripcion TINYTEXT)
BEGIN 
    INSERT INTO inventario_tallas(descripcion) VALUES (Descripcion);
END/


CREATE OR REPLACE PROCEDURE obtenerTallas()
BEGIN
    SELECT * FROM inventario_tallas WHERE estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerTalla(IN Id INT)
BEGIN
    SELECT * FROM inventario_tallas WHERE estado = 1 AND idTalla=Id;
END/

CREATE OR REPLACE PROCEDURE eliminarTalla(IN Id INT)
BEGIN
    UPDATE inventario_tallas SET estado = 0 WHERE idTalla = Id;
    UPDATE inventario_tallas
    JOIN inventario_materia_prima inventario ON inventario_tallas.idTalla = inventario.idTalla
    SET inventario_tallas.estado = 0,inventario.estado=0 
    WHERE inventario_tallas.idTalla = Id AND inventario_tallas.estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarTalla(IN Descripcion TINYTEXT, IN Id INT)
BEGIN
    UPDATE inventario_tallas SET 
    descripcion = Descripcion
    WHERE idTalla = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE buscarTalla(IN Valor TINYTEXT)
BEGIN 
    SELECT * FROM inventario_tallas 
    WHERE estado=1 AND 
    (descripcion LIKE CONCAT('%',Valor,'%'));
END/
CREATE OR REPLACE PROCEDURE agregarProveedor(IN _empresa TINYTEXT, IN _correo TINYTEXT,IN _telefono TINYTEXT, 
IN _contacto TINYTEXT, IN _correoContacto TINYTEXT, IN _telefonoContacto TINYTEXT)
BEGIN
    INSERT INTO inventario_proveedores(empresa,direccion,correo,telefono,nombreContacto,correoContacto, telefonoContacto)
    VALUES(_empresa,_direccion,_correo,_telefono,_contacto, _correoContacto, _telefonoContacto);
END/

CREATE OR REPLACE PROCEDURE eliminarProveedor(IN Id INT)
BEGIN
    UPDATE inventario_proveedores
    JOIN inventario ON inventario_proveedores.idProveedor = inventario.idProveedor
    SET inventario_proveedores.estado=0,inventario.estado=0
    WHERE inventario_proveedores.idProveedor=Id AND inventario_proveedores.estado=1;
END/

CREATE OR REPLACE PROCEDURE agregarTipoEmpleado(IN Descripcion TINYTEXT, IN Rol INT)
BEGIN
    INSERT INTO tipo_empleado(descripcion,idRol) VALUES (Descripcion, Rol);
END/

CREATE OR REPLACE PROCEDURE obtenerTipoEmpleados()
BEGIN
    SELECT * FROM tipo_empleado WHERE estado = 1;
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