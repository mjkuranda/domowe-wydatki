CREATE VIEW view_select_all_Logi
AS
	SELECT	l.[Nr],
			u.[Nazwa użytkownika] AS [Użytkownik],
			l.[Data],
			l.[Opis]
	FROM	[dbo].[Logi] AS l
	INNER JOIN [dbo].[Użytkownicy] AS u ON u.Nr = l.[Nr użytkownika];