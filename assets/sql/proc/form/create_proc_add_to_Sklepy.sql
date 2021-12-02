SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Marek Kurañda>
-- Create date: <2021-01-13>
-- Description:	<Adding new shop>
-- =============================================
CREATE PROCEDURE proc_add_to_Sklepy
	@nazwa			nvarchar(50)	= NULL, 
	@adres			nvarchar(50)	= NULL,
	@kod_pocztowy	nvarchar(6)		= NULL,
	@miasto			nvarchar(50)	= NULL,
	@telefon		nvarchar(10)	= NULL
AS
BEGIN
	SET NOCOUNT ON;

	INSERT
		INTO [dbo].[Sklepy] (Nazwa, Adres, [Kod pocztowy], Miasto, Telefon)
		VALUES (@nazwa, @adres, @kod_pocztowy, @miasto, @telefon);
END
GO