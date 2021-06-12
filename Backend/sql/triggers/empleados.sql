DROP TRIGGER IF EXISTS tg_crearUsuario;
DELIMITER *
CREATE TRIGGER tg_crearUsuario
BEFORE INSERT ON empleados
FOR EACH ROW
BEGIN
    DECLARE permiso INT;
    DECLARE usuario VARCHAR(64);
    DECLARE p VARCHAR(32);
    DECLARE id INT;
    SELECT COUNT(idEmpleado) INTO id FROM empleados;
    SELECT CONCAT(NEW.nombre,SUBSTR(NEW.primerApellido,1,3),id+1) INTO usuario;
    SELECT CONCAT(SUBSTR(usuario,3,1),SUBSTR(UUID(),3,7),SUBSTR(new.primerApellido,1,3)) INTO p;
    IF NEW.tipoEmpleado=1 THEN
        SET permiso=3;
    ELSEIF NEW.tipoEmpleado=2 THEN
        SET permiso=2;
    ELSEIF NEW.tipoEmpleado=3 THEN
        SET permiso=1;
    ELSE 
        SET permiso=4; 
    END IF;
    INSERT INTO usuarios(usuario,password,token,idRol) VALUES(usuario,AES_ENCRYPT(HEX(p),CONCAT(usuario,permiso,usuario)),null,permiso);
    SET NEW.usuario := usuario;
END*
