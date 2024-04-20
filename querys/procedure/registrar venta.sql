CREATE PROCEDURE usp_RegistrarVenta(
    IN p_IdUsuario INT,
    IN p_NombreCliente VARCHAR(500),
    IN p_MontoTotal DECIMAL(18,2),
    IN p_DetalleVentaTableName VARCHAR(255),
    OUT p_Resultado BIT,
    OUT p_Mensaje VARCHAR(500)
)
BEGIN
    DECLARE idventa INT DEFAULT 0;
    DECLARE dynamic_sql VARCHAR(1000);

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SET p_Resultado = 0;
        SET p_Mensaje = ERROR_MESSAGE();
        ROLLBACK;
    END;

    START TRANSACTION;

    INSERT INTO VENTA(IdUsuario, NombreCliente, MontoTotal)
    VALUES(p_IdUsuario, p_NombreCliente, p_MontoTotal);

    SET idventa = LAST_INSERT_ID();

    SET dynamic_sql = CONCAT('INSERT INTO DETALLE_VENTA(IdVenta, IdProducto, PrecioVenta, Cantidad, SubTotal)
                              SELECT ', idventa, ', IdProducto, PrecioVenta, Cantidad, SubTotal FROM ', p_DetalleVentaTableName);

    PREPARE stmt FROM dynamic_sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

    COMMIT;

    SET p_Resultado = 1;
    SET p_Mensaje = 'Venta registrada exitosamente';

END;

