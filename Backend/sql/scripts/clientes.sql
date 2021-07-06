DELIMITER /
CREATE OR REPLACE PROCEDURE guardarCliente(IN TipoCliente INT, IN Dni TINYTEXT,
IN Nombre TINYTEXT, IN PrimerApellido TINYTEXT, IN SegundoApellido TINYTEXT,
IN Direccion TINYTEXT, IN Correo TINYTEXT, IN Celular TINYTEXT, IN Telefono TINYTEXT, IN Edad VARCHAR(3))
BEGIN
    INSERT INTO clientes (tipoCliente,dni, nombre, primerApellido, segundoApellido,direccion, correo, celular, telefono,edad) 
    VALUES (TipoCliente,Dni, Nombre, PrimerApellido, SegundoApellido, Direccion, Correo, Celular, Telefono,Edad); 
END/

CREATE OR REPLACE PROCEDURE obtenerClientes()
BEGIN   
    SELECT * FROM clientes WHERE estado = 1;
END/

CREATE OR REPLACE PROCEDURE obtenerCliente(IN Id INT)
BEGIN
    SELECT * FROM clientes WHERE idCliente = Id AND estado = 1;
END/

CREATE OR REPLACE PROCEDURE modificarCliente(IN TipoCliente INT,IN Dni TINYTEXT,IN Nombre TINYTEXT, IN PrimerApellido TINYTEXT, 
IN SegundoApellido TINYTEXT,IN Direccion TINYTEXT, IN Correo TINYTEXT, IN Celular TINYTEXT, 
IN Telefono TINYTEXT, IN Edad VARCHAR(3),IN Id INT)
BEGIN 
    UPDATE clientes SET 
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
    SELECT * FROM clientes
    WHERE estado=1 AND 
    (nombre LIKE CONCAT('%',Valor,'%') OR primerApellido LIKE CONCAT('%',Valor,'%') OR segundoApellido LIKE CONCAT('%',Valor,'%'));
END/