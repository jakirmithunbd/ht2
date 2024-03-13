jQuery(document).ready(function ($) {
    $('.salon-type span').on('click', function () {
        $('.salon-type span').removeClass('active');
        $(this).addClass('active');

        $('#searchblogpost').val('');

        const filterType = $(this).parent().hasClass('salon-tags')
            ? 'artist_tag'
            : 'salon_type';
        const salonSlug = $(this).data('slug');
        const data = {
            filterType,
            salonSlug,
        };
        loadPosts(data);
    });

    $('#searchblogpost').on('keyup', function () {
        let searchpost = $(this).val();
        loadPosts(null, searchpost);
    });

    function loadPosts(data = {}, searchpost = '') {
        let nonce = document.querySelector('.filter-nonce')?.dataset.nonce;

        $('#load-salon-posts').html(
            `<div class='preloader'><img src="${ajax.preloader}"/></div>`
        );

        wp.ajax
            .post('loadmore_posts', { data, nonce, searchpost })
            .done((res) => {
                if (res) {
                    $('#load-salon-posts').html(res.page);
                }
            })
            .fail((err) => {
                $('#load-salon-posts').html(err.message);
                console.log(err);
            });
    }

    loadPosts();

    // Ajax search

    $('#searchpost').on('keyup', function () {
        let searchedText = $(this).val();
        loadSearchPosts(searchedText);
    });

    function loadSearchPosts(searchedText = '') {
        let searchnonce =
            document.querySelector('.search-nonce')?.dataset.searchnonce;

        if( ! searchnonce ) {
			return;
		}
		
		console.log(searchnonce)

        $('#load-salon-posts').html(
            `<div class='preloader'><img src="${ajax.preloader}"/></div>`
        );

        wp.ajax
            .post('search_posts', { searchedText, searchnonce })
            .done((res) => {
                console.log(res.page);
                if (res.page) {
                    $('#load-searched-posts').html(res.page);
                }
            });
    }

    loadSearchPosts();


});
