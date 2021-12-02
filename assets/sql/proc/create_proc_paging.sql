CREATE PROCEDURE proc_paging
@table VARCHAR(50),
@offset VARCHAR(10),
@count  VARCHAR(10)
AS
BEGIN
	DECLARE @query NVARCHAR(MAX);
	IF (@table != 'view_select_all_Uprawnienia')
		SET @query = 'SELECT * FROM [' + @table + '] ORDER BY [Nr] ASC OFFSET ' + @offset + ' ROWS FETCH NEXT ' + @count + ' ROWS ONLY;';
	ELSE
		SET @query = 'SELECT * FROM [' + @table + '] ORDER BY [Nazwa u¿ytkownika] ASC OFFSET ' + @offset + ' ROWS FETCH NEXT ' + @count + ' ROWS ONLY;';
	EXEC (@query);
END