require(['jquery'], function($) {
    'use strict';
    (function($) {
        "use strict";
        $('#ensign-nivoslider-3').nivoSlider({
            effect: 'fade',
            slices: 15,
            boxCols: 8,
            boxRows: 4,
            animSpeed: 500,
            pauseTime: 5000,
            startSlide: 0,
            directionNav: true,
            controlNavThumbs: true,
            pauseOnHover: true,
            manualAdvance: false
        });
    })(jQuery);
});