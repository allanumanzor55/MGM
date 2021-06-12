DROP PROCEDURE IF EXISTS guardarCliente;
DROP PROCEDURE IF EXISTS obtenerCliente;
DROP PROCEDURE IF EXISTS obtenerClientes;
DROP PROCEDURE IF EXISTS eliminarCliente;
DROP PROCEDURE IF EXISTS modificarCliente;
DROP PROCEDURE IF EXISTS buscarCliente;
DELIMITER /
CREATE PROCEDURE guardarCliente(IN _tipoCliente INT, IN _dni TINYTEXT,
IN _nombre TINYTEXT, IN _primerApellido TINYTEXT, IN _segundoApellido TINYTEXT,
IN _direccion TINYTEXT, IN _correo TINYTEXT, IN _celular TINYTEXT, IN _telefono TINYTEXT, IN _edad VARCHAR(3))
BEGIN
    INSERT INTO clientes (tipoCliente,dni, nombre, primerApellido, segundoApellido,direccion, correo, celular, telefono,edad) 
    VALUES (_tipoCliente,_dni, _nombre, _primerApellido, _segundoApellido, _direccion, _correo, _celular, _telefono,_edad); 
END/

CREATE PROCEDURE obtenerClientes()
BEGIN   
    SELECT * FROM clientes WHERE estado = 1;
END/

CREATE PROCEDURE obtenerCliente(IN _id INT)
BEGIN
    SELECT * FROM clientes WHERE idCliente = _id AND estado = 1;
END/

CREATE PROCEDURE modificarCliente(IN _tipoCliente INT,IN _dni TINYTEXT,IN _nombre TINYTEXT, IN _primerApellido TINYTEXT, 
IN _segundoApellido TINYTEXT,IN _direccion TINYTEXT, IN _correo TINYTEXT, IN _celular TINYTEXT, 
IN _telefono TINYTEXT, IN _edad VARCHAR(3),IN _id INT)
BEGIN 
    UPDATE clientes SET 
        tipoCliente = _tipoCliente,
        dni = _dni,
        nombre = _nombre,
        primerApellido = _primerApellido,
        segundoApellido = _segundoApellido,
        direccion = _direccion,
        correo = _correo,
        celular = _celular,
        telefono = _telefono,
        edad = _edad
    WHERE idCliente  = _id AND estado = 1;
END/

CREATE PROCEDURE eliminarCliente(IN _id INT )
BEGIN
    UPDATE clientes SET estado = 0 WHERE idCliente = _id AND estado = 1;
END/

CREATE PROCEDURE buscarCliente(IN _valor TINYTEXT)
BEGIN 
    SELECT * FROM clientes
    WHERE estado=1 AND 
    (nombre LIKE CONCAT('%',_valor,'%') OR primerApellido LIKE CONCAT('%',_valor,'%') OR segundoApellido LIKE CONCAT('%',_valor,'%'));
END/