CREATE FUNCTION func_get_all_Osoby ()
RETURNS TABLE
AS
	RETURN SELECT [Nr], CONCAT([Imię], ' ', [Nazwisko]) AS [Osoba] FROM view_select_all_Osoby;