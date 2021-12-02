SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kura�da
-- Create date: 2021-01-20
-- Description:	Returns bit if a rule exits
-- =============================================
CREATE FUNCTION func_check_rule
(
	@nr		INT = -1,
	@nazwa	VARCHAR(30) = NULL
)
RETURNS VARCHAR(30)
AS
BEGIN
	DECLARE @r BIT;
	SET @r = 0;

	-- Je�li ustawiono numer
	IF (@nr != -1 AND @nr != 0)
		SET @r = (SELECT COUNT(*) FROM [Zasady] WHERE [Nr] = @nr);
	-- Je�li ustawiono nazw�
	ELSE   
		BEGIN  
			IF (LEN(@nazwa) > 4)
				SET @r = (SELECT COUNT(*) FROM [Zasady] WHERE [Nazwa] = @nazwa);  
		END;

	-- Zwr�� rezultat
	RETURN @r;
END
