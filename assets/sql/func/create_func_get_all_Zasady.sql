CREATE FUNCTION func_get_all_Zasady ()
RETURNS TABLE
AS
	RETURN SELECT * FROM view_select_all_Zasady;