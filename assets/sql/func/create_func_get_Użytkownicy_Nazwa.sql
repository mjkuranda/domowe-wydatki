SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kurañda
-- Create date: 2021-01-16
-- Description:	Returns user name
-- =============================================
CREATE FUNCTION func_get_U¿ytkownicy_Nazwa
(
	@id VARCHAR(30)
)
RETURNS TABLE
AS
	RETURN SELECT [Nazwa u¿ytkownika] FROM [dbo].[view_select_all_U¿ytkownicy] WHERE [Nr] = @id;

