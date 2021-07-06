CREATE OR REPLACE VIEW vw_usuarios
AS
SELECT empleado.idEmpleado as "id",empleado.tipoEmpleado as "idTipo",empleado.dni,empleado.nombre, 
empleado.primerApellido,empleado.segundoApellido,empleado.direccion,empleado.correo,empleado.celular,empleado.telefono,
empleado.sueldo,tipo.descripcion as "tipo",usuario.idUsuario,usuario.usuario,usuario.TipoUsuario, usuario.password,usuario.token,tipo.idRol
FROM empleados empleado 
JOIN tipo_empleado tipo ON empleado.tipoEmpleado = tipo.idTipoEmpleado
JOIN usuarios usuario ON empleado.usuario = usuario.usuario
WHERE empleado.estado = 1
UNION ALL
SELECT cliente.idCliente as "id",cliente.tipoCliente as "idTipo",cliente.dni,cliente.nombre, 
cliente.primerApellido,cliente.segundoApellido,cliente.direccion,cliente.correo,cliente.celular,cliente.telefono,
0,tipo.descripcion as "tipo",usuario.idUsuario,usuario.usuario,usuario.TipoUsuario, usuario.password,usuario.token,tipo.idRol
FROM clientes cliente 
JOIN tipo_cliente tipo ON cliente.tipoCliente = tipo.idTipoCliente
JOIN usuarios usuario ON cliente.usuario = usuario.usuario
WHERE cliente.estado = 1


