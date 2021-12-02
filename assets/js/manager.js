var id_palette     = 0,
    id_font_family = 'Times New Roman',
    id_font_color  = '#00FF00';
var date_client    = getTime(new Date().getHours() + ':' + new Date().getMinutes() + ':' + new Date().getSeconds()),
    date_server    = null;

/*
    Gdy dokument się załaduje,
    jest gotowy do działania.
*/
$(document).ready(() => {
    // Ustaw ustawienia
    if (!$.cookie('id_palette'))     { $.cookie('id_palette',     id_palette,     { expires: 9999, path: '/' }); }
    if (!$.cookie('id_font-family')) { $.cookie('id_font-family', id_font_family, { expires: 9999, path: '/' }); } else { $('body').css('font-family', $.cookie('id_font-family')); }
    if (!$.cookie('id_font-color'))  { $.cookie('id_font-color',  id_font_color,  { expires: 9999, path: '/' }); } else { $('body').css('color', $.cookie('id_font-color')); }

    if (!$.cookie('id_user')) { $.cookie('id_user', -1, { expires: 9999, path: '/' }); }

    // Zarządzaj czasem
    date_server = getTime($('.server-time').text());
    timeUpdate(new Date(date_client), new Date(date_server));
    setInterval(clock, 1000);
    $('.client-timezone').text(Intl.DateTimeFormat().resolvedOptions().timeZone);

    // Dodaj metodę usuwania
    $(document).on('click', 'span[title="Usuń"]', clickDelete);

    // Pobierz kolory z palety
    var pal = new Palette($.cookie('id_palette'));

    // Stwórz style palety
    createPaletteStyle(pal);
});



class Palette {
    constructor(id) {
        let pal_obj = null;
        $.ajax({
            dataType: 'json',
            url: 'assets/data/colors.json',
            async: false,
            data: (data) => { console.log(data); },
            success: (data) => { print('Success! File "colors.json" was loaded!'); pal_obj = data; },
            error: (xhr, ajaxOptions, thrownError) => { console.log(thrownError); }
        });

        // Kolory palety
        this.cols = pal_obj.palettes[id];
        print('The number ' + id + ' palette was loaded!');
    }

    // Zwróć tablicę kolorów z palety
    getPalette() {
        return this.cols;
    }

    // Zwróć konkretny kolor z konkretnej palety
    getColor(col) {
        return this.cols[col];
    }
}



/* pal - tablica kolorów palety */
function createPaletteStyle (pal) {
    // Utwórz dynamiczne style
    let styles = '';
    for (i = 0; i < pal.cols.length; i++) {
        styles += '.__col' + i + ' { background-color: #' + pal.cols[i].hex + ' }';
    }

    // Dla svg
    styles += 'svg { fill: ' + $.cookie('id_font-color') + '}';
    
    // Dodaj
    $('head').append('<style>' + styles + '</style>');
}

// Programowa wiadomość
function print (msg, obj) {
    console.log('%cSystem: ' + '%c' + msg, 'color: red;', 'color: blue;', (obj) ? obj : "");
}



// function css (element, property) {
//     return window.getComputedStyle(document.querySelectorAll(element), null).getPropertyValue(eval(property));
// }

// alert(css('nav p', 'font-style'));


function getTime (date) {
    return new Date('2020-12-31 ' + date).getTime();
}

function clock() {
    date_client += 1000;
    date_server += 1000;

    let dc = new Date(date_client);
    let ds = new Date(date_server);

    timeUpdate(dc, ds);
}

function timeUpdate (dc, ds) {
    $('.client-time').text(
        ((dc.getHours() < 10) ? '0' + dc.getHours() : dc.getHours()) + ':' +
        ((dc.getMinutes() < 10) ? '0' + dc.getMinutes() : dc.getMinutes()) + ':' +
        ((dc.getSeconds() < 10) ? '0' + dc.getSeconds() : dc.getSeconds()));
    $('.server-time').text(
        ((ds.getHours() < 10) ? '0' + ds.getHours() : ds.getHours()) + ':' +
        ((ds.getMinutes() < 10) ? '0' + ds.getMinutes() : ds.getMinutes()) + ':' +
        ((ds.getSeconds() < 10) ? '0' + ds.getSeconds() : ds.getSeconds()));
}



function clickDelete () {
    if (confirm("Czy, aby na pewno chcesz usunąć ten rekord?")) {
        let parent_obj = $(this).closest('tr');
        let parent_val = parent_obj.attr('value');
    
        let table = $('h1 > strong').text();
    
        let d = JSON.parse('{ "table": "' + table + '", "id": "' + parent_val.split('-')[0] + '", "id2": "' + parent_val.split('-')[1] + '" }');
    
        // Usuń rekord
        $.ajax({
            url: 'site/tiles/delete_record.php',
            method: 'POST',
            dataType: 'json',
            data: d,
            async: false,
            success: (data) => { print('Success'); console.log('Received data:', data); location.reload(); },
            error: (x, y, z) => { console.log('Error:', x, y, z); }
        })
        .done(() => { print('Done!'); });
    }
    else alert("Może i dobrze zrobiłeś ;)");
}