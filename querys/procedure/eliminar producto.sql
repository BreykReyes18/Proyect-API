

CREATE PROCEDURE SP_EliminarProducto(
    IN p_IdProducto INT,
    OUT p_Respuesta BIT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    DECLARE pasoreglas BIT DEFAULT 1;

    SET p_Respuesta = 0;
    SET p_Mensaje = '';

    IF EXISTS (
        SELECT * FROM DETALLE_VENTA dv
        INNER JOIN PRODUCTO p ON p.IdProducto = dv.IdProducto
        WHERE p.IdProducto = p_IdProducto
    )
    THEN
        SET pasoreglas = 0;
        SET p_Mensaje = CONCAT(p_Mensaje, 'No se puede eliminar porque se encuentra relacionado a una VENTA\n');
    END IF;

    IF pasoreglas = 1 THEN
        DELETE FROM PRODUCTO WHERE IdProducto = p_IdProducto;
        SET p_Respuesta = 1;
    END IF;
END 

