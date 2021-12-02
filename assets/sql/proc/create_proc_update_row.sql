SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Marek Kurañda>
-- Create date: <2021-01-23>
-- Description:	<Updating one row>
-- =============================================
CREATE PROCEDURE proc_update_row
	@table nvarchar(50) = NULL, 
	@id nvarchar(30) = NULL,
	@q nvarchar(1000) = NULL
AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @SqlStatment AS NVARCHAR(1000);
	SET @SqlStatment = 'UPDATE [dbo].[' + @table + '] SET ' + @q + ' WHERE [Nr] = ' + @id;
	EXECUTE sp_executesql @SqlStatment;
END
GO