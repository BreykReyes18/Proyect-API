

CREATE PROCEDURE sp_EliminarCategoria(
    IN p_IdCategoria INT,
    OUT p_Resultado BIT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    DECLARE existe_relacion_producto INT;

    SET p_Resultado = 1;

    SELECT COUNT(*) INTO existe_relacion_producto 
    FROM CATEGORIA c
    INNER JOIN PRODUCTO p ON p.IdCategoria = c.IdCategoria
    WHERE c.IdCategoria = p_IdCategoria;

    IF existe_relacion_producto = 0 THEN
        DELETE FROM CATEGORIA WHERE IdCategoria = p_IdCategoria;
        SET p_Mensaje = 'Categoría eliminada exitosamente';
    ELSE
        SET p_Resultado = 0;
        SET p_Mensaje = 'La categoría se encuentra relacionada a un producto';
    END IF;
END 


