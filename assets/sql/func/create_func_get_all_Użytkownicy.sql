CREATE FUNCTION func_get_all_Użytkownicy ()
RETURNS TABLE
AS
	RETURN SELECT * FROM view_select_all_Użytkownicy;