SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kura�da
-- Create date: 2021-01-20
-- Description:	Returns id of rule
-- =============================================
CREATE FUNCTION func_get_Zasady_Nr
(
	@nazwa VARCHAR(30)
)
RETURNS INT
AS
BEGIN
	DECLARE @r INT;
	SET @r = (SELECT [Nr] FROM [Zasady] WHERE [Nazwa] = @nazwa);

	-- Zwr�� rezultat
	RETURN @r;
END
