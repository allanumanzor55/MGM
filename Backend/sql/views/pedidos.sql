CREATE OR REPLACE VIEW vw_pedidos
AS
SELECT pedidos.idPedido,pedidos.fechaPedido,pedidos.descripcion,pedidos.idCliente,clientes.nombre,pedidos.estadoPago
FROM pedidos 
JOIN clientes ON pedidos.idCliente = clientes.idCliente
WHERE pedidos.estado=1;

CREATE OR REPLACE VIEW vw_productosPedidos
AS 
SELECT pedidos_productos.idPedido, pedidos_productos.idProducto,vw_inventario.tipo, vw_inventario.material, vw_inventario.estilo, vw_inventario.talla,vw_inventario.color,vw_inventario.precio,
pedidos_productos.cantidad,pedidos_productos.subtotal 
FROM pedidos_productos
JOIN vw_inventario ON vw_inventario.idInventario = pedidos_productos.idProducto
WHERE pedidos_productos.estado=1;