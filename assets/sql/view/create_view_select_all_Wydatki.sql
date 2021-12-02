CREATE VIEW view_select_all_Wydatki
AS
	SELECT
		w.[Nr],
		k.[Nazwa kategorii],
		CONCAT(o.[Imiê], ' ', o.[Nazwisko]) AS Osoba,
		s.[Nazwa],
		w.[Data],
		ROUND(w.[Kwota], 2) AS Kwota,
		w.[Opis]
	FROM [Wydatki] AS w
	INNER JOIN [Kategorie] AS k ON w.[Nr kategorii] = k.[Nr]
	INNER JOIN [Osoby] AS o ON w.[Nr osoby] = o.[Nr]
	INNER JOIN [Sklepy] AS s ON w.[Nr sklepu] = s.[Nr];