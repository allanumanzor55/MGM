DROP TRIGGER IF EXISTS tg_crearCatSinEstilo;
DELIMITER *
CREATE TRIGGER tg_crearCatSinEstilo
AFTER INSERT ON categoria_tipos
FOR EACH ROW
BEGIN
    INSERT INTO inventario_categorias(idTipo,estilo) VALUES (NEW.idTipo,"Sin Estilo");
END*