USE [Domowe_Wydatki]
GO
/****** Object:  StoredProcedure [dbo].[proc_update_row]    Script Date: 2021-01-23 20:24:10 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Marek Kurañda>
-- Create date: <2021-01-23>
-- Description:	<Updating Osoby>
-- =============================================
ALTER PROCEDURE [dbo].[proc_update_to_Osoby]
	@id INT,
	@imie varchar(30) = NULL,
	@nazwisko varchar(30) = NULL
AS
BEGIN
	SET NOCOUNT ON;

	UPDATE [dbo].[Osoby] SET [Imiê] = @imie, [Nazwisko] = @nazwisko WHERE [Nr] = @id;
END
