SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kurañda
-- Create date: 2021-01-14
-- Description:	Returns server datetime
-- =============================================
CREATE PROCEDURE proc_select_datetime
AS
BEGIN
	SET NOCOUNT ON;

    SELECT	CONCAT(
		CONVERT(DATE, GETDATE()),
		'T',
		CONVERT(TIME, GETDATE())
		);
END
GO
