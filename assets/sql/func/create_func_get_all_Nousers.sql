SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kurañda
-- Create date: 2021-01-23
-- Description:	Returns all nousers
-- =============================================
CREATE FUNCTION func_get_all_Nousers ()
RETURNS TABLE
AS
	RETURN
		SELECT	[Nr],
				CONCAT([Imiê], ' ', [Nazwisko]) AS [Osoba]
		FROM	[view_select_all_Nousers];