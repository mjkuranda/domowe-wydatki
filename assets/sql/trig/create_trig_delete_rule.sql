CREATE TRIGGER trig_delete_rule
	ON [dbo].[Zasady]
    FOR DELETE
AS
	PRINT 'Nie mo�esz usuwa� danych z tej tabeli!';
ROLLBACK;