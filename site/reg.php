<main class="center __col2">
    <div class="flex-center">
        <!-- Registration section -->
        <section>
            <form action="" method="POST">
                <fieldset>
                    <legend class="flex-center">Rejestracja użytkownika</legend>

                    <div class="flex-center">
                        <div class="flex-right"><label for="Nazwa użytkownika">Nazwa użytkownika:</label></div>
                        <div class="flex-left"><input type="text" name="Nazwa użytkownika" /></div>
                    </div>
                    <div class="flex-center">
                        <div class="flex-right"><label for="Osoba">Wybierz osobę:</label></div>
                        <div class="flex-left"><select name="Osoba"></select></div>
                    </div>

                    <br>

                    <div class="flex-center">
                        <div class="flex-right"><label for="Hasło">Hasło:</label></div>
                        <div class="flex-left"><input type="text" name="Hasło" /></div>
                    </div>
                    <div class="flex-center">
                        <div class="flex-right"><label for="Powtórz hasło">Powtórz hasło:</label></div>
                        <div class="flex-left"><input type="text" name="Powtórz hasło" /></div>
                    </div>
                </fieldset>

                <section class="reglog-bottom flex-center">
                    <button class="button-normal __col3" name="b_add" title="Dodaj rekord">Dodaj!</button>
                    <button class="button-normal __col3" name="b_clear" type="reset" title="Wyczyść formularz">Wyczyść</button>
                </section>
            </form>
        </section>
    </div>
</main>
<script src="assets/js/reglog.js"></script>