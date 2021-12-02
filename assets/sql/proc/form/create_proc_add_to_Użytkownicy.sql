SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kurañda
-- Create date: 2021-01-16
-- Description:	Adding new user
-- =============================================
CREATE PROCEDURE proc_add_to_U¿ytkownicy
	@nazwa			nvarchar(30)	= NULL,
	@haslo			nvarchar(32)	= NULL,
	@nr_osoby		int				= NULL
AS
BEGIN
	SET NOCOUNT ON;

	INSERT INTO [U¿ytkownicy] ([Nazwa u¿ytkownika], [Has³o]) VALUES (@nazwa, @haslo)

	DECLARE @id AS INT;
	SET @id = (SELECT MAX(Nr) FROM view_select_all_U¿ytkownicy)

	INSERT INTO [Powi¹zania] ([Nr Osoby], [Nr U¿ytkownika]) VALUES (@id, @id);
END
