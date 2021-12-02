CREATE FUNCTION func_get_all_Sklepy ()
RETURNS TABLE
AS
	RETURN SELECT [Nr], [Nazwa] FROM view_select_all_Sklepy;