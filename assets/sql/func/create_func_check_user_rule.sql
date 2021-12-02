SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kurañda
-- Create date: 2021-01-20
-- Description:	Returns bit if a user has a rule
-- =============================================
CREATE FUNCTION func_check_user_rule
(
	@nr_user	INT,
	@nr_rule	INT
)
RETURNS BIT
AS
BEGIN
	DECLARE @r BIT;
	SET @r = (SELECT COUNT(*) FROM [Uprawnienia] WHERE [Nr zasady] = @nr_rule AND [Nr u¿ytkownika] = @nr_user);

	-- Zwróæ rezultat
	RETURN @r;
END
