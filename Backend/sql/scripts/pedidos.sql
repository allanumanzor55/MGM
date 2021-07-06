DELIMITER /
CREATE OR REPLACE PROCEDURE crearPedido(IN Descripcion TINYTEXT,IN Cliente INT, IN EstadoPago TINYTEXT, OUT IdPedido INT)
BEGIN
    INSERT INTO pedidos(descripcion,idCliente,estadoPago) VALUES (Descripcion,Cliente,EstadoPago);
    SELECT LAST_INSERT_ID() INTO IdPedido;
END/

CREATE OR REPLACE PROCEDURE agregarProductoPedido(IN Pedido INT, IN Producto INT, IN Cantidad INT)
BEGIN
    DECLARE _subtotal DECIMAL(9,2);
    SELECT precio*Cantidad INTO _subtotal FROM inventario WHERE idInventario = Producto;
    INSERT INTO pedidos_productos(IdPedido,idProducto,cantidad,subtotal) 
    VALUES(Pedido,Producto,Cantidad,_subtotal);
END/

CREATE OR REPLACE PROCEDURE obtenerPedidos()
BEGIN
    SELECT * FROM vw_pedidos;
END/

CREATE OR REPLACE PROCEDURE obtenerPedido(IN Id INT)
BEGIN
    SELECT * FROM vw_pedidos WHERE IdPedido = Id;
END/

CREATE OR REPLACE PROCEDURE obtenerProductosPedido(IN Id INT)
BEGIN
    SELECT * FROM vw_pedidos WHERE IdPedido = Id;
END/

CREATE OR REPLACE PROCEDURE eliminarPedido(IN Id INT)
BEGIN
    UPDATE pedidos SET estado = 0 WHERE IdPedido = Id;
END/

CREATE OR REPLACE PROCEDURE buscarPedido(IN Valor TINYTEXT)
BEGIN
    SELECT * FROM vw_pedidos
    WHERE estado=1 AND 
    (fecha LIKE CONCAT('%',Valor,'%') OR nombre LIKE CONCAT('%',Valor,'%') OR descripcion LIKE CONCAT('%',Valor,'%'));
END/