$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | SHOW DASHBOARD
    |--------------------------------------------------------------------------
    */

    $('.dashboard-main').hide().fadeIn(500);


    /*
    |--------------------------------------------------------------------------
    | THEME
    |--------------------------------------------------------------------------
    */

    const savedTheme =
        localStorage.getItem('dashboardTheme');

    if (savedTheme) {

        $('html').attr(
            'data-bs-theme',
            savedTheme
        );

        updateThemeIcon(savedTheme);

    }


    $('.theme-toggle').on('click', function () {

        const currentTheme =
            $('html').attr('data-bs-theme') || 'light';

        const newTheme =
            currentTheme === 'dark'
                ? 'light'
                : 'dark';

        $('html').attr(
            'data-bs-theme',
            newTheme
        );

        localStorage.setItem(
            'dashboardTheme',
            newTheme
        );

        updateThemeIcon(newTheme);

    });


    function updateThemeIcon(theme) {

        $('.toggleIcon')
            .removeClass(
                'bi-moon-stars bi-sun'
            );

        if (theme === 'dark') {

            $('.toggleIcon')
                .addClass('bi-sun');

        } else {

            $('.toggleIcon')
                .addClass('bi-moon-stars');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE SEARCH
    |--------------------------------------------------------------------------
    */

    $('#mobileSearchToggleBtn').on(
        'click',
        function () {

            const search =
                $('#mobileSearchComponent');

            search.toggleClass('active');

            if (search.hasClass('active')) {

                $('.mobile-search-input')
                    .trigger('focus');

            } else {

                $('.mobile-search-input')
                    .trigger('blur');

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | SCROLL ANIMATION
    |--------------------------------------------------------------------------
    */

    function checkScrollAnimations() {

        $('.fade-scroll-element').each(
            function () {

                const elementTop =
                    $(this).offset().top;

                const windowBottom =
                    $(window).scrollTop() +
                    $(window).height();

                if (
                    elementTop <
                    windowBottom - 40
                ) {

                    $(this)
                        .addClass('visible');

                }

            }
        );

    }


    $(window).on(
        'scroll resize',
        checkScrollAnimations
    );


    checkScrollAnimations();


    /*
    |--------------------------------------------------------------------------
    | MOBILE NAV TOUCH EFFECT
    |--------------------------------------------------------------------------
    */

    $('.mobile-dashboard-item').on(
        'touchstart',
        function () {

            $(this).css(
                'transform',
                'scale(.94)'
            );

        }
    );


    $('.mobile-dashboard-item').on(
        'touchend',
        function () {

            $(this).css(
                'transform',
                'scale(1)'
            );

        }
    );

});