CREATE VIEW view_select_all_Uprawnienia
AS
	SELECT	uz.[Nr] AS [Nr u�ytkownika],
			z.[Nr] AS [Nr zasady],
			uz.[Nazwa u�ytkownika] AS [Nazwa u�ytkownika],
			z.[Nazwa] AS [Nazwa zasady]
	FROM	[dbo].[Uprawnienia] AS up
	INNER JOIN [dbo].[U�ytkownicy] AS uz ON uz.[Nr] = up.[Nr u�ytkownika]
	INNER JOIN [dbo].[Zasady] AS z ON z.[Nr] = up.[Nr zasady];