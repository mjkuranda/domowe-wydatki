CREATE FUNCTION func_get_osoby_count (@count INT)
RETURNS INT
BEGIN
	DECLARE @c AS INT;
	SET @c = (SELECT COUNT(*) FROM [Osoby]);
	RETURN (@c / @count) + 1;
END