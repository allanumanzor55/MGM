INSERT INTO usuarios(usuario,TipoUsuario,password,token) VALUES('admin','EMPLEADO',AES_ENCRYPT(HEX('admin'),'admin'),0);
INSERT INTO roles(rol,descripcion,empleados,clientes,inventario,guiaRemision,bodegas,catalogo,cotizacion,pedido,configuracion) VALUES('ADMINISTRADOR','ROL CON TODO LOS PRIVILEGIOS',3,3,3,3,3,3,3,3,3);
INSERT INTO roles(rol,descripcion,empleados,clientes,inventario,guiaRemision,bodegas,catalogo,cotizacion,pedido,configuracion) VALUES('Usuario Estandar','ROL SIN PRVILEGIOS',0,0,0,0,0,0,0,0,0);
INSERT INTO tipo_empleado(descripcion,idRol) VALUES ('GERENTE',1);
INSERT INTO fotografias_usuarios(fotografia,nombreFoto,tamano,formato) VALUES ('...','admin','137000','image/jpeg');
INSERT INTO empleados (idFoto,tipoEmpleado,dni,nombre,primerApellido,segundoApellido,direccion,correo,celular,telefono,sueldo,usuario)
VALUES (1,1,'0800-1111-22331','Jose Rafael','Herrera','Sagastume','Colonia Sagastume','rafa@gmail.com','99223312','31233132',23133,'admin');
INSERT INTO tipo_cliente(descripcion,idRol) values ('DETALLE',2);
INSERT INTO tipo_cliente(descripcion,idRol) values ('MAYORISTA',2);
INSERT INTO tipo_cliente(descripcion,idRol) values ('EVENTUAL',2);
INSERT INTO categoria_tipos (descripcion, material) VALUES ('gorras','plastico');
INSERT INTO categoria_tipos (descripcion, material) VALUES ('camisa','policoton');
INSERT INTO categoria_tipos (descripcion, material) VALUES ('camisa','algodon');

INSERT INTO inventario_categorias (idTipo,estilo) VALUES (1,'normal');
INSERT INTO inventario_categorias (idTipo,estilo) VALUES (2,'3/4');
INSERT INTO inventario_categorias (idTipo,estilo) VALUES (2,'manga larga');
INSERT INTO inventario_categorias (idTipo,estilo) VALUES (3,'manga sport');

INSERT INTO inventario_tallas (descripcion) VALUES ('xs');
INSERT INTO inventario_tallas (descripcion) VALUES ('xl');
INSERT INTO inventario_tallas (descripcion) VALUES ('s');

INSERT INTO bodegas (descripcion,ubicacion) VALUES ('Bodega Principal','Colonia E.');
INSERT INTO bodegas (descripcion,ubicacion) VALUES ('Bodega Insumos','Colonia 1.');
