SELECT CONVERT( AES_DECRYPT(usuarios.password,CONCAT(usuarios.usuario,usuarios.idPermiso,usuarios.usuario)) USING utf8) FROM usuarios;