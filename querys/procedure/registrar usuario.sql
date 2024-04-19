

CREATE PROCEDURE SP_REGISTRARUSUARIO(
    IN p_Codigo VARCHAR(50),
    IN p_Nombre VARCHAR(100),
    IN p_Cedula VARCHAR(15),
    IN p_Correo VARCHAR(100),
    IN p_Clave VARCHAR(100),
    IN p_IdRol INT,
    IN p_Estado BIT,
    OUT p_IdUsuarioResultado INT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    DECLARE existe_usuario INT;

    SET p_IdUsuarioResultado = 0;
    SET p_Mensaje = '';

    SELECT COUNT(*) INTO existe_usuario FROM usuario WHERE Codigo = p_Codigo;

    IF existe_usuario = 0 THEN
        INSERT INTO usuario (Codigo, Nombre, Cedula, Correo, Clave, IdRol, Estado) 
        VALUES (p_Codigo, p_Nombre,p_Cedula, p_Correo, p_Clave, p_IdRol, p_Estado);
        
        SET p_IdUsuarioResultado = LAST_INSERT_ID();
    ELSE
        SET p_Mensaje = 'No se puede repetir el documento para más de un usuario';
    END IF;

END 


