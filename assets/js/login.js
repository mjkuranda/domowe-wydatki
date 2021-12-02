$(document).ready(loginReady);

function loginReady () {
    // Cancell that event
    $(document).off('click', 'form button[name="b_add"]', clickAdd);
    // Add new event
    $(document).on('click', 'form button[name="b_add"]', logIn);

    // Change title of page
    $('h1').html('Logowanie');
    $('legend').html('Podaj dane użytkownika');

    // Remove one option
    $('select#Osoby').parent().parent().remove();
}

function logIn () {
    let login    = $('input[name="Nazwa użytkownika"]').val();
    let password = $('input[name="Hasło"]').val();

    let logged = false;
    let id = -1;

    $.ajax({
        url: 'site/tiles/login.php',
        method: 'POST',
        data: { "Nazwa": login, "Hasło": password },
        dataType: 'json',
        async: false,
        success: (data) => { console.log(data); logged = data.logged; if (!data.logged) $('.form-info > p').html('Wystąpił błąd przy logowaniu!'); $('input[type=password]').val(''); },
        error: (x, y, z) => { print('Error!', x, y, z); $('.form-info > p').html('Wystąpił błąd!'); }
    }).fail( function(xhr, textStatus, errorThrown) {
        console.log(xhr.responseText);
    });

    if (logged) {
        // Return Nr
        $.ajax({
            url: 'site/tiles/get_Użytkownicy_Nr.php',
            method: 'POST',
            data: { "Nazwa": login },
            dataType: 'json',
            async: false,
            success: (data) => { console.log(data); id = data.Nr; },
            error: (x, y, z) => { print('Error!', x, y, z); }
        }).fail( function(xhr, textStatus, errorThrown) {
            console.log(xhr.responseText);
        });

        $.cookie('id_user', id, { expires: 1, path: '/' });
        window.location.href = window.location.origin + window.location.pathname.substring(0, 25) + 'main';
    }

    return false;
}