

CREATE PROCEDURE sp_EditarCategoria(
    IN p_IdCategoria INT,
    IN p_Descripcion VARCHAR(50),
    IN p_Estado BIT,
    OUT p_Resultado BIT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    DECLARE existe_otra_categoria INT;

    SET p_Resultado = 1;

    SELECT COUNT(*) INTO existe_otra_categoria 
    FROM CATEGORIA 
    WHERE Descripcion = p_Descripcion AND IdCategoria != p_IdCategoria;

    IF existe_otra_categoria = 0 THEN
        UPDATE CATEGORIA 
        SET Descripcion = p_Descripcion,
            Estado = p_Estado
        WHERE IdCategoria = p_IdCategoria;
    ELSE
        SET p_Resultado = 0;
        SET p_Mensaje = 'No se puede repetir la descripción de una categoría';
    END IF;
END 

