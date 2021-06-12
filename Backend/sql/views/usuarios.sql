CREATE OR REPLACE VIEW vw_usuarios
AS
SELECT empleado.idEmpleado,empleado.tipoEmpleado as "idTipoEmpleado",empleado.dni,empleado.nombre, 
empleado.primerApellido,empleado.segundoApellido,empleado.direccion,empleado.correo,empleado.celular,empleado.telefono,
empleado.sueldo,tipo.descripcion as "tipoEmpleado",usuario.idUsuario,usuario.usuario, usuario.password,usuario.token,usuario.idRol
FROM empleados empleado 
JOIN tipo_empleado tipo ON empleado.tipoEmpleado = tipo.idTipoEmpleado
JOIN usuarios usuario ON empleado.usuario = usuario.usuario
WHERE empleado.estado = 1;
