$(document).ready(function() {
    const sidebar = $('#sidebar');
    const sidebarToggle = $('#sidebar-toggle');
    const closeBtn = $('#close-sidebar-btn');
    const wrapper = $('#admin-wrapper');
    const searchInput = $('#searchInput');
    const clearBtn = $('#clearSearch');

    const isMobile = () => window.innerWidth < 992;

    // Toggle sidebar mobile
    sidebarToggle.on('click', function() {
        if (isMobile()) {
            sidebar.toggleClass('-translate-x-full');
            if (sidebar.hasClass('-translate-x-full')) {
                closeBtn.addClass('hidden');
            } else {
                closeBtn.removeClass('hidden');
            }
        }
    });

    closeBtn.on('click', function() {
        if (isMobile()) {
            sidebar.addClass('-translate-x-full');
            closeBtn.addClass('hidden');
        }
    });

    // Logout Confirmation 
    $('#logout-btn').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah kamu yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
            confirmButtonColor: '#ff4d94',
            cancelButtonColor: '#6c757d',
        }).then((result) => {
            if (result.isConfirmed) $('#logout-form').submit();
        });
    });

    // Search clear button
    function setupClearSearch(inputSelector, clearBtnSelector, formSelector) {
        const input = $(inputSelector);
        const clearBtn = $(clearBtnSelector);
        const form = $(formSelector);

        function toggleBtn() {
            clearBtn.toggleClass('hidden', input.val().trim() === '');
        }

        input.on('input', toggleBtn);

        clearBtn.on('click', function() {
            input.val('');
            toggleBtn();
            form.submit();
        });

        toggleBtn(); 
    }

    // Desktop search
    setupClearSearch('#searchInput', '#clearSearch', '#searchForm');

    // Mobile search
    setupClearSearch('#mobileSearchInput', '#mobileClearSearch', '#mobileSearchForm');

    // Toggle mobile search dropdown
    const mobileSearchDropdown = $('#mobile-search-dropdown');
    $('#mobile-search-btn').on('click', function(e) {
        e.stopPropagation();
        mobileSearchDropdown.toggleClass('opacity-0 invisible translate-y-0 -translate-y-2 opacity-100 visible');
    });

    $(document).on('click', function(e) {
        if (!$('#mobile-search-btn').is(e.target) && $('#mobile-search-btn').has(e.target).length === 0 &&
            !mobileSearchDropdown.is(e.target) && mobileSearchDropdown.has(e.target).length === 0) {
            mobileSearchDropdown.addClass('opacity-0 invisible -translate-y-2')
                                .removeClass('opacity-100 visible translate-y-0');
        }
    });

    // Profile dropdown
    const profileBtn = $('.profile-initial-circle');
    const profileDropdown = profileBtn.next('ul');

    profileBtn.on('click', function(e) {
        e.stopPropagation();
        profileDropdown.toggleClass('hidden');
    });

    $(document).on('click', function() {
        profileDropdown.addClass('hidden');
    });
});
