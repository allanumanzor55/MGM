DROP PROCEDURE IF EXISTS crearPedido;
DROP PROCEDURE IF EXISTS agregarProductoPedido;
DROP PROCEDURE IF EXISTS obtenerPedidos;
DROP PROCEDURE IF EXISTS obtenerPedido;
DROP PROCEDURE IF EXISTS obtenerProductosPedido;
DROP PROCEDURE IF EXISTS eliminarPedido;
DROP PROCEDURE IF EXISTS buscarPedido;
DELIMITER /
CREATE PROCEDURE crearPedido(IN _descripcion TINYTEXT,IN _cliente INT, IN _estadoPago TINYTEXT, OUT idPedido INT)
BEGIN
    INSERT INTO pedidos(descripcion,idCliente,estadoPago) VALUES (_descripcion,_cliente,_estadoPago);
    SELECT LAST_INSERT_ID() INTO idPedido;
END/

CREATE PROCEDURE agregarProductoPedido(IN _pedido INT, IN _producto INT, IN _cantidad INT)
BEGIN
    DECLARE _subtotal DECIMAL(9,2);
    SELECT precio*_cantidad INTO _subtotal FROM inventario WHERE idInventario = _producto;
    INSERT INTO pedidos_productos(idPedido,idProducto,cantidad,subtotal) 
    VALUES(_pedido,_producto,_cantidad,_subtotal);
END/

CREATE PROCEDURE obtenerPedidos()
BEGIN
    SELECT * FROM vw_pedidos;
END/

CREATE PROCEDURE obtenerPedido(IN _id INT)
BEGIN
    SELECT * FROM vw_pedidos WHERE idPedido = _id;
END/

CREATE PROCEDURE obtenerProductosPedido(IN _id INT)
BEGIN
    SELECT * FROM vw_pedidos WHERE idPedido = _id;
END/

CREATE PROCEDURE eliminarPedido(IN _id INT)
BEGIN
    UPDATE pedidos SET estado = 0 WHERE idPedido = _id;
END/

CREATE PROCEDURE buscarPedido(IN _valor TINYTEXT)
BEGIN
    SELECT * FROM vw_pedidos
    WHERE estado=1 AND 
    (fecha LIKE CONCAT('%',_valor,'%') OR nombre LIKE CONCAT('%',_valor,'%') OR descripcion LIKE CONCAT('%',_valor,'%'));
END/