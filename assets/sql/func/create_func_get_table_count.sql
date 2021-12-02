USE [Domowe_Wydatki]
GO
/****** Object:  UserDefinedFunction [dbo].[func_get_table_count]    Script Date: 2021-01-28 18:14:28 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER FUNCTION [dbo].[func_get_table_count] (@table VARCHAR(50), @count INT)
RETURNS INT
BEGIN
	DECLARE @c AS INT;
	DECLARE @q NVARCHAR(MAX);
	SET @q = 'SELECT COUNT(*) FROM [' + @table + ']';
	exec sp_executeSQl @q, @c;
	RETURN (@c / @count) + 1;
END