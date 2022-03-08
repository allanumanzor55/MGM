DELIMITER /
DROP PROCEDURE IF EXISTS comprobarUser;
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
DROP PROCEDURE IF EXISTS obtenerId;
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

CREATE OR REPLACE PROCEDURE generarMasterPassword()
BEGIN
    DELETE FROM master_password;
    INSERT INTO master_password VALUES (AES_ENCRYPT(HEX(SUBSTR(UUID(),1,10)),'KarlaRafaelMario'));
END/
CREATE OR REPLACE PROCEDURE comprobarMasterPassword(IN MasterPassword TINYTEXT, OUT Validado BOOLEAN)
BEGIN
    DECLARE c TINYTEXT;
    SET Validado := FALSE;
    SELECT CONVERT(UNHEX(AES_DECRYPT(contra,'KarlaRafaelMario')) USING utf8) INTO c FROM master_password;
    IF c = MasterPassword THEN
        SET Validado = TRUE;
    END IF;
END/
