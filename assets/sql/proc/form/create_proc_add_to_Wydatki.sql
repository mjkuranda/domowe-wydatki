SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Marek Kurañda>
-- Create date: <2021-01-25>
-- Description:	<Add Wydatki>
-- =============================================
CREATE PROCEDURE proc_add_to_Wydatki
	@nr_kategorii INT,
	@nr_osoby INT,
	@nr_sklepu INT,
	@data datetime,
	@kwota varchar(20),
	@opis nvarchar(80)
AS
BEGIN
	INSERT INTO [dbo].[Wydatki]
			([Nr kategorii], [Nr osoby], [Nr sklepu], [Data], [Kwota], [Opis])
	VALUES
			(@nr_kategorii, @nr_osoby, @nr_sklepu, @data, CAST(@kwota AS decimal(18, 2)), @opis);
END
GO
