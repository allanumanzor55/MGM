DELIMITER /
CREATE OR REPLACE PROCEDURE obtenerGuias()
BEGIN
    SELECT * FROM vw_guia_remision;
END/

CREATE OR REPLACE PROCEDURE obtenerGuia(IN id INT)
BEGIN
    SELECT * FROM vw_guia_remision WHERE idGuia = id;
END/

CREATE OR REPLACE PROCEDURE obtenerMateriaPrimaGuia(IN _guia INT, IN _materia INT)
BEGIN
    SELECT * FROM vw_materia_prima_remision WHERE idGuia = _guia AND idMateriaPrima = _materia;
END/

CREATE OR REPLACE PROCEDURE obtenerMaterialGuia(IN _guia INT, IN _material INT)
BEGIN
    SELECT * FROM vw_materiales_remision WHERE idGuia = _guia AND idMaterial = _material;
END/

CREATE OR REPLACE PROCEDURE obtenerMateriasPrimasGuia(IN _guia INT)
BEGIN
    SELECT * FROM vw_materia_prima_remision WHERE idGuia = _guia;
END/

CREATE OR REPLACE PROCEDURE obtenerMaterialesGuia(IN _guia INT)
BEGIN
    SELECT * FROM vw_materiales_remision WHERE idGuia = _guia;
END/