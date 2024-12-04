$(document).ready(function () {
    // Load Collection Items via AJAX
    $.ajax({
        url: './fetch_collection.php',
        method: 'GET',
        success: function (data) {
            $('.collection-list').html(data);

            // Initialize Isotope after content is loaded
            var $grid = $('.collection-list').isotope({
                itemSelector: '.collection-item',
                layoutMode: 'fitRows',
            });

            // Trigger layout once images are fully loaded
            $grid.imagesLoaded().progress(function () {
                $grid.isotope('layout');
            });

            // Filter items on button click
            $('.filter-button-group').on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                resetFilterBtns();
                $(this).addClass('active-filter-btn');
                $grid.isotope({ filter: filterValue });
            });

            var filterBtns = $('.filter-button-group').find('button');
            function resetFilterBtns() {
                filterBtns.each(function () {
                    $(this).removeClass('active-filter-btn');
                });
            }

            // Initialize Lazy Loading
            initializeLazyLoading();
        },
        error: function () {
            console.error("Failed to load collection items.");
        },
    });

    // Load Special Products via AJAX
    $.ajax({
        url: './fetch_special.php',
        method: 'GET',
        success: function (data) {
            $('.special-list').html(data);
            initializeLazyLoading();
        },
        error: function () {
            console.error("Failed to load special products.");
        },
    });

    // Load Top Rated Products via AJAX
    $.ajax({
        url: './fetch_top_rated.php',
        method: 'GET',
        success: function (data) {
            $('.top-rated-list').html(data);
            initializeLazyLoading();
        },
        error: function () {
            console.error("Failed to load top-rated products.");
        },
    });

    // Lazy Loading Function
    function initializeLazyLoading() {
        const lazyImages = document.querySelectorAll("img.lazy");
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src; // Set the actual source
                    img.classList.remove("lazy"); // Remove lazy class
                    observer.unobserve(img); // Stop observing

                    // Trigger Isotope layout after image load
                    $('.collection-list').isotope('layout');
                }
            });
        });

        lazyImages.forEach((image) => {
            imageObserver.observe(image); // Observe each lazy image
        });
    }
});
