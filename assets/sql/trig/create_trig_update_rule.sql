SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kurañda
-- Create date: 2021-01-29
-- Description:	Forbids to change record in "Zasady"
-- =============================================
CREATE TRIGGER [dbo].[trig_update_rule]
   ON  [dbo].[Zasady]
   AFTER DELETE
AS 
BEGIN
	PRINT 'Nie mo¿esz zmieniaæ danych w tej tabelce!';
	ROLLBACK;
END
GO
