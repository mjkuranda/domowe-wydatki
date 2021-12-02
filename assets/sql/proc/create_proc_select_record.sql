SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kurañda
-- Create date: 2021-01-22
-- Description:	Select one record
-- =============================================
CREATE PROCEDURE proc_select_record
	@table NVARCHAR(50),
	@id NVARCHAR(10)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	DECLARE @SqlStatment AS NVARCHAR(1000)
    
	SET @SqlStatment = 'SELECT * FROM view_select_all_' + @table + ' WHERE [Nr] = ' + @id;

	EXECUTE sp_executesql @SqlStatment;
END
GO