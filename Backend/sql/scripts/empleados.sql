DELIMITER /
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