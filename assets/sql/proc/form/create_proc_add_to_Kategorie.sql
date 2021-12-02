SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Marek Kurañda>
-- Create date: <2021-01-13>
-- Description:	<Adding new category>
-- =============================================
CREATE PROCEDURE proc_add_to_Kategorie
	@nazwa_kategorii nvarchar(30) = NULL
AS
BEGIN
	SET NOCOUNT ON;

	INSERT INTO [dbo].[Kategorie] ([Nazwa kategorii]) VALUES (@nazwa_kategorii);
END
GO