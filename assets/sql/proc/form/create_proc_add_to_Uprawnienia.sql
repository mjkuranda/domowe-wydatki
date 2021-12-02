SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Marek Kurañda>
-- Create date: <2021-01-23>
-- Description:	<Adding new rule for user>
-- =============================================
CREATE PROCEDURE proc_add_to_Uprawnienia
	@id_u	int		= NULL, 
	@id_z	int		= NULL
AS
BEGIN
	SET NOCOUNT ON;

	INSERT
		INTO [dbo].[Uprawnienia] ([Nr u¿ytkownika], [Nr zasady])
		VALUES (@id_u, @id_z);
END
GO