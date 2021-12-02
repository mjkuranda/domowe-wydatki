CREATE VIEW view_select_all_Logi
AS
	SELECT	l.[Nr],
			u.[Nazwa u퓓tkownika] AS [U퓓tkownik],
			l.[Data],
			l.[Opis]
	FROM	[dbo].[Logi] AS l
	INNER JOIN [dbo].[U퓓tkownicy] AS u ON u.Nr = l.[Nr u퓓tkownika];