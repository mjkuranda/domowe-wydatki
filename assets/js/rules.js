var
    rules = null;

$(document).ready(rulesReady);

function rulesReady () {
    $(document).on('change', 'select#Użytkownicy', changeUser);

    $.ajax({
        url: 'site/tiles/get_all_options.php',
        method: 'POST',
        data: { "table": "Użytkownicy" },
        dataType: 'html',
        async: false,
        success: (data) => { print('Success'); $('select#Użytkownicy').html(data); },
        error: (x, y, z) => { console.log('Error:', x, y, z); }
    })
    .done(() => { print('Done!'); });
}

function changeUser () {
    // Wyczyść selecta
    $('select#Zasady_Niepasujące').html('');

    // Pobierz dostępne zasady
    let id = $('select#Użytkownicy').children(':selected').attr('id');
    let d  = JSON.parse('{ "table": "Zasady_Niepasujące", "user": ' + id + ' }');
    $.ajax({
        url: 'site/tiles/get_all_options.php',
        method: 'POST',
        data: d,
        dataType: 'html',
        async: false,
        success: (data) => { print('Success'); $('select#Zasady_Niepasujące').html(data); console.log(data); },
        error: (x, y, z) => { console.log('Error:', x, y, z); }
    })
    .done(() => { print('Done!'); });

    // Dodaj nowe zasady
}