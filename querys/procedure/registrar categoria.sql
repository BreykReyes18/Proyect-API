

CREATE PROCEDURE SP_RegistrarCategoria(
    IN p_Descripcion VARCHAR(50),
    IN p_Estado BIT,
    OUT p_Resultado INT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    SET p_Resultado = 0;

    IF NOT EXISTS (SELECT * FROM CATEGORIA WHERE Descripcion = p_Descripcion) THEN
        INSERT INTO CATEGORIA (Descripcion, Estado) VALUES (p_Descripcion, p_Estado);
        SET p_Resultado = LAST_INSERT_ID();
    ELSE
        SET p_Mensaje = 'No se puede repetir la descripción de una categoría';
    END IF;
END 


