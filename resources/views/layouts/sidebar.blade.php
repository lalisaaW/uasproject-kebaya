<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{-- @foreach($sidebarMenus as $menu)
            <li class="nav-item">
                <a class="nav-link" href="{{ $menu->menu_link }}">
                    <i class="{{ $menu->menu_icon }}"></i>
                    <span class="menu-title">{{ $menu->menu_name }}</span>
                    @if(!empty($menu->children))
                        <i class="menu-arrow"></i>
                    @endif
                </a>
                @if(!empty($menu->children))
                    <div class="collapse">
                        <ul class="nav flex-column sub-menu">
                            @foreach($menu->children as $childMenu)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $childMenu->menu_link }}">{{ $childMenu->menu_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach --}}
        <div class="position-sticky">
            <ul class="nav flex-column" id="sidebarMenu">
                <!-- Sidebar menu items will be dynamically inserted here -->
            </ul>
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('setmenu.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Setting Menu</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="pages/ui-features/buttons.html">Buttons</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="pages/ui-features/typography.html">Typography</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Form elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic
                            Elements</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                aria-controls="charts">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Charts</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="pages/charts/chartjs.html">ChartJs</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false"
                aria-controls="tables">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">Tables</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic
                            table</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false"
                aria-controls="icons">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html">
                            Register </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#error" aria-expanded="false"
                aria-controls="error">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500
                        </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../../docs/documentation.html">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>
@section('js')
<script>
$(document).ready(function() {
    $.ajax({
        url: "{{ route('setmenu.getApprovedMenus') }}",
        type: 'GET',
        success: function(menus) {
            var sidebarHtml = '';
            menus.forEach(function(menu) {
                sidebarHtml += `<li class="nav-item">
                    <a class="nav-link" href="${menu.menu_link}">
                        <i class="${menu.menu_icon}"></i>
                        ${menu.menu_name}
                    </a>`;
                if (menu.children && menu.children.length > 0) {
                    sidebarHtml += '<ul class="nav flex-column ml-3">';
                    menu.children.forEach(function(child) {
                        sidebarHtml += `<li class="nav-item">
                            <a class="nav-link" href="${child.menu_link}">
                                <i class="${child.menu_icon}"></i>
                                ${child.menu_name}
                            </a>
                        </li>`;
                    });
                    sidebarHtml += '</ul>';
                }
                sidebarHtml += '</li>';
            });
            $('#sidebarMenu').html(sidebarHtml);
        },
        error: function(xhr) {
            console.error('Error loading menus:', xhr.responseText);
        }
    });
});

function updateSidebar(menus) {
        var sidebarHtml = '';
        menus.forEach(function(menu) {
            sidebarHtml += `<li class="nav-item">
                <a class="nav-link" href="${menu.menu_link}">
                    <i class="${menu.menu_icon}"></i>
                    ${menu.menu_name}
                </a>`;
            if (menu.children && menu.children.length > 0) {
                sidebarHtml += '<ul class="nav flex-column ml-3">';
                menu.children.forEach(function(child) {
                    sidebarHtml += `<li class="nav-item">
                        <a class="nav-link" href="${child.menu_link}">
                            <i class="${child.menu_icon}"></i>
                            ${child.menu_name}
                        </a>
                    </li>`;
                });
                sidebarHtml += '</ul>';
            }
            sidebarHtml += '</li>';
        });
        $('#sidebarMenu').html(sidebarHtml);
    }
    
    // Ekspos fungsi updateSidebar ke objek window agar bisa diakses dari luar
    window.updateSidebar = updateSidebar;
</script>

@endsection