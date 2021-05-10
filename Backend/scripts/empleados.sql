DROP PROCEDURE IF EXISTS guardarEmpleado;
DROP PROCEDURE IF EXISTS obtenerEmpleados;
DROP PROCEDURE IF EXISTS obtenerEmpleado;
DROP PROCEDURE IF EXISTS modificarEmpleado;
DROP PROCEDURE IF EXISTS eliminarEmpleado;
DROP PROCEDURE IF EXISTS buscarEmpleado;

DELIMITER /

CREATE PROCEDURE guardarEmpleado(IN _tipoEmpleado INT, IN _dni TINYTEXT,
IN _nombre TINYTEXT, IN _primerApellido TINYTEXT, IN _segundoApellido TINYTEXT,
IN _direccion TINYTEXT, IN _correo TINYTEXT, IN _celular TINYTEXT, IN _telefono TINYTEXT,
IN _sueldo DECIMAL(11,2))
BEGIN 
    INSERT INTO 
    empleados(tipoEmpleado, nombre, dni , primerApellido, segundoApellido,direccion, correo, celular, telefono, sueldo) 
    VALUES(_tipoEmpleado, _nombre, _dni, _primerApellido, _segundoApellido, _direccion, _correo, _celular, _telefono, _sueldo); 
END/

CREATE PROCEDURE obtenerEmpleados()
BEGIN
    SELECT * FROM empleados WHERE estado=1;
END/

CREATE PROCEDURE obtenerEmpleado(IN _id INT )
BEGIN
    SELECT * FROM empleados WHERE idEmpleado = _id AND estado = 1;
END/

CREATE PROCEDURE modificarEmpleado(IN _dni TINYTEXT,
IN _nombre TINYTEXT, IN _primerApellido TINYTEXT, IN _segundoApellido TINYTEXT,
IN _direccion TINYTEXT, IN _correo TINYTEXT, IN _celular TINYTEXT, IN _telefono TINYTEXT,
IN _sueldo DECIMAL(11,2),IN _id INT )
BEGIN 
    UPDATE 
    empleados SET
        dni = _dni,
        nombre = _nombre,
        primerApellido = _primerApellido,
        segundoApellido = _segundoApellido,
        direccion = _direccion,
        correo = _correo,
        celular = _celular,
        telefono = _telefono,
        sueldo = _sueldo
    WHERE idEmpleado = _id AND estado = 1;
END/

CREATE PROCEDURE eliminarEmpleado(IN _id INT)
BEGIN 
    UPDATE empleados SET estado = 0 WHERE idEmpleado = _id AND estado =1;
END/

CREATE PROCEDURE buscarEmpleado(IN _valor TINYTEXT)
BEGIN 
    SELECT * FROM empleados 
    WHERE estado=1 AND 
    (nombre LIKE CONCAT('%',_valor,'%') OR primerApellido LIKE CONCAT('%',_valor,'%') OR segundoApellido LIKE CONCAT('%',_valor,'%'));
END/

DROP TRIGGER IF EXISTS tg_crearUsuario;
DELIMITER *
CREATE TRIGGER tg_crearUsuario
BEFORE INSERT ON empleados
FOR EACH ROW
BEGIN
    DECLARE permiso INT;
    DECLARE usuario VARCHAR(64);
    DECLARE id INT;
    SELECT COUNT(idEmpleado) INTO id FROM empleados;
    SELECT CONCAT(NEW.nombre,SUBSTR(NEW.primerApellido,1,3),id) INTO usuario;
    IF NEW.tipoEmpleado=1 THEN
        SET permiso=2;
    ELSEIF NEW.tipoEmpleado=2 THEN
        SET permiso=3;
    ELSEIF NEW.tipoEmpleado=3 THEN
        SET permiso=4;
    ELSE 
        SET permiso=1;
    END IF;
    INSERT INTO usuarios VALUES(usuario,null,null,permiso);
    SET NEW.usuario := usuario;
END*