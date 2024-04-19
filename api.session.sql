
CREATE PROCEDURE SP_REGISTRARUSUARIO(
    IN p_Cedula VARCHAR(50),
    IN p_NombreCompleto VARCHAR(100),
    IN p_Correo VARCHAR(100),
    IN p_Clave VARCHAR(100),
    IN p_IdRol INT,
    IN p_Estado bit,
    OUT p_IdUsuarioResultado INT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    DECLARE existe_usuario INT;

    SET p_IdUsuarioResultado = 0;
    SET p_Mensaje = '';

    SELECT COUNT(*) INTO existe_usuario FROM USUARIO WHERE Cedula = p_Cedula;

    IF existe_usuario = 0 THEN
        INSERT INTO USUARIO (Cedula, NombreCompleto, Correo, Clave, IdRol, Estado) 
        VALUES (p_Cedula, p_NombreCompleto, p_Correo, p_Clave, p_IdRol, p_Estado);
        
        SET p_IdUsuarioResultado = LAST_INSERT_ID();
    ELSE
        SET p_Mensaje = 'No se puede repetir la cédula para más de un usuario';
    END IF;

END 
