CREATE PROCEDURE proc_paging
	@description VARCHAR(100)
AS
	INSERT INTO [Logi] ([Opis]) VALUES (@description)