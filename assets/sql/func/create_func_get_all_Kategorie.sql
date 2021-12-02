CREATE FUNCTION func_get_all_Kategorie ()
RETURNS TABLE
AS
	RETURN SELECT [Nr], [Nazwa Kategorii] FROM view_select_all_Kategorie;