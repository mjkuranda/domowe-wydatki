CREATE VIEW view_select_all_Uprawnienia
AS
	SELECT	uz.[Nr] AS [Nr użytkownika],
			z.[Nr] AS [Nr zasady],
			uz.[Nazwa użytkownika] AS [Nazwa użytkownika],
			z.[Nazwa] AS [Nazwa zasady]
	FROM	[dbo].[Uprawnienia] AS up
	INNER JOIN [dbo].[Użytkownicy] AS uz ON uz.[Nr] = up.[Nr użytkownika]
	INNER JOIN [dbo].[Zasady] AS z ON z.[Nr] = up.[Nr zasady];