SELECT CONVERT(UNHEX(AES_DECRYPT(usuarios.password,CONCAT(usuarios.usuario,usuarios.idRol,usuarios.usuario))) USING utf8) FROM usuarios