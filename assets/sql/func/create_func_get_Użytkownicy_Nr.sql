SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kurañda
-- Create date: 2021-01-16
-- Description:	Returns user id
-- =============================================
CREATE FUNCTION func_get_U¿ytkownicy_Nr
(
	@name VARCHAR(30)
)
RETURNS TABLE
AS
	RETURN SELECT [Nr] FROM [dbo].[view_select_all_U¿ytkownicy] WHERE [Nazwa u¿ytkownika] = @name;

