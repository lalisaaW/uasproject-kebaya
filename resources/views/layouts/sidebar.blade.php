<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @if(Auth::user()->ID_JENIS_USER == 1)
                    <!-- Admin Menu -->
                    <a class="nav-link" href="{{ route('main') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        <span class="menu-title">Dashboard</span>
                    </a>
                    <a class="nav-link" href="{{ route('menu_settings.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                        <span class="menu-title">Menu Settings</span>
                    </a>
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <div class="sb-nav-link-icon"><i class="icon-grid menu-icon"></i></div>
                        <span class="menu-title">User</span>
                    </a>
                    <a class="nav-link" href="{{ route('menus.index') }}">
                        <div class="sb-nav-link-icon"><i class="icon-grid menu-icon"></i></div>
                        <span class="menu-title">Menu</span>
                    </a>
                @else
                    <!-- User Menu - Dynamic Menus -->
                    <div id="approvedMenus">
                        @foreach($menus as $menu)
                            <a class="nav-link" href="{{ $menu->MENU_LINK }}">
                                <div class="sb-nav-link-icon"><i class="{{ $menu->MENU_ICON }}"></i></div>
                                {{ $menu->MENU_NAME }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </ul>
</nav>

@push('styles')
<style>
    /* Sidebar background and padding */
    #sidebar {
        background-color: #343a40;
        color: #fff;
        padding: 10px;
    }

    /* Styling for each menu item */
    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        transition: background-color 0.3s ease;
        border-radius: 5px;
    }

    /* Icon and Text Styling */
    .sb-nav-link-icon {
        margin-right: 10px;
    }

    .menu-title {
        font-weight: 500;
    }

    /* Hover effect */
    .nav-link:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Active link styling */
    .nav-link.active {
        background-color: #28a745;
    }

    /* Sidebar menu items when in user mode */
    #approvedMenus .nav-link {
        border-left: 3px solid transparent;
    }

    #approvedMenus .nav-link:hover {
        background-color: #495057;
        border-left-color: #007bff;
    }

    /* Responsiveness - collapsing sidebar for mobile */
    @media (max-width: 768px) {
        #sidebar {
            width: 80px;
        }

        .nav-link {
            text-align: center;
            padding: 10px;
        }

        .sb-nav-link-icon {
            margin-right: 0;
        }

        .menu-title {
            display: none;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        @if(Auth::user()->ID_JENIS_USER != 1)
            // Make AJAX request to fetch approved menus for non-admin users
            $.ajax({
                url: '{{ route("menu_settings.approved_menus") }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let menuHtml = '';
                    data.forEach(function(menu) {
                        menuHtml += `
                            <a class="nav-link" href="${menu.MENU_LINK}">
                                <div class="sb-nav-link-icon"><i class="${menu.MENU_ICON}"></i></div>
                                <span class="menu-title">${menu.MENU_NAME}</span>
                            </a>
                        `;
                    });
                    $('#approvedMenus').html(menuHtml);  // Insert dynamic menu items
                },
                error: function(xhr, status, error) {
                    console.error("Error loading approved menus:", error);
                }
            });
        @endif
    });
</script>
@endpush
