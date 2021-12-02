SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Marek Kurañda
-- Create date: 2021-01-29
-- Description:	Forbids to insert records in "Zasady"
-- =============================================
CREATE TRIGGER [dbo].[trig_insert_rule]
   ON  [dbo].[Zasady]
   AFTER INSERT
AS 
	PRINT 'Nie mo¿esz dodawaæ nowych zasad!';
GO
