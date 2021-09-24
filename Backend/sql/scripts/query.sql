INSERT INTO master_password VALUES (AES_ENCRYPT(HEX('MarioGraphics-31-12-1997'),'KarlaRafaelMario'));
SELECT CONVERT(UNHEX(AES_DECRYPT(contra,'KarlaRafaelMario')) USING utf8) FROM master_password;
SELECT CONVERT(UNHEX(AES_DECRYPT(usuarios.password,usuarios.usuario)) USING utf8) FROM usuarios;
INSERT INTO usuarios('admin','EMPLEADO',password,token) VALUES(usuario,'EMPLEADO',AES_ENCRYPT(HEX('admin'),'admin'),0);
INSERT INTO empleados