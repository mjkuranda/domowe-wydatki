SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Marek Kurañda>
-- Create date: <2021-01-19>
-- Description:	<Adding new log>
-- =============================================
CREATE PROCEDURE proc_add_to_Logi
	@nr_u¿ytkownika int				= NULL, 
	@data			smalldatetime	= NULL,
	@opis			nvarchar(100)	= NULL
AS
BEGIN
	SET NOCOUNT ON;

	INSERT
		INTO [dbo].[Logi] ([Nr u¿ytkownika], [Data], [Opis])
		VALUES (@nr_u¿ytkownika, @data, @opis);
END
GO