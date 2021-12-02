SELECT
	w.[Nr wydatku],
	k.[Nazwa kategorii],
	o.[Imię], o.[Nazwisko],
	s.[Nazwa],
	w.[Data],
	w.[Kwota],
	w.[Opis]
FROM [Wydatki] AS w
INNER JOIN [Kategorie] AS k ON w.[Nr kategorii] = k.[Nr kategorii]
INNER JOIN [Osoby] AS o ON w.[Nr osoby] = o.[Nr osoby]
INNER JOIN [Sklepy] AS s ON w.[Nr sklepu] = s.[Nr sklepu];