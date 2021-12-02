$(document).ready(formReady);

// json form.json file
var json = null,
    curr_table = null,
    datas = null;

function formReady () {
    // Add buttons events
    $(document).on('click', 'form button[name="b_add"]', clickAdd);

    // Get url datas
    datas = JSON.parse($('.form-info > div.hidden').text());

    // Getting json file
    $.ajax({
        data: 'json',
        url: 'assets/data/form.json',
        async: false,
        success: (data) => { json = data; },
        error: (x, y, z) => { print(x + ", " + y + ", " + z); }
    });

    // Adding all tags to form
    json[datas.table].elements.forEach(element => {
        // Attributes
        let attrs = '';
        let keys   = Object.keys(element);
        let values = Object.values(element);
        
        for (let i = 1; i < keys.length; i++) {
            attrs += ' ' + keys[i] + '="' + values[i] + '"';
        }

        let html_tag = '';
        if (element.tag != 'select' && element.tag != 'textarea') html_tag = '<' + element.tag + attrs + ' />';
        else html_tag = '<' + element.tag + attrs + '></' + element.tag + '>';

        $('main form section.form-datas > fieldset').append('<div class="flex-center"></div>');
        $('main form section.form-datas > fieldset > div:last-child').append('<div class="flex-right"><label for="' + element.name + '">' + element.name + ':</label></div>');
        $('main form section.form-datas > fieldset > div:last-child').append('<div class="flex-left">' + html_tag + '</div>');
    });

    // Adding all options to elements
    json[datas.table].select.forEach(element => {
        if (datas.table != 'Uprawnienia') {
            let select = $('select[id="' + element + '"]');
            
            // Printing
            console.log(element, select);

            // Adding options
            $.ajax({
                url: 'site/tiles/get_all_options.php',
                method: 'POST',
                data: { "table": element, "reg": datas.register },
                dataType: 'html',
                async: false,
                success: (data) => { print('Success'); $('select#' + element).html(data); },
                error: (x, y, z) => { console.log('Error:', x, y, z); }
            })
            .done(() => { print('Done!'); });
        }
    });

    // Assignment
    curr_table = json[datas.table].elements;

}

function clickAdd () {
    let inputs    = document.forms[0].querySelectorAll('input');
    let selects   = document.forms[0].querySelectorAll('select');
    let textareas = document.forms[0].querySelectorAll('textarea');
    let result = true;

    // Inputs
    for (let i = 0; i < inputs.length; i++) {
        let regex = new RegExp(inputs[i].pattern);
        let value = inputs[i].value;

        // Jeśli wystąpił problem
        if (!regex.test(value) || value === '' || (inputs[i].type === 'date' && (new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()).getTime()) > (new Date(inputs[i].value).getTime()) )) {
            print('Input "' + inputs[i].name + '" incorrect!');
            inputs[i].focus();
            $(inputs[i]).addClass('__wrong').removeClass('__correct');
            result = false;
            alert('Wprowadzone dane są niepoprawne!');
            break;
        }
        else $(inputs[i]).addClass('__correct').removeClass('__wrong');
    }

    $(selects).each((i, el) => {
        $(el).addClass('__correct').removeClass('__wrong');
    });

    // Textareas
    if (result)
    $(textareas).attr('required', true).each((i, el) => {
        if (el.value === '') {
            print('Textarea "' + el.name + '" incorrect!');
            el.focus();
            $(el).addClass('__wrong').removeClass('__correct')
            result = false;
            alert('Wprowadzone dane są niepoprawne!');
        }
        else $(el).addClass('__correct').removeClass('__wrong');
    });

    if (result) {
        // Creating basic JSON with basic structure
        let js = JSON.parse($('section.form-info > div').text());

        // JSON with form
        let form_json = '{';
        if (inputs.length != 0) {
            inputs.forEach((el, i, array) => {
                form_json += '"' + el.name + '": "' + el.value + '"';
                if (!(i === array.length - 1)) form_json += ', ';
            });
        }
        if (selects.length != 0) {
            if (inputs.length != 0) form_json += ', '; // end of inputs
            selects.forEach((el, i, array) => {
                form_json += '"' + el.name + '": "' + $(el).children(':selected').attr('id') + '"';
                if (!(i === array.length - 1)) form_json += ', ';
            });
        }
        if (textareas.length != 0) {
            if (inputs.lenth != 0 || selects.length != 0) form_json += ', '; // end of inputs/selects
            textareas.forEach((el, i, array) => {
                form_json += '"' + el.name + '": "' + el.value + '"';
                if (!(i === array.length - 1)) form_json += ', ';
            });
        }

        form_json += '}';

        // Completing
        console.log(form_json);
        js.form = JSON.parse(form_json);
        js.user = JSON.parse('{ "id": "' + $.cookie('id_user') + '" }');
        console.log('Given JSON:', js);

        let samename = false;
        if (datas.register == true) {
            $.ajax({
                url: 'site/tiles/get_Użytkownicy_Ile.php',
                method: 'POST',
                data: { "Nazwa": $('input[name="Nazwa użytkownika"]').val() },
                dataType: 'json',
                async: false,
                success: (data) => { print('Count:', data.count); if (data.count != null) samename = true; },
                error: (x, y, z) => { console.log('Error:', x, y, z); }
            })
            .done(() => {
                console.log('Counted...');
                if (samename) $('.form-info > p').html('Użytkownik o podanej nazwie istnieje już w bazie!'); });
        }

        if (samename == false || samename == undefined) {
            // Dodaj rekord
            $.ajax({
                url: 'site/tiles/insert_new_record.php',
                method: 'POST',
                data: js,
                dataType: 'json',
                async: false,
                success: (data) => { print('Success'); console.log('Received data:', data); $('.form-info > p').html('Rekord został dodany poprawnie!'); $('.form-info').addClass('form-info-notempty'); $('.__correct').removeClass('__correct');
                },
                error: (x, y, z) => { console.log('Error:', x, y, z); }
            })
            .done(() => { print('Done!'); document.forms[0].reset(); document.forms[0].elements[1].focus(); if (datas.table == 'Uprawnienia') $('select[name="Zasada"]').html(''); });
        }
    }
    return false;
}

function getRegExp (expression) {
    return '/' + expression + '/';
}