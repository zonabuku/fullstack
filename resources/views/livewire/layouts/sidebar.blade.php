<div>
    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="{{ route('post.manager') }}">
                <img src="{{ asset('assets/img/logo/logo_webgis_sanggau.png') }}" alt="" class="dark-logo" />
                <img src="{{ asset('assets/img/logo/logo_webgis_sanggau.png') }}" alt="" class="light-logo" />
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li>
                        <a href="{{ route('post.manager') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('/') ? 'active' : '' }}">
                            <span class="micon dw dw-house-1"></span><span class="mtext">Post Manager</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>