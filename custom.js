
jQuery(document).ready(function ($) {
    
   
        
    var currentPage = 1; // Initialize the current page
    
    // Function to load posts based on the selected page number
    function loadPosts(page) {
        var cityValue = jQuery('#city-dropdown').val();
        var dealerValue = jQuery('#dealer').val();
        var tagValue = jQuery('#tags-dropdown').val();
        jQuery('.loader').show();
        jQuery.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_content',
                currentPage: page,
                city: cityValue,
                dealer: dealerValue,
                tag: tagValue,
            },
            success: function (response) {
                jQuery('.loader').hide();
                jQuery('.filter-content').html(response);
            },
        });
    }

    // Initial form submission
    jQuery('#sub-btn').on('click', function (e) {
        e.preventDefault();
        currentPage = 1; // Reset current page to 1
        loadPosts(currentPage);
    });

    // Pagination click event
    jQuery(document).on('click', '.page-numbers', function (e) {
        e.preventDefault();

        var clickedPage = parseInt(jQuery(this).text());

        if (!isNaN(clickedPage)) {
            currentPage = clickedPage; 
            loadPosts(currentPage);
        } else if (jQuery(this).hasClass('next')) {
            currentPage++;
            loadPosts(currentPage);
        } else if (jQuery(this).hasClass('prev') && currentPage > 1) {
            currentPage--;
            loadPosts(currentPage);
        }
    });


});

