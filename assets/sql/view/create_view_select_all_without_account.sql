SELECT	*
	FROM	[dbo].[Osoby]
	WHERE	[Nr] NOT IN (SELECT [Nr] FROM view_select_all_Osoby);