USE [Domowe_Wydatki]
GO
/****** Object:  StoredProcedure [dbo].[proc_update_row]    Script Date: 2021-01-23 20:24:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Marek Kurañda>
-- Create date: <2021-01-26>
-- Description:	<Updating Kategorie>
-- =============================================
CREATE PROCEDURE [dbo].[proc_update_to_Kategorie]
	@id INT,
	@nazwa_kategorii varchar(50) = NULL
AS
BEGIN
	SET NOCOUNT ON;

	UPDATE [dbo].[Kategorie] SET [Nazwa kategorii] = @nazwa_kategorii WHERE [Nr] = @id;
END
