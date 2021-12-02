CREATE VIEW view_select_all_U¿ytkownicy
AS
	SELECT	u.[Nr] AS [Nr],
			u.[Nazwa u¿ytkownika] AS [Nazwa u¿ytkownika],
			CONCAT(o.[Imiê], ' ', o.[Nazwisko]) AS [Osoba],
			u.[Has³o] AS [Has³o]
	FROM	[dbo].[U¿ytkownicy] AS u
	LEFT JOIN [dbo].[Osoby] AS o ON o.[Nr] = u.[Nr];