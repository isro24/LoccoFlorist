$(document).ready(function() {
    const sidebar = $('#sidebar');
    const sidebarToggle = $('#sidebar-toggle');
    const closeBtn = $('#close-sidebar-btn');
    const wrapper = $('#admin-wrapper');
    const searchInput = $('#searchInput');
    const clearBtn = $('#clearSearch');

    const isMobile = () => window.innerWidth < 992;

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

    $(document).on('click', function(e) {
        if (isMobile() && !$(e.target).closest('#sidebar, #sidebar-toggle, #close-sidebar-btn').length) {
            sidebar.addClass('-translate-x-full');
            closeBtn.addClass('hidden');
        }
    });

    $(window).on('resize', function() {
        if (isMobile()) {
            sidebar.addClass('-translate-x-full');
            closeBtn.addClass('hidden');
        } else {
            sidebar.removeClass('-translate-x-full');
            closeBtn.addClass('hidden');
        }
    });

    if (isMobile()) {
        sidebar.addClass('-translate-x-full');
        closeBtn.addClass('hidden');
    } else {
        sidebar.removeClass('-translate-x-full');
        closeBtn.addClass('hidden');
    }

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

    function toggleClearBtn() {
        if (searchInput.val().trim() !== '') {
            clearBtn.removeClass('hidden');
        } else {
            clearBtn.addClass('hidden');
        }
    }

    searchInput.on('input', toggleClearBtn);

    clearBtn.on('click', function() {
        searchInput.val('').focus();
        toggleClearBtn();
        $('#searchForm').submit();
    });

    toggleClearBtn();

    function removeAllTooltips() {
        $('#sidebar .nav-link, #logout-btn').each(function() {
            const $el = $(this);
            if ($el.data('bs.tooltip')) $el.tooltip('dispose');
            $el.removeAttr('title data-bs-original-title');
        });
    }

    function updateTooltips() {
        const isCollapsed = wrapper.hasClass('sidebar-collapsed') && !isMobile();
        removeAllTooltips();

        if (isCollapsed) {
            $('#sidebar .nav-link').each(function() {
                const text = $(this).find('.nav-text').text().trim();
                if (text) {
                    $(this).tooltip({
                        title: text,
                        placement: 'right',
                        trigger: 'hover',
                        delay: { show: 300, hide: 100 }
                    });
                }
            });

            $('#logout-btn').tooltip({
                title: 'Logout',
                placement: 'right',
                trigger: 'hover',
                delay: { show: 300, hide: 100 }
            });
        }
    }

    updateTooltips();

    $('#sidebar-toggle-desktop').on('click', function() {
        if (!isMobile()) {
            wrapper.toggleClass('sidebar-collapsed');
            updateTooltips();
        }
    });

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
