DROP TRIGGER IF EXISTS tg_crearUsuario;
DELIMITER *
CREATE TRIGGER tg_crearUsuario
BEFORE INSERT ON empleados
FOR EACH ROW
BEGIN
    DECLARE usuario VARCHAR(64);
    DECLARE p VARCHAR(32);
    DECLARE id INT;
    SELECT COUNT(idEmpleado) INTO id FROM empleados;
    SELECT CONCAT(SUBSTR(NEW.nombre,1,2),NEW.primerApellido,id+1) INTO usuario;
    SELECT CONCAT(SUBSTR(usuario,3,1),SUBSTR(UUID(),3,7),SUBSTR(new.primerApellido,1,3)) INTO p;
    INSERT INTO usuarios(usuario,password,token) VALUES(usuario,AES_ENCRYPT(HEX(p),usuario),0);
    SET NEW.usuario := usuario;
END*
