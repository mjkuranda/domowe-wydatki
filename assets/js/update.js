$(document).ready(updateReady);

function updateReady () {
    // Remove button
    $(document).off('click', 'form button[name="b_add"]', clickAdd);
    $(document).on('click', 'form button[name="b_add"]', clickUpdate);
    $('form button[name="b_clear"]').attr('disabled', 'disabled');
    
    $('h1 > p').text('Edycja tabeli');
    $('button[name="b_add"]').html('Edytuj!');

    let json = JSON.parse($('.form-info > div.hidden').text());
    let json_req = null;

    // Load all fields
    $.ajax({
        url: 'site/tiles/select_record.php',
        method: 'POST',
        data: json,
        dataType: 'html',
        async: false,
        success: (data) => { print('Success'); json_req = JSON.parse(data); json_req.data.Kwota = '0' + json_req.data.Kwota; },
        error: (x, y, z) => { console.log('Error:', x, y, z); }
    })
    .done(() => { print('Done!'); });

    // If all is good
    if (json_req != null) {
        // If data is null
        if (json_req.data == null) $('main > div.flex-center > div').html('Uppss... Coś poszło nie tak :/');
        else {
            Object.keys(json_req.data).forEach((el, id, arr) => {
                if ($('input[name="' + el + '"]').length != 0) {
                    if (typeof json_req.data[el] == 'object') $('input[name="' + el + '"]').val(json_req.data[el].date.split(' ')[0]);
                    else $('input[name="' + el + '"]').val(json_req.data[el]);
                } else
                if ($('select[name="' + el + '"]').length != 0) {
                    $('select[name="' + el + '"]').val(json_req.data[el]);
                } else
                if ($('textarea[name="' + el + '"]').length != 0) {
                    $('textarea[name="' + el + '"]').val(json_req.data[el]);
                }
            });
        }
    }
}

function clickUpdate () {
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
            if (inputs.lenth != 0) form_json += ', '; // end of inputs
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
        js.form = JSON.parse(form_json);
        js.user = JSON.parse('{ "id": "' + $.cookie('id_user') + '" }');
        console.log('Given JSON:', js);

        // Update subquery
        // let que = "";
        // Object.keys(js.form).forEach((el, id, arr) => {
        //     que += "[" + el + "] = '" + Object.values(js.form)[id] + "'";
        //     if (arr.length-1 != id) que += ", ";
        // });
        // js.subquery = que;

        // Dodaj rekord
        $.ajax({
            url: 'site/tiles/update_record.php',
            method: 'POST',
            data: js,
            dataType: 'json',
            async: false,
            success: (data) => { print('Success'); console.log('Received data:', data); $('.form-info > p').html('Rekord został zaktualizowany poprawnie!'); $('.form-info').addClass('form-info-notempty'); $('.__correct').removeClass('__correct');
            },
            error: (x, y, z) => { console.log('Error:', x, y, z); }
        })
        .done(() => { print('Done!'); });
    }

    return false;
}