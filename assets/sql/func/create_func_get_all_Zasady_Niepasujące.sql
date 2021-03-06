CREATE FUNCTION func_get_all_Zasady_Niepasujące
(
	@id INT
)
RETURNS TABLE
AS
	RETURN
		SELECT	z.[Nr],
				z.[Nazwa],
				z.[Opis]
		FROM	view_select_all_Zasady AS z,
				view_select_all_Użytkownicy AS us
		WHERE	us.[Nr] = @id
			AND
				z.[Nr] NOT IN (SELECT [Nr zasady] FROM view_select_all_Uprawnienia WHERE [Nr użytkownika] = @id)