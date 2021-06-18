DROP PROCEDURE IF EXISTS comprobarUser;
DROP PROCEDURE IF EXISTS comprobarPassword;
DROP PROCEDURE IF EXISTS login;
DROP PROCEDURE IF EXISTS comprobarLogin;
DROP PROCEDURE IF EXISTS logout;
DROP PROCEDURE IF EXISTS obtenerPermisos;
DELIMITER /
CREATE PROCEDURE comprobarUser(IN _user TINYTEXT, OUT id INT)
BEGIN
    DECLARE n INT;
    SELECT COUNT(*) INTO n FROM vw_usuarios WHERE usuario = _user;
    IF n>0 THEN
        SELECT idUsuario INTO id FROM vw_usuarios WHERE usuario = _user;
    ELSE 
        SET id:=0;
    END IF;
END/

CREATE PROCEDURE comprobarPassword(IN id INT, IN _password TINYTEXT,OUT validado BOOLEAN)
BEGIN
    DECLARE pass TINYTEXT;
    SELECT CONVERT(UNHEX(AES_DECRYPT(usuarios.password,usuarios.usuario)) USING utf8) INTO pass
    FROM usuarios WHERE idUsuario=id;
    IF _password = pass THEN
        SET validado := TRUE;
    ELSE
        SET validado := FALSE;
    END IF;
END/

CREATE PROCEDURE login(IN id INT, IN _token TEXT)
BEGIN
    UPDATE usuarios SET token=_token WHERE idUsuario = id;
END/ 

CREATE PROCEDURE comprobarLogin(IN _token TINYTEXT, OUT validado BOOLEAN)
BEGIN
    DECLARE n INT;
    SELECT COUNT(*) INTO n FROM usuarios WHERE token = _token;
    IF n > 0 THEN
        SET validado = TRUE;
    ELSE 
        SET validado = FALSE;
    END IF;
END/

CREATE PROCEDURE logout(IN id INT)
BEGIN
    UPDATE usuarios SET token = "" WHERE idUsuario = id;
END/

CREATE PROCEDURE obtenerPermisos(IN id INT)
BEGIN
    SELECT rol.idRol,rol.rol, rol.empleados, rol.clientes, rol.inventario, rol.inventarioFinal, rol.fichaProducto,
    rol.ventas, rol.configuracion FROM roles rol 
    JOIN vw_usuarios us ON us.idRol = rol.idRol
    WHERE us.idUsuario = id;
END/