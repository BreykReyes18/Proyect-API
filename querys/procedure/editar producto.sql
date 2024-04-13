

CREATE PROCEDURE sp_ModificarProducto(
    IN p_IdProducto INT,
    IN p_Codigo VARCHAR(20),
    IN p_Nombre VARCHAR(30),
    IN p_Descripcion VARCHAR(30),
    IN p_IdCategoria INT,
    IN p_Estado BIT,
    OUT p_Resultado BIT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    DECLARE existe_otro_producto INT;

    SET p_Resultado = 1;

    SELECT COUNT(*) INTO existe_otro_producto 
    FROM PRODUCTO 
    WHERE codigo = p_Codigo AND IdProducto != p_IdProducto;

    IF existe_otro_producto = 0 THEN
        UPDATE PRODUCTO 
        SET codigo = p_Codigo,
            Nombre = p_Nombre,
            Descripcion = p_Descripcion,
            IdCategoria = p_IdCategoria,
            Estado = p_Estado
        WHERE IdProducto = p_IdProducto;
    ELSE
        SET p_Resultado = 0;
        SET p_Mensaje = 'Ya existe un producto con el mismo código';
    END IF;
END 


