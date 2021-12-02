$(document).ready(isReady);

function isReady () {
    $(document).on('click', 'nav > div:first-child', clickMainPage);
    $(document).on('click', 'nav > div > p', clickNavTile);
}

function clickMainPage () {
    window.location.href = window.location.origin + window.location.pathname + '/../main';
}

function clickNavTile () {
    let ul  = $(this).parent().children('ul');
    ul.slideToggle('fast');
}