CREATE VIEW view_select_all_Logi
AS
	SELECT	l.[Nr],
			u.[Nazwa u�ytkownika] AS [U�ytkownik],
			l.[Data],
			l.[Opis]
	FROM	[dbo].[Logi] AS l
	INNER JOIN [dbo].[U�ytkownicy] AS u ON u.Nr = l.[Nr u�ytkownika];