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
-- Description:	<Updating Sklepy>
-- =============================================
CREATE PROCEDURE [dbo].[proc_update_to_Sklepy]
	@id INT,
	@nazwa varchar(50) = NULL,
	@adres varchar(50) = NULL,
	@kod_pocztowy nvarchar(6) = NULL,
	@miasto nvarchar(50) = NULL,
	@telefon nvarchar(10) = NULL
AS
BEGIN
	SET NOCOUNT ON;

	UPDATE [dbo].[Sklepy]
	SET [Nazwa] = @nazwa,
		[Adres] = @adres,
		[Kod pocztowy] = @kod_pocztowy,
		[Miasto] = @miasto,
		[Telefon] = @telefon
	WHERE [Nr] = @id;
END
