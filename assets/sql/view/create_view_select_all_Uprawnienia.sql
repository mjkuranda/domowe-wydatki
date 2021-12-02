CREATE VIEW view_select_all_Uprawnienia
AS
	SELECT	uz.[Nr] AS [Nr u퓓tkownika],
			z.[Nr] AS [Nr zasady],
			uz.[Nazwa u퓓tkownika] AS [Nazwa u퓓tkownika],
			z.[Nazwa] AS [Nazwa zasady]
	FROM	[dbo].[Uprawnienia] AS up
	INNER JOIN [dbo].[U퓓tkownicy] AS uz ON uz.[Nr] = up.[Nr u퓓tkownika]
	INNER JOIN [dbo].[Zasady] AS z ON z.[Nr] = up.[Nr zasady];