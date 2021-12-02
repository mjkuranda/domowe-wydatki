SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Marek Kurañda>
-- Create date: <2020-12-29>
-- Description:	<Adding new person>
-- =============================================
CREATE PROCEDURE proc_add_to_Osoby
	@imie     nvarchar(30) = NULL, 
	@nazwisko nvarchar(30) = NULL
AS
BEGIN
	SET NOCOUNT ON;

	INSERT INTO [dbo].[Osoby] (Imiê, Nazwisko) VALUES (@imie, @nazwisko);
END
GO