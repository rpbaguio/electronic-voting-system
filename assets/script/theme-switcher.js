$(function() {
    // Theme switcher
    $('body').on('click', '.change-theme', function(e) {
        var theme_name = $(this).attr('rel');
        var theme = window.location.origin + "/assets/themes/" + theme_name + "/css/style.min.css";
        set_theme(theme);
        e.preventDefault();
    });

    function supports_html5_storage() {
        try {
            return 'localStorage' in window && window['localStorage'] !== null;
        } catch (e) {
            return false;
        }
    }
    var supports_storage = supports_html5_storage();

    function set_theme(theme) {
        $('link[title="main"]').attr('href', theme);
        if (supports_storage) {
            localStorage.theme = theme;
        }
    }

    // On load, set theme from local storage
    if (supports_storage) {
        var theme = localStorage.theme;
        if (theme) {
            set_theme(theme);
        }
    } else {
        // Don't annoy user with options that don't persist */
        $('#theme-dropdown').hide();
    }
})
