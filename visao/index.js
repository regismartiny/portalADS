$(document).ready(function () {
    //////////////////////////////Controle de navegação de páginas//////////////////////////
    var newHash = '',
        $conteudoCentral = $('#container-conteudo');

    $('body').delegate('a', 'click', function () {
        let attr = $(this).attr('href')
        if (attr.startsWith('/')) {
            window.location.hash = attr;
            return false;
        }
        return true;
    });

    // Not all browsers support hashchange
    // For older browser support: http://benalman.com/projects/jquery-hashchange-plugin/
    $(window).on('hashchange', function () {
        newHash = window.location.hash.substr(1);
        $conteudoCentral.load('/visao' + newHash, function () {
            console.log('Página carregada: ' + newHash);
        });
    });
    ///////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////Controle do menu/////////////////////////////////////////
    $('.dropdown-item').click(function () {
        if (isMenuExpandido()) {
            toggleMenu();
        }
        $('.dropdown-item').removeClass('active');
        $(this).addClass('active');
    });
    $('.nav-item').click(function () {
        let isDropDown = $(this).hasClass('dropdown');
        if (isMenuExpandido() && !isDropDown) {
            toggleMenu();
        }
        $('.nav-item').removeClass('active');
        $(this).addClass('active');
    });
});

function isMenuExpandido() {
    $('#navbar-toggler').attr('aria-expanded') === 'true';
}

function toggleMenu() {
    $('.collapse').collapse('toggle');
}