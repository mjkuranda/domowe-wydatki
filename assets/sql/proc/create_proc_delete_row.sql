SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Marek Kurañda>
-- Create date: <2021-01-13>
-- Edited date: <2021-01-23>
-- Description:	<Deleting one row>
-- =============================================
CREATE PROCEDURE [dbo].[proc_delete_row]
	@table	nvarchar(50) = NULL, 
	@id		nvarchar(30) = NULL,
	@id2	nvarchar(30) = NULL
AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @SqlStatment AS NVARCHAR(1000);
	
	IF (LEN(@id2) <> 0)
		SET @SqlStatment = 'DELETE FROM [dbo].[Uprawnienia] WHERE [Nr u¿ytkownika] = ' + @id + ' AND [Nr zasady] = ' + @id2;
	ELSE
		SET @SqlStatment = 'DELETE FROM [dbo].[' + @table + '] WHERE [Nr] = ' + @id;
	EXECUTE sp_executesql @SqlStatment;
END
