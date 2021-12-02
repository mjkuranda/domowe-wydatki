CREATE VIEW view_select_all_Nousers
AS
	SELECT	o.[Nr],
			o.[Imiê],
			o.[Nazwisko]
	FROM	view_select_all_Osoby AS o
	LEFT JOIN view_select_all_U¿ytkownicy AS u
	ON o.Nr = u.Nr
	WHERE	u.Nr IS NULL