

CREATE PROCEDURE sp_RegistrarProducto(
    IN p_Codigo VARCHAR(20),
    IN p_Nombre VARCHAR(30),
    IN p_Descripcion VARCHAR(30),
    IN p_IdCategoria INT,
    IN p_Estado BIT,
    OUT p_Resultado INT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    SET p_Resultado = 0;

    IF NOT EXISTS (SELECT * FROM producto WHERE Codigo = p_Codigo) THEN
        INSERT INTO producto (Codigo, Nombre, Descripcion, IdCategoria, Estado) 
        VALUES (p_Codigo, p_Nombre, p_Descripcion, p_IdCategoria, p_Estado);

        SET p_Resultado = LAST_INSERT_ID();
    ELSE
        SET p_Mensaje = 'Ya existe un producto con el mismo código';
    END IF;
END 

