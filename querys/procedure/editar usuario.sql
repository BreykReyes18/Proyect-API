

CREATE PROCEDURE SP_EDITARUSUARIO(
    IN p_IdUsuario INT,
    IN p_Codigo VARCHAR(50),
    IN p_Nombre VARCHAR(100),
    IN p_Correo VARCHAR(100),
    IN p_Clave VARCHAR(100),
    IN p_IdRol INT,
    IN p_Estado BIT,
    OUT p_Respuesta BIT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    DECLARE existe_otro_usuario INT;

    SET p_Respuesta = 0;
    SET p_Mensaje = '';

    SELECT COUNT(*) INTO existe_otro_usuario 
    FROM usuario 
    WHERE Codigo = p_Codigo AND IdUsuario != p_IdUsuario;

    IF existe_otro_usuario = 0 THEN
        UPDATE usuario 
        SET Codigo = p_Codigo,
            Nombre = p_Nombre,
            Correo = p_Correo,
            Clave = p_Clave,
            IdRol = p_IdRol,
            Estado = p_Estado
        WHERE IdUsuario = p_IdUsuario;

        SET p_Respuesta = 1;
    ELSE
        SET p_Mensaje = 'No se puede repetir el documento para más de un usuario';
    END IF;

END 

