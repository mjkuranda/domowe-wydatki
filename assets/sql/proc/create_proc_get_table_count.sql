CREATE PROCEDURE proc_get_table_count
@table NVARCHAR(50)
AS
BEGIN
	DECLARE @c AS INT;
	DECLARE @SqlStatment AS NVARCHAR(1000)
    
	SET @SqlStatment = 'SELECT COUNT(*) FROM ' + @table;

	EXECUTE sp_executesql @SqlStatment
END