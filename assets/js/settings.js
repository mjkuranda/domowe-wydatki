$(document).ready(formReady);

// json form.json file
var json = null,
    pals = null;

function formReady () {
    // Add buttons events
    $(document).on('click', 'button[name="b_save"]', clickSave);

    // Getting json file
    $.ajax({
        data: 'json',
        url: 'assets/data/colors.json',
        async: false,
        success: (data) => { json = data; pals = data; },
        error: (x, y, z) => { print(x + ", " + y + ", " + z); }
    });

    // Adding all palettes
    json.palettes.forEach((el, i, arr) => {
        $('main fieldset#__main-settings select#__main-settings-list').append('<option id="col' + i + '" value="' + i + '">Paleta ' + (i + 1) + '</option>');
    });

    // --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---

    // Getting json file
    $.ajax({
        data: 'json',
        url: 'assets/data/settings.json',
        async: false,
        success: (data) => { json = data; },
        error: (x, y, z) => { print(x + ", " + y + ", " + z); }
    });

    // Adding all font families
    json.settings['font-family'].forEach((el, i, arr) => {
        $('main fieldset#__main-settings select#__main-settings-font-family').append('<option id="' + i + '" style="font-family: ' + el + '" value="' + el + '">' + el + '</option>');
    });

    // --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---

    // json.settings['font-color'].forEach((el, i, arr) => {
    //     $('main fieldset#__main-settings select#__main-settings-font-color').append('<option id="' + i + '" style="color: ' + el + '" value="' + el + '">' + el + '</option>');
    // });
    // let num = 0; // 16777215 = 0xFFFFFF
    // // 65536 
    // for (let n = num; n < (0xFFFFFF / 65536) + 1; n++) {
    //     let hex = (n * 65536).toString(16);
        
    //     // Jeżeli potrzeba zer...
    //     while (hex.length < 6) {
    //         hex = '0' + hex;       
    //     }

    //     console.log(hex);

    //     $('main fieldset#__main-settings select#__main-settings-font-color').append('<option id="' + n + '" style="color: ' + ('#' + hex) + '" value="' + ('#' + hex) + '">' + ('#' + hex) + '</option>');
    // }

    // Adding all font colors
    for (let n = 0; n < 4096; n+=15) {
        let bin = n.toString(4);
        // Jeżeli potrzeba zer...
        while (bin.length < 6) {
            bin = '0' + bin;   
        }

        let hex = bin;
        hex = hex.replaceAll('0', '0');
        hex = hex.replaceAll('1', '4');
        hex = hex.replaceAll('2', '9');
        hex = hex.replaceAll('3', 'F');
        
        console.log(bin, hex);

        $('main fieldset#__main-settings select#__main-settings-font-color').append('<option id="' + n + '" style="color: ' + ('#' + hex) + '" value="' + ('#' + hex) + '">' + ('#' + hex) + '</option>');
    }
    $('main fieldset#__main-settings select#__main-settings-font-color').append('<option style="color: #FFFFFF" value="#FFFFFF">#FFFFFF</option>');
    

    // --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- ---
    
    // Select settings
    $('select#__main-settings-list option[value="' + $.cookie('id_palette') + '"]').attr('selected', 'selected');
    $('select#__main-settings-font-family option[value="' + $.cookie('id_font-family') + '"]').attr('selected', 'selected');
    $('select#__main-settings-font-color option[value="' + $.cookie('id_font-color') + '"]').attr('selected', 'selected');

    // Add events
    $('select#__main-settings-list').change(function () {
        $('head style').remove();
        
        let el = $(this).children('option:selected').val();
        createPaletteStyle(new Palette(el));
    });
    $('select#__main-settings-font-family').change(function () {
        let el = $(this).children('option:selected').val();
        $('body').css('font-family', el);
    });
    $('select#__main-settings-font-color').change(function () {
        let el = $(this).children('option:selected').val();
        $('body').css('color', el);
    });
}



function clickSave () {
    let id_palette     = $('select#__main-settings-list').children('option:selected').val();
    let id_font_family = $('select#__main-settings-font-family').children('option:selected').val();
    let id_font_color  = $('select#__main-settings-font-color').children('option:selected').val();

    // console.log(
    //     id_palette,
    //     id_font_family,
    //     id_font_color
    // );

    $.cookie('id_palette',     id_palette,     { expires: 9999, path: '/' });
    $.cookie('id_font-family', id_font_family, { expires: 9999, path: '/' });
    $.cookie('id_font-color',  id_font_color,  { expires: 9999, path: '/' });

    location.reload();
}