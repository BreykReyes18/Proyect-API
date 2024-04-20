

CREATE PROCEDURE SP_ELIMINARUSUARIO(
    IN p_IdUsuario INT,
    OUT p_Respuesta BIT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    DECLARE pasoreglas BIT DEFAULT 1;

    SET p_Respuesta = 0;
    SET p_Mensaje = '';

    IF EXISTS (
        SELECT * FROM VENTA V
        INNER JOIN USUARIO U ON U.IdUsuario = V.IdUsuario
        WHERE U.IDUSUARIO = p_IdUsuario
    )
    THEN
        SET pasoreglas = 0;
        SET p_Mensaje = CONCAT(p_Mensaje, 'No se puede eliminar porque el usuario se encuentra relacionado a una VENTA\n');
    END IF;

    IF pasoreglas = 1 THEN
        DELETE FROM USUARIO WHERE IdUsuario = p_IdUsuario;
        SET p_Respuesta = 1;
    END IF;
END 


